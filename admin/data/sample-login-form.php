<?php

/*
  Sample Processing of Forgot password form via ajax
  Page: extra-register.html
 */
session_start();
include_once '../include/Admin.php';
$admin = new Admin();
echo 'im here';
# Response Data Array
$resp = array();

// Fields Submitted
$username = $_POST["username"];
$password = $_POST["password"];


// This array of data is returned for demo purpose,
$resp['submitted_data'] = $_POST;


// Login success or invalid login data [success|invalid]
// Your code will decide if username and password are correct
$login_status = 'invalid';


$login = $admin->check_login($username, $password);
if ($login) {
    // Registration Success
    $login_status = 'success';
}

$resp['login_status'] = $login_status;

// Login Success URL
if ($login_status == 'success') {
    // Set the redirect url after successful login
    $resp['redirect_url'] = 'index.php';
}
echo json_encode($resp);
