<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Services\UserService;
use Database\Seeders\UserSeeder;
use App\Models\User;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private string $firstName, $lastName, $email, $password;

    /**
     * Setup the test.
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(abstract: UserService::class);
        $this->firstName = "Annas";
        $this->lastName = "Pratama";
        $this->email = "annaspratama@outlook.com";
        $this->password = "Admin12&3";
    }

    /**
     * Test for register new user account.
     * 
     * @return void
     */
    public function testRegister(): void
    {
        $credentials = [
            'email' => "annaspratama@outlook.com",
            'password' => "Admin12&3",
            'first_name' => "Annas",
            'last_name' => "Pratama"
        ];
        $registeredUser = $this->userService->registerAccount(credentials: $credentials);

        self::assertIsNumeric(actual: $registeredUser);
    }

    /**
     * Test for update user account.
     * 
     * @return void
     */
    public function testUpdateAccount(): void
    {
        $this->seed(class: UserSeeder::class);

        $user = User::where(column: 'email', operator: '=', value: "annaspratama@outlook.com")->first();

        $account = [
            'first_name' => "Annas",
            'last_name' => "Pratama",
            'phone' => "082261064747"
        ];
        $updatedUser = $this->userService->updateAccount(userId: $user->id, account: $account);

        self::assertTrue(condition: $updatedUser);
    }

    /**
     * Test for success sign in account.
     * 
     * @return void
     */
    public function testSignInSuccess(): void
    {
        $this->seed(class: UserSeeder::class);
        $this->post(uri: '/tests/sign-in', data: [
            'email' => "annaspratama@outlook.com",
            'password' =>  "Admin12&3"
        ])
            ->assertStatus(status: 200)
            ->assertJson(value: [
                'data' => true
            ]);
    }

    /**
     * Test for success sign out account.
     * 
     * @return void
     */
    public function testSignOutSuccess(): void
    {
        $this->seed(class: UserSeeder::class);
        $this->post(uri: '/tests/sign-in', data: [
            'email' => "annaspratama@outlook.com",
            'password' =>  "Admin12&3"
        ]);
        $this->get(uri: '/tests/sign-out')
            ->assertStatus(status: 200)
            ->assertJson(value: [
                'data' => true
            ]);
    }

    /**
     * Test send email for verify account.
     * 
     * @return void
     */
    public function testSendMailVerifyAccount(): void
    {
        $this->seed(class: UserSeeder::class);
        $user = User::where(column: 'email', operator: '=', value: "annaspratama@outlook.com")->first();
        $this->userService->verifyAccount(email: $user->email);
        self::assertTrue(condition: true);
    }

    /**
     * Test send email for forgot password account.
     * 
     * @return void
     */
    public function testSendMailForgotPasswordAccount(): void
    {
        $this->seed(class: UserSeeder::class);
        $user = User::where(column: 'email', operator: '=', value: "annaspratama@outlook.com")->first();
        $this->userService->forgotPassword(email: $user->email);
        self::assertTrue(condition: true);
    }

    /**
     * Test for update new password success.
     * 
     * @return void
     */
    public function testUpdatePasswordAccountSuccess(): void
    {
        $this->seed(class: UserSeeder::class);
        $user = User::where(column: 'email', operator: '=', value: "annaspratama@outlook.com")->first();
        $result = $this->userService->updatePassword(email: $user->email, newPassword: "Oke123Siap", retypePassword: "Oke123Siap");
        self::assertTrue(condition: str_contains(haystack: $result, needle: "Success"));
    }

    /**
     * Test for update new password fail.
     * 
     * @return void
     */
    public function testUpdatePasswordAccountFail(): void
    {
        $this->seed(class: UserSeeder::class);
        $user = User::where(column: 'email', operator: '=', value: "annaspratama@outlook.com")->first();
        $result = $this->userService->updatePassword(email: $user->email, newPassword: "Oke123Siap", retypePassword: "Oke123Siapx");
        self::assertTrue(condition: str_contains(haystack: $result, needle: "Fail"));
    }
}