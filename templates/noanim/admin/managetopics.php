<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forum Topics</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Timestamp</th>
                    <th>Forum ID</th>
                    <th>Views</th>
                    <th>Pinned</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
            {posts}
                <tr>
                    <td>{id}</td>
                    <td>{name}</td>
                    <td>{author}</td>
                    <td>{timestamp}</td>
                    <td>{forum_id}</td>
                    <td>{views}</td>
                    <td>{pinned}</td>
                	<td><a class="btn btn-outline btn-success btn-xs" href="<?php echo base_url(); ?>admin/pin/{id}">Pin</a> <a class="btn btn-outline btn-danger btn-xs" href="/admin/deletetopic/{id}">Delete</a></td>
                </tr>
            {/posts}
            </tbody>
        </table>
    </div>
</div>