<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INKOMANE - Welcome</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
    body { background-color: #f4f8fc; color: #1a1a1a; }

    a { text-decoration: none; color: inherit; }
    button { cursor: pointer; }

    /* Navbar */
    nav { background-color: #fff; padding: 1rem 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-radius: 0 0 10px 10px; }
    .nav-container { display: flex; align-items: center; max-width: 1100px; margin: 0 auto; }
    .logo-links { display: flex; align-items: center; gap: 1.5rem; }
    .logo { font-weight: bold; font-size: 1.5rem; color: #1a2b4c; }
    ul { list-style: none; display: flex; gap: 1rem; }
    ul li a { color: #1a2b4c; font-weight: 500; }
    .auth-buttons { margin-left: auto; display: flex; gap: 0.5rem; }
    .auth-buttons .login { background-color: #fff; color: #1a2b4c; border: 1px solid #1a2b4c; padding: 0.5rem 1rem; border-radius: 5px; font-weight: bold; }
    .auth-buttons .signup { background-color: #1a2b4c; color: #fff; padding: 0.5rem 1rem; border-radius: 5px; font-weight: bold; border: none; }

    /* Hero Section */
    .hero { text-align: center; padding: 5rem 2rem 3rem; background: #e6f0fa; }
    .hero h1 { font-size: 2.2rem; margin-bottom: 1rem; line-height: 1.3; }
    .hero p { margin-bottom: 2rem; color: #333; font-size: 1.1rem; }
    .hero .hero-buttons button { padding: 0.8rem 1.8rem; border-radius: 5px; font-weight: bold; font-size: 1rem; margin: 0 0.5rem; border: none; }
    .hero .hero-buttons .support-btn { background-color: #1a2b4c; color: #fff; }
    .hero .hero-buttons .shop-btn { background-color: #fff; color: #1a2b4c; border: 1px solid #1a2b4c; }

    /* Main Sections */
    .main { display: flex; justify-content: center; flex-wrap: wrap; gap: 2rem; margin: 2rem; }

    .card { background-color: #fff; border-radius: 12px; padding: 2rem; width: 350px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center; }
    .card h3 { margin-bottom: 1rem; font-size: 1.4rem; color: #0c0c0c; }
    .card p { font-size: 1rem; color: #333; }
    .card button { margin-top: 1rem; padding: 0.6rem 1.2rem; border: none; border-radius: 5px; background-color: #1a2b4c; color: #fff; font-weight: bold; }

    /* Support Card */
    .support-card .support-options { display: flex; justify-content: space-around; margin-bottom: 1rem; }
    .support-card .support-options div { text-align: center; }
    .support-card .support-options i { font-size: 2.2rem; margin-bottom: 0.5rem; color: #1a2b4c; }
    .support-card .support-features { text-align: left; margin-top: 1rem; }
    .support-card .support-features p { margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
    .support-card .support-features p::before { content: "✔"; color: #1a2b4c; font-weight: bold; }

    /* Shop Card */
    .shop-card .shop-items { display: flex; justify-content: space-around; gap: 1rem; flex-wrap: wrap; }
    .shop-card .shop-items div { flex: 1 1 45%; text-align: center; }
    .shop-card img { max-width: 100%; margin-bottom: 1rem; }

    /* Responsive */
    @media (max-width: 768px) {
      .main { flex-direction: column; align-items: center; }
      .shop-card .shop-items div { flex: 1 1 80%; }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav>
    <div class="nav-container">
      <div class="logo-links">
        <div class="logo">INKOMANE</div>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="{{ route('customer.tickets.index') }}">Support</a></li>
          <li><a href="#">Shop</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
      <div class="auth-buttons">
        <a href="{{ route('login') }}"><button class="login">Login</button></a>
        <a href="{{ route('register') }}"><button class="signup">Sign Up</button></a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <h1>Need Help or Want to Shop?<br>You're in the Right Place.</h1>
    <p>INKOMANE is your support hub — create tickets, get help, or shop from our gift store all in one place.</p>
    <div class="hero-buttons">
      <a href="{{ route('customer.tickets.create') }}"><button class="support-btn">Get Support</button></a>
      <a href="#"><button class="shop-btn">Visit Shop</button></a>
    </div>
  </section>

  <!-- Main Content -->
  <div class="main">

    <!-- Support Section -->
    <div class="card support-card">
      <h3>Support</h3>
      <div class="support-options">
        <div>
          <i class="ticket-icon">🎫</i>
          <p>Create Ticket</p>
        </div>
        <div>
          <i class="status-icon">📄</i>
          <p>Check Status</p>
        </div>
      </div>
      <div class="support-features">
        <p>Fast Support</p>
        <p>24/7 Ticket System & Helpline</p>
        <p>Secure Payments via Stripe & PayPal</p>
      </div>
    </div>

    <!-- Shop Section -->
    <div class="card shop-card">
      <h3>Shop</h3>
      <div class="shop-items">
        <div>
          <img src="https://via.placeholder.com/150x150.png?text=Mug" alt="INKOMANE Mug">
          <p>INKOMANE Mug<br>$15.00</p>
          <button>Shop Now</button>
        </div>
        <div>
          <img src="inkomane-tshirt.jpeg" alt="INKOMANE T-shirt">
          <p>INKOMANE T-shirt<br>$25.00</p>
          <button>Shop Now</button>
        </div>
      </div>
    </div>

  </div>

</body>
</html>
