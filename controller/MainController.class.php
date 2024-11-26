<?php

class MainController {
  /*
   * Properties
   */
  private $model;

  private $transaction;

  /*
   * Constructor
   */
  public function __construct()
  {
    require_once("model/Product.class.php");
    $this->model = new Product();

    require_once("model/CartItem.class.php");

    require_once("controller/TransactionController.class.php");
    $this->transaction = new TransactionController();

    require_once("model/Customer.class.php");

    session_start();
  }

  /*
   * Functions
   */
  public function invoke()
  {
    if (isset($_GET['action'])) {
      $this->run($_GET['action']);
    } else {
      $this->displayHomePage();
    }
  }

  //CLI Emulator
  private function run($action)
  {
    switch ($action) {
      case "addToCart":
        $newCartItem = new CartItem((new Product())->getProductByID($_GET["pid"]), 1);

        /*
         * If no cart exists!
         */
        if (!isset($_SESSION['cart'])) {
          $_SESSION['cart'] = array($newCartItem);
        } /*
         * If a cart already exists!
         */
        else {
          //Flag for if a product of same type already exists.
          $duplicate = false;

          //Cycle through the cart to see whether a product of the same type already exists.
          foreach ($_SESSION['cart'] as $currentItem) {

            //If the same product is already in-cart...
            if ($currentItem->getPID() == $newCartItem->getPID()) {

              //increment amount by 1.
              $currentItem->incrementAmount();

              //Change this boolean so that a new item is not created in the cart.
              $duplicate = true;
              break;
            }
          }

          //Else make a new entry.
          if (!$duplicate) {
            array_push($_SESSION['cart'], $newCartItem);
          }

        }

        unset($_GET['action']);
        header("location: index.php");
        $this->displayHomePage();
        break;

      case "removeFromCart":
        //Cycle through all cart items.
        foreach ($_SESSION['cart'] as $currentItem) {
          //If an item matches the desired pid, delete.
          if ($_GET["pid"] == $currentItem->getPID()) {
            if (($key = array_search($currentItem, $_SESSION['cart'])) !== false) {
              unset($_SESSION['cart'][$key]);
            }
          }
          //If cart is empty, delete session.
          if (empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
          }
        }

        unset($_GET['action']);
        header("location: index.php");
        $this->displayHomePage();
        break;

      case "checkout":
        //NEEDS REWRITING

        /*
         * Failsafes
         */
        //Check if a cart exists at all!
        if(!isset($_SESSION['cart'])){
          break;
        }
        //Check if current cart is empty!
        if(empty($_SESSION['cart'])) {
          break;
        }


        $currentCart = $_SESSION['cart'];

        /*
         * MODIFY STOCK LEVEL.
         */
        foreach($currentCart as $crc) {
          //Retrieve current product's ID
          $currentPID = (int) $crc->getProduct()->getID();

          //Query database and get the current stock level.
          $currentProductObj = $this->model->getProductByID($currentPID);
          $currentStockLevel = $currentProductObj->getQuantity();

          //Retrieve current product's amount in cart.
          $currentAmountInCart = $crc->getAmount();

          $newStockLevel = $currentStockLevel - $currentAmountInCart;

          //Query database and update the stock level.
          $this->model->setStockLevel($currentPID, $newStockLevel);
        }

        /*
         * CREATE ENTRIES IN THE 'ORDER' AND 'ORDERDETAILS' TABLES.
         */
        //RETRIEVE LATEST ENTRY IN `ORDER` AND INCREMENT LATEST orderNumber by 1.
        $lastOrderNumber = $this->transaction->getLastOrderID();
        $newOrderNumber = $lastOrderNumber + 1; //DATA

        //RETRIEVE CURRENTLY LOGGED ON CUSTOMER
        $currentCustomerObj = $_SESSION['customerSession'];
        $currentCustomerEmail = $currentCustomerObj->getEmail(); //DATA

        //(QUERY DB) CREATE ENTRY IN 'ORDER' TABLE.
        $this->transaction->newOrder($newOrderNumber, $currentCustomerEmail);

        //CREATE ENTRIES IN 'ORDERDETAILS' TABLE.
        foreach($currentCart as $crc) {
          //ID
          $detailProductID = $crc->getProduct()->getID();

          //QUANTITY IN CART
          $detailProductAmount = $crc->getAmount();

          //PRICE
          $detailProductPrice = $crc->getProduct()->getPrice();

          //QUERY DB
          $this->transaction->newDetail($newOrderNumber, $detailProductID, $detailProductAmount, $detailProductPrice);
        }

        unset($_SESSION['cart']);

        $this->displayHomePage();
        break;

      case "logout":

        //Unset currently logged-in session.
        if(isset($_SESSION['employeeSession']) || !empty($_SESSION['employeeSession'])) {
          $_SESSION['employeeSession'] = null;
          unset($_SESSION['employeeSession']);
        }
        if(isset($_SESSION['customerSession']) || !empty($_SESSION['customerSession'])) {
          $_SESSION['customerSession'] = null;
          unset($_SESSION['customerSession']);
        }

        //Delete Controller cookies
        setcookie('userSession', $_GET['controller'], time() - 3600);

        header("location: index.php?controller=LoginController");
        exit;

      case "deleteAccount":

        //Check Employee
        if(isset($_SESSION['employeeSession']) || !empty($_SESSION['employeeSession'])) {
          $_SESSION['employeeSession']->deleteAccount();
        }

        //Check Customer
        if(isset($_SESSION['customerSession']) || !empty($_SESSION['customerSession'])) {
          $_SESSION['customerSession']->deleteAccount();
        }

        break;

      case "openProfile":

        $this->displayProfilePage();

        break;

      case "openMain":
        $this->displayHomePage();

        break;

      default:
        break;
    }
  }

  private function displayHomePage()
  {
    //Write from database to JSON
    $this->writeProductsToJSON();

    //Retrieve contents of JSON files into variables.
    $mensProducts = $this->readProductsFromJSON("male.json");
    $womensProducts = $this->readProductsFromJSON("female.json");
    $featuredProducts = $this->readProductsFromJSON("featured.json");
    $onSaleProducts = $this->readProductsFromJSON("sale.json");

    if (isset($_SESSION['cart'])) {
      $cartData = $_SESSION['cart'];
      $cartTotal = $this->getCartTotal($cartData);
    }

    include("view/viewHome.php");
  }

  private function displayProfilePage() {

    if (isset($_SESSION['cart'])) {
      $cartData = $_SESSION['cart'];
      $cartTotal = $this->getCartTotal($cartData);
    }

    if(isset($_SESSION['customerSession'])) {
      $customerProfile = $_SESSION['customerSession'];
    }
    else if(isset($_SESSION['employeeSession'])) {
      $employeeProfile = $_SESSION['employeeSession'];
    }

    include ("view/viewProfile.php");
  }

  private function getCartTotal($cart) {
    $totalPrice = 0.00;
    foreach($cart as $currentItem) {
      //Get Amount
      $amount = $currentItem->getAmount();

      //Get Price
      $price = $currentItem->getProduct()->getPrice();

      $totalPrice += ($amount * $price);
    }
    return $totalPrice;
  }

  private function readProductsFromJSON($fileName) {
    //Get list of products from JSON.
    //Returns an array of arrays containing product information. Inner Array Length is 9.
    return json_decode(file_get_contents("json/".$fileName), true);

    //Iterate through the outer array using foreach.
    //Access the 8-row information using individual indexes, from the view php file.
  }

  private function writeProductsToJSON() {
    //Men's Products
    $mensJSON = $this->jsonStringBuilder($this->model->getProductsbySex('m'));
    file_put_contents("json/male.json", $mensJSON);
//    echo "MENS JSON: " . $mensJSON . "<br><br>";

    //Womens Products
    $womensJSON = $this->jsonStringBuilder($this->model->getProductsBySex('f'));
    file_put_contents("json/female.json", $womensJSON);
//    echo "WOMENS JSON: " . $womensJSON . "<br><br>";

    //Featured Products
    $featuredJSON = $this->jsonStringBuilder($this->model->getFeaturedProducts());
    file_put_contents("json/featured.json", $featuredJSON);
//    echo "FEATURED JSON: " . $featuredJSON . "<br><br>";

    //On Sale Products
    $onSaleProducts = $this->jsonStringBuilder($this->model->getSaleDisplay());
    file_put_contents("json/sale.json", $onSaleProducts);
//    echo "ONSALE JSON: " . $onSaleProducts . "<br><br>";
  }

  // Superseded by json_encode()!
  private function jsonStringBuilder($productArray) {
    $iteration = 0;

    $jsonString = "[ ";
    foreach($productArray as $item) {
      $jsonString .= "{ ";

      //ID - 0
      $jsonString .= "\"id\": ";
      $jsonString .= $item->getID();
      $jsonString .= ", ";

      //NAME - 1
      $jsonString .= "\"name\": ";
      $jsonString .= "\"".$item->getName()."\"";
      $jsonString .= ", ";

      //DESCRIPTION - 2
      $jsonString .= "\"description\": ";
      $jsonString .= "\"".$item->getDescription()."\"";
      $jsonString .= ", ";

      //IMAGE - 3
      $jsonString .= "\"image\": ";
      $jsonString .= "\"".$item->getImage()."\"";
      $jsonString .= ", ";

      //TYPE - 4
      $jsonString .= "\"type\": ";
      $jsonString .= "\"".$item->getType()."\"";
      $jsonString .= ", ";

      //SEX - 5
      $jsonString .= "\"sex\": ";
      $jsonString .= "\"".$item->getSex()."\"";
      $jsonString .= ", ";

      //QUANTITY IN STOCK - 6
      $jsonString .= "\"quantityInStock\": ";
      $jsonString .= $item->getQuantity();
      $jsonString .= ", ";

      //PRICE - 7
      $jsonString .= "\"price\": ";
      $jsonString .= $item->getPrice();
      $jsonString .= ", ";

      //DISCOUNT PERCENT - 8
      $jsonString .= "\"discountPercent\": ";
      $jsonString .= $item->getDiscount();


      $jsonString .= " }";

      //ADD A CHECK IF THIS IS LAST. IF NOT, ADD COMMA!
      if(!($iteration >= (sizeof($productArray) - 1))) {
        $jsonString .= ", ";
      }

      $iteration += 1;
    }

    $jsonString .= " ]";

    return $jsonString;
  }

}

?>
