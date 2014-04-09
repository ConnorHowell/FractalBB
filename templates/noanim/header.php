<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{blog_title} | {page_name}</title>

    <!-- Bootstrap core CSS -->
    <link href="{template_dir}/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="{template_dir}/css/modern-business.css" rel="stylesheet">
    <link href="{template_dir}/css/animate-custom.css" rel="stylesheet">
    <link href="{template_dir}/css/btn.css" rel="stylesheet">
    <link href="{template_dir}/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="{template_dir}/js/jquery-1.10.2.js"></script>
    <script src="{template_dir}/ckeditor/ckeditor.js"></script>
    <script src="{template_dir}/ckeditor/adapters/jquery.js"></script>
    <script>
        $( document ).ready( function() {
            $( '#posteditor' ).ckeditor(); // Use CKEDITOR.replace() if element is <textarea>.
        } );
    </script>
</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">{blog_title}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>online">Players Online</a></li>
                    <li><a href="<?php echo base_url(); ?>forum">Forum</a></li>
                    <li><a href="<?php echo base_url(); ?>about">About</a></li>
                    <li><a href="<?php echo base_url(); ?>contact">Contact</a></li>
                    <li><a href="<?php echo base_url(); ?>ucp">UCP</a></li>
                    <?php if (get_cookie('token') !== FALSE && $userdata[0]['admin'] > 0) {
                        echo '<li><a href="'.base_url().'admin">Admin</a></li>';
                    } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">