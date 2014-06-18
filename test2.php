<?php
namespace test2;
/* Core */
use core\model\db\wDb;
use core\model\pdo\wPdo;
use core\model\orm\wOrm;

/* Models */
use model\auteursoustheme\Auteursoustheme;
use model\soustheme\Soustheme;
use model\auteur\Auteur;
use model\reservation\Reservation;
use model\arrival\Arrival;

include_once $_SERVER['DOCUMENT_ROOT'] . '/jos/'.'util/functions.php';

$pdo = new wPdo('mysql:host=localhost;dbname=tests_orm', 'root', '');
$db  = new wDb($pdo);
wOrm::setDataSource($db);

# Response Data Array
$resp = array();

// Fields Submitted
$dateFile = "oussama.txt";
$fWrite = fopen($dateFile, "a");
//

$wichOne = "comitee";
$email = "zakii@hot.me";
//$wrote = fwrite($fWrite, "*arrival" . "\n");
$aut                  = new Auteur();
$aut->email           = $email;
$aut->pass            = md5("123");

$aut->nom             = "ZAKI";
$aut->prenom          = "Oussama";
$aut->adresse         = "LOT ZAHRA 1 N 22 VILLA NAKHIL SEMLALIA" . ' ' . "40060".' '."";
$aut->tel             = "212617111120";
$aut->pays            = "Afghan";
$aut->nationalite     = "Afghan";
$aut->resume          = "";
//
$aut->institution = "University". ' : ' . "qsdqsd";
$aut->laboratoire = "sqdqsd";
$aut->equipeTravaille = "qqqqqqqqq";
$aut->wichone  = $wichOne;


$wrote = fwrite($fWrite, "*creating user" . "\n");


//
//$wrote = fwrite($fWrite, "*theme\n");
//
$hotel = 1;
// reservation
if(isset($hotel)){
//if(isset($_POST["hotel"])){
    $res                  = new Reservation();
        $check = explode(" - ", "March 13, 2014 - March 27, 2014");
        $res->checkIn         = $check[0];
        $res->checkOut        = $check[1];
}
$res->hotel_id = $hotel;
$res->chamber_type = "Double";

//
$wrote = fwrite($fWrite, "*reservation" . "\n");

// pick Up
$arr                  = new Arrival();
$arr->time = "7:00 AM";
$arr->place = "airport";


$aut->setArrival($arr);
$aut->setReservation($res);


echo '<br />';
echo '<br />';
echo "done";
//echo '<br />';
//$aut->save();
$aut = Auteur::findOne(array('email' => $email));
echo $aut->getId();
$favThemes = array(5, 10);

if($wichOne=="comitee"){
    foreach ($favThemes as $sousthemeID){
//    //foreach ($_POST["favThemes"] as $sousthemeID){
//        
        $ssthemes = new Auteursoustheme();
        $ssthemes->auteur_id = $aut->getId();
        $ssthemes->soustheme_id = $sousthemeID;
        print_r($ssthemes);
        $ssthemes->save();
        
    }
}
$wrote = fwrite($fWrite, "*saving" . "\n");
fclose($fWrite);

?>