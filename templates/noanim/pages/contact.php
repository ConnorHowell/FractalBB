<div class="row">

  <div class="col-lg-12">
    <h1 class="page-header">Contact <small>We'd Love to Hear From You!</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>">Home</a></li>
      <li class="active">Contact</li>
    </ol>
  </div>
</div><!-- /.row -->

<div class="row">

  <div class="col-sm-12">
    <h3>Let's Get In Touch!</h3>
    <p>Lid est laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats vitaes nemo minima rerums unsers sadips amets. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
      <form role="form" method="POST" action="<?php echo base_url(); ?>contact">
        <div class="row">
          <div class="form-group col-lg-4">
            <label for="input1">Name</label>
            <input type="text" name="contact_name" class="form-control" id="input1" required>
          </div>
          <div class="form-group col-lg-4">
            <label for="input2">Email Address</label>
            <input type="email" name="contact_email" class="form-control" id="input2" required>
          </div>
          <div class="form-group col-lg-4">
            <label for="input3">Username (IGN)</label>
            <input type="phone" name="contact_username" class="form-control" id="input3" required>
          </div>
          <div class="clearfix"></div>
          <div class="form-group col-lg-12">
            <label for="input4">Message</label>
            <textarea name="contact_message" class="form-control" rows="6" id="input4" required></textarea>
          </div>
          <div class="form-group col-lg-12">
            <input type="hidden" name="save" value="contact">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
  </div>

</div><!-- /.row -->