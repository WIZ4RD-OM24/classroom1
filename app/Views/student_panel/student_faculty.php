<?php echo view('student_panel/student_header');?>
<?php use App\Models\SubjectModel;?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>FACULTY</h1>
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
                      <th>Sr No</th>
                      <th> Image</th>
                      <th>  Name</th>
                      <th>  Email</th>
                      <th>  subject</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                 
                  <?php
                  $i=1;?>
                  <?php foreach($teachers as $teacher):?>
                     <?php if($teacher['class_id']==$_SESSION['student']['class_id'] ):?>
                   
                    <tr>
                      <td><?php echo $i; ?></td>
                     
                      <td>
                      <img src= "<?php echo base_url('uploads/pfp/'.$teacher['teacher_image']);?>" height="100px" width="100px" class="avatar img-circle img-thumbnail" alt="avatar">
              
                      </td>
                      <td><?php echo $teacher['teacher_name']; ?></td>
                      <td><?php echo $teacher['email']; ?></td>
                      <?php $SubjectModel= new SubjectModel();?>
                      <?php $subject=$SubjectModel->where('teacher_id',$teacher['teacher_id'])->first();?>
                      <td><?php echo $subject['subject_name']; ?></td>
                   <?php $i++; ?>
                    <?php endif;?>
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
  <?php echo view('student_panel/student_footer');?>