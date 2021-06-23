<?php
require_once("model/UserDB.php");
require_once("ViewHelper.php");

session_start();
    

class UserController {
    public static function showLoginForm() {
       ViewHelper::render("view/user-login.php");
    }

    public static function login() {
       if (UserDB::validLoginAttempt($_POST["username"], $_POST["password"])) {
        $user= UserDB::returnUser($_POST["username"], $_POST["password"]);
        $_SESSION["userID"]=$user[0]["userID"];
        $_SESSION["userFamilyID"] = $user[0]["familyID"];
        $_SESSION["moderator"] = $user[0]["moderator"];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
            $user= UserDB::returnUser($_SESSION["username"],$_SESSION["password"]);
            $familyName = UserDB::getFamily($user[0]["familyID"]);
            $vars = [
                "ID" => $user[0]["userID"],
                "name" => $user[0]["userName"],
                "surname" => $user[0]["userSurname"],
                "familyID" => $user[0]["familyID"],
                "familyName" =>$familyName[0]["familyName"],
                "username" => $_POST["username"],
                "password" => $_POST["password"]
            ];
            
            ViewHelper::redirect(BASE_URL . "user/about?ID=".$_SESSION["userID"]);
       } else {
            ViewHelper::render("view/user-login.php", [
                "errorMessage" => "Invalid username or password."
            ]);
       }
    }

    public static function about(){
        if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
            $user= UserDB::returnUser($_SESSION["username"],$_SESSION["password"]);
            $familyName = UserDB::getFamily($user[0]["familyID"]);
            $history = UserDB::getHistory($user[0]["userID"]);
            
            $vars = [
                "ID" => $user[0]["userID"],
                "name" => $user[0]["userName"],
                "surname" => $user[0]["userSurname"],
                "familyID" => $user[0]["familyID"],
                "familyName" =>$familyName[0]["familyName"],
                "history" => $history
            ];
           /* $_SESSION["userID"]=$user[0]["userID"];
            $_SESSION["userFamilyID"] = $user[0]["familyID"];
            /*$_SESSION["userName"]=$user[0]["userName"];
            $_SESSION["userSurname"]=$user[0]["userSurname"];
            
            $_SESSION["familyName"] = $familyName[0]["familyName"];*/
            ViewHelper::render("view/user-info-page.php", $vars);
        }else{
            ViewHelper::render("view/user-login.php", [
                "errorMessage" => "Invalid username or password."
            ]);
        }
    }

    public static function locations(){
        if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
             $familyName = UserDB::getFamily($_SESSION["userFamilyID"]);
        $vars = [
            "familyID" =>  $_SESSION["userFamilyID"],
            "familyName" => $familyName[0]["familyName"],
            "locations" =>UserDB::getLocations($_SESSION["userFamilyID"])
        ];
        ViewHelper::render("view/locations-page.php", $vars);
        }else{
            ViewHelper::redirect(BASE_URL . "user/login");
        }
       
    }

    public static function reservation(){
        if(isset($_SESSION['username']) && !empty($_SESSION['username'])){

            $familyName = UserDB::getFamily($_SESSION["userFamilyID"]);
            $vars = [
                "familyID" =>  $_SESSION["userFamilyID"],
                "familyName" => $familyName[0]["familyName"],
                "time" => "",
                "date" => "",
                "reserved"=> "",
                "errorMessage"=>"",
                "locations" =>UserDB::getOpenLocations($_SESSION["userFamilyID"])
            ];
            ViewHelper::render("view/reservation-page.php", $vars);
        }else{
            ViewHelper::redirect(BASE_URL . "user/login");
        }
    }

    public static function reserve(){
       
        if((isset($_POST['time']) && !empty($_POST['time']))
            && (isset($_POST['date']) && !empty($_POST['date']))&&
            (isset($_POST['locID']) && !empty($_POST['locID'])))
            {
                if (time()<=strtotime($_POST["time"]) && 
                    strtotime($_POST["time"])<=strtotime("+1 hour +5 minutes",time())){
                    $user= UserDB::returnUser($_SESSION["username"],$_SESSION["password"]);
                    UserDB::write2DB($_POST['locID'],$user[0]["userID"],$_POST['time'],$_POST['date']);
                    ViewHelper::redirect(BASE_URL . "user/about");
                }
                else{
                    $familyName = UserDB::getFamily($_SESSION["userFamilyID"]);
                    ViewHelper::render("view/reservation-page.php", [
                        "familyID" =>  $_SESSION["userFamilyID"],
                        "familyName" => $familyName[0]["familyName"],
                        "time" => "",
                        "date" => "",
                        "reserved"=> "",
                        "errorMessage" => "Ura ne ustreza pogoju: Rezervacija je možna največ 1h vnaprej",
                        "locations" =>UserDB::getOpenLocations($_SESSION["userFamilyID"])
                        
                    ]);
                }
        }else{
            $familyName = UserDB::getFamily($_SESSION["userFamilyID"]);
                    ViewHelper::render("view/reservation-page.php", [
                        "familyID" =>  $_SESSION["userFamilyID"],
                        "familyName" => $familyName[0]["familyName"],
                        "time" => "",
                        "date" => "",
                        "reserved"=> "",
                        "errorMessage" => "Ura ni izbrana",
                        "locations" =>UserDB::getOpenLocations($_SESSION["userFamilyID"])
                        
                    ]);
            //ViewHelper::redirect(BASE_URL . "user/reservation");
        }

       
    }

    public static function register(){
        if((isset($_POST['name']) && !empty($_POST['name']))
            && (isset($_POST['surname']) && !empty($_POST['surname']))&&
            (isset($_POST['familyID']) && !empty($_POST['familyID']))&&
            (isset($_POST['username']) && !empty($_POST['username']))&& 
            (isset($_POST['password']) && !empty($_POST['password']))
            ){
                if(UserDB::freeLoginName($_POST["username"])){
                    UserDB::addNew($_POST['name'],$_POST['surname'],$_POST['username'],$_POST['password'],$_POST['familyID']);
                ViewHelper::render("view/user-login.php", [
                    "errorMessage" => "Registracija uspešna, lahko se prijavite"
                ]);
                }else{
                    $vars=[
                        "name"=>"",
                        "surname"=>"",
                        "familyID"=>"",
                        "username"=>"",
                        "errorMessage" =>"Uporabniško ime je že uporabljeno",
                        "password"=>"",
                        "families" => UserDB::getFamiles()
                        ];
                        ViewHelper::render("view/user-registration-page.php", $vars);
                }
                
            }
        else{
            $vars=[
            "name"=>"",
            "surname"=>"",
            "familyID"=>"",
            "username"=>"",
            "errorMessage" =>"",
            "password"=>"",
            "families" => UserDB::getFamiles()
            ];
            ViewHelper::render("view/user-registration-page.php", $vars);
        }
    }
    
}