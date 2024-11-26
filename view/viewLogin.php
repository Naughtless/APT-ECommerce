<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width" initial-scale=1.0">

  <link rel="stylesheet" href="../assets/viewMain/css/design.css">
  <!---box icons-->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

  <title>Capaccio</title>
</head>

<body>
<header class="page-header" id="header">
  <nav class="nav body-grid">
    <div class="nav-body" id="nav-bd">
      <i class='bx bx-grid-alt'></i>
    </div>

    <a href="#" class="nav-logo">Capaccio</a>

    <!--    <div class="nav-menu" id="nav-menu">-->
    <!--      <ul class="nav-list">-->
    <!--        <li class="nav-item"><a href="./index.html" class="nav-link">Home</a></li>-->
    <!--        <li class="nav-item"><a href="./index.html#featured" class="nav-link">Featured</a></li>-->
    <!--        <li class="nav-item"><a href="./index.html#sale" class="nav-link">Sale</a></li>-->
    <!--        <li class="nav-item"><a href="./women.html" class="nav-link">Women</a></li>-->
    <!--        <li class="nav-item"><a href="./men.html" class="nav-link">Men</a></li>-->
    <!--      </ul>-->
    <!--    </div>-->

    <div class="nav-interaction">

      <!--      <div class="nav-cart">-->
      <!--        <i class='bx bx-cart-alt'></i>-->
      <!--      </div>-->
      <!---->
      <!---cart-->
      <!--      <div class="cart">-->
      <!--        <h2 class="cart-title">Your Cart</h2>-->
      <!--        <div class="cart-content">-->
      <!--          <div class="cart-box">-->
      <!--            <img src="img/clothes/mm2.jpg" alt="" class="cart-img">-->
      <!--            <div class="cart-detail">-->
      <!--              <div class="cart-prod">Tyra Handbag</div>-->
      <!--              <div class="cart-price">$38</div>-->
      <!--              <input type="number" value="1" class="cart-quantity">-->
      <!--            </div>-->
      <!---->
      <!--            <i onclick="return this.parentNode.remove();" class='bx bxs-trash-alt delete-cart'></i>-->
      <!--          </div>-->
      <!--        </div>-->
      <!---->
      <!--        <div class="total">-->
      <!--          <div class="total-title">Total Price</div>-->
      <!--          <div class="total-price">$0</div>-->
      <!--        </div>-->
      <!---->
      <!--        <button type="button" class="cart-button">Checkout</button>-->
      <!---->
      <!--        <i class='bx bx-x-circle' id="close-cart"></i>-->
      <!--      </div>-->

      <div class="nav-profile">
        <i class='bx bx-user'></i>
      </div>

    </div>

  </nav>
</header>

<main class="page-main">
  <!--Login-->
  <section class="featured" id="login">
    <h2 class="section-title">Login</h2>

    <!--login-->
    <div class="login-form">

      <!-- Begin login form -->
      <form action="index.php" method="POST">

        <div class="email">
          <p class="smol-text">Email</p>
          <input type="text" class="textbox" id="email" placeholder="Enter Email..." name="login" required>
        </div>

        <div class="password">
          <p class="smol-text">Password</p>
          <input type="password" class="textbox" id="pw" placeholder="Enter Password..." name ="password" required>
        </div>


        <ul class="linkbutton">

          <li class="groupbutton">
            <a href="#" class="text-button">Forgot Password?</a>
          </li>

          <li class="groupbutton">
            <a href="index.php?action=displayRegister" class="text-button">Don't have an account? Click here to register</a>
          </li>

        </ul>

        <div class="error">
          <p class="error-msg">Error</p>
        </div>

        <br>

        <input type="hidden" name="action" value="attemptLogin">
        <input type="submit" class="loginbutton" value="Login">


      </form>
      <!-- end login form -->

    </div>


  </section>

</main>

<script src="../assets/viewMain/js/main.js"></script>

</body>

<footer>


</footer>
</html>
