<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - INKOMANE</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }

        /* Split left and right sides */
        .left, .right {
            flex: 1;
            min-width: 0;
        }

        .left {
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left img {
            max-width: 300px;
            width: 60%;
            height: auto;
        }

        .right {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 350px;
        }

        h2 {
            text-transform: uppercase;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            border: 1px solid transparent;
            border-radius: 8px;
            outline: none;
            margin-bottom: 20px;
        }

        input:focus {
            border: 2px solid black;
        }

        .forgot {
            display: block;
            text-align: right;
            font-size: 13px;
            margin-bottom: 20px;
            color: blue;
            text-decoration: none;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            cursor: pointer;
        }

        .login-btn:hover {
            opacity: 0.9;
        }

        .register {
            margin-top: 15px;
            text-align: center;
            font-size: 13px;
        }

        .register a {
            color: blue;
            text-decoration: none;
        }

        .register a:hover {
            text-decoration: underline;
        }

        /* Error messages */
        .errors {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="left">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>

    <div class="right">
        <div class="form-container">
            <h2>Login</h2>

            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <a href="{{ route('password.request') }}" class="forgot">Forgot Password?</a>

                <button type="submit" class="login-btn">Login</button>
            </form>

            <div class="register">
                Don’t have an account? <a href="{{ route('register') }}">Register here</a>
            </div>
        </div>
    </div>
</body>
</html>
