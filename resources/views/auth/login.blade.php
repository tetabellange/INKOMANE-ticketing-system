<!DOCTYPE html>
<html>
<head>
    <title>Login - INKOMANE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial; margin: 50px; }
        .form-container { max-width: 400px; margin: 0 auto; }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #f3d3d3ff; 
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            outline: none;
            box-shadow: 0 4px 6px rgba(97, 97, 97, 0.5);
              }
        button { background: #007cba; color: white; padding: 12px 20px; border: none; width: 100%; }
        .error { color: red; font-size: 14px; }
        .success { color: green; font-size: 14px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Login to INKOMANE</h2>
        
        @if(session('success'))
            <div class="success">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p><a href="/register">Don't have an account? Register here</a></p>
    </div>
</body>
</html>