<?php
    if (get_cookie('token') == FALSE || $this->user_model->getDetails(get_cookie('token'))[0]['admin'] < 1) {
              redirect('/','refresh');
            } 
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>{blog_title} - {page_name}</title>

    <!-- Core CSS - Include with every page -->
    <link href="{template_dir}css/bootstrap.min.css" rel="stylesheet">
    <link href="{template_dir}font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="{template_dir}css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="{template_dir}css/plugins/timeline/timeline.css" rel="stylesheet">
    <link href="{template_dir}css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <script src="{template_dir}/js/jquery-1.10.2.js"></script>
    <script src="{template_dir}/ckeditor/ckeditor.js"></script>
    <script src="{template_dir}/ckeditor/adapters/jquery.js"></script>
    <script>
        $( document ).ready( function() {
            $( '#posteditor' ).ckeditor(); // Use CKEDITOR.replace() if element is <textarea>.
        } );
    </script>


    <!-- SB Admin CSS - Include with every page -->
    <link href="{template_dir}css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>admin">{blog_title}</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                    {userdata}
                        <li><a href="<?php echo base_url(); ?>ucp/viewuser/{username}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    {/userdata}
                        </li>
                        <li><a href="<?php echo base_url(); ?>admin/options"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

        </nav>
        <!-- /.navbar-static-top -->

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-book fa-fw"></i> Blog<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url(); ?>admin/blogposts">Manage Posts</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>admin/createpost">Create Post</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>admin/comments">Manage Comments</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-folder-open fa-fw"></i> Forum<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url(); ?>admin/categories">Manage Categories</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>admin/managetopics">Manage Topics</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>admin/manageposts">Manage Posts</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-code fa-fw"></i> Modules<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url(); ?>admin/modules_ucp">UCP</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>admin/modules_sidebar">Sidebar</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/themes"><i class="fa fa-desktop fa-fw"></i> Theme Options</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/options"><i class="fa fa-cogs fa-fw"></i> General Options</a>
                    </li>
                     <li>
                        <a href="#"><i class="fa fa-globe fa-fw"></i> Server Managment<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url(); ?>admin/bans">Manage Bans</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>"><i class="fa fa-reply fa-fw"></i> Preview Site</a>
                    </li>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->
<div id="page-wrapper">