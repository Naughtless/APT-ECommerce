<?php

class DatabaseController {
  /*
   * Properties
   */
  private $dbConnection;

  /*
   * Constructor
   */
  public function __construct() {
    require_once("global/config.php");

    $this->dbConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_SCHEMA);

    if($this->dbConnection == false) {
      die("ERROR: Database connection failed!");
    }
  }

  /*
   * Functions
   */

  // executeUpdate()
  public function runQueryNoResult($query) {
    mysqli_query($this->dbConnection, $query);
    while(mysqli_next_result($this->dbConnection)){;}
  }

  // executeQuery()
  public function runQuery($query) {
    $resultSet = mysqli_query($this->dbConnection, $query);
    while(mysqli_next_result($this->dbConnection)){;}

    while($currentRow = mysqli_fetch_assoc($resultSet)) {
      $resultArray[] = $currentRow;
    }

    if(!empty($resultArray)) {
      return $resultArray;
    }
  }
  public function runProcedure($query) {
    $resultSet = mysqli_query($this->dbConnection, $query);
    mysqli_next_result($this->dbConnection);
    while(mysqli_next_result($this->dbConnection)){;}

    while($currentRow = mysqli_fetch_assoc($resultSet)) {
      $resultArray[] = $currentRow;
    }

    if(!empty($resultArray)) {
      return $resultArray;
    }
  }

  public function runQuerySafeMode($query) {
    $safeConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_SCHEMA);
    mysqli_query($safeConnection, $query);
    $safeConnection->close();
  }

}

?>
