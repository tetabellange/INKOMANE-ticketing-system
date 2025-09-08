<!DOCTYPE html>
<html>
<head>
    <title>Register - INKOMANE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { 
               background-color: beige; /* Light beige */
font-family: Arial; margin: 50px; }
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
        button { background: #379cceff; color: white; padding: 12px 20px; border: none; width: 100%; }
        .error { color: red; font-size: 14px; }
        h2 {
  font-family: 'Playfair Display', serif;
  font-size: 28px;
  font-weight: bold;
  color: #333;
  letter-spacing: 0px;
  text-transform: uppercase;
}
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Register for INKOMANE</h2>
        
        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

       <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
        </form>

        <p><a href="/login">Already have an account? Login here</a></p>
    </div>
</body>
</html>