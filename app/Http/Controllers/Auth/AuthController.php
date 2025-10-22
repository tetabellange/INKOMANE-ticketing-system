<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // ----------------------------
    // Show Login Form
    // ----------------------------
    public function showLogin()
    {
        return view('auth.login');
    }

    // ----------------------------
    // Handle Login
    // ----------------------------
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        Log::info('Login attempt: ' . $request->email);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            Log::info('Login success: ' . $user->email . ' Role: ' . $user->role);

            // First login redirect for customers
            if ($user->first_login && $user->role === 'customer') {
                $user->update(['first_login' => false]);
                return redirect()->route('welcome_first');
            }

            return $this->redirectToDashboard($user);
        }

        Log::warning('Login failed: ' . $request->email);

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ])->withInput();
    }

    // ----------------------------
    // Show Register Form
    // ----------------------------
    public function showRegister()
    {
        return view('auth.register');
    }

    // ----------------------------
    // Handle Registration
    // ----------------------------
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'customer',      // default role
            'first_login' => true,
        ]);

        Auth::login($user);

        return redirect()->route('welcome_first');
    }

    // ----------------------------
    // Logout
    // ----------------------------
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to home page instead of login
        return redirect()->route('welcome')->with('success', 'You have been logged out.');
    }

    // ----------------------------
    // Show Forgot Password Form
    // ----------------------------
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // ----------------------------
    // Send Password Reset Link
    // ----------------------------
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No account found with that email.']);
        }

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => Carbon::now()]
        );

        // TODO: Send email to user with reset link
        return back()->with('status', 'Password reset link has been generated (simulation).');
    }

    // ----------------------------
    // Show Reset Password Form
    // ----------------------------
    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // ----------------------------
    // Handle Password Reset
    // ----------------------------
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $reset = DB::table('password_resets')->where('email', $request->email)->first();
        if (!$reset || !Hash::check($request->token, $reset->token)) {
            return back()->withErrors(['email' => 'Invalid or expired token.']);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Your password has been reset. Please login.');
    }

    // ----------------------------
    // Role-based Dashboard Redirect
    // ----------------------------
    protected function redirectToDashboard(User $user)
    {
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'agent' => redirect()->route('agent.dashboard'),
            'customer' => redirect()->route('customer.dashboard'),
            default => redirect()->route('login')->withErrors('Unauthorized role.'),
        };
    }
}
