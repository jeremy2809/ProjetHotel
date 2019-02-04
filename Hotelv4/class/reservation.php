<?php

class reservation{

  
    //Affiches les chambres dispo de date a date
    public static function chambredisponible($db,$depart,$arrive){

        $dispo = $db->query("SELECT c.* FROM reservation r RIGHT JOIN chambre c ON c.nom_chambre = r.nom_chambre WHERE (r.nom_chambre IS NULL) OR ((date_arrive NOT BETWEEN '$arrive' AND '$depart') AND (date_depart NOT BETWEEN '$arrive' AND '$depart'))")->fetchall();
       return $dispo;

    }


    //affiches toutes les chambres
    public static function chambre($db){

        $chambre = $db->query('SELECT * FROM chambre')->fetchall();
        return $chambre;

    }
    // reservation de la chambre
    public static function book($db,$prenom,$chambre,$arrive,$depart){

        $book = $db->query ("INSERT INTO reservation SET nom_chambre = ? ,date_arrive = ? , date_depart = ?,username= ? ",[$_POST['chambre'],$_POST['date_depart'],$_POST['date_arrive'],$prenom]);
    }

    // Montre les reservations en cours
    public static function historique($db,$prenom){

        return  $db->query("SELECT * FROM reservation  Where username= ?",[$prenom])->fetchall();
        
    }
    // Convertion des dates fr->eng
    public static function convertiondate($date){
        
        $date = explode("/", $date);
        return $newdate=$date[2].'-'.$date[1].'-'.$date[0];
    }


}