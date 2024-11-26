<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">

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

    <div class="nav-menu" id="nav-menu">
      <ul class="nav-list">
        <li class= "nav-item"><a href="index.php?action=openMain" class="nav-link">Home</a></li>
        <li class= "nav-item"><a href="index.php?action=openMain#featured" class="nav-link">Featured</a></li>
        <li class= "nav-item"><a href="index.php?action=openMain#sale" class="nav-link">Sale</a></li>
        <li class= "nav-item"><a href="index.php?action=openMain" class="nav-link">Women</a></li>
        <li class= "nav-item"><a href="index.php?action=openMain" class="nav-link">Men</a></li>
      </ul>
    </div>

    <div class="nav-interaction">
      <div class="nav-cart">
        <i class='bx bx-cart-alt' ></i>
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
        <a href="index.php?action=openMain" class='bx bx-user'></a>
      </div>

    </div>

  </nav>
</header>

<main class="page-main">
  <!---profile-->
  <section class="featured" id="profile">
    <h2 class= "section-title2">PROFILE</h2>
    <div class="profile">
      <img class="profile-pic" src="../assets/viewMain/img/rowlet.png" alt="photo">
      <h3 class="sub-section2">About</h3>


      <div class= desc-prof>

        <?php
        if(isset($customerProfile)) {
        ?>

        <!-- NAME -->
        <div class= "tiny-section" id= "full-name">
          <h4 class= "sub-text"><i class='bx bxs-user'></i> Name</h4>
          <p class="xtra-smol2"><?php echo $customerProfile->getName(); ?></p>
        </div>

        <!--EMAIL-->
        <div class= "tiny-section" id= "email">
          <h4 class= "sub-text"><i class='bx bxl-gmail'></i> Email</h4>
          <p class="xtra-smol2"><?php echo $customerProfile->getEmail(); ?></p>
        </div>

        <!--PHONE-->
        <div class= "tiny-section" id= "contact-num">
          <h4 class= "sub-text"><i class='bx bxs-contact' ></i> Contact Number</h4>
          <p class="xtra-smol2"><?php echo $customerProfile->getPhone(); ?></p>
        </div>

        <!--ADDRESS-->
        <div class= "tiny-section" id= "address">
          <h4 class= "sub-text"><i class='bx bx-current-location' ></i> Address</h4>
          <p class="xtra-smol2"><?php echo $customerProfile->getAddress(); ?></p>
        </div>

        <?php
        }
        else if(isset($employeeProfile)) {
        ?>

          <!-- NAME -->
          <div class= "tiny-section" id= "full-name">
            <h4 class= "sub-text"><i class='bx bxs-user'></i> Name</h4>
            <p class="xtra-smol2"><?php echo $employeeProfile->getName(); ?></p>
          </div>

          <!--NUMBER-->
          <div class= "tiny-section" id= "email">
            <h4 class= "sub-text"><i class='bx bxl-gmail'></i> Employee Number</h4>
            <p class="xtra-smol2"><?php echo $employeeProfile->getEmployeeNumber(); ?></p>
          </div>

          <!--Job Desc-->
          <div class= "tiny-section" id= "contact-num">
            <h4 class= "sub-text"><i class='bx bxs-contact' ></i> Job Title</h4>
            <p class="xtra-smol2"><?php echo $employeeProfile->getJobTitle(); ?></p>
          </div>

          <!--Office ID-->
          <div class= "tiny-section" id= "address">
            <h4 class= "sub-text"><i class='bx bx-current-location' ></i> Office ID</h4>
            <p class="xtra-smol2"><?php echo $employeeProfile->getOfficeLocation(); ?></p>
          </div>

        <?php
        }
        ?>

        <div class = "profilebutton">
          <a href ="#" class= "accbutton1">Coming Soon</a>

          <a href ="index.php?action=logout" class= "accbutton2">Logout</a>
        </div>

      </div>

    </div>
  </section>
</main>

<script src="../assets/viewMain/js/main.js"></script>

</body>
</html>
