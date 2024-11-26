<?php

class Product {
  /*
   * Properties
   */
  //Static Data
  private $id;
  private $name;
  private $description;
  private $image;
  private $type;
  private $sex;
  //Dynamic Data
  private $quantityInStock;
  private $price;
  private $discountPercent;

  //Connection
  private $dbAccessPoint;

  /*
   * Constructor
   */
  public function __construct() {
    require_once("controller/DatabaseController.class.php");
    $this->dbAccessPoint = new DatabaseController();
  }

  /*
   * Functions
   */
  //Proprietary function to fill in the fields of Product, as overloading is not supported in PHP.
  public function fillDetails($id, $name, $description, $image, $type, $sex, $quantityInStock, $price, $discountPercent) {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->image = $image;
    $this->type = $type;
    $this->sex = $sex;
    $this->quantityInStock = $quantityInStock;
    $this->discountPercent = $discountPercent;

    if($discountPercent > 0) {
      $this->price = ($price - ($price * ($discountPercent/100)));
    }
    else {
      $this->price = $price;
    }
  }

  //Primary resultSet retriever function
  public function getProducts($query) {
    $resultSet = $this->dbAccessPoint->runProcedure($query);

    if(!empty($resultSet)) {
      $productsList = array();
      foreach($resultSet as $value) {
        $itrData = new Product();
        $itrData->fillDetails(
          $value["id"],
          $value["name"],
          $value["description"],
          $value["image"],
          $value["type"],
          $value["sex"],
          $value["quantityInStock"],
          $value["price"],
          $value["discountPercent"]
        );

        $productsList[] = $itrData;
      }
      return $productsList;
    }
  }

  //Get all products, return an array of Product.
  public function getAllProducts() {
    return ($this->getProducts("CALL getAllProducts()"));
    //return ($this->getProducts("SELECT * FROM product"));
  }

  //Get products by sex.
  public function getProductsBySex($sex) {
    return ($this->getProducts("CALL getProductsBySex('$sex')"));
    //return ($this->getProducts("SELECT * FROM product WHERE sex ='$sex'"));
  }

  //Get product by productID
  public function getProductByID($queryPID) {
    //Gets a Result set, in array form of length 1.
    $resultSet = $this->dbAccessPoint->runQuery("CALL getProductByID($queryPID)");
    //$resultSet = $this->dbAccessPoint->runQuery("SELECT * FROM product WHERE id = $queryPID");

    if(!empty($resultSet)) {
      $itrData = new Product();
      //Retrieve data from the 1-length array & fill it into a Product object.
      foreach ($resultSet as $value) {
        $itrData->fillDetails(
          $value["id"],
          $value["name"],
          $value["description"],
          $value["image"],
          $value["type"],
          $value["sex"],
          $value["quantityInStock"],
          $value["price"],
          $value["discountPercent"]
        );
      }
      //Return a product object.
      return $itrData;
    }
  }

  //Get featured products.
  public function getFeaturedProducts() {
    return ($this->getProducts("CALL getFeaturedProducts()"));
    //return ($this->getProducts("SELECT * FROM product ORDER BY id DESC LIMIT 4"));
  }

  //Get the 4 on-sale display items.
  public function getSaleDisplay() {
    return ($this->getProducts("CALL getSaleDisplay()"));
    //return ($this->getProducts("SELECT * FROM product ORDER BY discountPercent DESC LIMIT 4"));
  }

  //Set Stock level.
  public function setStockLevel($productID, $newStockLevel) {
    $this->dbAccessPoint->runQuerySafeMode(
      "UPDATE product SET quantityInStock = $newStockLevel, id = $productID WHERE id = $productID"
    );
  }

  //Getters
  public function getID() {
    return $this->id;
  }
  public function getName() {
    return $this->name;
  }
  public function getDescription() {
    return $this->description;
  }
  public function getImage() {
    return $this->image;
  }
  public function getType() {
    return $this->type;
  }
  public function getSex() {
    return $this->sex;
  }
  public function getQuantity() {
    return $this->quantityInStock;
  }
  public function getPrice() {
    return $this->price;
  }
  public function getDiscount() {
    return $this->discountPercent;
  }
}

?>
