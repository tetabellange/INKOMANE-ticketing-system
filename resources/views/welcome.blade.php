<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            font-family: Arial, sans-serif;
        }

        /* Left and Right sides always equal */
        .left, .right {
            flex: 1;
            min-width: 0; /* ensures equal halves */
        }

        /* Left side */
        .left {
            background-color: black;
            display: flex;
            justify-content: center;  /* horizontal center */
            align-items: center;      /* vertical center */
        }

        .logo {
            max-width: 300px;  /* larger size */
            width: 60%;        /* responsive scaling */
            height: auto;      /* keep proportions */
        }

        /* Right side */
        .right {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Form container */
        .form-container {
            width: 350px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            padding-left: 5px;
            font-size: 24px;
            text-transform: uppercase;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px;       /* bigger input boxes */
            font-size: 16px;
            border: 1px solid transparent;
            border-radius: 8px;
            outline: none;
            margin-bottom: 20px;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
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

        /* Login button */
        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
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
    </style>
</head>
<body>

    <!-- Left side with logo -->
    <div class="left">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>

    <!-- Right side with login form -->
    <div class="right">
        <div class="form-container">
            <h2>LOGIN</h2>
            
            <label for="email">Email Address</label>
            <input type="email" id="email" placeholder="Enter your email">
            
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter your password">
            
            <a href="#" class="forgot">Forgot Password?</a>
            
            <!-- Login button (redirect link) -->
            <a href="/dashboard" class="login-btn">Login</a>
            
            <div class="register">
                Don’t have an account? <a href="/register">Register here</a>
            </div>
        </div>
    </div>

</body>
</html>
