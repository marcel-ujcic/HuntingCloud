<?php

require_once "DBInit.php";

class ReservationDB {
//+ 43200

    public static function validReservation() {
        $dbh = DBInit::getInstance();
        $query = "SELECT * FROM rezervacija WHERE created > unix_timestamp()  " ;
        $stmt = $dbh->prepare($query);
       // $stmt ->bindValue(":nowdate",date("Y-m-d h:i:s"));
        $stmt->execute();
        $result = $stmt->fetchAll();
       
        while(!empty($result)){
            
            $query = "SET FOREIGN_KEY_CHECKS=0" ;
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            
            
           
            $query = "DELETE FROM rezervacija WHERE rezervacijaID =:rezID" ;
            $stmt = $dbh->prepare($query);
            $stmt ->bindValue(":rezID",$result[0]["rezervacijaID"]);
            $stmt->execute(); 
            
            $query = "UPDATE locations SET rezervirano=:dane, rezervacijaID =:nuld WHERE rezervacijaID =:rezID" ;
            $stmt = $dbh->prepare($query);
            $stmt ->bindValue(":dane","Ne");
            $stmt ->bindValue(":nuld",NULL);
            $stmt ->bindValue(":rezID",$result[0]["rezervacijaID"]);
            $stmt->execute();

            $query = "SELECT * FROM rezervacija WHERE created > unix_timestamp()  " ;
            $stmt = $dbh->prepare($query);
           // $stmt ->bindValue(":nowdate",date("Y-m-d h:i:s"));
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        return $result;
    
    }
}