<?php
session_start();
include_once 'lang/Lang.php';
$lang = new Lang();

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

$aut = new Auteur();
if (isset($_SESSION['userid'])) {
    $ID = $_SESSION['userid'];
}

if (isset($_GET['q']) && $_GET['q'] == 'logout') {
    $aut->user_logout();
    header("location:index.php");
}

/* Sets the connection */
$pdo = new wPdo('mysql:host=localhost;dbname=tests_orm', 'root', '');
$db = new wDb($pdo);
wOrm::setDataSource($db);
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Open Source Days</title>
        <meta name="description" content="The Open Source Day Conference was established as a response to our client's request. The brand created by us has turned into the biggest open source event in Morocco." />
        <meta name="author" content="ENSA Marrakech" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/style.min.css" />
        <link rel="stylesheet" href="css/fonts.css" />
        <link rel="stylesheet" href="css/fontello.css" />
        <link rel="stylesheet" href="css/jquery.countdown.css" />
        <link rel="stylesheet" href="css/flexslider.css" />
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="images/favicon.png" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <header class="top-bar" id="topbar">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <a class="logo pull-left" href="#intro">
                            <span></span>
                        </a>
                        <div class="navbar main-nav pull-right">
                            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <nav>
                                <div class="nav-collapse collapse">
                                    <ul class="nav">
                                        
                                    </ul>
                                    <ul id="mainnav" class="nav">
                                        <li><a href="#about"><?php echo $lang->phrases['about']; ?></a></li>
                                        <li><a href="#speakers"><?php echo $lang->phrases['authors']; ?></a></li>
                                        <li><a href="#schedule"><?php echo $lang->phrases['schedule']; ?></a></li>
                                        <li><a href="#workshops"><?php echo $lang->phrases['workshops']; ?></a></li>
                                        <li><a href="#venue"><?php echo $lang->phrases['venue']; ?></a></li>
                                        <li><a href="#sponsors"><?php echo $lang->phrases['sponsors']; ?></a></li>
                                        <li><a href="#contact"><?php echo $lang->phrases['contact']; ?></a></li>
                                        <?php
                                        if ($aut->get_session()) {
                                            echo '<li><a href="auteur.php">';
                                            echo $lang->phrases['article'];
                                            echo "</a></li>";
                                            echo '<li><a href="profile.php">';
                                            echo $lang->phrases['profile'];
                                            echo "</a></li>";
                                            echo '<li><a href="?q=logout">';
                                            echo $lang->phrases['logout'];
                                            echo "</a></li>";
                                        }
                                        else {
                                            echo '<li><a href="login.php">';
                                            echo $lang->phrases['login'];
                                            echo "</a></li>";
                                            echo '<li><a href="" data-toggle="modal" data-target="#modal-register" >';
                                            echo $lang->phrases['register'];
                                            echo "</a></li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section id="intro">
            <div class="container">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <div class="row jumbotron">
                                <div class="span12 text-center">
                                    <h1><?php echo $lang->phrases['title']; ?></h1>
                                    <h3><?php echo $lang->phrases['theme']; ?></h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row jumbotron">
                                <div class="span12 text-center">
                                    <h1><?php echo $lang->phrases['subtitle']; ?></h1>
                                    <h3 class="info">
                                        <span class="days"><?php echo $lang->phrases['days']; ?></span>
                                        <span class="month"><b><?php echo $lang->phrases['month']; ?></b></span>
                                        <span class="year"><?php echo $lang->phrases['year']; ?></span>
                                        <span class="location"><?php echo $lang->phrases['location']; ?></span>
                                    </h3>
                                    <a href="" data-toggle="modal" data-target="#modal-register" class="btn btn-large"><?php echo $lang->phrases['register']; ?></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row jumbotron">
                                <div class="span12 text-center">
                                    <h1><?php echo $lang->phrases['callForPaper']; ?></h1>
                                    <h3><?php echo $lang->phrases['subCallForPaper']; ?></h3>
                                    <a href="login.php" class="btn btn-large btn-primary"><?php echo $lang->phrases['login']; ?></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="modal hide fade" id="modal-register">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Registration</h3>
            </div>
            <div class="modal-body">
                <ul class="price-table">
                    <li class="price-item clearfix item">
                        <div class="price-header">
                            <span class="title"><?php echo $lang->phrases['rSimple']; ?></span>
                            <span class="price"><?php echo $lang->phrases['rSimplePrice']; ?></span>
                        </div>
                        <div class="price-content">
                            <p><?php echo $lang->phrases['rSimpleResume']; ?></p>
                            <a href="register_sm.php"><input type="button" class="btn" value="<?php echo $lang->phrases['register']; ?>" /></a>
                        </div>
                    </li>
                    <li class="price-item clearfix item">
                        <div class="price-header">
                            <span class="title"><?php echo $lang->phrases['rAuthor']; ?></span>
                            <span class="price"><?php echo $lang->phrases['rAuthorPrice']; ?></span>
                        </div>
                        <div class="price-content">
                            <p><?php echo $lang->phrases['rAuthorResume']; ?></p>
                            <a href="register_au.php"><input type="button" class="btn" value="<?php echo $lang->phrases['register']; ?>" /></a>
                        </div>
                    </li>
                    <li class="price-item clearfix item">
                        <div class="price-header">
                            <span class="title"><?php echo $lang->phrases['rScientific']; ?></span>
                            <span class="price"><?php echo $lang->phrases['rScientificPrice']; ?></span>
                        </div>
                        <div class="price-content">
                            <p><?php echo $lang->phrases['rScientificResume']; ?></p>
                            <a href="register_sc.php"><input type="button" class="btn" value="<?php echo $lang->phrases['register']; ?>" /></a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <a data-dismiss="modal" class="btn"><?php echo $lang->phrases['close']; ?></a>
            </div>
        </div>
        <section id="about">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="module-header about-header">
                            <h4><?php echo $lang->phrases['about']; ?></h4>
                        </div>
                    </div>
                    <div class="span12 hero-unit text-center">
                        <h1><?php echo $lang->phrases['slogan']; ?></h1>
                        <h3><?php echo $lang->phrases['days']; ?> <?php echo $lang->phrases['month']; ?> <?php echo $lang->phrases['year']; ?>, <?php echo $lang->phrases['location']; ?></h3>
                        <h4><?php echo $lang->phrases['resume']; ?></h4>
                    </div>
                    <div class="span12">
                        <div class="divider-space"></div>
                    </div>
                    <div class="span4 text-center">
                        <div class="icon-wrap large color1">
                            <i class="iconf-lightbulb"></i>
                        </div>
                        <h3><?php echo $lang->phrases['subtheme1']; ?></h3>
                        <p><?php echo $lang->phrases['subtheme1resume']; ?></p>
                    </div>
                    <div class="span4 text-center">
                        <div class="icon-wrap large color2">
                            <i class="iconf-world"></i>
                        </div>
                        <h3><?php echo $lang->phrases['subtheme2']; ?></h3>
                        <p><?php echo $lang->phrases['subtheme2resume']; ?></p>
                    </div>
                    <div class="span4 text-center">
                        <div class="icon-wrap large color3">
                            <i class="iconf-beaker"></i>
                        </div>
                        <h3><?php echo $lang->phrases['subtheme3']; ?></h3>
                        <p><?php echo $lang->phrases['subtheme3resume']; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <section id="register">
            <div class="container">
                <div class="row">
                    <div id="countdown"></div>
                    <div class="span12 white register-box text-center">
                        <h2 class="register-title"><?php echo $lang->phrases['registerMark']; ?></h2>
                        <a data-toggle="modal" data-target="#modal-register" id="register-button" class="btn btn-large btn-primary"><?php echo $lang->phrases['registerNow']; ?></a>
                    </div>
                </div>
            </div>
        </section>
        <section id="speakers">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="module-header speakers-header">
                            <h4><?php echo $lang->phrases['authors']; ?></h4>
                        </div>
                    </div>
                    <div class="span12 hero-unit text-center white">
                        <h2><?php echo $lang->phrases['authorsTitle']; ?></h2>
                        <p><?php echo $lang->phrases['authorsResume']; ?></p>
                    </div>
                    <div class="span12">
                        <div class="divider-space"></div>
                    </div>
                    <div class="span12">
                        <div id="speakerscarousel" class="carouselslider speakers-carousel item-4">
                            <ul>
                                <?php
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
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="schedule">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="module-header schedule-header">
                            <h4>Schedule</h4>
                        </div>
                    </div>

                    <div class="span12">
                        <ul id="schedule-tabs" class="nav nav-pills tab-fillspace ">
                            <li class="active">
                                <a href="#dayone" data-toggle="tab">September 23<sup>rd</sup></a>
                            </li>
                            <li class="">
                                <a href="#daytwo" data-toggle="tab">September 24<sup>th</sup></a>
                            </li>
                            <li class="">
                                <a href="#daythree" data-toggle="tab">September 25<sup>th</sup></a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane wo-tab-pane fade in active" id="dayone">
                            <div class="span4">
                                <h2>First Day</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin bibendum ipsum eget nulla molestie, 
                                    vitae ultricies nulla dapibus. Nulla vel faucibus erat, sed malesuada purus. Quisque varius metus 
                                    et erat pulvinar luctus. Fusce neque arcu, viverra vel dui vitae, commodo vulputate orci. Cras et 
                                    ipsum placerat, semper tortor a, venenatis enim. Morbi a vehicula nibh, ac bibendum nulla. Praesent 
                                    tincidunt neque eget lectus mattis ullamcorper.</p>
                                <div class="schedule-download">
                                    <a href="#" class="btn">
                                        <i class="iconf-acrobat"></i>
                                        <p>Full Schedule</p>
                                    </a>
                                </div>
                            </div>

                            <div class="span8">
                                <section class="timeline toggle-shortcode toggles">
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-wine"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>08:00</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Pre-Party <span>Sponsored by Nesyan</span></h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus 
                                                        lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-ok"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>10:00</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Registration</h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus 
                                                        lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-microphone"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>10:50</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Opening Keynote</h3>
                                                    <h4>John Doe <span>Dévan Studio</span></h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula id 
                                                        hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus 
                                                        lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-coffee"></i>
                                            </div>
                                        </div>
                                        <div class="time-box"><time>11:40</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Break <span>Sponsored by Sphere Labs</span></h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus 
                                                        lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-dialogue-box"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>12:00</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Talk: Practical Solutions</h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula id 
                                                        hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus 
                                                        lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-sun"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>13:00</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Lunch <span>Sponsored by Gravity</span></h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec vel 
                                                        neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. Etiam 
                                                        eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam libero. 
                                                        Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula id hendrerit 
                                                        tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus lectus quam, 
                                                        condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-microphone"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>14:10</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>The Future of Web</h3>
                                                    <h4>John Doe</h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus 
                                                        lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-microphone"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>15:00</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Responsive Template Design</h3>
                                                    <h4>John Doe</h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, conimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus 
                                                        lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-videocam"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>15:50</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Project Presentation: Micromoney Payments</h3>
                                                    <h4>John Doe <span>Micromoney</span></h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec vel 
                                                        neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. Etiam 
                                                        eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam libero. 
                                                        Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula id hendrerit 
                                                        tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus lectus quam, 
                                                        condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-pencil2"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>16:40</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Training Sessions</h3>
                                                    <h4>John Doe <span>Developers Camp</span></h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula id 
                                                        hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus 
                                                        lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </section>
                            </div>
                        </div>

                        <div class="tab-pane wo-tab-pane fade" id="daytwo">
                            <div class="span4">
                                <h2>Second Day</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin bibendum ipsum eget nulla molestie, 
                                    vitae ultricies nulla dapibus. Nulla vel faucibus erat, sed malesuada purus. Quisque varius metus 
                                    et erat pulvinar luctus. Fusce neque arcu, viverra vel dui vitae, commodo vulputate orci. Cras et 
                                    ipsum placerat, semper tortor a, venenatis enim. Morbi a vehicula nibh, ac bibendum nulla. Praesent 
                                    tincidunt neque eget lectus mattis ullamcorper.</p>
                                <div class="schedule-download">
                                    <a href="#" class="btn">
                                        <i class="iconf-acrobat"></i>
                                        <p>Full Schedule</p>
                                    </a>
                                </div>
                            </div>

                            <div class="span8">
                                <section class="timeline toggle-shortcode toggles">
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-microphone"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>08:00</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Typography</h3>
                                                    <h4>John Doe <span>Design Association</span></h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus 
                                                        lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-microphone"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>09:20</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Web Fonts</h3>
                                                    <h4>Jane Roe <span>Turbo Fonts</span></h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus 
                                                        lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-microphone"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>10:20</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>One-Page Websites</h3>
                                                    <h4>Richard Miles</h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus 
                                                        lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-coffee"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>11:30</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Break <span>Sponsored by Sphere Labs</span></h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula id 
                                                        hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. Vivamus 
                                                        lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-videocam"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>12:00</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Project Presentation: Facepage App</h3>
                                                    <h4>John Stiles <span>Facepage</span></h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-sun"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>13:00</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Lunch <span>Sponsored by Gravity</span></h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta.
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-microphone"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>14:10</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Mobile Platforms</h3>
                                                    <h4>John Doe</h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-videocam"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>15:30</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Project Presentation: Handsome Fonts Website</h3>
                                                    <h4>John Smith<span>GBVFD Design Firm</span></h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-pencil2"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>16:40</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Training Sessions: jQuery</h3>
                                                    <h4>Carla Coe <span>Developers Camp</span></h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </section>
                            </div>
                        </div>

                        <div class="tab-pane wo-tab-pane fade" id="daythree">
                            <div class="span4">
                                <h2>Third Day</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin bibendum ipsum eget nulla molestie, 
                                    vitae ultricies nulla dapibus. Nulla vel faucibus erat, sed malesuada purus. Quisque varius metus 
                                    et erat pulvinar luctus. Fusce neque arcu, viverra vel dui vitae, commodo vulputate orci. Cras et 
                                    ipsum placerat, semper tortor a, venenatis enim. Morbi a vehicula nibh, ac bibendum nulla. Praesent 
                                    tincidunt neque eget lectus mattis ullamcorper.</p>
                                <div class="schedule-download">
                                    <a href="#" class="btn">
                                        <i class="iconf-acrobat"></i>
                                        <p>Full Schedule</p>
                                    </a>
                                </div>
                            </div>

                            <div class="span8">
                                <section class="timeline toggle-shortcode toggles">
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-microphone"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>08:00</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>HTML5</h3>
                                                    <h4>Paula Poe</h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-dialogue-box"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>09:00</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Q&amp;A with Quintin Qoe</h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta.
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-coffee"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>11:30</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Break <span>Sponsored by Sphere Labs</span></h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-videocam"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>12:00</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Project Presentation: Web Audio</h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-sun"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>13:30</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Lunch <span>Sponsored by Gravity</span></h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-microphone"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>14:40</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Vector Illustrations</h3>
                                                    <h4>Marta Moe</h4>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula id 
                                                        hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-microphone"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>15:30</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>Closing Remarks</h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="event">
                                        <div class="timeline-icon">
                                            <div class="timeline-icon-container">
                                                <i class="iconf-wine"></i>
                                            </div>
                                        </div>
                                        <div class="time-box">
                                            <time>16:50</time>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="event-content">
                                                <div class="toggle-item-title event-title" data-count="1">
                                                    <h3>After-Party <span>Sponsored by Dévan</span></h3>
                                                </div>
                                                <div class="toggle-item-body" style="display: none;">
                                                    <p>Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio. Cum sociis 
                                                        natoquesel usts et magnis dis parturient montes, nascetur ridiculust mus. Donec 
                                                        vel neque ligula, sed cust metus. Vivamus porta velit at metus convallis porta. 
                                                        Etiam eget nunc ante. Nullam sit amet act nisis egestr sapien. Aliquam nec aliquam 
                                                        libero. Vestibulum consectetur sodales adipiscing. Vestibulum mi neque, vehicula 
                                                        id hendrerit tincidunt, aliquam nec elitas quisque pellentesque varius urna. 
                                                        Vivamus lectus quam, condimentum vitae tincidunt vel, congue id odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="workshops">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="module-header workshops-header">
                            <h4>Workshops</h4>
                        </div>
                    </div>
                    <ul class="event-items">
                        <li class="event-item clearfix span4">
                            <div class="event-date">
                                <time datetime="2014-09-23">Tuseday Sep. 23</time>
                            </div>
                            <div class="share-widget">
                                <a href="#"><i class="iconf-facebook"></i></a>
                                <a href="#"><i class="iconf-twitter"></i></a>
                            </div>
                            <br class="clearfix" />
                            <div class="event-entry text-center">
                                <h3 class="entry-title">Education Seminar</h3>
                                <p class="lead">Speaker: James Joe</p>
                                <div class="event-image">
                                    <img src="images/photos/780x780-02.jpg" alt="Education Seminar" class="img-circle" />
                                </div>
                                <div class="entry-content">
                                    <h4><time datetime="09:00">9:30 AM - 1:00 PM</time></h4>
                                    <h4>Downtown Conference Center</h4>
                                    <p>Nullam nibh leo, tempus quis lobortis nec, imperdiet in nibh. Nulla nec tortor non nulla sodales 
                                        mattis eu at purus. Nam posuere gravida turpis nec congue.</p>
                                </div>
                            </div>
                        </li>
                        <li class="event-item clearfix span4">
                            <div class="event-date">
                                <time datetime="2014-09-24">Wednesday Sep. 24</time>
                            </div>
                            <div class="share-widget">
                                <a href="#"><i class="iconf-facebook"></i></a>
                                <a href="#"><i class="iconf-twitter"></i></a>
                            </div>
                            <br class="clearfix" />
                            <div class="event-entry text-center">
                                <h3 class="entry-title">HTML5 & CSS3</h3>
                                <p class="lead">Speaker: James Joe</p>
                                <div class="event-image">
                                    <img src="images/photos/780x780-04.jpg" alt="HTML5 & CSS3" class="img-circle" />
                                </div>
                                <div class="entry-content">
                                    <h4><time datetime="14:00">2:00 - 4:30 PM</time></h4>
                                    <h4>Downtown Conference Center</h4>
                                    <p>Nullam nibh leo, tempus quis lobortis nec, imperdiet in nibh. Nulla nec tortor non nulla sodales 
                                        mattis eu at purus. Nam posuere gravida turpis nec congue.</p>
                                </div>
                            </div>
                        </li>
                        <li class="event-item clearfix span4">
                            <div class="event-date">
                                <time datetime="2014-09-25">Tursday Sep. 25</time>
                            </div>
                            <div class="share-widget">
                                <a href="#"><i class="iconf-facebook"></i></a>
                                <a href="#"><i class="iconf-twitter"></i></a>
                            </div>
                            <br class="clearfix" />
                            <div class="event-entry text-center">
                                <h3 class="entry-title">jQuery Master Class</h3>
                                <p class="lead">Speaker: James Joe</p>
                                <div class="event-image">
                                    <img src="images/photos/780x780-03.jpg" alt="jQuery Master Class" class="img-circle" />
                                </div>
                                <div class="entry-content">
                                    <h4><time datetime="12:30">12:30 - 2:00 PM</time></h4>
                                    <h4>Downtown Conference Center</h4>
                                    <p>Nullam nibh leo, tempus quis lobortis nec, imperdiet in nibh. Nulla nec tortor non nulla sodales 
                                        mattis eu at purus. Nam posuere gravida turpis nec congue.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>     
        <section id="venue" class="white">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="module-header venue-header">
                            <h4>Venue</h4>
                        </div>
                    </div>
                    <div class="span12 hero-unit text-center white">
                        <h4>Conference Will Be Held At</h4>
                        <h2>Downtown Conference Center</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus iaculis porta. 
                            Vivamus mattis tempus aliquet.</p>
                    </div>
                    <div class="span12 text-center">
                        <p>Aenean eget ullamcorper nisi. Nullam faucibus purus in porttitor iaculis. Sed tristique 
                            est non lorem sollicitudin, non aliquam ligula tincidunt. Curabitur luctus aliquam orci eu semper. 
                            Donec nec lorem sapien. Proin aliquam, eros feugiat iaculis tristique, lorem eros aliquet nisl, nec 
                            commodo est erat quis augue.</p>
                    </div>
                    <div class="span12">
                        <div class="subheader">
                            <h4>Getting Here</h4>
                        </div>
                    </div>
                    <div class="span4 text-center">
                        <div class="icon-wrap medium color1">
                            <i class="iconf-flight"></i>
                        </div>
                        <h3>Air Travel</h3>
                        <p>Donec risus augue, ultricies quis ornare ac, malesuada non augue. Ut venenatis tempus semper. 
                            Curabitur rhoncus, nulla sed rhoncus sollicitudin, dolor quam vehicula odio.</p>
                    </div>
                    <div class="span4 text-center">
                        <div class="icon-wrap medium color2">
                            <i class="iconf-road"></i>
                        </div>
                        <h3>By Car</h3>
                        <p>Donec risus augue, ultricies quis ornare ac, malesuada non augue. Ut venenatis tempus semper. 
                            Curabitur rhoncus, nulla sed rhoncus sollicitudin, dolor quam vehicula odio.</p>
                    </div>
                    <div class="span4 text-center">
                        <div class="icon-wrap medium color3">
                            <i class="iconf-suitcase"></i>
                        </div>
                        <h3>Travel Notes</h3>
                        <p>Donec risus augue, ultricies quis ornare ac, malesuada non augue. Ut venenatis tempus semper. 
                            Curabitur rhoncus, nulla sed rhoncus sollicitudin, dolor quam vehicula odio.</p>
                    </div>
                    <div class="span12">
                        <div class="subheader">
                            <h4>Hotels Nearby</h4>
                        </div>
                    </div>
                    <div class="span4 text-center">
                        <h3>Hotel Babylon</h3>
                        <p>177A Bleecker St. New York, NY 10019<br>Phone: (212) 234-5670</p>
                        <a href="#" title="website">
                            <div class="icon-wrap small color4">
                                <i class="iconf-monitor"></i>
                            </div>
                        </a>
                        <a href="#" title="map">
                            <div class="icon-wrap small color4">
                                <i class="iconf-map-pointer"></i>
                            </div>
                        </a>
                    </div>
                    <div class="span4 text-center">
                        <h3>Hilbert's Hotel</h3>
                        <p>175 5th Ave. Flatiron District, New York, NY 10010<br>Phone: (212) 426-3050</p>
                        <a href="#" title="website">
                            <div class="icon-wrap small color4">
                                <i class="iconf-monitor"></i>
                            </div>
                        </a>
                        <a href="#" title="map">
                            <div class="icon-wrap small color4">
                                <i class="iconf-map-pointer"></i>
                            </div>
                        </a>
                    </div>
                    <div class="span4 text-center"><h3>Hyperion Hotel</h3>
                        <p>890 5th Ave. New York, NY 10019<br>Phone: (212) 357-4600</p>
                        <a href="#" title="website">
                            <div class="icon-wrap small color4">
                                <i class="iconf-monitor"></i>
                            </div>
                        </a>
                        <a href="#" title="map">
                            <div class="icon-wrap small color4">
                                <i class="iconf-map-pointer"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section id="map">
            <div id="map_canvas"></div>
        </section>
        <section id="sponsors">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="module-header sponsors-header">
                            <h4>Sponsors</h4>
                        </div>
                    </div>
                    <div class="span12 hero-unit text-center">
                        <h2>Sponsorship plays a major role in the success of our event.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus iaculis porta. 
                            Vivamus mattis tempus aliquet.</p>
                    </div>
                    <div class="span12 text-center">
                        <div class="subheader">
                            <h4>Main Sponsors</h4>
                        </div>
                    </div>
                    <div class="span4 text-center">
                        <a href="#"><img src="images/sponsors/01.png" alt="" class="sponsor-logo" /></a>
                    </div>
                    <div class="span4 text-center">
                        <a href="#"><img src="images/sponsors/02.png" alt="" class="sponsor-logo" /></a>
                    </div>
                    <div class="span4 text-center">
                        <a href="#"><img src="images/sponsors/03.png" alt="" class="sponsor-logo" /></a>
                    </div>
                    <div class="span12">
                        <div class="subheader">
                            <h4>Collaborators</h4>
                        </div>
                    </div>
                    <div class="span3 text-center">
                        <a href="#"><img src="images/sponsors/04.png" alt="" class="sponsor-logo" /></a>
                    </div>
                    <div class="span3 text-center">
                        <a href="#"><img src="images/sponsors/05.png" alt="" class="sponsor-logo" /></a>
                    </div>
                    <div class="span3 text-center">
                        <a href="#"><img src="images/sponsors/06.png" alt="" class="sponsor-logo" /></a>
                    </div>
                    <div class="span3 text-center">
                        <a href="#"><img src="images/sponsors/07.png" alt="" class="sponsor-logo" /></a>
                    </div>
                    <div class="span12">
                        <div class="subheader">
                            <h4>Media Sponsors</h4>
                        </div>
                    </div>
                    <div class="span2 text-center">
                        <a href="#"><img src="images/sponsors/08.png" alt="" class="sponsor-logo" /></a>
                    </div>
                    <div class="span2 text-center">
                        <a href="#"><img src="images/sponsors/09.png" alt="" class="sponsor-logo" /></a>
                    </div>
                    <div class="span2 text-center">
                        <a href="#"><img src="images/sponsors/10.png" alt="" class="sponsor-logo" /></a>
                    </div>
                    <div class="span2 text-center">
                        <a href="#"><img src="images/sponsors/11.png" alt="" class="sponsor-logo" /></a>
                    </div>
                    <div class="span2 text-center">
                        <a href="#"><img src="images/sponsors/12.png" alt="" class="sponsor-logo" /></a>
                    </div>
                    <div class="span2 text-center">
                        <a href="#"><img src="images/sponsors/13.png" alt="" class="sponsor-logo" /></a>
                    </div>
                </div>
            </div>
        </section>
        <section id="news">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="module-header news-header">
                            <h4>News</h4>
                        </div>
                    </div>
                    <ul class="news-items hfeed">
                        <li class="news-item clearfix span4">
                            <div class="news-date">
                                <span class="month">May</span>
                                <span class="day">16</span>
                            </div>
                            <div class="share-widget">
                                <a href="#"><i class="iconf-facebook"></i></a>
                                <a href="#"><i class="iconf-twitter"></i></a>
                            </div>
                            <br class="clearfix" />
                            <div class="news-entry">
                                <h3 class="entry-title">2014 Conference Will Be Held in September</h3>
                                <div class="entry-image">
                                    <img src="images/photos/780x475-01.jpg" alt="News Image" />
                                </div>
                                <div class="entry-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales tincidunt sodales. 
                                        Nam tellus velit, hendrerit ac venenatis adipiscing, sollicitudin vitae orci. Vestibulum 
                                        mollis pharetra metus sit amet convallis.</p>
                                    <a href="#">Read full story <i class="iconf-angle-right"></i></a>
                                </div>
                            </div>
                        </li>
                        <li class="news-item clearfix span4">
                            <div class="news-date">
                                <span class="month">April</span>
                                <span class="day">25</span>
                            </div>
                            <div class="share-widget">
                                <a href="#"><i class="iconf-facebook"></i></a>
                                <a href="#"><i class="iconf-twitter"></i></a>
                            </div>
                            <br class="clearfix" />
                            <div class="news-entry">
                                <h3 class="entry-title">Conference Location at the Heart of NY</h3>
                                <div class="entry-image">
                                    <img src="images/photos/780x475-02.jpg" alt="News Image" />
                                </div>
                                <div class="entry-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales tincidunt sodales. 
                                        Nam tellus velit, hendrerit ac venenatis adipiscing, sollicitudin vitae orci. Vestibulum 
                                        mollis pharetra metus sit amet convallis.</p>
                                    <a href="#">Read full story <i class="iconf-angle-right"></i></a>
                                </div>
                            </div>
                        </li>
                        <li class="news-item clearfix span4">
                            <div class="news-date">
                                <span class="month">February</span>
                                <span class="day">17</span>
                            </div>
                            <div class="share-widget">
                                <a href="#"><i class="iconf-facebook"></i></a>
                                <a href="#"><i class="iconf-twitter"></i></a>
                            </div>
                            <br class="clearfix" />
                            <div class="news-entry">
                                <h3 class="entry-title">Things You Can See While You Are Here</h3>
                                <div class="entry-image">
                                    <img src="images/photos/780x475-03.jpg" alt="News Image" />
                                </div>
                                <div class="entry-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales tincidunt sodales. 
                                        Nam tellus velit, hendrerit ac venenatis adipiscing, sollicitudin vitae orci. Vestibulum 
                                        mollis pharetra metus sit amet convallis.</p>
                                    <a href="#">Read full story <i class="iconf-angle-right"></i></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section id="contact" class="white">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="module-header contact-header">
                            <h4>Contact</h4>
                        </div>
                    </div>
                    <div class="span12 hero-unit text-center white">
                        <h2>Get in touch</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus iaculis porta. Vivamus mattis tempus aliquet.</p>
                    </div>
                    <form action="#" >
                        <div class="control-group span4">
                            <label for="contact-name" class="control-label">Name:</label>
                            <div class="controls">
                                <input type="text" id="contact-name" class="input-block-level" required/="" />
                            </div>
                        </div>
                        <div class="control-group span4">
                            <label for="contact-email" class="control-label">Email:</label>
                            <div class="controls">
                                <input type="email" id="contact-email" class="input-block-level" required/="" />
                            </div>
                        </div>
                        <div class="control-group span4">
                            <label for="contact-subject" class="control-label">Subject:</label>
                            <div class="controls">
                                <input type="text" id="contact-subject" class="input-block-level" />
                            </div>
                        </div>
                        <div class="control-group span12">
                            <label for="contact-message" class="control-label">Message:</label>
                            <div class="controls">
                                <textarea name="contact-message" id="contact-message" cols="30" rows="6" class="input-block-level">
                                </textarea>
                            </div>
                        </div>

                        <div class="control-group span12">
                            <div class="controls">
                                <input type="submit" class="btn btn-primary pull-right" value="Send Message" />
                            </div>
                        </div>
                    </form>

                    <div class="span12 text-center">
                        <div class="subheader">
                            <h4>Contact info</h4>
                        </div>
                    </div>
                    <div class="span12 text-center">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales tincidunt sodales. Nam tellus velit, 
                            hendrerit ac venenatis adipiscing, sollicitudin vitae orci. Vestibulum mollis pharetra metus sit amet convallis.</p>
                    </div>
                    <div class="span4 text-center">
                        <p><i class="iconf-mobile"></i> Inqueries: +1 234 567 89 00</p>
                    </div>
                    <div class="span4 text-center">
                        <p><i class="iconf-money"></i> Prices and Media: +1 234 567 89 00</p>
                    </div>
                    <div class="span4 text-center">
                        <p><i class="iconf-mail"></i> Email: <a href="info@eventify2014.com">info@eventify2014.com</a></p>
                    </div>

                    <div class="span12 text-center">
                        <div class="social">
                            <a href="#" target="_blank" title="Facebook" class="icon-wrap small facebook"><i class="iconf-facebook"></i></a>
                            <a href="#" target="_blank" title="Twitter" class="icon-wrap small twitter"><i class="iconf-twitter"></i></a>
                            <a href="#" target="_blank" title="Google+" class="icon-wrap small google"><i class="iconf-gplus"></i></a>
                            <a href="#" target="_blank" title="Linkedin" class="icon-wrap small linkedin"><i class="iconf-linkedin"></i></a>
                            <a href="#" target="_blank" title="RSS" class="icon-wrap small rss"><i class="iconf-rss"></i></a>
                            <a href="#" target="_blank" title="Vimeo" class="icon-wrap small vimeo"><i class="iconf-vimeo"></i></a>
                            <a href="#" target="_blank" title="Flickr" class="icon-wrap small flickr"><i class="iconf-flickr"></i></a>
                            <a href="#" target="_blank" title="Lanyrd" class="icon-wrap small lanyrd"><i class="iconf-lanyrd"></i></a>
                            <a href="#" target="_blank" title="Eventbrite" class="icon-wrap small eventbrite"><i class="iconf-eventbrite"></i></a>
                            <a href="#" target="_blank" title="Eventful" class="icon-wrap small eventful"><i class="iconf-eventful"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="newsletter">
            <div class="container">
                <div class="row">
                    <div class="span12 hero-unit text-center">
                        <h2>Subscribe to Our Newsletter</h2>
                    </div>
                    <form action="#" >
                        <div class="control-group span4 offset4 text-center">
                            <div class="controls">
                                <input type="email" id="subscribe-email" class="input-block-level" value="Your Email Address" required="" />
                                <input type="submit" class="btn btn-primary" value="Send Message" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>        
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="span12 text-center">
                        <img src="images/logo-footer.png" alt="Eventify" />
                        <div class="copyright">
                            © 2013 <a href="http://www.alialamshahi.com">Ali Alamshahi</a>, All rights reserved. Eventify is organised by 
                            <a href="#">Lorem ipsum</a><br /> 
                            Purchase this template @ Themeforest
                        </div>
                        <a href="http://validator.w3.org/check?verbose=1&amp;uri=http%3A%2F%2Falialamshahi.com%2Fthemes%2Feventify%2F">Valid HTML5</a>
                    </div>
                </div>
            </div>
        </footer>

        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="js/jquery.ui.map.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
        <script type="text/javascript" src="js/jquery.carousel.js"></script>
        <script type="text/javascript" src="js/jquery.scrollTo-1.4.3.1-min.js"></script>
        <script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
        <script type="text/javascript" src="js/jquery.localscroll-1.2.7-min.js"></script>
        <script type="text/javascript" src="js/jquery.nav.js"></script>
        <script type="text/javascript" src="js/jquery.countdown.min.js"></script>
        <script type="text/javascript" src="js/tweetie.min.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>


    </body>
</html>