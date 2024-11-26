<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X_UA_Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width" , initial-scale=1.0">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="../assets/viewMain/css/styles.css">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="shortcut icon" href="#">
  <link rel="stylesheet" type="text/css" href="../assets/viewMain/css/lightslider.css">
  <script type="text/javascript" src="../assets/viewMain/js/jquery.js"></script>
  <script type="text/javascript" src="../assets/viewMain/js/lightslider.js"></script>


  <title>Capaccio</title>
</head>

<body>
<header class="page-header" id="header">
  <nav class="nav body-grid">
    <div class="nav-body" id="nav-bd">
      <i class='bx bx-grid-alt'></i>
    </div>

    <a href="#" class="nav-logo">Capaccio</a>

    <div class="nav-menu" id="nav-menu">
      <ul class="nav-list">
        <li class="nav-item"><a href="#home" class="nav-link appear">Home</a></li>
        <li class="nav-item"><a href="#featured" class="nav-link">Featured</a></li>
        <li class="nav-item"><a href="#sale" class="nav-link">Sale</a></li>
        <li class="nav-item"><a href="#women" class="nav-link">Women</a></li>
        <li class="nav-item"><a href="#men" class="nav-link">Men</a></li>
      </ul>
    </div>

    <div class="nav-interaction">

      <div class="nav-cart">
        <i class='bx bx-cart-alt'></i>
      </div>

      <!---cart-->
      <div class="cart">
        <h2 class="cart-title">Your Cart</h2>
        <div class="cart-content">

          <!-- Cart items start -->
          <?php
          if (isset($cartData)) {
            foreach ($cartData as $currentItem) {
              ?>
              <div class="cart-box">
                <img src="<?php echo $currentItem->getProduct()->getImage(); ?>" alt="" class="cart-img">
                <div class="cart-detail">
                  <div class="cart-prod"><?php echo $currentItem->getProduct()->getName(); ?></div>
                  <div class="cart-price">$<?php echo $currentItem->getProduct()->getPrice(); ?></div>
                  <input type="number" value="<?php echo $currentItem->getAmount(); ?>" class="cart-quantity">
                </div>
                <a onclick="return this.parentNode.remove();"
                   href="index.php?action=removeFromCart&pid=<?php echo $currentItem->getPID(); ?>"
                   class='bx bxs-trash-alt delete-cart'
                ></a>
              </div>
              <?php
            }
          }
          ?>

        </div>

        <div class="total">
          <div class="total-title">Total Price</div>
          <?php
          if(isset($cartTotal)) {
            echo "<div class=\"total-price\">$ $cartTotal</div>";
          }
          else {
            echo "<div class=\"total-price\">$ 0</div>";
          }
          ?>

        </div>

        <a href="index.php?action=checkout" class="cart-button">Checkout</a>

        <i class='bx bx-x-circle' id="close-cart"></i>
      </div>

      <div class="nav-profile">
        <!-- the profile button -->
        <a href="index.php?action=openProfile" class='bx bx-user'></a>
      </div>

    </div>

  </nav>
</header>

<main class="page-main">
  <!---home-->
  <section class="home" id="home">
    <div class="home-grid">
      <div class="home-banner">
        <div class="home-shape"></div>
        <img src="../assets/viewMain/img/clothes/home.png" alt="" class="home-img">
      </div>

      <div class="home-info">
        <div class="home-hot">
          <div class="home-rectangle">
            <p>HOT NOW!</p>
          </div>
        </div>
        <h1 class="home-title">Tiffany Heels<br>GOLD</h1>
        <p class="home-desc">Limited Edition | Shipping Free!</p>
        <a href="#" class="home-button">get yours now.</a>
      </div>
    </div>
  </section>

  <!---Featured-->
  <section class="featured" id="featured">
    <h2 class="section-title">FEATURED</h2>
    <div class="featured-body body-grid">

      <?php
      foreach ($featuredProducts as $currentItr) {
        ?>
        <article class="featured-box">
          <img src="<?php echo $currentItr["image"]; ?>" alt="" class="featured-img">
          <span class="featured-name"><?php echo $currentItr["name"]; ?></span>
          <span class="featured-price">$<?php echo $currentItr["price"]; ?></span>
          <a href="index.php?action=addToCart&pid=<?php echo $currentItr["id"] ?>" class="featured-button">
            <i class='bx bx-shopping-bag'></i>
          </a>
        </article>
        <?php
      }
      ?>

<!--      --><?php
//      foreach ($featuredProducts as $currentItr) {
//        ?>
<!--        <article class="featured-box">-->
<!--          <img src="--><?php //echo $currentItr->getImage(); ?><!--" alt="" class="featured-img">-->
<!--          <span class="featured-name">--><?php //echo $currentItr->getName(); ?><!--</span>-->
<!--          <span class="featured-price">$--><?php //echo $currentItr->getPrice(); ?><!--</span>-->
<!--          <a href="index.php?action=addToCart&pid=--><?php //echo $currentItr->getID() ?><!--" class="featured-button">-->
<!--            <i class='bx bx-shopping-bag'></i>-->
<!--          </a>-->
<!--        </article>-->
<!--        --><?php
//      }
//      ?>

    </div>
  </section>

  <!---Sale-->
  <section class="sale" id="sale">
    <h2 class="section-title">SALE</h2>
    <div class="sale-body body-grid">

      <?php
      foreach ($onSaleProducts as $currentItr) {
        ?>
        <article class="sale-card">
          <div class="sale-data"><?php echo $currentItr["discountPercent"]; ?>% off</div>
          <div class="sale-info">
            <h3 class="sale-name"><?php echo $currentItr["name"]; ?></h3>
            <p class="sale-desc"><?php echo $currentItr["description"]; ?></p>
            <a href="index.php?action=addToCart&pid=<?php echo $currentItr["id"]; ?>" class="sale-button">
              Add to cart
              <i class='bx bxs-chevron-right'></i>
            </a>
          </div>
          <img src="<?php echo $currentItr["image"]; ?>" alt="" class="sale-img">
        </article>
        <?php
      }
      ?>

<!--      --><?php
//      foreach ($onSaleProducts as $currentItr) {
//        ?>
<!--        <article class="sale-card">-->
<!--          <div class="sale-data">--><?php //echo $currentItr->getDiscount(); ?><!--% off</div>-->
<!--          <div class="sale-info">-->
<!--            <h3 class="sale-name">--><?php //echo $currentItr->getName(); ?><!--</h3>-->
<!--            <p class="sale-desc">--><?php //echo $currentItr->getDescription(); ?><!--</p>-->
<!--            <a href="index.php?action=addToCart&pid=--><?php //echo $currentItr->getID() ?><!--" class="sale-button">-->
<!--              Add to cart-->
<!--              <i class='bx bxs-chevron-right'></i>-->
<!--            </a>-->
<!--          </div>-->
<!--          <img src="--><?php //echo $currentItr->getImage(); ?><!--" alt="" class="sale-img">-->
<!--        </article>-->
<!--        --><?php
//      }
//      ?>

    </div>
  </section>


  <!---Women-->
  <h2 class="section-title">COLLECTION</h2>
  <div class=women-title>
    <h2 class="women-header">Women</h2>
    <a href="#" class="women-button"> See More
      <i class='bx bxs-chevron-right'></i>
    </a>
  </div>
  <ul id="slides" class="women-slider">

    <!-- BEGIN SLIDERS -->

    <?php
    foreach ($womensProducts as $currentItr) {
      ?>
      <li class="item-a">
        <div class=women-body>
          <div class="women-box">
            <div class="slider-img">
              <img src="<?php echo $currentItr["image"]; ?>" alt="1">
              <div class="overlay">
                <a href="index.php?action=addToCart&pid=<?php echo $currentItr["id"]; ?>" class="women-buy">
                  Buy Now
                </a>
              </div>
            </div>

            <div class="women-detail">
              <a href='#' class="women-name"><?php echo $currentItr["name"]; ?></a>
              <a href='#' class="women-price">$<?php echo $currentItr["price"]; ?></a>
            </div>
          </div>
        </div>
      </li>
      <?php
    }
    ?>

<!--    --><?php
//    foreach ($womensProducts as $currentItr) {
//      ?>
<!--      <li class="item-a">-->
<!--        <div class=women-body>-->
<!--          <div class="women-box">-->
<!--            <div class="slider-img">-->
<!--              <img src="--><?php //echo $currentItr->getImage(); ?><!--" alt="1">-->
<!--              <div class="overlay">-->
<!--                <a href="index.php?action=addToCart&pid=--><?php //echo $currentItr->getID() ?><!--" class="women-buy">Buy-->
<!--                  Now</a>-->
<!--              </div>-->
<!--            </div>-->
<!---->
<!--            <div class="women-detail">-->
<!--              <a href='#' class="women-name">--><?php //echo $currentItr->getName(); ?><!--</a>-->
<!--              <a href='#' class="women-price">$--><?php //echo $currentItr->getPrice(); ?><!--</a>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </li>-->
<!--      --><?php
//    }
//    ?>

    <!-- END SLIDERS-->

  </ul>

  <!-- Non-Functional Decor, for now -->
  <div class="new-body bd-grid">
    <div class="new-box">
      <img src="../assets/viewMain/img/clothes/y-removebg-previewcrop.png" alt="" class="new-img">
      <h3 class="new-title">Women's Shoes Collection</h3>
      <span class="new-price">From $89.99</span>
      <a href="#" class="new-button">View More<i class='bx bx-right-arrow-alt'></i></a>
    </div>

    <div class="new-prod">
      <div class="prod-card">
        <img src="../assets/viewMain/img/clothes/aacrop-removebg-preview.png" alt="" class="new-prod-img">
        <div class="new-overlay">
          <a href="#" class="women-buy">Details</a>
        </div>
      </div>

      <div class="prod-card">
        <img src="../assets/viewMain/img/clothes/ddcrop-removebg-preview.png" alt="" class="new-prod-img">
        <div class="new-overlay">
          <a href="#" class="women-buy">Details</a>
        </div>
      </div>

      <div class="prod-card">
        <img src="../assets/viewMain/img/clothes/eecrop-removebg-preview.png" alt="" class="new-prod-img">
        <div class="new-overlay">
          <a href="#" class="women-buy">Details</a>
        </div>
      </div>

      <div class="prod-card">
        <img src="../assets/viewMain/img/clothes/cccrop-removebg-preview.png" alt="" class="new-prod-img">
        <div class="new-overlay">
          <a href="#" class="women-buy">Details</a>
        </div>
      </div>
    </div>
  </div>


  <!---Men-->
  <div class=women-title>
    <h2 class="women-header">Men</h2>
    <a href="#" class="women-button"> See More
      <i class='bx bxs-chevron-right'></i>
    </a>
  </div>
  <ul id="slide" class="men-slider">

    <!-- Begin Sliders -->

    <?php
    foreach ($mensProducts as $currentItr) {
      ?>
      <li class="item-a">
        <div class=women-body>
          <div class="women-box">
            <div class="slider-img">
              <img src="<?php echo $currentItr["image"]; ?>" alt="1">
              <div class="overlay">
                <a href="index.php?action=addToCart&pid=<?php echo $currentItr["id"]; ?>" class="women-buy">Buy
                  Now</a>
              </div>
            </div>

            <div class="women-detail">
              <a href='#' class="women-name"><?php echo $currentItr["name"]; ?></a>
              <a href='#' class="women-price">$<?php echo $currentItr["price"]; ?></a>
            </div>
          </div>
        </div>
      </li>
      <?php
    }
    ?>

<!--    --><?php
//    foreach ($mensProducts as $currentItr) {
//      ?>
<!--      <li class="item-a">-->
<!--        <div class=women-body>-->
<!--          <div class="women-box">-->
<!--            <div class="slider-img">-->
<!--              <img src="--><?php //echo $currentItr->getImage(); ?><!--" alt="1">-->
<!--              <div class="overlay">-->
<!--                <a href="index.php?action=addToCart&pid=--><?php //echo $currentItr->getID() ?><!--" class="women-buy">Buy-->
<!--                  Now</a>-->
<!--              </div>-->
<!--            </div>-->
<!---->
<!--            <div class="women-detail">-->
<!--              <a href='#' class="women-name">--><?php //echo $currentItr->getName(); ?><!--</a>-->
<!--              <a href='#' class="women-price">$--><?php //echo $currentItr->getPrice(); ?><!--</a>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </li>-->
<!--      --><?php
//    }
//    ?>

    <!-- End Sliders -->
  </ul>


  <!---Services-->
  <div class="service-container">
    <div class="service-box">
      <a href="#!" class="service-button">
        <i class='bx bx-package'></i>
      </a>
      <h3>Free Shipping</h3>
      <p>minimum order of 50k.</p>
    </div>

    <div class="service-box">
      <a href="#!" class="service-button">
        <i class='bx bxs-offer'></i>
      </a>
      <h3>Lots of Offers</h3>
      <p>Discounts up to 50% off or 200k.</p>
    </div>

    <div class="service-box">
      <a href="#!" class="service-button">
        <i class='bx bx-user-voice'></i>
      </a>
      <h3>24/7 Customer Service</h3>
      <p>we will be ready for you whenever.</p>
    </div>
  </div>

  <!---Newsletter-->
  <section class="newsletter" id="newsletter">
    <div class="newsletter-body body-grid">
      <div>
        <h2 class="newsletter-title">JOIN CAPACCIO NOW! </h2>
        <p class="newsletter-desc">Get 45% Discount on your first purchase~</p>
      </div>

      <form action="" class="newsletter-suscribe">
        <input type="text" class="newsletter-input">
        <a href="#" class="newsletter-button">SUSCRIBE</a>
      </form>
    </div>
  </section>

  <!---footer-->
  <footer class="footer section">
    <div class="footer__container body-grid">
      <div class="footer__box">
        <h3 class="footer__title">Capaccio</h3>
        <p class="footer_desc">Check out our newest collection!</p>
      </div>

      <div class="footer__box">
        <h3 class="footer__title">Explore</h3>
        <ul>
          <li><a href="#home" class="footer__link">Home</a></li>
          <li><a href="#featured" class="footer__link">Featured</a></li>
          <li><a href="#sale" class="footer__link">Sale</a></li>
          <li><a href="./women.html" class="footer__link">Women</a></li>
          <li><a href="#home" class="footer__link">Men</a></li>
        </ul>
      </div>

      <div class="footer__box">
        <h3 class="footer__title">Support</h3>
        <ul>
          <li><a href="#" class="footer__link">Customer Service</a></li>
          <li><a href="#" class="footer__link">About Us</a></li>
          <li><a href="#" class="footer__link">Employment Info</a></li>
        </ul>
      </div>

      <div class="footer__box">
        <a href="#" class="footer__social"><i class='bx bx1-facebook'></i></a>
        <a href="#" class="footer__social"><i class='bx bx1-instagram'></i></a>
        <a href="#" class="footer__social"><i class='bx bx1-twitter'></i></a>
        <a href="#" class="footer__social"><i class='bx bx1-google'></i></a>
      </div>

    </div>

    <p class="footer__copy">&#169; 2022 The Gemoy. All right reserved</p>
  </footer>

</main>

<script src="../assets/viewMain/js/main.js"></script>
<script type="text/javascript" src="../assets/viewMain/js/script.js"></script>
</body>
</html>
