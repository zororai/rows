<?php

namespace Tests\Feature;

use App\Models\GalleryImage;
use App\Models\Story;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    private function admin(): User
    {
        return User::where('is_admin', true)->firstOrFail();
    }

    public function test_public_pages_render(): void
    {
        foreach (['/', '/history', '/causes', '/homes', '/school', '/publications', '/founder', '/projects', '/contact', '/donate', '/stories', '/gallery', '/gallery?category=Awards'] as $url) {
            $this->get($url)->assertOk();
        }

        $this->get('/stories/'.Story::first()->slug)->assertOk();
        $this->get('/test.html')->assertRedirect('/stories');
    }

    public function test_home_shows_latest_stories(): void
    {
        $this->get('/')->assertSee(Story::published()->first()->title);
    }

    public function test_drafts_are_hidden(): void
    {
        $draft = Story::create(['title' => 'Secret draft', 'slug' => 'secret-draft', 'body' => 'x', 'is_published' => false]);

        $this->get('/stories')->assertDontSee('Secret draft');
        $this->get('/stories/'.$draft->slug)->assertNotFound();
    }

    public function test_admin_requires_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/stories/create')->assertRedirect('/admin/login');
    }

    public function test_non_admin_users_are_forbidden(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/admin')->assertForbidden();
    }

    public function test_admin_can_log_in(): void
    {
        $this->post('/admin/login', ['email' => 'admin@roseofsharon.co.zw', 'password' => 'ChangeMe123!'])
            ->assertRedirect('/admin');

        $this->get('/admin')->assertOk()->assertSee('Welcome back');
    }

    public function test_wrong_password_is_rejected(): void
    {
        $this->post('/admin/login', ['email' => 'admin@roseofsharon.co.zw', 'password' => 'nope'])
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_admin_can_create_edit_and_delete_a_story(): void
    {
        $this->actingAs($this->admin());

        $this->post('/admin/stories', [
            'title' => 'Graduation day',
            'body' => "First paragraph.\n\nSecond paragraph.",
            'is_published' => '1',
            'image' => UploadedFile::fake()->image('cover.jpg', 800, 600),
        ])->assertRedirect('/admin/stories');

        $story = Story::where('title', 'Graduation day')->firstOrFail();
        $this->assertSame('graduation-day', $story->slug);
        $this->assertFileExists(public_path($story->image));

        $this->get('/stories/graduation-day')->assertOk()->assertSee('Second paragraph.');

        $this->put("/admin/stories/{$story->slug}", ['title' => 'Graduation day 2026', 'body' => 'Updated', 'is_published' => '1'])
            ->assertRedirect('/admin/stories');
        $this->assertSame('graduation-day-2026', $story->fresh()->slug);

        $image = $story->fresh()->image;
        $this->delete('/admin/stories/graduation-day-2026')->assertRedirect();
        $this->assertDatabaseMissing('stories', ['id' => $story->id]);
        $this->assertFileDoesNotExist(public_path($image));
    }

    public function test_admin_can_upload_and_delete_gallery_images(): void
    {
        $this->actingAs($this->admin());

        $this->post('/admin/gallery', [
            'images' => [UploadedFile::fake()->image('a.jpg'), UploadedFile::fake()->image('b.png')],
            'category' => 'Events',
            'show_on_home' => '1',
        ])->assertRedirect('/admin/gallery');

        $uploaded = GalleryImage::where('category', 'Events')->get();
        $this->assertCount(2, $uploaded);

        $this->get('/gallery?category=Events')->assertOk()->assertSee($uploaded->first()->image);

        foreach ($uploaded as $image) {
            $this->delete("/admin/gallery/{$image->id}")->assertRedirect();
            $this->assertFileDoesNotExist(public_path($image->image));
        }
    }

    public function test_seeded_images_are_never_deleted_from_disk(): void
    {
        $this->actingAs($this->admin());
        $seeded = GalleryImage::where('image', 'like', 'images/%')->firstOrFail();

        $this->delete("/admin/gallery/{$seeded->id}")->assertRedirect();
        $this->assertFileExists(public_path($seeded->image));
    }

    public function test_uploads_reject_non_images(): void
    {
        $this->actingAs($this->admin());

        $this->post('/admin/gallery', ['images' => [UploadedFile::fake()->create('evil.php', 1, 'text/x-php')]])
            ->assertSessionHasErrors('images.0');
    }
}
