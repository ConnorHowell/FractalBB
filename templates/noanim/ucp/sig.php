<div class="row">
  <div class="col-lg-12">
    <h1>Editing Signature</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>ucp/"><i class="icon-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="icon-file-alt"></i>Editing Signature</li>
    </ol>
  </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Your Signature
            </div>
            <div class="panel-body">
	            <form method="POST" action="<?php echo base_url(); ?>ucp/updatesignature">
	            	<textarea class="posteditor" id="posteditor" name="posteditor">{userdata}{signature}{/userdata}</textarea>
	            	<br><button class="btn btn-outline btn-success" type="submit">Save Changes</button>
	            </form>
            </div>
        </div>
	</div>
</div>