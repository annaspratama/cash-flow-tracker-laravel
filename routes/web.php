<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;
use App\Http\Controllers\Dashboard\VerificationController;
use App\Http\Controllers\UploadImageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Dashboard
Route::middleware(['auth', 'verified'])->group(callback: function () {
    // Dashboard
    Route::get(uri: '/', action: [DashboardController::class, 'dashboardPage'])->name(name: 'dashboard-dashboard-page');

    // Users
    Route::prefix('/roles')->group(callback: function () {
        Route::get(uri: '', action: [DashboardUserController::class, 'rolesPage'])->name(name: 'dashboard-roles-page');
        Route::get(uri: '/{roleId}/permissions', action: [DashboardUserController::class, 'permissionsPage'])
            ->where(name: 'roleId', expression: '[0-9]+')->name(name: 'dashboard-permissions-page');
    });
    Route::prefix('/change-password')->group(callback: function () {
        Route::get(uri: '', action: [DashboardUserController::class, 'changePasswordPage'])->name(name: 'dashboard-change-password-page');
        Route::post(uri: '', action: [DashboardUserController::class, 'updatePassword'])->name(name: 'dashboard.update.password');
    });
    Route::prefix('/your-profile')->group(callback: function () {
        Route::get(uri: '', action: [DashboardUserController::class, 'accountProfilePage'])->name(name: 'dashboard-account-profile-page');
    });
    Route::prefix('/users')->group(callback: function () {
        Route::get(uri: '', action: [DashboardUserController::class, 'usersPage'])->name(name: 'dashboard-users-page');
        Route::get(uri: '/delete', action: [DashboardUserController::class, 'delete'])->name(name: 'dashboard-delete-user');
    });
});

// Dashboard needs verification
Route::controller(VerificationController::class)->group(callback: function () {
    Route::get(uri: '/recover-password', action: 'recoverPasswordPage')->name(name: 'auth-recover-password-page');
    Route::get(uri: '/verify/{id}/{hash}', action: 'verify')->name('verification.verify');
    Route::get(uri: '/needs-verification', action: 'needsVerificationPage')->name('verification.notice');
    Route::get(uri: '/resend-verification', action: 'resendVerification')->name('verification.resend');
});

// Recover password
Route::middleware('guest')->group(callback: function () {
    Route::get(uri: '/recover-password/{token}', action: function (string $token) {
        return view('authentication.recover-password', ['token' => $token]);
    })->name('password.reset');
    Route::post(uri: '/send-recover-password-link', action: [VerificationController::class, 'recoverPassword'])->name(name: 'password.link.send');
    Route::post(uri: '/recover-password', action: [VerificationController::class, 'actionRecoverPassword'])->name(name: 'password.update');
});

// Authentication
Route::controller(UserController::class)->group(callback: function () {
    Route::get(uri: '/register', action: 'registerPage')->name(name: 'auth-register-page');
    Route::get(uri: '/sign-in', action: 'signInPage')->name(name: 'auth-signin-page');
    Route::get(uri: '/forgot-password', action: 'forgotPasswordPage')->name(name: 'auth-forgot-password-page');
    Route::post(uri: '/action-register', action: 'register')->name(name: 'auth-action-register');
    Route::post(uri: '/action-sign-in', action: 'signIn')->name(name: 'auth-action-signin');
    Route::get(uri: '/action-sign-out', action: 'signOut')->name(name: 'auth-action-signout');
});

// Support test case for user
Route::prefix('tests')->group(function () {
    Route::controller(UserController::class)->group(callback: function () {
        Route::post(uri: '/sign-in', action: 'testSignIn');
        Route::get(uri: '/sign-out', action: 'testSignOut');
    });
    Route::post(uri: '/upload-image', action: [UploadImageController::class, 'testUploadImage']);
});