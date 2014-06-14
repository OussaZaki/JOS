<?php

namespace model\articletag;

use core\model\orm\wOrm;

/**
 * Classe ArticleTag
 * @method int getArticle_id()       Returns the tag's id
 * @method int getSoustheme_id()   Returns the article's id
 */
class ArticleSoustheme extends wOrm
{
  protected static $_tableName = 'article_soustheme';

  
  protected $article_id;
  protected $soustheme_id;
  
  public function __construct()
  {
    parent::__construct();
  }

  /* Custom methods should come here */

}

