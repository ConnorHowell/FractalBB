<div class="row">
  <div class="col-lg-12">
    <h1>Viewing User <small>{username}</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>ucp/"><i class="icon-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="icon-file-alt"></i> Viewing User: {username}</li>
    </ol>
  </div>
</div>

<div class="row">
	<div class="col-lg-4 animated bounceIn">
	    <div class="panel panel-warning">
	      <div class="panel-heading">
	        <div class="row">
	          <div class="col-xs-6">
	            <img src="http://www.gravatar.com/avatar/{gravatar_hash}?s=90&d=mm">
	          </div>
	          <div class="col-xs-6 text-right">
	            <p class="announcement-heading">{username}</p>
	          </div>
	        </div>
	      </div>
	      <a href="<?php echo base_url(); ?>online">
	        <div class="panel-footer announcement-bottom">
	          <div class="row">
	            <div class="col-xs-6">
	              User List
	            </div>
	            <div class="col-xs-6 text-right">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	          </div>
	        </div>
	      </a>
	    </div>
	</div>
	<div class="col-lg-4 animated bounceIn">
	    <div class="panel panel-danger">
	      <div class="panel-heading">
	        <div class="row">
	          <div class="col-xs-6">
	            <i class="fa fa-user fa-5x"></i>
	          </div>
	          <div class="col-xs-6 text-right">
	            <p class="announcement-heading">{kills}</p>
	            <p class="announcement-text">Kills</p>
	          </div>
	        </div>
	      </div>
	      <a href="<?php echo base_url(); ?>online">
	        <div class="panel-footer announcement-bottom">
	          <div class="row">
	            <div class="col-xs-6">
	              User List
	            </div>
	            <div class="col-xs-6 text-right">
	              <i class="fa fa-arrow-circle-right"></i>
	            </div>
	          </div>
	        </div>
	      </a>
	    </div>
	</div>
	<div class="col-lg-4 animated bounceIn">
            <div class="panel panel-success">
              <div class="panel-heading" style="height: 153px;">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-money fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">${cash}</p>
                    <p class="announcement-text">Money</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>
<div class="row">
	<div class="col-lg-4">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-clock-o"></i> Recent Blog Comments</h3>
          </div>
          <div class="panel-body">
            <div class="list-group">
            {latest_posts}
              <a href="<?php echo base_url(); ?>viewpost/{post_id}" class="list-group-item">
                <span class="badge">{timestamp}</span>
                 {content}
              </a>
            {/latest_posts}
            </div>
            <div class="text-right">
              <a href="<?php echo base_url(); ?>">View All Posts <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-clock-o"></i> Recent Forum Posts</h3>
          </div>
          <div class="panel-body">
            <div class="list-group">
            {latest_forum}
              <a href="<?php echo base_url(); ?>forum/viewtopic/{id}" class="list-group-item">
                <span class="badge">{timestamp}</span>
                 {name}
              </a>
            {/latest_forum}
            </div>
            <div class="text-right">
              <a href="<?php echo base_url(); ?>forum">View All Posts <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
</div>