<?php
$db_config_path = '../application/config/database.php';

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		} else if ($core->write_general($_POST) == false) {
			$message = $core->show_message('error',"The general configuration file could not be written, please chmod application/config/general.php file to 777");
		}

		// If no errors, redirect to registration page
		if(!isset($message)) {
		  $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://".$_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
      $redir = str_replace('install/','',$redir); 
			header( 'Location: ' . $redir) ;
		}

	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, password, and database name are required.');
	}
}

?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>FractalBB | Install</title>

        <meta name="description" content="FreshUI is a Premium Web App and Admin Template created by pixelcave and published on Themeforest.">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="http://members.fractal-hub.com/img/favicon.ico">
        <link rel="apple-touch-icon" href="http://members.fractal-hub.com/img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="http://members.fractal-hub.com/img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="http://members.fractal-hub.com/img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="http://members.fractal-hub.com/img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="http://members.fractal-hub.com/img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="http://members.fractal-hub.com/img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="http://members.fractal-hub.com/img/icon152.png" sizes="152x152">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- The Open Sans font is included from Google Web Fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic">

        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="http://members.fractal-hub.com/css/bootstrap.css">

        <!-- Related styles of various icon packs and javascript plugins -->
        <link rel="stylesheet" href="http://members.fractal-hub.com/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="http://members.fractal-hub.com/css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="http://members.fractal-hub.com/css/themes.css">
        <link rel="stylesheet" href="http://members.fractal-hub.com/css/themes/amethyst.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (Browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <script src="http://members.fractal-hub.com/js/vendor/modernizr-2.6.2-respond-1.3.0.min.js"></script>
    </head>

    <!-- Body -->
    <!-- In the PHP version you can set the following options from the config file -->
    <!--
        Add one of the following classes to the body element for the desirable feature:
        'sidebar-left-pinned'                         for a left pinned sidebar (always visible > 1200px)
        'sidebar-right-pinned'                        for a right pinned sidebar (always visible > 1200px)
        'sidebar-left-pinned sidebar-right-pinned'    for both sidebars pinned (always visible > 1200px)
    -->
    <body class="header-fixed-top">
        <div id="page-container">
            <div id="fx-container" class="fx-opacity">
                <!-- Page content -->
                <div id="page-content" class="block">
                    <!-- Invoice Header -->
                    <div class="block-header">
                        <!-- If you do not want a link in the header, instead of .header-title-link you can use a div with the class .header-section -->
                        <a href="" class="header-title-link">
                            <h1>
                                <i class="fa fa-download animation-expandUp"></i>Install<br><small>FractalBB</small>
                            </h1>
                        </a>
                    </div>
                    <!-- END Invoice Header -->

                    <!-- Advanced Wizard Title -->
                        <div class="block-title">
                            <h2><i class="fa fa-download"></i>Installation</h2>
                        </div>
                        <!-- END Advanced Wizard Title -->

                        <!-- Advanced Wizard Content -->
                        <form id="advanced-wizard" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-horizontal">
                            <!-- First Step -->
                            <div id="advanced-first" class="step">
                                <!-- Step Info -->
                                <div class="wizard-steps">
                                    <div class="row">
                                        <div class="col-xs-6 text-center active">1. Database</div>
                                        <div class="col-xs-6 text-center">2. Server Info</div>
                                    </div>
                                </div>
                                <!-- END Step Info -->
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="val_hostname">Hostname *</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cloud fa-fw"></i></span>
                                            <input type="text" id="val_hostname" name="val_hostname" class="form-control" required value="localhost">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="val_username">Username *</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                            <input type="text" id="val_username" name="val_username" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="val_password">Password *</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-asterisk fa-fw"></i></span>
                                            <input type="password" id="val_password" name="val_password" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="val_database">Database *</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sitemap fa-fw"></i></span>
                                            <input type="text" id="val_database" name="val_database" class="form-control" required value="FractalBB">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END First Step -->

                            <!-- Second Step -->
                            <div id="advanced-second" class="step">
                                <!-- Step Info -->
                                <div class="wizard-steps">
                                    <div class="row">
                                        <div class="col-xs-6 text-center done">1. Database <i class="fa fa-check"></i></div>
                                        <div class="col-xs-6 text-center active">2. Server Info</div>
                                    </div>
                                </div>
                                <!-- END Step Info -->
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="val_name">Name *</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="val_name" name="val_name" class="form-control" required placeholder="SAMP Server!">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="val_description">Description *</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="val_description" name="val_description" class="form-control" required placeholder="My amazing GTA Server">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="val_server_ip">Server IP *</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                            <input type="text" id="val_server_ip" name="val_server_ip" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="val_server_port">Server Port *</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sitemap fa-fw"></i></span>
                                            <input type="text" id="val_server_port" name="val_server_port" class="form-control" required value="7777">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="val_rcon_password">RCON Password</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                            <input type="text" id="val_rcon_password" name="val_rcon_password" class="form-control" placeholder="My Super Secret Password.... Shhh">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="val_license_key">License Key</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-shield fa-fw"></i></span>
                                            <input type="text" id="val_license_key" name="val_license_key" class="form-control" placeholder="You obtained this from FractalHub, check your emails!" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Second Step -->

                            <!-- Form Buttons -->
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <input type="reset" class="btn btn-default" id="back2" value="Back">
                                    <input type="submit" class="btn btn-primary" id="next2" value="Next">
                                </div>
                            </div>
                            <!-- END Form Buttons -->
                        </form>
                        <!-- END Advanced Wizard Content -->

                    </div>

                </div>
                <!-- END Page Content -->
            </div>
            <!-- END FX Container -->
        </div>
        <!-- END Page Container -->

        <!-- Scroll to top link, check main.js - scrollToTop() -->
        <a href="javascript:void(0)" id="to-top"><i class="fa fa-angle-up"></i></a>

        <!-- Get Jquery library from Google but if something goes wrong get Jquery from local file - Remove 'http:' if you have SSL -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>!window.jQuery && document.write(unescape('%3Cscript src="js/vendor/jquery-1.10.2.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js, Jquery plugins and custom Javascript code -->
        <script src="http://members.fractal-hub.com/js/vendor/bootstrap.min.js"></script>
        <script src="http://members.fractal-hub.com/js/plugins.js"></script>
        <script src="http://members.fractal-hub.com/js/main.js"></script>
        
        <!-- Javascript code only for this page -->
        <script>
            $(function() {
                /* For advanced usage and examples you can check out
                 *  Jquery Wizard       -> http://www.thecodemine.org
                 *  Jquery Validation   -> https://github.com/jzaefferer/jquery-validation
                 */

                /* Initialize Basic Wizard */
                $('#basic-wizard').formwizard({focusFirstInput: true, disableUIStyles: true, inDuration: 0, outDuration: 0});

                /* Initialize Advanced Wizard with Validation */
                $('#advanced-wizard').formwizard({
                    disableUIStyles: true,
                    validationEnabled: true,
                    validationOptions: {
                        errorClass: 'help-block',
                        errorElement: 'span',
                        errorPlacement: function(error, e) {
                            e.parents('.form-group > div').append(error);
                        },
                        highlight: function(e) {
                            $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                            $(e).closest('.help-block').remove();
                        },
                        success: function(e) {
                            // You can remove the .addClass('has-success') part if you don't want the inputs to get green after success!
                            e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
                            e.closest('.help-block').remove();
                        },
                        rules: {
                            val_username: {
                                required: true,
                            },
                            val_hostname: {
                                required: true,
                            },
                            val_password: {
                                required: true,
                            },
                            val_license_key: {
                                required: true,
                            },
                        },
                        messages: {
                            val_username: {
                                required: 'Please enter a username',
                            },
                            val_hostname: {
                                required: 'Please enter a hostanme',
                            },
                            val_password: {
                                required: 'Please provide a password',
                            },
                            val_license_key: {
                            	required: 'Please put in a license key',
                            }
                        }
                    },
                    inDuration: 0,
                    outDuration: 0
                });
            });
        </script>

    </body>
</html>