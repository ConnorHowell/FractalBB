<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forum Posts</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Content</th>
                    <th>Topic ID</th>
                    <th>Forum ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {posts}
                <tr>
                    <td>{id}</td>
                    <td><?php echo mysql_real_escape_string('{content}'); ?></td>
                    <td>{topic_id}</td>
                    <td>{forum_id}</td>
                	<td><a class="btn btn-outline btn-danger btn-xs" href="<?php echo base_url(); ?>admin/deleteforumpost/{id}">Delete</a></td>
                </tr>
            {/posts}
            </tbody>
        </table>
    </div>
</div>