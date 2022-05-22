<?= view('header');?>

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
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="card-body">
              <div class="form-group">
                <label for="inputStatus">Select Subject</label>
                <select id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Select Subject</option>
                  <option>Subject 1</option>
                  <option>Subject 2</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Description</label>
                <textarea type="text" id="inputClientCompany" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Upload</label>
                <form action="/action_page.php">
                <input type="file" name="My file">
                <label for="inputClientCompany">Due Date -  </label>
                <input type="date" name="Due Date"><br><br>
                
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
       <?= view('footer');?>
    


