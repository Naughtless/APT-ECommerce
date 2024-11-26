<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width", initial-scale=1.0">

  <link rel="stylesheet" href="../assets/viewMain/css/design.css">
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
<!--        <li class= "nav-item"><a href="./index.html" class="nav-link">Home</a></li>-->
<!--        <li class= "nav-item"><a href="./index.html#featured" class="nav-link">Featured</a></li>-->
<!--        <li class= "nav-item"><a href="./index.html#sale" class="nav-link">Sale</a></li>-->
<!--        <li class= "nav-item"><a href="./women.html" class="nav-link">Women</a></li>-->
<!--        <li class= "nav-item"><a href="./men.html" class="nav-link">Men</a></li>-->
<!--      </ul>-->
<!--    </div>-->

    <div class="nav-interaction">
<!--      <ul class= "nav-nyerahgw">-->
<!--        <li class= nav-icon>-->
<!--          <div class="nav-cart">-->
<!--            <i class='bx bx-cart-alt' ></i>-->
<!--          </div>-->
<!---->
          <!---cart-->
<!--          <div class="cart">-->
<!--            <h2 class="cart-title">Your Cart</h2>-->
<!--            <div class="cart-content">-->
<!--              <div class="cart-box">-->
<!--                <img src="img/clothes/mm2.jpg" alt="" class="cart-img">-->
<!--                <div class="cart-detail">-->
<!--                  <div class="cart-prod">Tyra Handbag</div>-->
<!--                  <div class="cart-price">$38</div>-->
<!--                  <input type="number" value="1" class="cart-quantity">-->
<!--                </div>-->
<!---->
<!--                <i onclick ="return this.parentNode.remove();" class='bx bxs-trash-alt delete-cart'></i>-->
<!--              </div>-->
<!--            </div>-->
<!---->
<!--            <div class="total">-->
<!--              <div class="total-title">Total Price</div>-->
<!--              <div class="total-price">$0</div>-->
<!--            </div>-->
<!---->
<!--            <button type="button" class="cart-button">Checkout</button>-->
<!---->
<!--            <i class='bx bx-x-circle' id="close-cart"></i>-->
<!--          </div>-->
<!---->
<!--        </li>-->
<!--        <li class= "nav-icon">-->
          <div class="nav-profile">
            <i class='bx bx-user'></i>
<!--            <ul class = "acc-list">-->
<!--              <li class = "nav-item2"><a href = "./login.html">Login</a> </li>-->
<!--              <li class = "nav-item2"> <a href= "./register.html">Register</a> </li>-->
<!--            </ul>-->
          </div>

<!--        </li>-->
<!--      </ul>-->

    </div>

  </nav>
</header>

<main class="page-main">
  <!--Login-->
  <section class = "featured" id = "Register">
    <h2 class= "section-title">Register</h2>

    <div class = "alert">
      <button type= "button" class="close" id= "close-popup-btn"><i class='bx bx-x'></i></button>
      <img src= "img/error_127px.png" class= "warning-sign" alt="">
      <p class= "alert-msg">Error!</p>
    </div>

    <div class= "register-form">

      <!-- BEGIN FORM -->
      <form class = "account" action="index.php" method="POST">
        <div class= "first-name">
          <p class = "smol-text">First Name</p>
          <input type = "text" autocomplete = "off" class="textbox" id="first-name" placeholder= "Enter First Name..." name="firstname" required>
        </div>

        <div class= "last-name">
          <p class = "smol-text">Last Name</p>
          <input type = "text" autocomplete = "off" class="textbox" id="last-name" placeholder= "Enter Last Name..." name ="lastname" required>
        </div>

        <div class= "email">
          <p class = "smol-text">Email</p>
          <input type = "text" autocomplete = "off" class="textbox" id="email" placeholder= "Enter Email..." name="email" required>
        </div>

        <div class = "password">
          <p class = "smol-text">Password</p>
          <input type = "password" autocomplete = "off" class="textbox" id="pw" placeholder= "Enter Password..." name="regPassword" required><br>
        </div>

        <div class = "confirmpassword">
          <p class = "smol-text">Confirm Passowrd</p>
          <input type = "password" autocomplete = "off" class="textbox" id="cpw" placeholder= "Confirm Password..." required><br>
        </div>

        <ul class= "linkbutton">
          <li class= "groupbutton">
            <a href = "index.php?action=displayLogin" class = "text-button">Already have an account? Click here to login</a>
            <br>
          </li>
        </ul>

        <input type ="checkbox" class="checkbox" id="tnc" required>
        <label for= "tnc" class="xtra-smol">I have read and agree to the following <a href = "#" class="tnc-thing">Terms & Conditions</a></label><br>

        <input type="hidden" name="action" value="attemptRegister">

        <input type="submit" class="registerbutton" value="Create Account">
      </form>
      <!-- END FORM -->

    </div>
  </section>

</main>

<script src="../assets/viewMain/js/error.js"></script>

</body>

<footer>


</footer>
</html>
