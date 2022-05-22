<?php echo view('student_panel/student_header');?>
<div class="content-wrapper">
  <div class="container bootstrap snippets bootdey">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div> 
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <hr>
    <div class="col md-3 text-center">
        <!-- left column -->
        <div class="col md-3">
          <?php if($errors):?>
        <?php foreach ($errors as $error): ?>
    <li><?= esc($error) ?></li>
<?php endforeach ?>
<?php endif; ?>

          
            <div class="text-center">
            <img src="<?php echo base_url('uploads/pfp/'.$student['student_image']);?>"  height="200px" width="200px" class="avatar img-circle img-thumbnail" alt="avatar">
            </div>
            <?= form_open_multipart('StudentController/edit_profile') ?>
            <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> Upload Profile Image 
                    <input type="file" name="student_image">
                  </div>
                  <p class="help-block">Max. 32MB</p>
            </div>
        </div>
    
    <!-- edit form column -->
    <form>
      <div class="col md-3 text-center">
        <input type="hidden" name="student_id" id="id" value="<?php echo $studentr['student_id']; ?>">
        <div class="form-group">
          <label class="col-lg-4 control-label justify-content-start">Roll No:
            <input class="form-control" name="student_roll_no" type="text" value="<?php echo $student['student_roll_no'];?>">
          </label>
       </div>  
        <div class="form-group">
          <label class="col-lg-4 control-label justify-content-start">Name:
          <input class="form-control" name="student_name" type="text" value="<?php echo $student['student_name'];?>">
          </label>
        </div>
        <div class="form-group">
          <label class="col-lg-4 control-label">Email:
            <input  class="form-control" type="text" value="<?php echo $student['email'];?>" disabled>
          </label>
        </div>
        <div class="form-group">
          <label class="col-lg-4 control-label">Mobile No.:
            <input class="form-control" name="student_mobile" type="text" value="<?php echo $student['student_mobile'];?>" >
          </label>
        </div>
        <div class="d-flex justify-content-start">
          <input type = "submit" class = "btn btn-success" value="Save Changes"></button>
     </div>
      
    </form>
    
    </div>
</div>
</div>
</div>
<?php echo view('student_panel/student_footer');?>
				        	              

