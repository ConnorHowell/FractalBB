<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Options</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Page And Server Options
            </div>
            <div class="panel-body">
            <form role="form" action="update" method="POST">
                <div class="row">
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label>Blog Name</label>
                                <input class="form-control" type="text" value="{blog_title}" name="blog_title" required>
                                <p class="help-block">The name of your website / server.</p>
                            </div>
                            <div class="form-group">
                                <label>Blog Subtitle</label>
                                <input class="form-control" type="text" value="{blog_heading}" name="blog_subtitle" required>
                                <p class="help-block">The subtitle of your server, e.g. My server!</p>
                            </div>
                            <div class="form-group">
                                <label>License Key</label>
                                <input class="form-control" type="text" value="You don't need this!" name="license_key" disabled>
                                <p class="help-block">The license key you acquired from <a href="http://www.fractal-hub.com">FractalHub</a></p>
                            </div>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label>Server IP</label>
                                <input class="form-control" type="text" value="{server_ip}" name="server_ip" required>
                                <p class="help-block">The IP you use to connect to your server.</p>
                            </div>
                            <div class="form-group">
                                <label>Server Port</label>
                                <input class="form-control" type="text" value="{server_port}" name="server_port" required>
                                <p class="help-block">The port your server is listening on the default is 7777</p>
                            </div>
                            <div class="form-group">
                                <label>RCON Password</label>
                                <input class="form-control" type="password" value="{rcon_password}" name="rcon_password" required>
                                <p class="help-block">This is required for most admin functions!</p>
                            </div>
                            <button type="submit" class="btn btn-outline btn-success">Update</button>
                        
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
                </form>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>