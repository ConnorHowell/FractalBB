<div class="row">
	<div class="col-lg-12">
		<h1>Module <small>This is a test Module</small></h1>
		<ol class="breadcrumb">
	  		<li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
	  		<li><a href="/ucp/module/{module_url}"><i class="fa fa-code"></i> {module_name}</a></li>
		</ol>
	</div>
</div><!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {module_name}
            </div>
            <div class="panel-body">
	            Module Stuff goes anywhere on this page, here would be a good place! <a href="/ucp/module/{module_url}/page">This is a URL that will go to a page within a modules own folder!</a><br>Edit this module to incoperate your own PHP within the folder: <code>/modules/ucp/TestModule/</code> Make sure to keep the <code>enabled.fractalbb</code> file otherwise your module will be disabled!<br> Furthermore you can also reference files within the module using the shortcode: <code>view_path</code>
            </div>
        </div>
	</div>
</div>