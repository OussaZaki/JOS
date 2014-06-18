<?php

namespace model\theme;

use core\model\orm\wOrm;

/**
 * Classe Theme
 * @method int getId()       Returns the theme's id
 * @method string getNom()   Returns the theme's nom
 * @method array getSousthemes()
 */
class Theme extends wOrm
{
  /* Definition */
  protected $id;
  protected $nom;

  public function __construct()
  {
    parent::__construct();
    $this->addRelation(wOrm::ONE_TO_MANY, array('column' => 'id', 'foreignClass' => 'Article', 'foreignColumn' => 'ThemePrincipalID'));
    $this->addRelation(wOrm::ONE_TO_MANY, array('column' => 'id', 'foreignClass' => 'Soustheme', 'foreignColumn' => 'themeID'));
  }
  
  public function __toString()
  {
    return $this->getNom();
  }
  
  /* Custom methods should come here */
  
  public function getNbSousthemes()
  {
    return count($this->getSousthemes());
  }
  
  public function getNbArticles()
  {
    return count($this->getArticles());
  }
}

