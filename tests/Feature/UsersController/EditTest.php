<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Storage;

class EditTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * 異常系：gif(jpeg, png, jpg以外のファイル形式)のアップロード
     */
    public function testEditProfileImageFormatValidation()
    {
        $user = factory(User::class)->create();
        $dummy_image = UploadedFile::fake()->image('test.gif')->size(100);
        $attributes = [
            'name'  => $user['name'],
            'email' => $user['email'],
            'profile_image' => $dummy_image
        ];

        $response = $this->actingAs($user)->put('/users/1', $attributes);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'profile_image' => 'profile imageにはjpeg, png, jpgタイプのファイルを指定してください。',
        ]);
    }

    /**
     * 異常系：2048 kB以上のファイルのアップロード
     */
    public function testEditProfileImageOversizeValidation()
    {
        $user = factory(User::class)->create();
        $dummy_image = UploadedFile::fake()->image('test.png')->size(2049);
        $attributes = [
            'name'  => $user['name'],
            'email' => $user['email'],
            'profile_image' => $dummy_image
        ];

        $response = $this->actingAs($user)->put('/users/1', $attributes);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'profile_image' => 'profile imageには、2048 kB以下のファイルを指定してください。',
        ]);
    }

    public function testEditProfile()
    {
        $user = factory(User::class)->create();
        $url = url('/users/1');
        $response = $this->actingAs($user)->get($url);

        $response->assertStatus(200);
    }
}