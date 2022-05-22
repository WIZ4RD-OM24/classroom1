<?php echo view('header');?>
<div class="content-wrapper">
  <div class="container bootstrap snippets bootdey">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
          <div class="d-flex justify-content-end">
          <a style="margin-left:px;" type = "button" class = "btn btn-primary" href="<?php echo base_url('/view-edit-admin-profile'); ?>">Edit Profile</a>
        </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <hr>
    <div class="row text-center">

    <!-- left column -->

    <!-- edit form column -->
    <div class="col md-3">
      <div class="text-center">
      
        <img src="<?php echo base_url('uploads/pfp/'.$admin['admin_image']);?>" height="200px" width="200px" class="avatar img-circle img-thumbnail" alt="avatar">
        
      
      <form class="form-horizontal" role="form">
        <div class="form-group">
          <label class="col-lg-3 control-label">Name</label>
          <div class="col-lg-3">
            <input style="margin-left:380px;" class="form-control" type="text" value="<?php echo $admin['admin_name'];?>" disabled>
            
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Email</label>
          <div class="col-lg-3">
            <input style="margin-left:380px;" disabled class="form-control" type="text" value="<?php echo $admin['email'];?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Mobile No</label>
          <div class="col-lg-3">
            <input style="margin-left:380px;" class="form-control" type="text" value="<?php echo $admin['admin_mobile'];?>" disabled>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-lg-3 control-label">Designation</label>
          <div class="col-lg-3">
            <input style="margin-left:380px;" class="form-control" type="text" value="<?php echo $admin['admin_designation'];?>" disabled>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Organisation</label>
          <div class="col-lg-3">
            <input style="margin-left:380px;" class="form-control" type="text" value="<?php echo $admin['admin_organisation'];?>" disabled>
          </div>
        </div>
        
      </form>
      </div>
    </div>
</div>
</div>
</div>
<?php echo view('footer');?>
				        	              

