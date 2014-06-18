<?php

namespace model\auteursoustheme;

use core\model\orm\wOrm;
use core\model\db\wDb;
use core\model\pdo\wPdo;
use model\auteur\Auteur;

/**
 * Classe Auteursoustheme
 * @method int getUser_id()        Returns the user's id
 * @method int getSoustheme_id()   Returns the soustheme's id
 */
class Auteursoustheme extends wOrm {

    protected static $_tableName = 'auteur_soustheme';
    protected $auteur_id;
    protected $soustheme_id;

    public function __construct() {
        parent::__construct();
    }

    /* Custom methods should come here */

    public function getAuteur() {
        $pdo = new wPdo('mysql:host=localhost;dbname=tests_orm', 'root', '');
        $db = new wDb($pdo);
        wOrm::setDataSource($db);
        return Auteur::findOne(array('id' => $this->getAuteur_id()));
    }

    public function getAuteurFullName() {
        $pdo = new wPdo('mysql:host=localhost;dbname=tests_orm', 'root', '');
        $db = new wDb($pdo);
        wOrm::setDataSource($db);
        $aut = new Auteur();
        $aut = $this->getAuteur();
        return $aut->nom
                . ' ' . $aut->prenom;
    }

}
