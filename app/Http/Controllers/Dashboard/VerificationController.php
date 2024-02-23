<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class VerificationController extends Controller
{
    /**
     * Control all verification requests.
     */
    public function __construct() {
        $this->middleware('guest')->except(methods: [
            'needsVerificationPage', 'resendVerification',
            'verify', 'recoverPassword'
        ]);
        $this->middleware('auth')->only(methods: [
            'needsVerificationPage', 'resendVerification', 'verify'
        ]);
        $this->middleware('throttle:2,1')->only('verify', 'resendVerification', 'recoverPassword');
    }

    /**
     * Verify account after button being clicked.
     * 
     * @param EmailVerificationRequest $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();
        return redirect()->route(route: 'dashboard-dashboard-page');
    }

    /**
     * Needs verification account page.
     * 
     * @param Request $request
     * 
     * @return Illuminate\Http\Response
     */
    public function needsVerificationPage(Request $request)
    {
        return $request->user()->hasVerifiedEmail() 
            ? redirect()->route(route: 'dashboard-dashboard-page') : view(view: 'dashboard/verification-notice/verification-notice');
    }

    /**
     * Resend verification to account email.
     * 
     * @param Request $request
     * 
     * @return 
     */
    public function resendVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->withSuccess("A fresh verification link has been sent to your email address.");
    }

    /**
     * Recover password by send an reset link to user email.
     * 
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function recoverPassword(Request $request): RedirectResponse
    {
        $request->validate(rules: [
            'email' => 'required|email',
            'g-recaptcha-response' => 'required'
        ]);
 
        $status = Password::sendResetLink(
            credentials: $request->only(keys: 'email')
        );
    
        return $status === Password::RESET_LINK_SENT
                        ? back()->with(key: ['status' => __($status)])
                        : back()->withErrors(provider: ['email' => __($status)]);
    }

    /**
     * Reset password by given link on the email.
     * 
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function actionRecoverPassword(Request $request): RedirectResponse
    {
        $request->validate(rules: [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            credentials: $request->only('email', 'password', 'password_confirmation', 'token'),
            callback: function (User $user, string $password) {
                $user->forceFill(attributes: [
                    'password' => Hash::make($password)
                ])->setRememberToken(value: Str::random(length: 60));
     
                $user->save();
     
                event(new PasswordReset(user: $user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route(route: 'auth-signin-page')->with(key: 'status', value: __($status))
                    : back()->withErrors(provider: ['email' => [__($status)]]);
    }
}