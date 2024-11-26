<?php

class Employee {
  /*
   * Properties
   */
  private $employeeNumber;
  private $password;
  private $name;
  private $officeLocation;
  private $jobTitle;

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
  //Attempt Login
  public function attemptLogin($employeeNumber, $password) {
    $resultSet = $this->dbAccessPoint->runQuery("SELECT * FROM employee WHERE employeeNumber = $employeeNumber AND password = '$password'");

    //Check if the database returns a row.
//    if(!empty($resultSet) && sizeof($resultSet) > 0) {
    if($resultSet != null) {
      return true;
    }
    else {
      return false;
    }
  }

  public function getEmployeeByID($id) {
    $resultSet = $this->dbAccessPoint->runQuery("SELECT * FROM employee WHERE employeeNumber = $id");

    if(!empty($resultSet)) {
      $itrData = new Employee();
      foreach($resultSet as $value) {
        $itrData->setPassword($value["password"]);
        $itrData->setEmployeeNumber($value["employeeNumber"]);
        $itrData->setName($value["name"]);
        $itrData->setOfficeLocation($value["officeLocation"]);
        $itrData->setJobTitle($value["jobTitle"]);
      }
      return $itrData;
    }
  }

  public function deleteAccount() {
    $this->dbAccessPoint->runQuerySafeMode("DELETE FROM employee WHERE employeeNumber = '$this->employeeNumber'");
  }

  //Getters
  public function getEmployeeNumber() {
    return $this->employeeNumber;
  }
  public function getPassword() {
    return $this->password;
  }
  public function getName() {
    return $this->name;
  }
  public function getOfficeLocation() {
    return $this->officeLocation;
  }
  public function getJobTitle() {
    return $this->jobTitle;
  }

  //Setters
  public function setEmployeeNumber($employeeNumber) {
    $this->employeeNumber = $employeeNumber;
  }
  public function setName($name) {
    $this->name = $name;
  }
  public function setPassword($password) {
    $this->password = $password;
  }
  public function setOfficeLocation($officeLocation) {
    $this->officeLocation = $officeLocation;
  }
  public function setJobTitle($jobTitle) {
    $this->jobTitle = $jobTitle;
  }
}

?>
