<?php

namespace model\soustheme;

use core\model\orm\wOrm;

/**
 * Classe Soustheme
 * @method int getID()        Returns the soustheme's id
 * @method string getNom()   Returns the soustheme's name
 * @method string getThemeID()   Returns the soustheme's Theme
 */
class Soustheme extends wOrm {
    /* Definition */

    protected $id;
    protected $nom;
    protected $themeID;

    public function __construct() {
        parent::__construct();
    }

    /* Custom methods should come here */

    /**
     * @return Article
     */
    public function getTheme() {
        return Theme::find(array('id' => $this->getThemeID()));
    }

    /**
     * @return string
     */
    public function getThemeNom() {
        return $this->getTheme()->getNom();
    }

}
