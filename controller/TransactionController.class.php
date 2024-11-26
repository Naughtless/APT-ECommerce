<?php

class TransactionController {
  /*
   * Properties
   */
  private $orderNumber;
  private $customer;

  private $productModel;
  private $dbAccessPoint;

  public function __construct() {
    require_once("controller/DatabaseController.class.php");
    $this->dbAccessPoint = new DatabaseController();
  }

  public function getLastOrderID() {
    $resultSet = $this->dbAccessPoint->runProcedure("SELECT * FROM aptecommerce.order ORDER BY orderNumber DESC LIMIT 1");

    if(!empty($resultSet)) {
      foreach ($resultSet as $value) {
        //Return latest orderNumber;
        return $value["orderNumber"];
      }
    }
  }

  public function newOrder($orderNumber, $customer) {
    $this->dbAccessPoint->runQueryNoResult(
      "INSERT INTO aptecommerce.order (orderNumber, orderDate, customer) VALUES ($orderNumber, CURDATE(), '$customer')"
    );
  }

  public function newDetail($orderNumber, $productID, $quantity, $price) {
    $this->dbAccessPoint->runQueryNoResult(
      "INSERT INTO orderdetails (orderNumber, productID, quantity, price) VALUES ($orderNumber, $productID, $quantity, $price)"
    );
  }
}

?>
