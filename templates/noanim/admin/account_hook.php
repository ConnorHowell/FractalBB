<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Account Hook</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
    <form role="form" action="update_acc" method="POST">
        <div class="panel panel-default">
            <div class="panel-heading">
                Basic Options
            </div>
            <div class="panel-body">
            
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Account Method</label>
                            <select class="form-control" name="acc_method">
                              <option value="MySQL" <?php if($this->config->item('acc_method') == 'MySQL') {echo 'selected';} ?>>MySQL</option>
                              <option value="FTP" <?php if($this->config->item('acc_method') == 'FTP') {echo 'selected';} ?>>FTP - INI Based</option>
                            </select>
                            <p class="help-block">The way user data is stored on your server (MySQL database, which should be linked with the FractalBB one or FTP access to your server that saves using INI).</p>
                        </div>
                        <div class="form-group">
                            <label>Encryption Method</label>
                            <select class="form-control" name="acc_enc">
                              <option value="udb_hash" <?php if($this->config->item('acc_enc') == 'udb_hash') {echo 'selected';} ?>>udb_hash</option>
                              <option value="WhirlPool" <?php if($this->config->item('acc_enc') == 'WhirlPool') {echo 'selected';} ?>>WhirlPool</option>
                              <option value="md5" <?php if($this->config->item('acc_enc') == 'md5') {echo 'selected';} ?>>MD5</option>
                            </select>
                            <p class="help-block">The way user passwords are stored, we don't support plain text because of how insecure it is. If you are not sure ask someone who will know, or consult the thread of your gamemode.</p>
                        </div>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                FTP Options
            </div>
            <div class="panel-body">
            <div class="row">
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label>Account Directory (From default folder, follow with a trailing slash)</label>
                                <input class="form-control" type="text" value="{acc_dir}" name="acc_dir">
                                <p class="help-block">e.g. scriptfiles/Users/</p>
                            </div>
                            <div class="form-group">
                                <label>Name of file tag</label>
                                <input class="form-control" type="text" value="{main_tag}" name="main_tag">
                                <p class="help-block">This is the name of the INI tag that is at the top of the file in [], e.g. User</p>
                            </div>
                            <div class="form-group">
                                <label>Name of password field</label>
                                <input class="form-control" type="text" value="{pass_tag}" name="pass_tag">
                                <p class="help-block">This is the name of the INI variable that stores the password, e.g. Password</p>
                            </div>
                            <div class="form-group">
                                <label>Name of kills field</label>
                                <input class="form-control" type="text" value="{kill_tag}" name="kill_tag">
                                <p class="help-block">This is the name of the INI variable that stores the kill count, e.g. Kills</p>
                            </div>
                            <div class="form-group">
                                <label>Name of money field</label>
                                <input class="form-control" type="text" value="{cash_tag}" name="cash_tag">
                                <p class="help-block">This is the name of the INI variable that stores the players money, e.g. Cash</p>
                            </div>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label>FTP IP/Hostname</label>
                                <input class="form-control" type="text" value="{ftp_ip}" name="ftp_ip">
                                <p class="help-block">The IP you use to connect to your FTP server. (server1.fractaltech.biz for FractalHub users)</p>
                            </div>
                            <div class="form-group">
                                <label>FTP Username</label>
                                <input class="form-control" type="text" value="{ftp_user}" name="ftp_user">
                                <p class="help-block">The username your FTP account uses. (Your FractalHub username for FractalHub users)</p>
                            </div>
                            <div class="form-group">
                                <label>FTP Password</label>
                                <input class="form-control" type="password" value="{ftp_pass}" name="ftp_pass">
                                <p class="help-block">The password used for the FTP account above. (FractalHub members will have this in the game server email)</p>
                            </div>
                            <button type="submit" class="btn btn-outline btn-success">Update</button>
                        
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        </form>
    </div>
    <!-- /.col-lg-12 -->
</div>