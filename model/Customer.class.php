<?php

class Customer {
  /*
   * Properties
   */
  private $email;
  private $password;
  private $name;
  private $phone;
  private $address;

  private $dbAccessPoint;

  /*
   * Constructor
   */
  public function __construct() {
    require_once("controller/DatabaseController.class.php");
    $this->dbAccessPoint = new DatabaseController();
  }

  /*
   * Function
   */
  //Attempt Login
  public function attemptLogin($login, $password) {
    $resultSet = $this->dbAccessPoint->runQuery("SELECT * FROM customer WHERE email = '$login' AND password = '$password'");

    //Check if the database returns a row.
//    if(!empty($resultSet) && sizeof($resultSet) > 0) {
    if($resultSet != null) {
      return true;
    }
    else {
      return false;
    }
  }

  public function getCustomerByID($id) {
    $resultSet = $this->dbAccessPoint->runQuery("SELECT * FROM customer WHERE email = '$id'");

    if(sizeof($resultSet) > 0) {
      $itrData = new Customer();
      foreach($resultSet as $value) {
        $itrData->setPassword($value["password"]);
        $itrData->setEmail($value["email"]);
        $itrData->setName($value["name"]);
        $itrData->setPhone($value["phone"]);
        $itrData->setAddress($value["address"]);
      }
      return $itrData;
    }
  }

  //Registration
  public function register($email, $password, $name, $phone, $address) {
    $this->registerBasic($email, $password, $name);
    $this->phone = $phone;
    $this->address = $address;
  }
  public function registerBasic($email, $password, $name) {
    $this->dbAccessPoint->runQueryNoResult("INSERT INTO customer (email, password, name, phone, address) VALUES ('$email', '$password', '$name', 'defaultPhone', 'defaultAddress')");

    //Temporary patch-job to also insert into dim table.
    $starschemaConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_FACT);
    $starschemaQuery = "INSERT INTO customer_dim (email, password, name, phone, address) SELECT email, password, name, phone, address FROM aptecommerce.customer WHERE email = '$email'";
    mysqli_query($starschemaConnection, $starschemaQuery);
    $starschemaConnection->close();
  }
  public function deleteAccount() {
    $this->dbAccessPoint->runQuerySafeMode("DELETE FROM customer WHERE email = '$this->email'");
  }


  //Getters
  public function getEmail() {
    return $this->email;
  }
  public function getPassword() {
    return $this->password;
  }
  public function getName() {
    return $this->name;
  }
  public function getPhone() {
    return $this->phone;
  }
  public function getAddress() {
    return $this->address;
  }

  //Setters
  public function setEmail($email) {
    $this->email = $email;
  }
  public function setName($name) {
    $this->name = $name;
  }
  public function setPassword($password) {
    $this->password = $password;
  }
  public function setPhone($phone) {
    $this->phone = $phone;
  }
  public function setAddress($address) {
    $this->address = $address;
  }
}

?>
