<!DOCTYPE html>
<html>
<head>
  <title>INKOMANE Ticketing System</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Roboto&display=swap" rel="stylesheet">
  <style>
    h1 {
      font-family: 'Playfair Display', serif;
      font-size: 40px;
      font-weight: bold;
      color: #ffddddff;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    h2 {
      font-family: 'Playfair Display', serif;
      font-size: 30px;
      font-weight: normal;
      color: #ffddddff;
      opacity: 0;
      transform: scale(0.8);
      animation: popIn 1s ease forwards;
      animation-delay: 4.5s; 
    }

    p.get-started {
      font-family: feof;
      font-size: 24px;
      color: #ffddddff;
      opacity: 0;
      animation: fadeIn 1s ease forwards;
      animation-delay: 6s; /* after subtitle */
      margin-left: 50px; /* slightly shifted right */
    }

    .buttons {
      opacity: 0;
      animation: fadeIn 1s ease forwards;
      animation-delay: 7s; /* after Get Started */
      margin-left: 50px;  /* match Get Started */
    }

    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      background-image: url('/background.jpeg');
      background-attachment: fixed;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      justify-content: flex-start; 
      align-items: flex-start;
      height: 100vh;
      padding: 80px; 
    }

    .container {
      max-width: 1000px;
      background: none;
      padding: 20px;
      border-radius: 10px;
      box-shadow: none;
      text-align: left; 
    }

    h1, h2, p {
      text-align: left; 
    }

    a {
      background: #007cba;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      margin: 10px 5px 0 0;
      display: inline-block;
      border-radius: 5px;
    }

    
    .typing {
      white-space: nowrap;
      overflow: hidden;
      width: 0;
      border-right: 3px solid #ffddddff; 
      animation: typing 4s steps(30, end) forwards, blink .75s step-end infinite;
    }

    @keyframes typing {
      from { width: 0 }
      to { width: 100% }
    }

    @keyframes blink {
      50% { border-color: transparent }
    }

    .typing.done {
      border-right: none;
    }

    @keyframes popIn {
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }
  </style>
</head>
<body>
    <div class="container">
        <h1 class="typing" id="title">Welcome to INKOMANE</h1>
        <h2>Customer Support & Ticketing System</h2><br>
        
        <p class="get-started">Get started:</p>
        <div class="buttons">
            <a href="/register">Register</a>
            <a href="/login">Login</a>
        </div>
    </div>

    <script>
      // Remove cursor after h1 typing
      setTimeout(() => {
        document.getElementById("title").classList.add("done");
      }, 4000); 
    </script>
</body>
</html>
