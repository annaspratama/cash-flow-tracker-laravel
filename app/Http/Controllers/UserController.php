<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SignInRequest;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

class UserController extends Controller
{
    private UserService $userService;

    /**
     * Control all user requests.
     * 
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest')->except(methods: [
            'signOut',
        ]);
        $this->middleware('auth')->only(methods: 'signOut');
        $this->userService = $userService;
    }

    /**
     * Display register page.
     * 
     * @Illuminate\Http\Response
     */
    public function registerPage(Request $request)
    {
        return view(view: 'authentication/register');
    }

    /**
     * Display sign in page.
     * 
     * @return Illuminate\Http\Response
     */
    public function signInPage(Request $request)
    {
        return view(view: 'authentication/sign-in');
    }

    /**
     * Display forgot password page.
     * 
     * @return Illuminate\Http\Response
     */
    public function forgotPasswordPage(Request $request)
    {
        return view(view: 'authentication/forgot-password');
    }

    /**
     * Sign authorized user in.
     * 
     * @param SignInRequest $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function signIn(SignInRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        $rememberMe = $request->input(key: 'remember-me', default: false);
 
        if ($this->userService->signIn(request: $request, credentials: $credentials, rememberToken: $rememberMe)) {
            return redirect()->intended(default: '/');
        }
 
        return back()->withErrors(provider: [
            'error' => "The provided credentials do not match on our records. Please check your email and password.",
        ]);
    }

    /**
     * Register new user and send account verification via email.
     * 
     * @param RegisterRequest $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
 
        if ($this->userService->registerAccount(credentials: $credentials)) {
            $user = User::where(column: 'email', operator: '=', value: $credentials['email'])->first();

            event(new Registered($user));
            
            return redirect()->route(route: 'auth-signin-page')->withSuccess("You've been registered. Check your email to verify your account.");
        }
 
        return back();
    }

    /**
     * Signing out authorized account.
     * 
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function signOut(Request $request): RedirectResponse
    {
        $signOut = $this->userService->signOut(request: $request);
        if ($signOut) return redirect()->route(route: 'auth-signin-page');
    }

    /**
     * Custom controller function for supporting test case.
     * 
     * @param Request $request
     * @return bool
     */
    public function testSignIn (SignInRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        
        return response()->json(data: [
            'data' => $this->userService->signIn(request: $request, credentials: $credentials, rememberToken: false)
        ], status: 200);
    }

    /**
     * Custom controller function for supporting test case.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function testSignOut (Request $request): JsonResponse
    {
        return response()->json(data: [
            'data' => $this->userService->signOut(request: $request)
        ], status: 200);
    }
}
