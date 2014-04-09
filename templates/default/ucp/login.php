
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>{blog_title} - {page_name}</title>

    <!-- Core CSS - Include with every page -->
    <link href="{template_dir}css/bootstrap.css" rel="stylesheet">
    <link href="{template_dir}font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{template_dir}css/animate-custom.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="{template_dir}css/sb-admin.css" rel="stylesheet">

</head>

<body style="background: url({template_dir}img/6.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
    ">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default animated swing">
                    <div class="panel-heading">
                        <h3 class="panel-title">{blog_title} | Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" >
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <button class="btn btn-lg btn-success btn-block" role="submit" name="submit" value="submit">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="{template_dir}js/jquery-1.10.2.js"></script>
    <script src="{template_dir}js/bootstrap.min.js"></script>
    <script src="{template_dir}js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="{template_dir}js/sb-admin.js"></script>

</body>

</html>
