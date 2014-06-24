</div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->
    <!-- Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form action="<?php echo base_url(); ?>ucp/updateprofile" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="settingsModalLabel">Settings!</h4>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label>Username</label>
                <input class="form-control" type="text" name="username" placeholder="Username" value="{username}" disabled="">
                <p class="help-block">Want to change your username? Well you can't!</p>
            </div>
            <div class="form-group">
                <label>Password Change</label>
                <input class="form-control" type="password" name="currentPW" placeholder="Current password">
                <p class="help-block">Enter Current Password</p>
                <input class="form-control" type="password" name="newPW" placeholder="New password">
                <p class="help-block">Enter New Password</p>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline btn-primary">Save changes</button>
      </div>
    </div></form><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <!-- JavaScript -->
    <script src="{template_dir}js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="{template_dir}js/morris/chart-data-morris.js"></script>
    <script src="{template_dir}js/tablesorter/jquery.tablesorter.js"></script>
    <script src="{template_dir}js/tablesorter/tables.js"></script>

  </body>
</html>
<!--
 ______              _        _ _    _       _     
|  ____|            | |      | | |  | |     | |    
| |__ _ __ __ _  ___| |_ __ _| | |__| |_   _| |__  
|  __| '__/ _` |/ __| __/ _` | |  __  | | | | '_ \ 
| |  | | | (_| | (__| || (_| | | |  | | |_| | |_) |
|_|  |_|  \__,_|\___|\__\__,_|_|_|  |_|\__,_|_.__/ 
-->