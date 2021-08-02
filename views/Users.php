<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
if (isset($_SESSION)) {
  if ($_SESSION['loggedIn'] == true) {
    if ($_SESSION['role'] != 'Admin') {
      header('Location:forbidden.php');
    }
  } else {
    header('Location:forbidden.php');
  }
}
?>
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
              <h1>Users</h1>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      </section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data</h3>
								<?php include '../includes/messages.php' ?>
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add data</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    require '../vendor/autoload.php';
                    $data = User::all()->sortByDesc('created_at');
                    $count = User::all()->count();
                    if ($count == 0) {
                      echo 'No records';
                    } else {
                      foreach ($data as $dat) {
                    ?>
                        <tr>
                          <td><?= $dat['username'] ?></td>
                          <td><?= $dat['password'] ?></td>
                          <td>
                            <button class='btn btn-primary' onclick="getData(<?= $dat['id'] ?>)">Edit</button>
                            <a href="../controllers/user.php?delete=<?= $dat['id'] ?>" class='btn btn-danger'>Delete</a>
                          </td>
                        </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Extra Large Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Insert</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <form action="../controllers/user.php" method='post' autocomplete="off">
                      <div class="row">
                        <div class="form-group col-md-12">
                          <label>Username</label>
                          <div class="input-group">
                            <input type="text" name='uname' class="form-control" placeholder="Username">
                          </div>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Password</label>
                          <div class="input-group">
                            <input data-toggle="password" name='pwd' class="form-control" type="password" maxlength="10" placeholder="Enter the password">
                          </div>
                        </div>
                      </div>
                      <center>
                        <button type="submit" name="insertData" class="btn btn-primary">Insert</button>
                      </center>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modalEdit">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Insert</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <form action="../controllers/user.php" method='post' id='editForm' autocomplete="off">
                      <div class="row">
                        <div class="form-group col-md-12">
                          <label>Username</label>
                          <div class="input-group">
                            <input type="text" name='uname' id='uname' class="form-control" placeholder="Username" disabled>
                          </div>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Password</label>
                          <div class="input-group">
                            <input data-toggle="password" name='pwd' class="form-control" type="password" maxlength="10" placeholder="Enter the password">
                          </div>
                        </div>
                      </div>
                      <center>
                        <button type="submit" name="updateData" class="btn btn-primary">Update</button>
                      </center>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- /.content-wrapper -->
    <?php include "../includes/footer.php"; ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <?php include "../includes/scripts.php"; ?>
  <script>
    const getData = (id) => {
      fetch(`../controllers/user.php?getId=${id}`, {
          method: 'GET'
        })
        .then(response => response.json())
        .then((data) => {
          val = data.data
          $('#modalEdit').modal('show');
          $('#editForm').attr('action', `../controllers/user.php?id=${id}`);
          $('#uname').val(val[0]);
        })
        .catch((err) => {
          console.log(err);
        })
    }
  </script>
</body>

</html>