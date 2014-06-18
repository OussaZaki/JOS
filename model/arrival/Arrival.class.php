<?php

namespace model\arrival;

use core\model\orm\wOrm;

/**
 * Classe Arrival
 * @method int getId()              Returns the arrival's id
 * @method int getTime()            Returns the arrival's time
 * @method int getUser_id()         Returns the arrival's user_id
 * @method int getPlace()           Returns the arrival's place
 */
class Arrival extends wOrm {

    protected static $_tableName = 'arrival';
    protected $id;
    protected $time;
    protected $user_id;
    protected $place;

    public function __construct() {
        parent::__construct();
    }

    public function getAuteur() {
        return Auteur::find(array('id' => $this->getUser_id()));
    }

    public function getAuteurFullName() {
        return $this->getAuteur()->getNom()
                . ' ' . $this->getAuteur()->getPrenom();
    }

}
