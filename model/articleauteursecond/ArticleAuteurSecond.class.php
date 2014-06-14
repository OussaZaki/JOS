<?php

namespace model\Articleauteursecond;

use core\model\orm\wOrm;

/**
 * Classe ArticleTag
 * @method int getTagId()       Returns the tag's id
 * @method int getArticleId()   Returns the article's id
 */
class ArticleAuteurSecond extends wOrm
{
  protected static $_tableName = 'article_auteur_second';

  
  protected $article_id;
  protected $auteur_id;
  
  public function __construct()
  {
    parent::__construct();
  }

  /* Custom methods should come here */

}

