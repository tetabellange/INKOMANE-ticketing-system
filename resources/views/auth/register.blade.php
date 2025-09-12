<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - INKOMANE</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }

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

        input[type="text"],
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

        .register-btn {
            width: 100%;
            padding: 12px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            cursor: pointer;
        }

        .register-btn:hover {
            opacity: 0.9;
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
            <h2>Register</h2>

            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <label for="name">Name</label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}">

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>

                <button type="submit" class="register-btn">Register</button>
            </form>
        </div>
    </div>
</body>
</html>
