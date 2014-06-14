<?php

namespace model\hotel;

use core\model\orm\wOrm;

/**
 * Classe Hotel
 * @method int getID()       Returns the Hotel's id
 * @method string getNom()   Returns the Hotel's name
 * @method int getStars()    Returns the Hotel's stars
 * @method string getURL()   Returns the Hotel's URL
 */
class Hotel extends wOrm
{
  /* Definition */
  protected $id;
  protected $nom;
  protected $stars;
  protected $url;

  public function __construct()
  {
    parent::__construct();
  }

  /* Custom methods should come here */
}

