<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php'; ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>
    <?php include '../includes/navbar.php'; ?>
    <?php include '../includes/sidebar.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Blank Page</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Blank Page</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title">
                  Summernote
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="../controllers/mail.php" method='POST' enctype="multipart/form-data">
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label>To:</label>
                      <div class="input-group">
                        <input type="email" name='adress' id='uname' class="form-control" placeholder="To:">
                      </div>
                    </div>
                  </div>
                  <textarea id="summernote" name='body'>
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
                  <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="exampleInputFile">File:</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name='file' class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Mail as:</label>
                        <select class="form-control" name='type'>
                          <option value='pdf'>PDF</option>
                          <option value='word'>WORD</option>
                          <option value='excel'>EXCEL</option>
                          <option value='csv'>CSV</option>
                          <option value='json'>JSON</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <center>
                        <button type="submit" name="mail" class="btn btn-primary">Update</button>
                      </center>
                      <br>
                    </div>
                </form>
              </div>
              <div class="card-footer">
                Mailing as
              </div>
            </div>
          </div>
          <!-- /.col-->
          
        </div>
        <!-- /.card -->
      </section>
      <!-- /.content -->
    </div>
    <!-- Modal -->

    <!-- /.content-wrapper -->
    <?php include "../includes/footer.php"; ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <?php include "../includes/scripts.php"; ?>
  <script>
    $(function() {
      // Summernote
      $('#summernote').summernote({
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']]
        ]
      })
      bsCustomFileInput.init();
    })

  </script>
</body>

</html>