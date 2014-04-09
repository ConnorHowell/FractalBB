<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forum Categories</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
<div class="push clearfix" style="margin-bottom: 15px !important;">
            <a href="#categorymodal" class="btn btn-outline btn-sm btn-success" data-toggle="modal"><i class="fa fa-pencil"></i> New</a>
        </div>
	<div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {categories}
                <tr>
                    <td>{id}</td>
                    <td>{name}</td>
                	<td><a class="btn btn-outline btn-primary btn-xs" href="<?php echo base_url(); ?>admin/viewcat/{id}">View</a> <a class="btn btn-outline btn-danger btn-xs" href="<?php echo base_url(); ?>admin/deletecat/{id}">Delete</a></td>
                </tr>
            {/categories}
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="categorymodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="POST" action="<?php echo base_url(); ?>admin/createcat" name="cat">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="categorymodalLabel">Create Category</h4>
      </div>
      <div class="modal-body">
        
            <div class="form-group">
                <label>Category Title</label>
                <input class="form-control" name="cattitle" required>
                <p class="help-block">The name of your category!</p>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline btn-success">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>