<?php
require_once("model/UserDB.php");
require_once("model/familiesDB.php");
require_once("ViewHelper.php");
require_once("model/UserDB.php");
//session_start();
class siteController {
    public static function showHome() {
        ViewHelper::render("view/home.php");
    }

    public static function showGuestMode() {
        $vars=[
            "families"=> familiesDB::returnFamilies()
        ];
        ViewHelper::render("view/guest.php",$vars);
    }

   public static function showMessages()
    {
        if(isset($_POST["delete"])){
            familiesDB::deleteMsg($_SESSION["userFamilyID"],$_POST["delete"]);
            $vars=[
                "family" => UserDB::getFamily($_SESSION["userFamilyID"]),
                "messages"=> familiesDB::returnMessages($_SESSION["userFamilyID"])
            ];
            ViewHelper::render("view/messages.php",$vars);
        }else{
            $vars=[
            "family" => UserDB::getFamily($_SESSION["userFamilyID"]),
            "messages"=> familiesDB::returnMessages($_SESSION["userFamilyID"])
        ];
        ViewHelper::render("view/messages.php",$vars);
        }
    }
        
   

}
?>