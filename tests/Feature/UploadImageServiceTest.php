<?php

namespace Tests\Feature;

use App\Services\UploadImageService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadImageServiceTest extends TestCase
{
    /**
     * Test for upload image.
     * 
     * @return void
     */
    public function testUploadImageSuccess(): void
    {
        $this->seed(class: UserSeeder::class);

        Storage::fake(disk: 'public/storage/user-images');

        $this->post(uri: '/tests/sign-in', data: [
            'email' => "annaspratama@outlook.com",
            'password' =>  "Admin12&3"
        ]);

        $this->post(uri: '/tests/upload-image', data: [
            'profile_image' => UploadedFile::fake()->image(name: 'profile-image.jpg')
        ])
        ->assertStatus(status: 200)
        ->assertJsonStructure(structure: [
            'data' => [
                'image_path'
            ]
        ]);
    }
}
