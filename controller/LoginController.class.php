<?php

class LoginController {
  private $account;

  private $employeeModel;
  private $customerModel;

  public function __construct() {
    require_once("model/Customer.class.php");
    require_once("model/Employee.class.php");

    $this->employeeModel = new Employee();
    $this->customerModel = new Customer();

    session_start();
  }

  public function invoke() {
    if(isset($_GET['action'])) {
      $this->run($_GET['action']);
    }
    else if(isset($_POST['action'])) {
      $this->run($_POST['action']);
    }
    else {
      $this->displayLoginPage();
    }
  }

  public function run($action) {
    switch($action) {
      case "attemptRegister":
        $name = $_POST['firstname'] . ' ' . $_POST['lastname'];
        $email = $_POST['email'];
        $regPassword = $_POST['regPassword'];

        //Make sure email doesn't already exist.
        //later.

        $this->customerModel->registerBasic($email, $regPassword, $name);

        $this->displayLoginPage();
        break;

      case "attemptLogin":
        //Check to see if a session already exists, and delete it.
        $this->clearAccountSessions();

        //Attempt employee login.
        $employeeLogin = (int) $_POST['login'];
        if($this->employeeModel->attemptLogin($employeeLogin, $_POST['password'])) {
          $newEmployee = $this->employeeModel->getEmployeeByID($employeeLogin);

          $_SESSION['employeeSession'] = $newEmployee;

          header("location: index.php?controller=MainController");
          exit;
        }
        //Attempt customer login.
        else if($this->customerModel->attemptLogin($_POST['login'], $_POST['password'])) {
          $newCustomer = $this->customerModel->getCustomerByID($_POST['login']);

          $_SESSION['customerSession'] = $newCustomer;

          header("location: index.php?controller=MainController");
          exit;
        }
        //else fail login.
        else {
          $this->clearAccountSessions();
          $this->displayLoginPage();
        }
        break;

      case "displayRegister":
        $this->displayRegisterPage();
        break;

      case "displayLogin":
        $this->displayLoginPage();
        break;

      default:
        break;
    }
  }

  public function clearAccountSessions() {
    if(isset($_SESSION['employeeSession']) || !empty($_SESSION['employeeSession'])) {
      $_SESSION['employeeSession'] = null;
      unset($_SESSION['employeeSession']);
    }
    if(isset($_SESSION['customerSession']) || !empty($_SESSION['customerSession'])) {
      $_SESSION['customerSession'] = null;
      unset($_SESSION['customerSession']);
    }
  }

  public function displayLoginPage() {
    include("view/viewLogin.php");
  }
  public function displayRegisterPage() {
    include("view/viewRegister.php");
  }
}

?>
