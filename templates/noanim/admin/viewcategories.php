<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Editing Category sub-forums</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="push clearfix" style="margin-bottom: 15px !important;">
            <a href="<?php echo base_url(); ?>admin/newforum/{forum_id}" class="btn btn-outline btn-sm btn-success"><i class="fa fa-pencil"></i> New</a>
        </div>
	<div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {forums}
                <tr>
                    <td>{id}</td>
                    <td>{name}</td>
                    <td>{description}</td>
                	<td><a class="btn btn-outline btn-primary btn-xs" href="<?php echo base_url(); ?>admin/editforum/{id}">Edit</a> <a class="btn btn-outline btn-danger btn-xs" href="<?php echo base_url(); ?>admin/deleteforum/{id}">Delete</a></td>
                </tr>
            {/forums}
            </tbody>
        </table>
    </div>
</div>