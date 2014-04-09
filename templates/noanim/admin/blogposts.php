<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog Posts</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Timestamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {posts}
                <tr>
                    <td>{id}</td>
                    <td>{title}</td>
                    <td>{author}</td>
                    <td>{timestamp}</td>
                	<td><a class="btn btn-outline btn-danger btn-xs" href="<?php echo base_url(); ?>admin/deleteentry/{id}">Delete</a> <a class="btn btn-outline btn-primary btn-xs" href="<?php echo base_url(); ?>admin/editentry/{id}">Edit</a></td>
                </tr>
            {/posts}
            </tbody>
        </table>
    </div>
</div>