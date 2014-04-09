<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Comments</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Post ID</th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Timestamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {comments}
                <tr>
                    <td>{id}</td>
                    <td>{post_id}</td>
                    <td>{author}</td>
                    <td>{content}</td>
                    <td>{timestamp}</td>
                	<td><a class="btn btn-outline btn-danger btn-xs" href="<?php echo base_url(); ?>admin/deletecomment/{id}">Delete</a></td>
                </tr>
            {/comments}
            </tbody>
        </table>
    </div>
</div>