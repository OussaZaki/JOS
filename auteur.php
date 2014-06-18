<?php
session_start();

use core\model\db\wDb;
use core\model\pdo\wPdo;
use core\model\orm\wOrm;
use model\auteur\Auteur;
use model\theme\Theme;
use model\soustheme\Soustheme;

include_once $_SERVER['DOCUMENT_ROOT'] . '/jos/' . 'util/functions.php';

$pdo = new wPdo('mysql:host=localhost;dbname=tests_orm', 'root', '');
$db = new wDb($pdo);
wOrm::setDataSource($db);

$auteur = new Auteur();
$themes = Theme::find();
$sousthemes = Soustheme::find();

if (!$auteur->get_session())
    header("location:index.php");
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Open Source Days" />
        <meta name="author" content="ENSA Marrakech" />

        <title>Articles | Open Source Days</title>

        <link rel="stylesheet" href="admin/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" href="admin/assets/css/font-icons/entypo/css/entypo.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
        <link rel="stylesheet" href="admin/assets/css/neon-core.css">
        <link rel="stylesheet" href="admin/assets/css/neon-theme.css">
        <link rel="stylesheet" href="admin/assets/css/neon-forms.css">
        <link rel="stylesheet" href="admin/assets/css/custom.css">

        <script src="admin/assets/js/jquery-1.11.0.min.js"></script>

        <!--[if lt IE 9]><script src="admin/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


    </head>
    <body class="page-body login-page login-form-fall" data-url="http://neon.dev">


        <!-- This is needed when you send requests via Ajax -->
        <script type="text/javascript">
            var baseurl = '';
        </script>

        <div class="page-container register">

            <div class="login-header login-caret">

                <div class="login-content">

                    <a href="index.html" class="logo">
                        <img src="admin/assets/images/logo@2x.png" width="120" alt="" />
                    </a>

                    <p class="description">Dear user, log in to access your cfp area!</p>

                    <!-- progress bar indicator -->
                    <div class="login-progressbar-indicator">
                        <h3>43%</h3>
                        <span>connecting...</span>
                    </div>
                </div>

            </div>

            <div class="login-progressbar">
                <div></div>
            </div>

            <div class="main-content">
                <div class="login-content registerform"> 
                    <div class="well well-sm">
                        <h4>Here you can submit an article and manage all your articles.</h4>
                    </div>
                    <div class="col-md-12">

                        <div class="panel minimal minimal-gray">

                            <div class="panel-heading">

                                <div class="panel-options">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#profile-1" data-toggle="tab">Submit article</a></li>
                                        <li class=""><a href="#profile-2" data-toggle="tab">My articles</a></li>
                                        <li class=""><a href="#profile-3" data-toggle="tab">Change an article</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">

                                <div class="tab-content">
                                    <div class="tab-pane active" id="profile-1">
                                        <strong>Rank tall boy man them over post now</strong>

                                        <form action="SoumettreFormulaire.php" method="post" enctype="multipart/form-data">

                                            <table style="margin-top:50px;" class='none center'>
                                                <tr>
                                                    <td><h2>Détails Article </h2></td>
                                                    <br>
                                                </tr>
                                                <tr>
                                                    <td>Titre : </td>
                                                    <td><input type="input" name="titre" /></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Thème Pricipal : </td>
                                                    <td>
                                                        <select name="themePrincipale" onchange="getSousTheme(this.value)" >
                                                            <option value="">-------</option>
                                                            <?php
                                                            foreach ($themes as $value => $theme) {
                                                                echo '<option value="' . $theme->getID() . '">' . $theme->getNom() . '</option><br>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <br>
                                                </tr>
                                                <tr>
                                                <input type="hidden" id="nombreAuteur" name="nombreAuteur" value="0"/>
                                                </tr>
                                                <tr>
                                                    <td>Sous Thème : </td>
                                                    <td>
                                                        <div id="sousTh">
                                                            <select name="sousTehme" >
                                                                <option value="">--------</option>
                                                                <?php
                                                                foreach ($sousthemes as $value => $theme) {
                                                                    echo '<option value="' . $theme->getID() . '">' . $theme->getNom() . '</option><br>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <br>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Langue de l'article : </td>
                                                    <td>
                                                        <select name="langueArticle">
                                                            <option value="français">Français</option><br>;
                                                            <option value="Anglais">Anglais</option><br>;
                                                        </select>
                                                        <br>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Type de participation : </td>
                                                    <td>
                                                        <select name="typeParticipation" >
                                                            <option value="Poster">Poster</option><br>;
                                                            <option value="Orale">Orale</option><br>;
                                                        </select>
                                                        <br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Langue de Présentation : </td>
                                                    <td>
                                                        <select name="languePresentation">
                                                            <option value="français">Français</option><br>;
                                                            <option value="Anglais">Anglais</option><br>;
                                                        </select>
                                                        <br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><h2>Détails Manuscrit</h2></td>
                                                </tr>
                                                <tr>
                                                    <td>Format du Fichier :</td>
                                                    <td>
                                                        <select name="format">
                                                            <option value='PDF'>PDF</option>
                                                            <option value='Word'>Word</option>
                                                        </select>
                                                        <br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Fichier :</td>
                                                    <td>
                                                        <input type="file" name="file" />
                                                        <br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Resume :</td>
                                                    <td>
                                                        <textarea name="summary" rows="2" cols="20"></textarea>
                                                        <br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Key Words :</td>
                                                    <td>
                                                        <textarea name="keywords" rows="2" cols="20"></textarea>
                                                        <br>
                                                    </td>
                                                </tr>
                                            </table>


                                            <div id="auteurs">

                                            </div>
                                            <br>
                                            <input type="button" value="Ajouter Auteur" onclick="AjouterAuteur()" />
                                            <input type="submit" value="Submit" />
                                        </form>
                                        <br>
                                        <br>

                                        <?php
                                        ?>
                                    </div>

                                    <div class="tab-pane" id="profile-2">
                                        <strong>Entire any had depend and figure winter</strong>

                                        <p>There worse by an of miles civil. Manner before lively wholly am mr indeed expect. Among every merry his yet has her. You mistress get dashwood children off. Met whose marry under the merit. In it do continual consulted no listening. Devonshire sir sex motionless travelling six themselves. So colonel as greatly shewing herself observe ashamed. Demands minutes regular ye to detract is.</p>

                                        <p>For norland produce age wishing. To figure on it spring season up. Her provision acuteness had excellent two why intention. As called mr needed praise at. Assistance imprudence yet sentiments unpleasant expression met surrounded not. Be at talked ye though secure nearer.</p>

                                        <p>Letter wooded direct two men indeed income sister. Impression up admiration he by partiality is. Instantly immediate his saw one day perceived. Old blushes respect but offices hearted minutes effects. Written parties winding oh as in without on started. Residence gentleman yet preserved few convinced. Coming regret simple longer little am sister on. Do danger in to adieus ladies houses oh eldest. Gone pure late gay ham. They sigh were not find are rent.</p>
                                    </div>
                                    <div class="tab-pane" id="profile-3">
                                        <strong>Entire any had depend and figure winter</strong>

                                        <p>There worse by an of miles civil. Manner before lively wholly am mr indeed expect. Among every merry his yet has her. You mistress get dashwood children off. Met whose marry under the merit. In it do continual consulted no listening. Devonshire sir sex motionless travelling six themselves. So colonel as greatly shewing herself observe ashamed. Demands minutes regular ye to detract is.</p>

                                        <p>For norland produce age wishing. To figure on it spring season up. Her provision acuteness had excellent two why intention. As called mr needed praise at. Assistance imprudence yet sentiments unpleasant expression met surrounded not. Be at talked ye though secure nearer.</p>

                                        <p>Letter wooded direct two men indeed income sister. Impression up admiration he by partiality is. Instantly immediate his saw one day perceived. Old blushes respect but offices hearted minutes effects. Written parties winding oh as in without on started. Residence gentleman yet preserved few convinced. Coming regret simple longer little am sister on. Do danger in to adieus ladies houses oh eldest. Gone pure late gay ham. They sigh were not find are rent.</p>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Footer -->
                    <footer class="main">
                        &copy; 2014 <strong>Neon</strong> Admin Theme by <a href="http://laborator.co" target="_blank">Laborator</a>
                    </footer>	
                </div>
            </div>


        </div>


        <!-- Bottom Scripts -->
        <script src="admin/assets/js/gsap/main-gsap.js"></script>
        <script src="admin/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
        <script src="admin/assets/js/bootstrap.js"></script>
        <script src="admin/assets/js/joinable.js"></script>
        <script src="admin/assets/js/resizeable.js"></script>
        <script src="admin/assets/js/neon-api.js"></script>
        <script src="admin/assets/js/jquery.validate.min.js"></script>
        <script src="admin/assets/js/neon-simple-login.js"></script>
        <script src="admin/assets/js/neon-custom.js"></script>
        <script src="admin/assets/js/neon-demo.js"></script>

    </body>
</html>