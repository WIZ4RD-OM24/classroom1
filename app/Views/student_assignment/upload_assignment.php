<?= view('student_panel/student_header');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Upload Assignments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Upload  Assignment</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="card-body">
      <form method="post" action ="<?= base_url('/upload-assignment');?>" enctype="multipart/form-data">
            <b>Title:</b> <?php echo $assignment['assignment_post_title'];?>
              <div class="form-group">
                <label for="inputClientCompany">Description</label>
                <textarea type="text" name="description" id="inputClientCompany" class="form-control" value="<?php echo $assignment['assignment_post_description'];?>" disabled > </textarea>
              </div>
              <div class="form-group">
                <label for="inputClientCompany">file</label>
                <input type="file" name="post_file" id="inputClientCompany" class="form-control" value="<?php echo $assignment['assignment_post_file'];?>" >
                <label for="inputClientCompany">Due Date -  </label>
                <input type="date" name="due_date" id="inputClientCompany" class="form-control" value="<?php echo $assignment['assignment_post_due_date'];?>" disabled ><br><br>
                
                </div>
                <div class="form-group">
                     <label for="inputClientCompany">Upload</label>
                      <input type="file" name="file">
                </div>
                <div class="form-group">
                <input type="submit" class="btn btn-primary btn-sm"/>
                <input type="reset" class="btn btn-danger btn-sm"/>
              </form>
              
              </div>
              
            </div>
            
          </div>
              </div>

          </div>
        </div>
       <?= view('student_panel/student_footer');?>
    


