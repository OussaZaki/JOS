<?php

/* Core */

use core\model\db\wDb;
use core\model\pdo\wPdo;
use core\model\orm\wOrm;

/* Models */
use model\tag\Tag;
use model\article\Article;
use model\theme\Theme;
use model\admin\Admin;
use model\auteur\Auteur;
use model\soustheme\Soustheme;

include_once $_SERVER['DOCUMENT_ROOT'] . '/jos/' . 'util/functions.php';

try {
    /* Sets the connection */
    $pdo = new wPdo('mysql:host=localhost;dbname=tests_orm', 'root', '');
    $db = new wDb($pdo);
    wOrm::setDataSource($db);

    /* Tests */
    echo '<b>Database overview :</b>';
    echo '<br />';
    echo '- ' . Admin::count() . ' admin(s)';
    echo '<br />';
    echo '- ' . Auteur::count() . ' auteur(s)';
    echo '<br />';
    echo '- ' . Soustheme::count() . ' soustheme(s)';
    echo '<br />';
    echo '- ' . Article::count() . ' article(s)';
    echo '<br />';
    echo '- ' . Theme::count() . ' commentaire(s)';
    echo '<br />';
    echo '- ' . Tag::count() . ' tag(s)';
    echo '<br />';
    $all = Auteur::find(array('wichone' => "author"));
    foreach ($all as $aut) {

        echo '<li>';
        echo '<div class="item">';
        echo '<div class="photo-wrap hover_colour">';
        echo '<img src="' . $aut->getPicture() . '" alt=" " />';
        echo '</div>';
        echo '<div class="text-wrap white">';
        echo '<h3>' . $aut->getNom() . ' ' . $aut->getPrenom() . '</h3>';
        echo '<h5>' . $aut->getInstitution() . '</h5>';
        echo '<hr class="divider-short center" />';
        echo '<p class="description">' . $aut->getResume() . '</p>';
        echo '</div>';
        echo '<div class="social">';
        echo '<p class="description">' . $aut->getEmail() . '<br>' . $aut->getTel() . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</li>';
    }
    //Creat Auteur
    echo '<br />';
    echo '<b>Create a new \'Auteur\' :</b>';
    echo '<br />';

//    $aut                  = new Auteur();
//    $aut->email           = 'zakiou@gmail.com';
//    $aut->pass            = md5('123456');
//    $aut->nom             = 'zaki';
//    $aut->prenom          = 'Oussama';
//    $aut->adresse         = '31 Rue 4 hay souaret';
//    $aut->tel             = '0617 11 11 20';
//    $aut->pays            = 'Maroc';
//    $aut->nationalite     = 'Marocain';
//    $aut->laboratoire     = 'Genie Informatique';
//    $aut->equipeTravaille = 'AEI ENSA M';
//
//    $aut->save();
//    echo '<br />';
    //Creat Theme
    echo '<br />';
    echo '<b>Create a new \'Theme\' :</b>';
    echo '<br />';

//    $them                  = new Theme();
//    $them->nom           = 'Informatique';
//
//    $them->save();
    echo '<br />';

    //Creat SousTheme
    echo '<br />';
    echo '<b>Create relations \'Theme\' :</b>';
    echo '<br />';
    $them = new Theme();
    $them = Theme::findOne(array('nom' => 'Informatique'));
    echo $them;
    echo '<br />';
    $sthem1 = Soustheme::findOne(array('nom' => 'PHP'));
    echo '<br />';
    echo $them->ID;
    echo '<br />';
    $sthem1->ThemeID = $them->ID;
    echo '<b>testingID</b>';
    echo '<br />';
    echo $sthem1->ThemeID;
    echo '<br />';
    $sthem1->save();

    $sthem2 = Soustheme::findOne(array('nom' => 'Java'));
    $sthem2->ThemeID = $them->ID;
    $sthem2->save();
    $them->setSousthemes(array($sthem1, $sthem2));
    echo 'After: ' . $them->getNbSousthemes();
//    $sthem1->setthemeID($them->getID());

    foreach ($them->getSousthemes() as $St) {
        echo '<li>' . $St->getNom() . '</li>';
    }
    dpm($them);
    $them->save(TRUE);
//
//    $sthem                  = new Soustheme();
//    $sthem->nom            = 'PHP';
//    $sthem->theme           = 'Informatique';
//    $sthem->save();
//    $sthem                  = new Soustheme();
//    $sthem->nom            = 'Java';
//    $sthem->theme           = 'Informatique';
//    $sthem->save();

    echo '<br />';

    echo '<b>Database overview :</b>';
    echo '<br />';
    echo '- ' . Admin::count() . ' admin(s)';
    echo '<br />';
    echo '- ' . Auteur::count() . ' auteur(s)';
    echo '<br />';
    echo '- ' . Soustheme::count() . ' soustheme(s)';
    echo '<br />';
    echo '- ' . Article::count() . ' article(s)';
    echo '<br />';
    echo '- ' . Theme::count() . ' commentaire(s)';
    echo '<br />';
    echo '- ' . Tag::count() . ' tag(s)';
    echo '<br />';

//    $article = Article::findOne(array('id' => 1));
//
//    echo '<br />';
//    echo 'L\'article intitul&eacute; "';
//    echo $article->getTitle();
//    echo '" comporte ';
//    echo $article->getNbCommentaires();
//    echo ' commentaire(s).';
//
//    echo '<br />';
//    echo '<br />';
//
//    echo '<b>Create a new \'Commentaire\' :</b>';
//    echo '<br />';
//
//    $comment                = new Commentaire();
//    $comment->author        = 'William';
//    $comment->message       = 'Hi ! How are you ? That\'s pretty cool ! =P';
//    $comment->is_published  = 1;
//    $comment->save();
//
//    echo 'It got the id : ' . $comment->getId() . '.';
//
//    echo '<br />';
//    echo '<br />';
//    echo '<b>Gonna retrieve it...</b>';
//    echo '<br />';
//
//    $a_comment = Commentaire::findOne(array('id' => $comment->getId()));
//    echo $a_comment->getMessage() . ' <em>by ' . $a_comment->getAuthor() . '</em>.';
//
//    echo '<br />';
//    echo '<br />';
//    echo '<b>Playing with relations :</b>';
//    echo '<br />';
//    echo 'Adds two comments to our article (1-N relation) : how many comments has it ?';
//    echo '<br />';
//
//    $comment2                = new Commentaire();
//    $comment2->author        = 'William (again)';
//    $comment2->message       = 'Hi ! This comment will not be registered until the article be saved.';
//    $comment2->is_published  = 1;
//
//    echo 'Before: ' . $article->getNbCommentaires();
//    echo '<br />';
//
//    $article->setCommentaires(array($comment, $comment2));
//
//    echo 'After: ' . $article->getNbCommentaires();
//    echo '<br />';
//    echo '<br />';
//    echo 'Comment\'s article :';
//    echo '<br />';
//    echo '<ul>';
//
//    foreach($article->getCommentaires() as $c) {
//        echo '<li>' . $c->getAuthor() . ' <i>said</i> ' . $c->getMessage() . '</li>';
//    }
//
//    echo '</ul>';
//    echo '<br />';
//    echo '<b>And now ?</b>';
//    echo '<br />';
//
//    echo '- ' . Article::count() . ' article(s)';
//    echo '<br />';
//    echo '- ' . Commentaire::count() . ' commentaire(s)';
//    echo '<br />';
//    echo '- ' . Tag::count() . ' tag(s)';
//    echo '<br />';
//    echo '<br />';
//
//    echo '<b>Delete the comment !</b>';
//
//    $comment->delete();
//
//    echo '<br />';
//    echo '<br />';
//    echo '<b>The end !</b>';
//    echo '<br />';
//
//    echo '- ' . Article::count() . ' article(s)';
//    echo '<br />';
//    echo '- ' . Commentaire::count() . ' commentaire(s)';
//    echo '<br />';
//    echo '- ' . Tag::count() . ' tag(s)';
//    echo '<br />';
//    echo '<br />';
} catch (\Exception $e) {
    echo 'Ooops! ' . $e->getMessage() . '<br />';
}