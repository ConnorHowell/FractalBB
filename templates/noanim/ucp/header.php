<?php if (get_cookie('token') == FALSE) {
              redirect('/ucp/login','refresh');
            } ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - {blog_title}</title>

    <!-- Bootstrap core CSS -->
    <link href="{template_dir}css/bootstrap.css" rel="stylesheet">
    <link href="{template_dir}css/animate-custom.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="{template_dir}css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="{template_dir}font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
    <script src="{template_dir}js/jquery-1.10.2.js"></script>
    <script src="{template_dir}/ckeditor/ckeditor.js"></script>
    <script src="{template_dir}/ckeditor/adapters/jquery.js"></script>
    <script>
        $( document ).ready( function() {
            $( '#posteditor' ).ckeditor(); // Use CKEDITOR.replace() if element is <textarea>.
        } );
    </script>
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>">{blog_title}</a>
        </div>
        {userdata}
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="<?php echo base_url(); ?>ucp/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <?php if (get_cookie('token') !== FALSE && $userdata[0]['admin'] > 0) {
                        echo '<li><a href="'.base_url().'admin"><i class="fa fa-home"></i> Admin</a></li>';
                    } ?>
            <li><a href="<?php echo base_url(); ?>ucp/editsignature"><i class="fa fa-pencil"></i> Edit Signature</a></li>
            <li class="divider"></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Modules <b class="caret"></b></a>
              <ul class="dropdown-menu">
                {ucp_modules}
              </ul>
            </li>
            <li><a href="/"><i class="fa fa-reply"></i> Back to home</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {username} <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>ucp/viewuser/{username}"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#settingsModal" data-toggle="modal"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>ucp/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
{/userdata}
      <div id="page-wrapper">