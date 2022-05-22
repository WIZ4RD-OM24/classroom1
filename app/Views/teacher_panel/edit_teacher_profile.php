<?php echo view('teacher_panel/teacher_header');?>
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
            <img src="<?php echo base_url('uploads/pfp/'.$teacher['teacher_image']);?>"  height="200px" width="200px" class="avatar img-circle img-thumbnail" alt="avatar">
            </div>
            <?= form_open_multipart('TeacherController/edit_profile') ?>
            <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> Upload Profile Image 
                    <input type="file" name="teacher_image">
                  </div>
                  <p class="help-block">Max. 32MB</p>
            </div>
        </div>
    
    <!-- edit form column -->
    <div class="col md-3 text-center">
      <input type="hidden" name="teacher_id" id="id" value="<?php echo $teacher['teacher_id']; ?>">
      <div class="form-group">
          <label class="col-lg-4 control-label justify-content-start">Name:</label>
          <div class="col-lg-8">
            <input class="form-control" name="teacher_name" type="text" value="<?php echo $teacher['teacher_name'];?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Email:</label>
          <div class="col-lg-8">
            <input  class="form-control" type="text" value="<?php echo $teacher['teacher_email'];?>" disabled>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Mobile No.:</label>
          <div class="col-lg-8">
            <input class="form-control" name="teacher_mobile" type="text" value="<?php echo $teacher['teacher_mobile'];?>" >
          </div>
        </div>
        
       
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Organisation:</label>
          <div class="col-lg-8">
            <input class="form-control" name="teacher_organisation" type="text" value="<?php echo $teacher['teacher_organisation'];?>" >
          </div>
        </div>
        <div class="d-flex justify-content-start">
          <input type = "submit" class = "btn btn-success" value="Save Changes"></button>
        </div>
      </form>
    </div>
</div>
</div>
</div>
<?php echo view('teacher_panel/teacher_footer');?>
