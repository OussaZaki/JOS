<?php

/* Core */
use core\model\db\wDb;
use core\model\pdo\wPdo;
use core\model\orm\wOrm;

/* Models */
use model\auteur\Auteur;
use model\soustheme\Soustheme;
use model\arrival\Arrival;
use model\reservation\Reservation;

include_once $_SERVER['DOCUMENT_ROOT'] . '/jos/'.'util/functions.php';

$pdo = new wPdo('mysql:host=localhost;dbname=tests_orm', 'root', '');
$db  = new wDb($pdo);
wOrm::setDataSource($db);

# Response Data Array
$resp = array();

// Fields Submitted
$dateFile = "oussama.txt";
$dataString = json_encode($_POST);
$fWrite = fopen($dateFile, "a");
$wrote = fwrite($fWrite, $dataString . "\n");
//

$wichOne = $_POST["wichOne"];
$email = $_POST["email"];

if($email == "zaki.oussama@gmail.com")
    echo "1";
else{
    $aut    = new Auteur($_POST["favThemes"], $email, $_POST["password"], $_POST["last_name"], $_POST["first_name"], $_POST["phone"], $_POST["adress"], $_POST["zip"], 
        $_POST["city"], $_POST["country"], $_POST["resume"], $_POST["nationality"], $_POST["institution"], $_POST["institutionName"], 
        $_POST["laboratory"], $_POST["workteam"], $wichOne, $_POST["hotel"], $_POST["checkInOut"], 
        $_POST["roomType"], $_POST["arrivalTime"], "airport");
    
    
}
//
//$aut                  = new Auteur();
//$aut->email           = $email;
//$aut->pass            = md5($_POST["password"]);
//
//$aut->nom             = $_POST["last_name"];
//$aut->prenom          = $_POST["first_name"];
//$aut->adresse         = $_POST["adress"] . ' ' . $_POST["zip"].' '.$_POST["city"];
//$aut->tel             = $_POST["phone"];
//$aut->pays            = $_POST["country"];
//$aut->nationalite     = $_POST["nationality"];
//$aut->resume          = $_POST["resume"];
//
//$aut->institution = $_POST["institution"]. ' : ' . $_POST["institutionName"];
//$aut->laboratoire = $_POST["laboratory"];
//$aut->equipeTravaille = $_POST["workteam"];
//$aut->wichone  = $wichOne;
//
//$wrote = fwrite($fWrite, "*creating user\n");
//
//$i = 0;
//if($wichOne=="comitee"){
//    foreach ($_POST["favThemes"] as $sousthemeID){
//        $ssthemes[$i] = new Soustheme();
//        $ssthemes[$i] = Soustheme::findOne(array('id' => $sousthemeID));
//        $i++;
//    }
//}
//$aut->setComiteeSousthemes($ssthemes);
//$wrote = fwrite($fWrite, "*theme\n");
//
//// reservation
//if(isset($_POST["hotel"])){
//    $res                  = new Reservation();
//    if( isset($_POST["checkInOut"]) && !empty($_POST["checkInOut"])){
//        $check = explode(" - ", $_POST["checkInOut"]);
//        $res->checkIn         = $check[0];
//        $res->checkOut        = $check[1];
//    }
//}
//$res->hotel_id = $_POST["hotel"];
//$res->chamber_type = $_POST["roomType"];
//
//$aut->setReservation($res);
//$wrote = fwrite($fWrite, "*reservation\n");
//
//// pick Up
//$arr                  = new Arrival();
//$arr->time = $_POST["arrivalTime"];
//$arr->place = "airport";
//
//$aut->setArrival($arr);
//$wrote = fwrite($fWrite, "*arrival\n");
//$aut->save();

$wrote = fwrite($fWrite, "*saving\n");
fclose($fWrite);
