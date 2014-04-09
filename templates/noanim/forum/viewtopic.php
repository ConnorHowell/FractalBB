<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Forum
            <small>Viewing Index</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="<?php echo base_url(); ?>forum">Forum</a></li>
            <li class="active">Viewing Topic</li>
        </ol>
    </div>

</div>
<div class="row">
    <div class="col-lg-3 animated slideInLeft">
    {user_module}
    </div>

    <div class="col-lg-9 animated slideInRight">
        <table class="table forum">
            <tbody>
            {topic_posts}
            <?php if(get_cookie('token') !== FALSE) { ?>
                <tr>
                    <th class="text-center"><a href="<?php echo base_url(); ?>ucp/viewuser/{username}">You</a></th>
                    <th>Reply</th>
                </tr>
                <tr>
                    <td class="forum-avatar text-center">
                        <a href="<?php echo base_url(); ?>ucp/viewuser/{username}"><img src="http://www.gravatar.com/avatar/{gravatar_hash}?s=64" class="img-circle" alt="avatar"></a>
                    </td>
                    <td class="forum-post">
                        <form action="<?php echo base_url(); ?>forum/post" method="post" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea id="posteditor" name="posteditor" rows="15" class="form-control textarea-editor"></textarea>
                                    <input type="hidden" name="topicid" value="{topicid}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-reply"></i> Reply</button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newPost" tabindex="-1" role="dialog" aria-labelledby="newPostLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="newPostLabel">New post</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Title</label>
            <input class="form-control">
            <p class="help-block">Give your forum post a name.</p>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" rows="3" id="posteditor" name="posteditor"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline btn-primary" data-location="advanced">Advanced</button>
        <button type="button" class="btn btn-outline btn-success">Post</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->