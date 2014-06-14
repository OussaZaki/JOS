<?php

use core\model\db\wDb;
use core\model\pdo\wPdo;
use core\model\orm\wOrm;
use model\soustheme\Soustheme;
use model\hotel\Hotel;

include_once $_SERVER['DOCUMENT_ROOT'] . '/jos/' . 'util/functions.php';

$pdo = new wPdo('mysql:host=localhost;dbname=tests_orm', 'root', '');
$db = new wDb($pdo);
wOrm::setDataSource($db);

$themes = Soustheme::find();
$hotels = Hotel::find();

$nationalities = array();
if (($handle = fopen("lang/nationalities.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
        foreach ($data as $value => $title) {
            $nationalities[$value] = $title;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Neon Admin Panel" />
        <meta name="author" content="" />

        <title>Neon | Register</title>


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
        <div class="page-container register"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	

            <div class="login-header login-caret">
                <div class="login-content">
                    <a href="index.html" class="logo">
                        <img src="admin/assets/images/logo@2x.png" width="120" alt="" />
                    </a>

                    <p class="description">Create an account, it's free and takes few moments only!</p>

                    <!-- progress bar indicator -->
                    <div class="login-progressbar-indicator">
                        <h3>43%</h3>
                        <span>logging in...</span>
                    </div>
                </div>
            </div>

            <div class="login-progressbar">
                <div></div>
            </div>

            <div class="main-content">
                <div class="login-content registerform"> 

                    <h4>Form Wizard with Validation <small>- add class <strong>validate</strong> to the form</small></h4>
                    <hr />

                    <div class="well well-sm">
                        <h4>Please fill the details to register new account.</h4>
                    </div>

                    <form method="post" role="form" id="form_register" class="form-wizard validate">

                        <div class="form-register-success">
                            <i class="entypo-check"></i>
                            <h3>You have been successfully registered.</h3>
                            <p>We have emailed you the confirmation link for your account.</p>
                        </div>

                        <div class="steps-progress">
                            <div class="progress-indicator"></div>
                        </div>

                        <ul id="timeliiine">
                            <li class="active">
                                <a href="#tab2-1" data-toggle="tab"><span>1</span>Personal Info</a>
                            </li>
                            <li>
                                <a href="#tab2-2" data-toggle="tab"><span>2</span>Professional Info</a>
                            </li>
                            <li>
                                <a href="#tab2-3" data-toggle="tab"><span>3</span>Booking</a>
                            </li>
                            <li>
                                <a href="#tab2-4" data-toggle="tab"><span>4</span>Register</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!--Tab 1 Personal-->
                            <div class="tab-pane active" id="tab2-1">

                                <div class="row">

                                    <!--First Name-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="first_name">First Name</label>
                                            <input class="form-control" name="first_name" id="first_name" data-validate="required" placeholder="Your first name" />
                                        </div>
                                    </div>

                                    <!--Last Name-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="last_name">Last Name</label>
                                            <input class="form-control" name="last_name" id="last_name" data-validate="required" placeholder="Your last name" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <!--Nationality-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="nationality">Nationality</label>
                                            <select name="nationality" id='nationality' class="selectboxit visible" data-first-option="false">
                                                <option disabled="disabled">Select a Nationality</option>
                                                <?php
                                                foreach ($nationalities as $value => $title) {
                                                    echo '<option value="' . $title . '">' . $title . '</option>';
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                    <!--Phone number-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="tel">Phone number</label>
                                            <input class="form-control" name="tel" id="tel" data-validate="required" data-mask="phone" placeholder="Your phone number" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <!--Adress-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="address_line">Address</label>
                                            <input class="form-control" name="address_line" id="address_line" placeholder="Your address" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <!--City-->
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label" for="city">City</label>
                                            <input type="text" class="form-control typeahead" data-prefetch="admin/data/countries.json" name="city" id="city" placeholder="Current city" />
                                        </div>
                                    </div>

                                    <!--Country-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="country">Country</label>

                                            <select name="country" id="country" class="selectboxit visible" data-first-option="false">
                                                <option disabled="disabled">Select a Country</option>
                                                <?php
                                                foreach ($nationalities as $value => $title) {
                                                    echo '<option value="' . $title . '">' . $title . '</option>';
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                    <!--Zip-->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label" for="zip">Zip</label>
                                            <input class="form-control" name="zip" id="zip" data-mask="*****" data-validate="required" placeholder="Zip Code" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <!--Resume-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="about">Write Something About You</label>
                                            <textarea class="form-control autogrow" name="about" id="about" data-validate="minlength[10]" rows="5" placeholder="Could be used also as Motivation Letter"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--Tab 2 Professional-->
                            <div class="tab-pane" id="tab2-2">

                                <strong>Working environment</strong>
                                <br />
                                <br />
                                <div class="row">
                                    
                                    <!-- Institution -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label" for="optionsRadios">Institution</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="institution" id="institution" value="Society">Society
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label" for="optionsRadios">&nbsp;</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="institution" id="institution" value="University" checked="">University
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Institution Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="institutionName">Institution Name</label>
                                            <input type="text" class="form-control" name="institutionName" id="institutionName" placeholder="Institution's name" />
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <!-- Laboratory -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="laboratory">Laboratory</label>
                                            <input type="text" class="form-control" name="laboratory" id="laboratory" placeholder="laboratory's name" />
                                        </div>
                                    </div>
                                    
                                    <!-- Work Team -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="workteam">Work Team</label>
                                            <input type="text" class="form-control" name="workteam" id="workteam" placeholder="Your work team" />
                                        </div>
                                    </div>
                                </div>

                                <br />
                                <strong>Favorite revision themes</strong>
                                <br />
                                <br />

                                <div class="row">
                                    <!-- fav theme -->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Themes List</label>

                                        <div class="col-sm-7">
                                            <select multiple="multiple" id="favThemes" name="my-select[]" class="form-control multi-select">
                                                <?php
                                                foreach ($themes as $value => $theme) {
                                                    echo '<option value="' . $theme->getID() . '">' . $theme->getNom() . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Tab 3 Booking-->
                            <div class="tab-pane" id="tab2-3">

                                <strong>Hotel Booking - You can skip this step !</strong>
                                <br />
                                <br />

                                <div class="row">
                                    <!-- Hotel -->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">List of our partner hotels</label>

                                        <div class="col-sm-7">
                                            <ul class="icheck-list">
                                                <?php
                                                foreach ($hotels as $value => $hotel) {
                                                    echo '<li>';
                                                    echo '<input type="radio" id="hotels" name="hotel-' . $hotel->getID() . '" value="' . $hotel->getID() . '">';
                                                    echo '<label for="hotel-' . $hotel->getID() . '">&nbsp;&nbsp;&nbsp;' . $hotel->getNom() . '</label>';
                                                    echo '<a href="' . $hotel->getURL() . '"> - <span class="badge badge-success">' . $hotel->getStars() . '</span> Stars - Website </a>';
                                                    echo '</li>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <br />
                                <br />
                                
                                <div class="row">
                                    <!-- Check In -->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Check In/Check Out</label>

                                        <div class="col-sm-5">

                                            <div class="daterange daterange-inline" data-format="MMMM D, YYYY" data-start-date="March 13, 2014" data-end-date="March 27, 2014">
                                                <i class="entypo-calendar"></i>
                                                <span id="checkInOut">March 13, 2014 - March 27, 2014</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <br />
                                <br />
                                
                                <div class="row">
                                    <!-- Room Type -->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="roomType">Room type</label>
                                        <div class="col-md-5">
                                            <select name="roomType" id="roomType" class="form-control">
                                                <option value="Single">Single room</option>
                                                <option value="Studio">Studio room</option>
                                                <option value="Double">Double room</option>
                                                <option value="Duplex">Duplex room</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <br />
                                <br />
                                <strong>* foreign travelers, you can indicate your arrival time in order to benefit our transportation services.</strong>
                                <br />
                                <br />
                                
                                <div class="row">
                                    <!-- Arrival Time -->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Arrival time</label>

                                        <div class="col-sm-4">
                                            <div class="input-group minimal">
                                                <div class="input-group-addon">
                                                    <i class="entypo-clock"></i>
                                                </div>
                                                <input type="text" id="arrivalTime" class="form-control timepicker">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <br />
                                <br />
                            </div>

                            <!--Tab 4 Register-->
                            <div class="tab-pane" id="tab2-4">

                                <div class="form-group">
                                    <label class="control-label">Enter your Email</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="entypo-user"></i>
                                        </div>

                                        <input type="text" class="form-control" name="email" id="email" data-validate="email" placeholder="Email Field">
                                    </div>
                                    <p class="email_exist text-danger"></p>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Choose Password</label>

                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="entypo-key"></i>
                                                </div>

                                                <input type="password" class="form-control" name="password" id="password" data-validate="required" placeholder="Enter strong password" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">						
                                        <div class="form-group">
                                            <label class="control-label">Repeat Password</label>

                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="entypo-cw"></i>
                                                </div>

                                                <input type="password" class="form-control" name="password" id="password" data-validate="required,equalTo[#password]" data-message-equal-to="Passwords doesn't match." placeholder="Confirm password" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br />
                                <p><strong>*  Please transfer the amount indicated in the previous list in the following bank account, and send as a copy of your paymenent recipient in order to confirm your registration.</strong></p>

                                <p><strong>Account N°:</strong> 1906199322111992</p>
                                <p><strong>Email     :</strong> payment@jos.com</p>
                                <br />
                                <div class="col-md-12">	
                                    <div class="form-group">
                                        <div class="checkbox checkbox-replace">

                                            <input type="checkbox" name="checkUs" id="checkUs">
                                            <label for="checkUs">By registering I accept terms and conditions.</label>
                                            <p class="checkUs_val text-danger"></p>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="form-group">
                                    <input name="register" type="button" value="Finish Registration" class="btn btn-primary"> 
                                    <!--                                    <button type="submit" class="btn btn-primary">Finish Registration</button>-->
                                </div>

                            </div>

                            <ul class="pager wizard">
                                <li class="previous">
                                    <a href="#"><i class="entypo-left-open"></i> Previous</a>
                                </li>

                                <li class="next">
                                    <a href="#">Next <i class="entypo-right-open"></i></a>
                                </li>
                            </ul>
                        </div>

                    </form>

                    <!-- Footer -->
                    <footer class="main">
                        &copy; 2014 <strong>Neon</strong> Admin Theme by <a href="http://laborator.co" target="_blank">Laborator</a>
                    </footer>	
                </div>
            </div>

        </div>

        <link rel="stylesheet" href="admin/assets/js/icheck/skins/minimal/_all.css">
        <link rel="stylesheet" href="admin/assets/js/icheck/skins/square/_all.css">
        <link rel="stylesheet" href="admin/assets/js/icheck/skins/flat/_all.css">
        <link rel="stylesheet" href="admin/assets/js/icheck/skins/futurico/futurico.css">
        <link rel="stylesheet" href="admin/assets/js/icheck/skins/polaris/polaris.css">
        <link rel="stylesheet" href="admin/assets/js/icheck/skins/line/_all.css">
        <link rel="stylesheet" href="admin/assets/js/selectboxit/jquery.selectBoxIt.css">
        <link rel="stylesheet" href="admin/assets/js/select2/select2-bootstrap.css">
        <link rel="stylesheet" href="admin/assets/js/select2/select2.css">
        <link rel="stylesheet" href="admin/assets/js/daterangepicker/daterangepicker-bs3.css">


        <!-- Bottom Scripts -->
        <script src="admin/assets/js/gsap/main-gsap.js"></script>
        <script src="admin/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
        <script src="admin/assets/js/bootstrap.js"></script>
        <script src="admin/assets/js/joinable.js"></script>
        <script src="admin/assets/js/resizeable.js"></script>
        <script src="admin/assets/js/typeahead.min.js"></script>
        <script src="admin/assets/js/select2/select2.min.js"></script>
        <script src="admin/assets/js/bootstrap-tagsinput.min.js"></script>
        <script src="admin/assets/js/neon-api.js"></script>
        <script src="admin/assets/js/jquery.bootstrap.wizard.min.js"></script>
        <script src="admin/assets/js/jquery.validate.min.js"></script>
        <script src="admin/assets/js/jquery.inputmask.bundle.min.js"></script>
        <script src="admin/assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
        <script src="admin/assets/js/bootstrap-datepicker.js"></script>
        <script src="admin/assets/js/bootstrap-switch.min.js"></script>
        <script src="admin/assets/js/neon-custom.js"></script>
        <script src="admin/assets/js/neon-demo.js"></script>
        <script src="admin/assets/js/icheck/icheck.min.js"></script>
        <script src="admin/assets/js/bootstrap-datepicker.js"></script>
        <script src="admin/assets/js/bootstrap-timepicker.min.js"></script>
        <script src="admin/assets/js/daterangepicker/moment.min.js"></script>
        <script src="admin/assets/js/daterangepicker/daterangepicker.js"></script>
        <script src="admin/assets/js/jquery.multi-select.js"></script>
        <script src="admin/assets/js/neon-register.js"></script>

    </body>
</html>