<?php echo view('header');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Assignments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Add  Assignment</li>
            </ol>
          </div>
          
      </div><!-- /.container-fluid -->
      <div>
        <div class="d-flex justify-content-end">
        <a class="btn btn-success mb-2" href="<?= base_url('/view-post-assignment')?>"> Add Assignment </a>
          
        </div>
        </div>
    </section>
    <div class="card-body">

              
            <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Delete Assignment</h3>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Assignment Name</th>
                    <th>Subject</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>Assignment Name</td>
                    <td>Subject</td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-eye"> View </i></a>
                      </div>
                    </td>
                    <td>
                    <div class="btn-group btn-group-sm">
                          <a href="#" class="btn btn-danger">Delete <i class="fas fa-trash"></i></a>
                       </div> 
                    </td>
                  <tr>
                    <td>Assignment Name</td>
                    <td>Subject</td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-eye"> View </i></a>
                      </div>
                    </td>
                    <td>
                    <div class="btn-group btn-group-sm">
                          <a href="#" class="btn btn-danger">Delete <i class="fas fa-trash"></i></a>
                       </div> 
                    </td>
</tr> 
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
              </div>

          </div>
        </div>
       
        <?php echo view('footer');?>
