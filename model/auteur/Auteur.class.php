<?php

namespace model\auteur;

use core\model\orm\wOrm;
use model\db_class\DB_Class;

/**
 * Classe Auteur
 * @method int getId()                  Returns the auteur's id
 * @method string getEmail()            Returns the auteur's email
 * @method string getPass()             Returns the auteur's pass
 * @method string getNom()              Returns the auteur's nom
 * @method string getPrenom()           Returns the auteur's prenom
 * @method string getAdresse()          Returns the auteur's adresse
 * @method string getTel()              Returns the auteur's tel
 * @method string getPays()             Returns the auteur's pays
 * @method string getNationalite()      Returns the auteur's nationalite
 * @method string getLaboratoire()      Returns the auteur's laboratoire
 * @method string getEquipeTravaille()  Returns the auteur's equipeTravaille
 * @method string getResume()           Returns the auteur's resume
 * @method string getWichone()          Returns the auteur's wichone
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
    protected $institution;
    protected $laboratoire;
    protected $equipeTravaille;
    protected $resume;
    protected $wichone;
    protected $picture;
    
    public function __construct() {
        parent::__construct();
        $db = new DB_Class();
        //$this->addRelation(wOrm::ONE_TO_MANY, array('column' => 'id', 'foreignClass' => 'Article', 'foreignColumn' => 'auteur_principal_id'));
        $this->addRelation(wOrm::ONE_TO_ONE, array('column' => 'id', 'foreignClass' => 'Reservation', 'foreignColumn' => 'user_id'));
        $this->addRelation(wOrm::ONE_TO_ONE, array('column' => 'id', 'foreignClass' => 'Arrival', 'foreignColumn' => 'user_id'));
        //$this->addRelation(wOrm::MANY_TO_MANY  , array('column' => 'id', 'foreignClass' => 'Soustheme', 'foreignColumn' => 'id', 'relationClass' => 'Auteursoustheme'));
        //$this->__init($email, $pass, $nom, $prenom, $tel, $adresse, $zip, $city, $pays, $resume, $nationalite, $institution, $institutionName, $laboratoire, $equipeTravaille, $wichone);
    }

    public function __init($email, $pass, $nom, $prenom, $tel, $adresse, $zip, $city, $pays, $resume, $nationalite, $institution, $institutionName, $laboratoire, $equipeTravaille, $wichone) {
        $pdo = new wPdo('mysql:host=localhost;dbname=tests_orm', 'root', '');
        $db = new wDb($pdo);
        wOrm::setDataSource($db);

        $this->email = $email;
        $this->pass = $pass;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse . ' ' . $zip . ' ' . $city;
        $this->tel = $tel;
        $this->pays = $pays;
        $this->nationalite = $nationalite;
        $this->resume = $resume;

        $this->institution = $institution . ' : ' . $institutionName;
        $this->laboratoire = $laboratoire;
        $this->equipeTravaille = $equipeTravaille;
        $this->wichone = $wichone;     
    }

    /* Custom methods should come here */

    /**
     * @return boolean
     */
    public function check_login($email, $password) {
        $password = md5($password);
        
        $result = mysql_query("SELECT id from auteur WHERE email = '$email' and pass = '$password'");
        if ($result === FALSE) {
            die(mysql_error()); // TODO: better error handling
        } else {
            $user_data = mysql_fetch_array($result);
            $no_rows = mysql_num_rows($result);

            if ($no_rows == 1) {
                $_SESSION['loginUser'] = true;
                $_SESSION['userid'] = $user_data['id'];
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
        if (isset($_SESSION['loginUser']))
            return $_SESSION['loginUser'];
        else
            return false;
    }

    public function user_logout() {
        $_SESSION['loginUser'] = FALSE;
        session_destroy();
    }

//    /**
//     * @return int
//     */
//    public function NbSousthemes() {
//        return count($this->getSousthemes());
//    }
//
//    /**
//     * @return int
//     */
//    public function getNbArticles() {
//        return count($this->getArticles());
//    }

}
