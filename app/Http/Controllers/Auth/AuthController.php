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
    // Login Handler
    // ----------------------------
    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Debug: log attempt
        Log::info('Login attempt for email: ' . $request->email);

        // Attempt login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Debug: successful login
            Log::info('User logged in: ' . $user->email . ' Role: ' . $user->role);

            // First login for customers
            if ($user->first_login && $user->role === 'customer') {
                $user->first_login = false; // mark first login complete
                $user->save();
                return redirect()->route('welcome_first');
            }

            // Redirect to role-based dashboard
            return $this->redirectToDashboard($user);
        }

        // Failed login
        Log::warning('Failed login attempt for email: ' . $request->email);

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
    // Registration Handler
    // ----------------------------
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // default role
            'first_login' => true,
        ]);

        Auth::login($user);

        return redirect()->route('welcome_first');
    }

    // ----------------------------
    // Logout Handler
    // ----------------------------
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
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

        // TODO: send email here
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
    // Reset Password Handler
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
            $user->password = Hash::make($request->password);
            $user->save();
        }

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Your password has been reset. Please login.');
    }

    // ----------------------------
    // Role-based dashboard redirect helper
    // ----------------------------
    protected function redirectToDashboard(User $user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'agent':
                return redirect()->route('agent.dashboard');
            case 'customer':
            default:
                return redirect()->route('customer.dashboard');
        }
    }
}
