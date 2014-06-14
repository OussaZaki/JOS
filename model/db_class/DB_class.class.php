<?php

namespace model\db_class;

include_once $_SERVER['DOCUMENT_ROOT'] . "/jos/config.php";

class DB_Class {

    function __construct() {
        $connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die('Oops connection error -> ' . mysql_error());
        mysql_select_db(DB_DATABASE, $connection) or die('Database error -> ' . mysql_error());
    }

}

