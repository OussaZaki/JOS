<?php
session_start();

use core\model\db\wDb;
use core\model\pdo\wPdo;
use core\model\orm\wOrm;
use model\admin\Admin;

include_once $_SERVER['DOCUMENT_ROOT'] . '/jos/' . 'util/functions.php';

$admin = new Admin();
$ID = $_SESSION['ID'];

if (!$admin->get_session()) {
    header("location:login.php");
} else {
    $pdo = new wPdo('mysql:host=localhost;dbname=tests_orm', 'root', '');
    $db = new wDb($pdo);
    wOrm::setDataSource($db);
    $admin = Admin::findOne(array('id' => $ID));
}
if (isset($_GET['q']) && $_GET['q'] == 'logout') {
    $admin->user_logout();
    header("location:login.php");
}
?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Administration" />
        <meta name="author" content="" />

        <title>JOS | Administration</title>


        <link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/neon-core.css">
        <link rel="stylesheet" href="assets/css/neon-theme.css">
        <link rel="stylesheet" href="assets/css/neon-forms.css">
        <link rel="stylesheet" href="assets/css/custom.css">

        <script src="assets/js/jquery-1.11.0.min.js"></script>

        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


    </head>
    <body class="page-body  page-fade" data-url="http://neon.dev">

        <div class="page-container">
            <div class="sidebar-menu">


                <header class="logo-env">

                    <!-- logo -->
                    <div class="logo">
                        <a href="index.html">
                            <img src="assets/images/logo@2x.png" width="120" alt="" />
                        </a>
                    </div>

                    <!-- logo collapse icon -->

                    <div class="sidebar-collapse">
                        <a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>



                    <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                    <div class="sidebar-mobile-menu visible-xs">
                        <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>

                </header>

                <ul id="main-menu" class="">
                    <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                    <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                    <!-- Search Bar -->
                    <li id="search">
                        <form method="get" action="">
                            <input type="text" name="q" class="search-input" placeholder="Search something..."/>
                            <button type="submit">
                                <i class="entypo-search"></i>
                            </button>
                        </form>
                    </li>
                    <li class="active opened active">
                        <a href="index.html">
                            <i class="entypo-gauge"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="layout-api.html">
                            <i class="entypo-layout"></i>
                            <span>Front End</span>
                        </a>
                        <ul>
                            <li>
                                <a href="layout-api.html">
                                    <span>Version Française</span>
                                </a>
                            </li>
                            <li>
                                <a href="layout-collapsed-sidebar.html">
                                    <span>Version Anglaise</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.html" target="_blank">
                            <i class="entypo-monitor"></i>
                            <span>Site Web</span>
                        </a>
                    </li>
                    <li>
                        <a href="ui-panels.html">
                            <i class="entypo-newspaper"></i>
                            <span>Soumissions</span>
                        </a>
                        <ul>
                            <li>
                                <a href="ui-panels.html">
                                    <span>Articles</span>
                                </a>
                            </li>
                            <li>
                                <a href="ui-tiles.html">
                                    <span>Affectation</span>
                                </a>
                            </li>
                            <li>
                                <a href="forms-buttons.html">
                                    <span>Comité Scientifique</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="mailbox.html">
                            <i class="entypo-mail"></i>
                            <span>Participations</span>
                        </a>
                        <ul>
                            <li>
                                <a href="mailbox.html">
                                    <i class="entypo-inbox"></i>
                                    <span>Liste des participants</span>
                                </a>
                            </li>
                            <li>
                                <a href="mailbox-compose.html">
                                    <i class="entypo-pencil"></i>
                                    <span>Réservation</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="extra-gallery.html">
                                            <span>Liste des hotels</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="extra-gallery-single.html">
                                            <span>Ajouter un hotel</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="mailbox-message.html">
                                    <i class="entypo-attach"></i>
                                    <span>Service transport</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="forms-main.html">
                            <i class="entypo-doc-text"></i>
                            <span>Calendrier</span>
                        </a>
                    </li>
                    <li>
                        <a href="tables-main.html">
                            <i class="entypo-window"></i>
                            <span>Notes</span>
                        </a>
                    </li>
                    <li>
                        <a href="tables-main.html">
                            <i class="entypo-window"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                </ul>

            </div>	
            <div class="main-content">

                <div class="row">

                    <!-- Profile Info and Notifications -->
                    <div class="col-md-6 col-sm-8 clearfix">

                        <ul class="user-info pull-left pull-none-xsm">

                            <!-- Profile Info -->
                            <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="assets/images/thumb-1@2x.png" alt="" class="img-circle" width="44" />
                                    <?php echo $admin->full_name ?>
                                </a>

                                <ul class="dropdown-menu">

                                    <!-- Reverse Caret -->
                                    <li class="caret"></li>

                                    <!-- Profile sub-links -->
                                    <li>
                                        <a href="extra-timeline.html">
                                            <i class="entypo-user"></i>
                                            Edit Profile
                                        </a>
                                    </li>

                                    <li>
                                        <a href="extra-calendar.html">
                                            <i class="entypo-calendar"></i>
                                            Calendar
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="entypo-clipboard"></i>
                                            Notes
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>

                </div>

                <hr />
                <ol class="breadcrumb bc-3">
                    <li>
                        <a href="index.php"><i class="entypo-home"></i>Admin</a>
                    </li>
                    <li>

                        <a href="fr.php">Front End</a>
                    </li>
                    <li class="active">

                        <strong>Version française</strong>
                    </li>
                </ol>

                <h2>Version française</h2>
                <br />



                <form role="form" class="form-horizontal form-groups-bordered">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary" data-collapsed="0">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        Information Générale
                                    </div>

                                    <div class="panel-options">
                                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="title" class="col-sm-3 control-label">Titre des journées</label>

                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="title" placeholder="Nouveau titre">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle" class="col-sm-3 control-label">Abreviation du titre</label>

                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="subtitle" placeholder="OSD 2014">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="theme" class="col-sm-3 control-label">Thème</label>

                                        <div class="col-sm-5">
                                            <textarea class="form-control autogrow" id="theme" placeholder="detailler le theme de l'event."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary" data-collapsed="0">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        Dates et Lieu
                                    </div>

                                    <div class="panel-options">
                                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="date">Date de l'evenement</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="date" class="form-control daterange" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="location">Location</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control typeahead" data-prefetch="admin/data/countries.json" name="location" id="city" placeholder="Lieu de l'event" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit" class="btn btn-default">Enregistrer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </form>



        <!-- Footer -->
        <footer class="main">

            &copy; 2014 <strong>Neon</strong> Admin Theme by <a href="http://laborator.co" target="_blank">Laborator</a>

        </footer>	
    </div>


    <!-- Sample Modal (Default skin) -->
    <div class="modal fade" id="sample-modal-dialog-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Widget Options - Default Modal</h4>
                </div>

                <div class="modal-body">
                    <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sample Modal (Skin inverted) -->
    <div class="modal invert fade" id="sample-modal-dialog-2">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Widget Options - Inverted Skin Modal</h4>
                </div>

                <div class="modal-body">
                    <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sample Modal (Skin gray) -->
    <div class="modal gray fade" id="sample-modal-dialog-3">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Widget Options - Gray Skin Modal</h4>
                </div>

                <div class="modal-body">
                    <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="assets/js/rickshaw/rickshaw.min.css">
    <link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="assets/js/icheck/skins/minimal/_all.css">
    <link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
    <link rel="stylesheet" href="assets/js/select2/select2.css">
    <link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css">
    <link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="assets/js/icheck/skins/minimal/_all.css">
    <link rel="stylesheet" href="assets/js/icheck/skins/square/_all.css">
    <link rel="stylesheet" href="assets/js/icheck/skins/flat/_all.css">
    <link rel="stylesheet" href="assets/js/icheck/skins/futurico/futurico.css">
    <link rel="stylesheet" href="assets/js/icheck/skins/polaris/polaris.css">

    <!-- Bottom Scripts -->
    <script src="assets/js/gsap/main-gsap.js"></script>
    <script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/joinable.js"></script>
    <script src="assets/js/resizeable.js"></script>
    <script src="assets/js/typeahead.min.js"></script>
    <script src="assets/js/select2/select2.min.js"></script>
    <script src="assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="assets/js/neon-api.js"></script>
    <script src="assets/js/jquery.bootstrap.wizard.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/jquery.inputmask.bundle.min.js"></script>
    <script src="assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/bootstrap-switch.min.js"></script>
    <script src="assets/js/neon-custom.js"></script>
    <script src="assets/js/neon-demo.js"></script>
    <script src="assets/js/icheck/icheck.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/bootstrap-timepicker.min.js"></script>
    <script src="assets/js/daterangepicker/moment.min.js"></script>
    <script src="assets/js/daterangepicker/daterangepicker.js"></script>
    <script src="assets/js/jquery.multi-select.js"></script>
    <script src="assets/js/neon-register.js"></script>

</body>
</html>