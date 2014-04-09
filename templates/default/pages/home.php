        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">{blog_title}
                    <small>{blog_heading}</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                </ol>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-8 animated slideInLeft">
                {blog_entries}
                <h1><a href="<?php echo base_url(); ?>viewpost/{id}">{title}</a>
                </h1>
                <p class="lead">by <a href="<?php echo base_url(); ?>ucp/viewuser/{author}">{author}</a>
                </p>
                <hr>
                <p><i class="fa fa-clock-o"></i> Posted on {timestamp}</p>
                <hr>
                <p>
                {content}
                </p>
                <a class="btn btn-primary" href="<?php echo base_url(); ?>viewpost/{id}">Read More <i class="fa fa-angle-right"></i></a>

                <hr>
                {/blog_entries}

                
            </div>

            <div class="col-lg-4 animated slideInRight">
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