        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">{page_title}
                    <small>{page_heading}</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="active">Currently Online</li>

                </ol>
            </div>

        </div>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Score</th>
                <th>Ping</th>
            </tr>
        </thead>
        <tbody>
        {players}
            <tr>
                <td>{playerid}</td>
                <td><a href="<?php echo base_url(); ?>ucp/viewuser/{nickname}">{nickname}</a></td>
                <td>{score}</td>
                <td>{ping}</td>
            </tr>
        {/players}
        </tbody>
    </table>
</div>