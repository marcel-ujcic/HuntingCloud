<?php
require_once("model/UserDB.php");
require_once("model/familiesDB.php");
require_once("ViewHelper.php");
require_once("model/UserDB.php");
//session_start();
class familyController {
    public static function showModeratorPage() {
        if(isset($_SESSION["moderator"]) && !empty($_SESSION["moderator"])){
            $vars=[
                "locations" =>  familiesDB::getAllReservations($_SESSION["userFamilyID"]),
                "familyName" =>UserDB::getFamily($_SESSION["userFamilyID"])
            ];

             ViewHelper::render("view/moderator/moderator-page.php",$vars);
        }
       
    }

    public static function showGuestMode() {
        $vars=[
            "families"=> familiesDB::returnFamilies()
        ];
        ViewHelper::render("view/guest.php",$vars);
    }

   public static function addMSG()
    {
        if(isset($_SESSION["moderator"]) && !empty($_SESSION["moderator"])){

            $title= $_POST["title"];
            $msg = $_POST["context"];
            familiesDB::writeMSG($_SESSION["userFamilyID"],$title,$msg);

            ViewHelper::redirect("../user/messages");
        }
    }
   

}

?>