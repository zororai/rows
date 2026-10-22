<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use App\Models\HeroSlide;
use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@roseofsharon.co.zw')],
            [
                'name' => env('ADMIN_NAME', 'Site Administrator'),
                'password' => env('ADMIN_PASSWORD', 'ChangeMe123!'),
                'is_admin' => true,
            ],
        );

        if (Story::doesntExist()) {
            $this->seedStories();
        }

        if (GalleryImage::doesntExist()) {
            $this->seedGallery();
        }

        if (HeroSlide::doesntExist()) {
            HeroSlide::fallback()->save();
        }
    }

    /** The alumni testimonials from the original static site. */
    private function seedStories(): void
    {
        $stories = [
            ['Marlena Ngonyamo: from our home to a Masters in Theology', 'images/news/test2.png', 'Marlena Ngonyamo, a vulnerable child who came to our orphanage at the age of 9. She studied Social Work at Trevecca University in Tennessee, USA, and graduated with a Masters of Arts in Theology at Theological College in Manchester, England.'."\n\n".'Her dream is to be able to offer opportunities to those suffering and in poverty in order to break generational cycles of poverty.'],
            ['Bestman Mhlanga: studying Law at the University of Zimbabwe', 'images/news/test4.png', 'Bestman Mhlanga came to our orphanage at age 10 and went on to obtain 14 points at Advanced Level.'."\n\n".'He studied Law at the University of Zimbabwe and he is currently employed at a law firm in Harare.'],
            ['Misheck Marungamise: Junior Councillor to law student', 'images/news/test6.png', 'Misheck Marungamise joined Rose of Sharon at the age of 15 and served as a Ruwa Town Junior Councillor.'."\n\n".'He is currently studying applied law at the Zimbabwe Institute of Legal Studies.'],
            ['Boaz Chishiri: Junior Mayor and our IT Manager', 'images/news/test8.png', 'Boaz Chishiri came to our orphanage at age 9. He was the Junior Mayor of Ruwa Town Council for 2016.'."\n\n".'Today he is attached at our orphanage as the IT Manager.'],
            ['Tinashe Chari: studying Accounting at UZ', 'images/news/test10.png', 'Tinashe Chari joined Rose of Sharon at the age of 8. He obtained 13 points at A Level.'."\n\n".'He is currently studying Accounting at the University of Zimbabwe.'],
            ['Jefrey Mhlanga: now a successful businessman', 'images/news/test12.png', 'Jefrey Mhlanga came to Rose of Sharon in 2006 and served as a Ruwa Town Junior Councillor.'."\n\n".'He is now a successful businessman.'],
            ['Mellisa Ndowa: former Deputy Mayoress', 'images/news/test14.png', 'Mellisa Ndowa, the former Deputy Mayoress at Ruwa Junior Council, came to our orphanage at the tender age of 13.'."\n\n".'She is currently studying Human Resources at Midlands State University.'],
            ['Bradley Dimikira: Junior Mayor 2020', 'images/news/test16.png', 'Bradley Dimikira came to our orphanage as a baby. Both of his parents are blind.'."\n\n".'He was the Junior Mayor of Ruwa Town Council for 2020 and is currently enrolled at the University of Zimbabwe, where he is pursuing his degree in Human Capital.'],
            ['Lhekwasi Patsurayi: now a full-time teacher', 'images/news/final.png', 'Lhekwasi Patsurayi joined us when she was 16 years old. She is blind.'."\n\n".'She went on to attain a Bachelor of Arts Honours degree in African Languages and Culture from Midlands State University, and is now a full-time teacher at Marlborough High.'],
            ['Arkinia Ngonyamo: Junior Councillor 2020', 'images/news/test18.png', 'Arkinia Ngonyamo came to our orphanage as a baby. She served as a Ruwa Town Junior Councillor in 2020.'."\n\n".'She is currently enrolled at Midlands State University, studying Human Resources.'],
            ['Keldon Patel: Pastor and businessman', 'images/news/test20.png', 'Keldon Patel and his late twin brother were admitted into our orphanage at the tender age of six years, after both parents perished because of the pandemic disease.'."\n\n".'He graduated with an associate degree in Theology from Faith World Bible School and he is now a successful Pastor and businessman.'],
        ];

        foreach ($stories as $i => [$title, $image, $body]) {
            Story::create([
                'title' => $title,
                'slug' => Story::uniqueSlug($title),
                'excerpt' => strtok($body, "\n"),
                'body' => $body,
                'image' => $image,
                'is_published' => true,
                'published_at' => now()->subDays($i),
            ]);
        }
    }

    private function seedGallery(): void
    {
        $images = [
            ['images/award1.png', 'Awards', true],
            ['images/award2.png', 'Awards', true],
            ['images/award4.png', 'Awards', false],
            ['images/award5.png', 'Awards', false],
            ['images/award6.png', 'Awards', false],
            ['images/award7.png', 'Awards', false],
            ['images/award8.png', 'Awards', false],
            ['images/award9.png', 'Awards', false],
            ['images/awards.jpg', 'Awards', true],
            ['images/DSC_0026.jpg', 'Our children', true],
            ['images/IMG_8020.jpg', 'Our children', true],
            ['images/DSC_0110.JPG', 'Our children', true],
            ['images/hero4.jpg', 'High School', true],
            ['images/farming.png', 'Projects', true],
            ['images/chicken.png', 'Projects', false],
            ['images/mai.png', 'Projects', false],
        ];

        foreach ($images as $i => [$image, $category, $onHome]) {
            GalleryImage::create([
                'image' => $image,
                'category' => $category,
                'show_on_home' => $onHome,
                'sort_order' => $i,
            ]);
        }
    }
}
