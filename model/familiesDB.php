<?php

require_once "DBInit.php";

class familiesDB {
//+ 43200

    public static function returnFamilies() {
        $dbh = DBInit::getInstance();
        $query = "SELECT * FROM families WHERE NOT familyID =:id" ;
        $stmt = $dbh->prepare($query);
        $stmt ->bindValue(":id",2);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function returnMessages($familyID) {
        $dbh = DBInit::getInstance();
        $query = "SELECT * FROM messages WHERE  familyID =:id ORDER BY created DESC" ;
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(":id",$familyID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getAllReservations($familyID) {
        $dbh = DBInit::getInstance();
       
        $query = "SELECT r.*, u.userName, u.userSurname FROM history r, users u WHERE  u.userID = r.userID AND u.familyID =:id" ;
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(":id",$familyID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function writeMSG($ID,$title,$msg){
        $dbh = DBInit::getInstance();
    
        $query = "INSERT INTO messages  (familyID, title,context) VALUES (?,?,?)";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(1,$ID);
        $stmt ->bindParam(2,$title);
        $stmt ->bindParam(3,$msg);
        $stmt->execute();
    }

    public static function deleteMsg($fID, $msgID){
        $dbh = DBInit::getInstance();
        $query = "DELETE FROM messages  WHERE ID =:msgID AND familyID=:fID";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam("msgID",$msgID);
        $stmt ->bindParam("fID",$fID);
        $stmt->execute();
    }

}