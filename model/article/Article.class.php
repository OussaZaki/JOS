<?php

namespace model\article;

use core\model\orm\wOrm;
use model\etat\Etat;

/**
 * Classe Article
 * @method int getId()                  Returns the article's id
 * @method string getTitre()            Returns the article's titre
 * @method string getEtat()             Returns the article's hook
 * @method string getText()             Returns the article's text
 * @method boolean getIs_published()    Returns true if the article is published, false otherwise
 * @method string getCreate_date()      Returns the article's creation datetime
 * @method string getUpdate_date()      Returns the article's update datetime
 *
 * @method array getCommentaires()
 */
class Article extends wOrm {
    /* Definition */

    protected $id;
    protected $titre;
    protected $etat;
    protected $format;
    protected $file;
    protected $resume;
    protected $type;
    protected $langue;
    protected $languePresentation;
    protected $AuteurPrincipalID;
    protected $ThemePrincipalID;
    
    public function __construct() {
        parent::__construct();
        $this->addRelation(wOrm::MANY_TO_MANY, array('column' => 'id', 'foreignClass' => 'Tag', 'foreignColumn' => 'id', 'relationClass' => 'ArticleTag'));
        $this->addRelation(wOrm::MANY_TO_MANY, array('column' => 'id', 'foreignClass' => 'Auteur', 'foreignColumn' => 'id', 'relationClass' => 'ArticleAuteurSecond'));
        $this->addRelation(wOrm::MANY_TO_MANY, array('column' => 'id', 'foreignClass' => 'Soustheme', 'foreignColumn' => 'id', 'relationClass' => 'ArticleSoustheme'));
    }

    /* Custom methods should come here */

    /**
     * @return boolean
     */
    public function wichEtat() {
        return Etat::$this->getEtat();
    }

    /**
     * @return int
     */
    public function getNbCommentaires() {
        return count($this->getCommentaires());
    }

}
