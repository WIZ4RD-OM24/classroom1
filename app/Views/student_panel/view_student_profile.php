<?= view('student_panel/student_header');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="margin-left:260px;">Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="d-flex justify-content-end">
              <a href="<?= base_url('/students')?>" class="btn btn-danger">Back</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row" style="margin-left:250px;">
          <div class="col-md-9">

            <!-- Profile Image -->
            <div class="col md-3">
                <div class="text-center">
                    <img src="<?php echo base_url('uploads/pfp/'.$student['student_image']);?>" height="200px" width="200px" class="avatar img-circle img-thumbnail" alt="avatar">
                </div>

                <h3 class="profile-username text-center">Student Name</h3>


                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                         <b style="margin-left:210px;">Roll No :</b> <a class="float-center"><?= $student['student_roll_no'];?></a>
                    </li>
                  <li class="list-group-item">
                    <b style="margin-left:210px;">Name :</b> <a class="float-center"><?= $student['student_name'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b style="margin-left:210px;">Email :</b> <a class="float-center"><?= $student['email'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b style="margin-left:210px;">Mobile :</b> <a class="float-center"><?= $student['student_mobile'];?></a>
                  </li>
                </ul>
                <div class="d-flex justify-content-start">
                     <a type = "button" class = "btn btn-primary" href="<?php echo base_url('/view-edit-student-profile'); ?>">Edit Profile</a>
                </div>

            </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
    <?= view('student_panel/student_footer');?>