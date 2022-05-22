<?php echo view('teacher_panel/teacher_header');?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>STUDENT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="d-flex justify-content-end">
              <a class="btn btn-danger">Back</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    
        <div class="row">
          <div class="col-12">
            <div class="card">

              <!-- ./card-header -->
              
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Roll No.</th>
                      <th>Profile Image</th>
                      <th>Name</th>
                      <th>Email</th>
                        
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($students as $student):?>
                    <tr>
                      <td><?php echo $student['student_roll_no']; ?></td>
                      <td><img src= "<?php echo base_url('uploads/pfp/'.$student['student_image']);?>" height="80px" width="80px" class="avatar img-circle img-thumbnail" alt="avatar"></td>
                      <td><?php echo $student['student_name']; ?></td>
                      <td><?php echo $student['email']; ?></td>
                      <?php endforeach;?>   
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php echo view('teacher_panel/teacher_footer');?>
