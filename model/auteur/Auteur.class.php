<?php

namespace model\auteur;
use core\model\orm\wOrm;
include_once './config.php';


class DB_Class {
    function __construct() {
        $connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die('Oops connection error -> ' . mysql_error());
        mysql_select_db(DB_DATABASE, $connection) or die('Database error -> ' . mysql_error());
    }
}


/**
 * Classe Auteur
 * @method int getId()                  Returns the auteur's id
 * @method string getEmail()            Returns the auteur's email
 * @method string getPass()             Returns the auteur's pass
 * @method string getNom()              Returns the auteur's nom
 * @method string getPrenom()           Returns the auteur's prenom
 */
class Auteur extends wOrm {
    /* Definition */

    protected $id;
    protected $email;
    protected $pass;
    protected $nom;
    protected $prenom;
    protected $adresse;
    protected $tel;
    protected $pays;
    protected $nationalite;
    protected $laboratoire;
    protected $equipeTravaille;


    public function __construct() {
        parent::__construct();
        $db = new DB_Class();
        $this->addRelation(wOrm::ONE_TO_MANY, array('column' => 'id', 'foreignClass' => 'Article', 'foreignColumn' => 'AuteurPrincipalID'));
    }

    /* Custom methods should come here */

    /**
     * @return boolean
     */
    public function check_login($email, $password) {
        $password = md5($password);

        $result = mysql_query("SELECT ID from auteur WHERE email = '$email' and pass = '$password'");
        if ($result === FALSE) {
            die(mysql_error()); // TODO: better error handling
        } else {
            $user_data = mysql_fetch_array($result);
            $no_rows = mysql_num_rows($result);

            if ($no_rows == 1) {
                $_SESSION['login'] = true;
                $_SESSION['ID'] = $user_data['ID'];
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    /**
     * @return boolean
     */
    public function get_session() {
        if (isset($_SESSION['login']))
            return $_SESSION['login'];
        else
            return false;
    }

    public function user_logout() {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }

}
