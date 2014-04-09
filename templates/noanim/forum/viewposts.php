<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Forum
            <small>Viewing Index</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a>
            </li>
            <li><a href="<?php echo base_url(); ?>forum">Forum</a></li>
            <li class="active">Viewing Forum</li>
        </ol>
    </div>

</div>
<div class="row">
    <div class="col-lg-3 animated slideInLeft">
        {user_module}
    </div>

    <div class="col-lg-9 animated slideInRight">
    <?php if(get_cookie('token') !== FALSE) { ?>
        <div class="push clearfix" style="margin-bottom: 15px !important;">
            <a href="#newPost" data-toggle="modal" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> New</a>
        </div>
        <?php } ?>

        <table class="table forum">
            <thead>
                <tr>
                    <th colspan="2">Title</th>
                    <th class="cell-stat text-center hidden-xs hidden-sm">Replies</th>
                    <th class="cell-stat text-center hidden-xs hidden-sm">Views</th>
                </tr>
            </thead>
            <tbody>
                {forum_posts}
            </tbody>
        </table>

        <div class="text-right">
            <ul class="pagination pagination-sm">
                {pagination}
            </ul>
        </div>
    </div>
</div>
<?php if(get_cookie('token') !== FALSE) { ?>
<!-- Modal -->
<div class="modal fade" id="newPost" tabindex="-1" role="dialog" aria-labelledby="newPostLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="<?php echo base_url(); ?>forum/postnew" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="newPostLabel">New post</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Title</label>
            <input class="form-control" name="post_title" required>
            <input type="hidden" value="{id}" name="forum_id">
            <p class="help-block">Give your forum post a name.</p>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" rows="3" id="posteditor" name="posteditor" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline btn-success">Post</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php } ?>