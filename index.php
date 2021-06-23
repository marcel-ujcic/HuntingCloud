<?php
error_reporting();
require_once("controller/UserController.php");
require_once("controller/siteController.php");

require_once("controller/familyController.php");


define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "user/login" => function () {
        unset($_SESSION["username"]);
        unset($_SESSION["moderator"]);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::login();
        } else {
            UserController::showLoginForm();
        }
    },
    "user/about" => function () {
    
            UserController::about();
       
    },
    "user/locations" => function () {
        UserController::locations();
    },
    "user/reservation" => function () {
        UserController::reservation();
    },
    "user/reserve" => function () {
        UserController::reserve();
    },
    "user/register" => function () {
        unset($_SESSION["username"]);
        unset($_SESSION["moderator"]);
        UserController::register();
    },
    "home"=> function () {
        unset($_SESSION["username"]);
        unset($_SESSION["moderator"]);
        siteController::showHome();
    },
    "user/guest"=> function () {
        siteController::showGuestMode();
    },
    "user/messages"=> function () {
        siteController::showMessages();
    },
    "family/admin"=> function () {
        familyController::showModeratorPage();
    },
    "families/newMsg" => function(){
        familyController::addMSG();
    },
    "families"=> function () {
        siteController::showGuestMode();
    },
    "" => function () {
        unset($_SESSION["username"]);
        unset($_SESSION["moderator"]);
        ViewHelper::redirect(BASE_URL . "home");
    },
];

try {
    if (isset($urls[$path])) {
       $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
    // ViewHelper::error404();
} 
