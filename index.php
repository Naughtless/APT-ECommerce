<?php

//if(isset($_COOKIE['userSession'])) {
//  $lastActiveController = $_COOKIE['userSession'];
//}
//else {
//  $lastActiveController = 'switchDefault';
//}

//Controller Selection
if(isset($_GET['controller'])) {
  setcookie('userSession', $_GET['controller'], 0);
  $currentController = loadController($_GET['controller']);
}
else {
    $currentController = loadController($lastActiveController);
}

$currentController->invoke();

//Function to load controller
function loadController($selectedController) {
    switch($selectedController) {
      case 'LoginController':
        require_once("controller/LoginController.class.php");
        return new LoginController();

      case 'MainController':
        require_once("controller/MainController.class.php");
        return new MainController();

      default:
        require_once("controller/LoginController.class.php");
        return new LoginController();
//        require_once("controller/MainController.class.php");
//        return new MainController();
    }
}

?>
