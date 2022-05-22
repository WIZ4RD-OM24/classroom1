<?= view('student_panel/student_header');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 >Classwork</h1>
          </div>
          
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

   
 
     

        <!-- /.row -->
        <div class="row" >
          <div class="col-sm-12">
            <div class="card">
              <!-- ./card-header -->
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      <div class="wrapper">
        <!-- /.row -->
       
    
        <!-- Main content -->
        <section class="content" style="width:90%;margin-left: 30px;">
          <div class="row">
            <div class="col-md-12">
            <?php foreach($classworks as $classwork): ?>   
              <div class="card ">
                <div class="card-header">
                  <h3 class="card-title">
                    <?= $classwork['classwork_title']; ?>
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body card-outline card-primary">
                  
                   <?php echo $classwork['classwork_content'];?>   
                  
                </div>  
                <div class="card-footer inline">
                  Uploaded by Omkar at <?= $classwork['created_at'];?>
                  <div class="d-flex justify-content-end">
                  <a href="<?php echo base_url('download-classwork/'.$classwork['classwork_id']);?>" class="btn btn-danger mb-2"><i class="fas fa-download"></i></a>&nbsp;&nbsp;
            </div>
                </div>
              </div>
                <?php endforeach;?>
            </div>
          </div>
      </div>  

<?= view('student_panel/student_footer');?>
