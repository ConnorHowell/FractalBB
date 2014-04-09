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
        ?>
        {userdata}
        <div class="well">
            <h4>{username}</h4><hr>
            <h5>Money: {money}</h5>
            <h5>Kills: {kills}</h5>
            <h5>Rank: {forum_rank}</h5><hr>
            <a href="<?php echo base_url(); ?>ucp/logout" class="btn btn-outline btn-warning btn-block">Logout</a>
        </div>
        {/userdata}
        <!-- /well -->
        <?php } ?>