<?php echo view('header');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TEACHER/STAFF MEMBERS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="d-flex justify-content-end">
              <a class="btn btn-danger">Back</a>
            </ol>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <?php /*if(isset($validation)):?>
                <div class="alert alert-warning">
                   <?php echo $validation->listErrors(); ?>
                </div>
                <?php endif;*/?>
    <form method="get" action="<?php echo base_url('/add-teacher'); ?>">

      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Teacher</h3>

            <div class="card-tools">
              
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text"   name="teacher_name" class="form-control" id="exampleInputEmail1"  placeholder="Enter name">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email"  name="teacher_email" class="form-control" id="exampleInputEmail1"  placeholder="Enter email   ">

                </div>
                
                <ol class="d-flex justify-content-start">
                  <input type="submit" class="btn btn-success" value="Add Teacher"></input>
                </ol>
                <!-- /.form-group -->
                </form>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                
               
                
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-12 col-sm-6">
                
                <!-- /.form-group -->
              </div>
              
              <!-- /.col -->
              <div class="col-12 col-sm-6">
                
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          
        </div>
        <!-- /.card -->

        

            
              
              
            
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php echo view('footer');?>
