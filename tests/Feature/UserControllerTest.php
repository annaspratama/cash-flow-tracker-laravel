<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    /**
     * Test for sign in success.
     * 
     * @return void
     */
    public function testSignInSuccess(): void
    {
        $this->seed(class: UserSeeder::class);

        $this->post(uri: '/action-sign-in', data: [
            'email' => "annaspratama@icloud.com",
            'password' =>"Admin12&3"
        ])
        ->assertRedirectToRoute(name: 'dashboard-dashboard-page');
    }

    /**
     * Test for sign in success.
     * 
     * @return void
     */
    public function testSignInFail(): void
    {
        $this->seed(class: UserSeeder::class);

        $this->post(uri: '/action-sign-in', data: [
            'email' => "annaspratama@icloud.com",
            'password' =>"Admin12&4"
        ])
        ->assertSessionHasErrors(keys: ['error']);
    }

    /**
     * Test for register new user success.
     * 
     * @return void
     */
    public function testRegisterSuccess(): void
    {
        $this->post(uri: '/action-register', data: [
            'email' => "annaspratama@icloud.com",
            'first_name' => "Annas",
            'last_name' => "Pratama",
            'password' => "Admin12&3",
            'g-recaptcha-response' => true
        ])
        ->assertSessionHas(key: 'success', value: "You've been registered. Check your email to verify your account.");
    }

    /**
     * Test for register new user fail.
     * 
     * @return void
     */
    public function testRegisterFail(): void
    {
        $this->post(uri: '/action-register', data: [
            'email' => "annaspratama@icloud.com",
            'first_name' => "Annas",
            'last_name' => "Pratama",
            'password' => "Admin12&3"
        ])
        ->assertSessionHasErrors(keys: ['g-recaptcha-response']);

        $user = User::where(column: 'email', operator: '=', value: "annaspratama@icloud.com")->first();
        self::assertEquals(expected: null, actual: $user);
    }
}
