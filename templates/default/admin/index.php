<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron">
            <h1>Welcome to the dashboard!</h1>
            <p>Thanks for installing FractalBB, to begin you should go ahead and create some posts. We would also reccommend you edit the text on some of the pages and ensure that your server details have been entered properly! Furthermore advanced player control, may not work at this current time, if that's the case sorry!</p>
            </p>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                To-Do List
            </div>
            <ul class="fa-ul">
                {checklist}
            </ul>
        </div>
    </div> 
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Users Online
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="visitorgraph">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Score</th>
                                <th>Ping</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        {players}
                            <tr>
                                <td>{playerid}</td>
                                <td>{nickname}</td>
                                <td>{score}</td>
                                <td>{ping}</td>
                                <td><div class="btn-group">
                                      <a href="<?php echo base_url(); ?>admin/ban/{playerid}/{username}/{nickname}" class="btn btn-xs btn-default">Ban</a>
                                      <a href="<?php echo base_url(); ?>admin/kick/{playerid}" class="btn btn-xs btn-default">Kick</a>
                                    </div></td>
                            </tr>
                        {/players}
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                </div>
        </div>
    </div> 
</div>