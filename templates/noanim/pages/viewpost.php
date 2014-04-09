<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Viewing Post
        {blog_entries}
            <small>{title}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a>
            </li>
            <li class="active">Blog Post</li>
        </ol>
    </div>

</div>

<div class="row">

    <div class="col-lg-8">
        <!-- the actual blog post: title/author/date/content -->
        <hr>
        <p><i class="fa fa-clock-o"></i> Posted on {timestamp} by <a href="<?php echo base_url(); ?>ucp/viewuser/{author}">{author}</a>
        </p>
        <hr>
        <p>{content}</p>
        {/blog_entries}

        <hr>
        <?php if (get_cookie('token') == FALSE) {
        ?>
        <!-- the comment box -->
        <div class="well">
            <h4>Leave a Comment: <small><a href="<?php echo base_url(); ?>ucp/login">Please login to post comments</a></small></h4>
            <form role="form">
                <div class="form-group">
                    <textarea class="form-control" rows="3" disabled="" id="posteditor"></textarea>
                </div>
                <button type="submit" class="btn btn-outline btn-primary" disabled>Submit</button>
            </form>
        </div>
        <?php } 
        else {
        ?>
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form role="form" method="POST" action="<?php echo base_url(); ?>welcome/postcomment">
                <div class="form-group">
                    <textarea class="form-control" rows="3" id="comment" name="comment" required></textarea>
                    <input type="hidden" name="slug" value="{slug}">
                </div>
                <button type="submit" class="btn btn-outline btn-primary">Submit</button>
            </form>
        </div>
        <?php } ?>
        <hr>

        <!-- the comments -->
        {comments}
        <h3>{author}
            <small>{timestamp}</small>
        </h3>
        <p>{content}</p>
        {/comments}
    </div>

    <div class="col-lg-4">
        <div class="well">
            <h4>Blog Search</h4>
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            <!-- /input-group -->
        </div>
        <!-- /well -->
        {modules}
    </div>
</div>
