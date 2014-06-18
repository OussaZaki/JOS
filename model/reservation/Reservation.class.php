<?php

namespace model\reservation;

use core\model\orm\wOrm;

/**
 * Classe Reservation
 * @method int getId()              Returns the reservation's id
 * @method int getCheckIn()         Returns the reservation's checkIn
 * @method int getCheckOut()        Returns the reservation's checkOut
 * @method int getUser_id()         Returns the reservation's user_id
 * @method int getHotel_id()        Returns the reservation's hotel_id
 * @method int getChamber_type()    Returns the reservation's chamber_type
 * @method int getOk()              Returns the reservation's ok
 */
class Reservation extends wOrm {

    protected static $_tableName = 'reservation';
    
    protected $id;
    protected $checkIn;
    protected $checkOut;
    protected $user_id;
    protected $hotel_id;
    protected $chamber_type;
    protected $ok;

    public function __construct() {
        parent::__construct();
    }

    /* Custom methods should come here */

    public function isOk() {
        return $this->ok;
    }

    public function setOk() {
        $this->ok = 1;
    }

    public function getAuteur() {
        return Auteur::find(array('id' => $this->getUser_id()));
    }

    public function getAuteurFullName() {
        return $this->getAuteur()->getNom()
                . ' ' . $this->getAuteur()->getPrenom();
    }

}
