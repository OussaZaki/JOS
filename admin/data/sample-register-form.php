<?php

/*
  Sample Processing of Register form via ajax
  Page: extra-register.html
 */

# Response Data Array
$resp = array();

// Fields Submitted
$dateFile = "oussama.txt";

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$nationality = $_POST["nationality"];
$phone = $_POST["phone"];
$adress = $_POST["adress"];
$country = $_POST["country"];
$city = $_POST["city"];
$zip = $_POST["zip"];
$resume = $_POST["resume"];
$email = $_POST["email"];

$dataString = "";
$dataString .= json_encode($_POST);
$fWrite = fopen($dateFile, "a");
$wrote = fwrite($fWrite, $dataString);
fclose($fWrite);
// This array of data is returned for demo purpose, see assets/js/neon-register.js
$resp['submitted_data'] = $_POST;

if($email == "zaki.oussama@gmail.com")
    echo "1";