<?php

require_once "DBInit.php";
require_once "ReservationDB.php";
class UserDB {

    // Returns true if a valid combination of a username and a password are provided.
    public static function validLoginAttempt($username, $password) {
        ReservationDB::validReservation();
        $dbh = DBInit::getInstance();
        $query = "SELECT COUNT(userID) FROM users WHERE loginName = :username AND userPassw = :password";
        
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(":username",$username);
        $stmt -> bindParam(":password",$password);
        $stmt->execute();
        return $stmt->fetchColumn(0) == 1;
    }
    
    

    public static function returnUser($username, $password){
        $dbh = DBInit::getInstance();
        $query = "SELECT userID,userName,userSurname,familyID,moderator FROM users WHERE loginName = :username AND userPassw = :password";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(":username",$username);
        $stmt -> bindParam(":password",$password);
        $stmt->execute();
       // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        return $result;

    }

    public static function getFamily($familyID){
        $dbh = DBInit::getInstance();
        $query = "SELECT familyName  FROM families WHERE familyID = :familyID";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(":familyID",$familyID);
        $stmt->execute();
       // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getLocations($familyID){
        $dbh = DBInit::getInstance();
        $query = "SELECT *  FROM locations WHERE familyID = :familyID";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(":familyID",$familyID);
       // $stmt ->bindValue(":dane","Ne");
       // $stmt ->bindValue(":jenull","NULL");
        $stmt->execute();
       // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getOpenLocations($familyID){
        $dbh = DBInit::getInstance();
        $query = "SELECT *  FROM locations WHERE familyID = :familyID AND rezervirano !=:da";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(":familyID",$familyID);
        $stmt ->bindValue(":da","Da");
        $stmt->execute();
       // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function write2DB($lokacijaID, $userID, $ura, $datum){
        $dbh = DBInit::getInstance();

        $query = "SET FOREIGN_KEY_CHECKS=0" ;
            $stmt = $dbh->prepare($query);
            $stmt->execute();

        
        $id =1;
        $query = "INSERT INTO rezervacija  (lokacijaID, userID, ura, datum) VALUES (?,?,?,?)";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(1,$lokacijaID);
        $stmt ->bindParam(2,$userID);
        $stmt ->bindParam(3,$ura);
        $stmt ->bindParam(4,$datum);
        $stmt->execute();

        $query = "SELECT rezervacijaID  FROM rezervacija WHERE lokacijaID =:lokacijaID";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam("lokacijaID",$lokacijaID);
        $stmt->execute();
        $rezID = $stmt->fetchALL();

        $query = "UPDATE locations  SET rezervirano =:da_ne, rezervacijaID =:rezID WHERE locationID =:lokacijaID";
        $stmt = $dbh->prepare($query);
        $stmt ->bindValue(":da_ne","Da");
        $stmt ->bindValue("rezID",$rezID[0]["rezervacijaID"]);
        $stmt ->bindParam("lokacijaID",$lokacijaID);
        $stmt->execute();

        $query = "SELECT locationName  FROM locations WHERE locationID = :lokacijaID";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(":lokacijaID",$lokacijaID);
        $stmt->execute(); 
        $imeLoc = $stmt->fetchAll();

        $query = "INSERT INTO history  (userID,familyID, lokacija, datum, ura) VALUES (?,?,?,?,?)";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(1,$userID);
        $stmt ->bindValue(2,$_SESSION["userFamilyID"]);
        $stmt ->bindValue(3,$imeLoc[0]["locationName"]);
        $stmt ->bindParam(4,$datum);
        $stmt ->bindParam(5,$ura);
        $stmt->execute();
       // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        /*$result = $stmt->fetchAll();
        return $result;*/
    }

    public static function getFamiles(){
        $dbh = DBInit::getInstance();
        $query = "SELECT *  FROM families WHERE not familyID =:id";
        $stmt = $dbh->prepare($query);
        $stmt ->bindValue(":id",2);
        $stmt->execute();
       // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function addNew($name, $surname, $username, $password,$familyID){
        $dbh = DBInit::getInstance();
        $query = "INSERT INTO users  (userName, userSurname, loginName, userPassw,familyID) VALUES (?,?,?,?,?)";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(1,$name);
        $stmt ->bindParam(2,$surname);
        $stmt ->bindParam(3,$username);
        $stmt ->bindParam(4,$password);
        $stmt ->bindParam(5,$familyID);
        $stmt->execute();
       // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        /*$result = $stmt->fetchAll();
        return $result;*/
    }

    public static function getHistory($userID){
        $dbh = DBInit::getInstance();
        $query = "SELECT *  FROM history WHERE userID =:userID";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(":userID",$userID);
        $stmt->execute();
       // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function freeLoginName($username){
        $dbh = DBInit::getInstance();
        $query = "SELECT COUNT(userID) FROM users WHERE loginName = :username";
        
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(":username",$username);
        $stmt->execute();
        return $stmt->fetchColumn(0) == 0;
    }

    
}
