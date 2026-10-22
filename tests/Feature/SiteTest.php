<?php

namespace Tests\Feature;

use App\Models\GalleryImage;
use App\Models\HeroSlide;
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

    public function test_admin_shortcuts_only_show_for_admins(): void
    {
        $story = Story::first();

        $this->get('/stories')->assertDontSee('Add a story')->assertDontSee('/admin/stories/create');
        $this->get('/stories/'.$story->slug)->assertDontSee('Edit this story');

        $this->actingAs(User::factory()->create());
        $this->get('/stories')->assertDontSee('Add a story');

        $this->actingAs($this->admin());
        $this->get('/stories')->assertSee('Add a story')->assertSee(route('admin.stories.create'));
        $this->get('/stories/'.$story->slug)->assertSee('Edit this story')->assertSee(route('admin.stories.edit', $story));
    }

    public function test_gallery_admin_controls_only_show_for_admins(): void
    {
        $image = GalleryImage::first();

        $this->get('/gallery')
            ->assertDontSee('Upload photos')
            ->assertDontSee('class="admin-tools"', false)
            ->assertDontSee(route('admin.gallery.destroy', $image));

        $this->actingAs($this->admin());
        $this->get('/gallery')
            ->assertSee('Upload photos')
            ->assertSee(route('admin.gallery.edit', ['gallery' => $image, 'return' => '/gallery']), false)
            ->assertSee(route('admin.gallery.destroy', $image));
    }

    public function test_admin_returns_to_public_gallery_after_upload_and_edit(): void
    {
        $this->actingAs($this->admin());
        $image = GalleryImage::first();

        $this->put("/admin/gallery/{$image->id}", ['title' => 'Prize giving', 'return' => '/gallery?category=Awards'])
            ->assertRedirect('/gallery?category=Awards');
        $this->assertSame('Prize giving', $image->fresh()->title);

        $this->post('/admin/gallery', ['images' => [UploadedFile::fake()->image('new.jpg')], 'return' => '/gallery'])
            ->assertRedirect('/gallery');
        $this->get('/gallery')->assertSee('Image uploaded.');

        foreach (GalleryImage::where('image', 'like', 'uploads/%')->get() as $uploaded) {
            $this->delete("/admin/gallery/{$uploaded->id}", [], ['HTTP_REFERER' => url('/gallery')])->assertRedirect('/gallery');
        }
    }

    public function test_return_parameter_cannot_redirect_off_site(): void
    {
        $this->actingAs($this->admin());
        $image = GalleryImage::first();

        foreach (['https://evil.example', '//evil.example', '/\\evil.example'] as $bad) {
            $this->put("/admin/gallery/{$image->id}", ['title' => 'x', 'return' => $bad])->assertRedirect('/admin/gallery');
        }
    }

    public function test_home_banner_shows_seeded_slide_with_highlight(): void
    {
        $this->get('/')->assertSee('Making <em>champions</em> out of the forgotten.', false);
    }

    public function test_admin_can_add_edit_and_delete_banner_slides(): void
    {
        $this->actingAs($this->admin());
        $this->get('/admin/hero')->assertOk();
        $this->get('/admin/hero/create')->assertOk();

        $this->post('/admin/hero', [
            'image' => UploadedFile::fake()->image('hero.jpg', 1920, 1080),
            'title' => 'Hope for *every* child',
            'subtitle' => 'A brand new banner',
            'is_active' => '1',
            'sort_order' => 1,
        ])->assertRedirect('/admin/hero');

        $slide = HeroSlide::where('title', 'Hope for *every* child')->firstOrFail();
        $this->assertFileExists(public_path($slide->image));

        $this->get('/')
            ->assertSee('Hope for <em>every</em> child', false)
            ->assertSee('A brand new banner')
            ->assertSee('data-bs-ride="carousel"', false);

        $this->get("/admin/hero/{$slide->id}/edit")->assertOk();
        $this->put("/admin/hero/{$slide->id}", ['title' => 'Hidden slide', 'is_active' => '0'])->assertRedirect('/admin/hero');
        $this->get('/')->assertDontSee('Hidden slide')->assertDontSee('data-bs-ride="carousel"', false);

        $image = $slide->image;
        $this->delete("/admin/hero/{$slide->id}")->assertRedirect();
        $this->assertDatabaseMissing('hero_slides', ['id' => $slide->id]);
        $this->assertFileDoesNotExist(public_path($image));
    }

    public function test_banner_slide_transition_is_saved_and_rendered(): void
    {
        $this->actingAs($this->admin());

        $this->post('/admin/hero', [
            'image' => UploadedFile::fake()->image('hero.jpg', 1920, 1080),
            'title' => 'Wipe slide',
            'transition' => 'wipe',
            'is_active' => '1',
            'sort_order' => 5,
        ])->assertRedirect('/admin/hero');

        $slide = HeroSlide::where('title', 'Wipe slide')->firstOrFail();
        $this->assertSame('wipe', $slide->transition);
        $this->get('/')->assertSee('data-fx="wipe"', false);
        $this->get('/admin/hero')->assertSee('Curtain wipe');

        $this->put("/admin/hero/{$slide->id}", ['title' => 'Wipe slide', 'transition' => 'explode', 'is_active' => '1'])
            ->assertSessionHasErrors('transition');
        $this->put("/admin/hero/{$slide->id}", ['title' => 'Wipe slide', 'is_active' => '1']);
        $this->assertSame('fade', $slide->fresh()->transition);

        $this->delete("/admin/hero/{$slide->id}");
    }

    public function test_banner_headline_html_is_escaped(): void
    {
        HeroSlide::query()->update(['title' => '<script>alert(1)</script> *Hi*']);

        $this->get('/')
            ->assertDontSee('<script>alert(1)</script>', false)
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt; <em>Hi</em>', false);
    }

    public function test_home_falls_back_to_default_banner_when_no_slide_is_active(): void
    {
        HeroSlide::query()->update(['is_active' => false]);

        $this->get('/')->assertOk()->assertSee('Making <em>champions</em> out of the forgotten.', false);
    }

    public function test_banner_slide_requires_an_image(): void
    {
        $this->actingAs($this->admin());

        $this->post('/admin/hero', ['title' => 'No photo'])->assertSessionHasErrors('image');
        $this->post('/admin/hero', ['title' => 'x', 'image' => UploadedFile::fake()->create('a.pdf', 10, 'application/pdf')])->assertSessionHasErrors('image');
    }

    public function test_guests_cannot_manage_the_banner(): void
    {
        $slide = HeroSlide::first();

        $this->get('/admin/hero')->assertRedirect('/admin/login');
        $this->delete("/admin/hero/{$slide->id}")->assertRedirect('/admin/login');
        $this->get('/')->assertDontSee('Edit banner');
        $this->assertDatabaseHas('hero_slides', ['id' => $slide->id]);
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
