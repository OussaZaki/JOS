<?php
use core\model\db\wDb;
use core\model\pdo\wPdo;
use core\model\orm\wOrm;

use model\auteur\Auteur;

include_once $_SERVER['DOCUMENT_ROOT'] . '/jos/' . 'util/functions.php';

$aut = new Auteur();

# Response Data Array
$resp = array();
$resp['submitted_data'] = $_POST;
// Fields Submitted
$email = $_POST["email"];

$login_status = 'invalid';

$pdo = new wPdo('mysql:host=localhost;dbname=tests_orm', 'root', '');
$db = new wDb($pdo);
wOrm::setDataSource($db);
$aut = Auteur::findOne(array("email" => $email));
if ($aut) {
    $login_status = 'success';
}

$resp['login_status'] = $login_status;


echo json_encode($resp);
