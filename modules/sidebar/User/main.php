<?php if (get_cookie('token') == FALSE) {
        ?>
        <div class="well">
            <h4>Login</h4>
            <form method="POST" action="<?php echo base_url(); ?>ucp/login">
            <div class="input-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
                <span class="input-group-addon">
                    <i class="fa fa-user"></i>                  
                </span>
            </div>
            <br>
            <div class="input-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="input-group-addon">
                    <i class="fa fa-key"></i>                  
                </span>
            </div><br>
            <button class="btn btn-outline btn-success btn-block" role="submit" name="submit" value="submit">Login</button>
            </form>
            <!-- /input-group -->
        </div>
        <!-- /well -->
        <?php } 
        else {
            $user = $this->user_model->getDetails(get_cookie('token'));
            $username = $this->user_model->userFromToken(get_cookie('token'));
            if ($this->config->item('acc_method') == 'FTP') {
                $kills = $user[$this->config->item('kill_tag')];
            }
            elseif ($this->config->item('acc_method') == 'MySQL') {
                $kills = $user['kills'];
            }

            if ($this->config->item('acc_method') == 'FTP') {
                $cash = $user[$this->config->item('cash_tag')];
            }
            elseif ($this->config->item('acc_method') == 'MySQL') {
                $cash = $user['money'];
        }
        ?>
        <div class="well">
            <h4><?php echo $username; ?></h4><hr>
            <h5>Money: <?php echo number_format($cash); ?></h5>
            <h5>Kills: <?php echo $kills; ?></h5><hr>
            <a href="<?php echo base_url(); ?>ucp/logout" class="btn btn-outline btn-warning btn-block">Logout</a>
        </div>
        <!-- /well -->
        <?php } ?>