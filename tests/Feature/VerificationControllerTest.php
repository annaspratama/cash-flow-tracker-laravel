<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Tests\TestCase;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class VerificationControllerTest extends TestCase
{
    /**
     * Test for forgot password success.
     * 
     * @return void
     */
    public function testForgotPasswordSuccess(): void
    {
        $this->seed(class: UserSeeder::class);

        $this->post(uri: '/send-recover-password-link', data: [
            'email' => "annaspratama@icloud.com",
            'g-recaptcha-response' => true
        ])
        ->assertSessionHas(key: 'status');
    }

    /**
     * Test for forgot password fail.
     * 
     * @return void
     */
    public function testForgotPasswordFail(): void
    {
        $this->seed(class: UserSeeder::class);

        $this->post(uri: '/send-recover-password-link', data: [
            'email' => "annaspratama@icloud.com"
        ])
        ->assertSessionMissing(key: 'status')
        ->assertSessionHasErrors(keys: 'g-recaptcha-response');
    }

    /**
     * Test for recover password by given link via email success.
     * 
     * @return void
     */
    public function testRecoverPasswordLinkSuccess(): void
    {
        $this->seed(class: UserSeeder::class);

        $this->post(uri: '/send-recover-password-link', data: [
            'email' => "annaspratama@icloud.com",
            'g-recaptcha-response' => true
        ]);

        $user = User::query()->where(column: 'email', operator: '=', value: "annaspratama@icloud.com")->first();
        $token = $token = Password::createToken($user);

        $this->post(uri: '/recover-password', data: [
            'token' => $token,
            'email' => "annaspratama@icloud.com",
            'password' => "UnitedGGMU",
            'password_confirmation' => "UnitedGGMU"
        ])
        ->assertRedirectToRoute(name: 'auth-signin-page')
        ->assertSessionHas(key: 'status');
    }

    /**
     * Test for recover password by given link via email fail.
     * 
     * @return void
     */
    public function testRecoverPasswordLinkFail(): void
    {
        $this->seed(class: UserSeeder::class);

        $this->post(uri: '/recover-password', data: [
            'email' => "annaspratama@icloud.com",
            'password' => "UnitedGGMU",
            'password_confirmation' => "UnitedGGMU"
        ])
        ->assertSessionHasErrors(keys: 'token');
    }

    /**
     * Test for resend account verification success.
     * 
     * @return void
     */
    public function testResendAccountVerificationSuccess(): void
    {
        $this->seed(class: UserSeeder::class);

        $user = User::where(column: 'email', operator: '=', value: "annaspratama@icloud.com")->first();
        
        $this->actingAs(user: $user)
            ->get(uri: '/resend-verification')
            ->assertSessionHas(key: 'success', value: "A fresh verification link has been sent to your email address.");
    }

    /**
     * Test for display account verification notice success.
     * 
     * @return void
     */
    public function testDisplayAccountVerificationNoticeSuccess(): void
    {
        $this->seed(class: UserSeeder::class);

        $user = User::where(column: 'email', operator: '=', value: "annaspratama@icloud.com")->first();
        
        $this->actingAs(user: $user)
            ->get(uri: '/needs-verification')
            ->assertViewIs(value: 'dashboard.verification-notice.verification-notice')
            ->assertSeeText(value: "Before proceeding, please check your email for a verification link.");
    }

    /**
     * Test for display account verification notice fail.
     * 
     * @return void
     */
    public function testDisplayAccountVerificationNoticeFail(): void
    {
        $this->seed(class: UserSeeder::class);
        
        $this->get(uri: '/needs-verification')
            ->assertRedirectToRoute(name: 'auth-signin-page');
    }

    /**
     * Test for verify an account by given link success.
     * 
     * @return void
     */
    public function testVerifyAccountSuccess(): void
    {
        $this->seed(class: UserSeeder::class);

        $user = User::where(column: 'email', operator: '=', value: "annaspratama@icloud.com")->first();

        $userId = $user->getKey();
        $hash = sha1($user->getEmailForVerification());

        $this->actingAs(user: $user)
            ->get(uri: "/verify/{$userId}/{$hash}")->assertRedirectToRoute(name: 'dashboard-dashboard-page');
    }

        /**
     * Test for verify an account by given link fail.
     * 
     * @return void
     */
    public function testVerifyAccountSuccessFail(): void
    {
        $this->seed(class: UserSeeder::class);

        $user = User::where(column: 'email', operator: '=', value: "annaspratama@icloud.com")->first();
        
        $userId = null;
        $hash = sha1($user->getEmailForVerification());

        $this->actingAs(user: $user)
            ->get(uri: "/verify/{$userId}/{$hash}")->assertNotFound();
    }
}
