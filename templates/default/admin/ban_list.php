<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Ban List</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Users Banned
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="visitorgraph">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Player</th>
                                <th>Banned By:</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                        {ban_list}
                            <tr>
                                <td>{id}</td>
                                <td>{player}</td>
                                <td>{admin}</td>
                                <td>{timestamp}</td>
                            </tr>
                        {/ban_list}
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div> 
</div>