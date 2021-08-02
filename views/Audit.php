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
              <h1>Audit</h1>
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
                <h3 class="card-title">Audit</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>Role</th>
                      <th>Actions</th>
                      <th>Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    require '../vendor/autoload.php';
                    $data = Audit::all()->sortByDesc('created_at');
                    $count = Audit::all()->count();
                    if ($count == 0) {
                      echo 'No records';
                    } else {
                      foreach ($data as $dat) {
                    ?>
                        <tr>
                          <td><?= $dat['username'] ?></td>
                          <td><?= $dat['role'] ?></td>
                          <td><?= $dat['action'] ?> </td>
                          <td><?= $dat['created_at'] ?> </td>
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

    <!-- /.content-wrapper -->
    <?php include "../includes/footer.php"; ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <?php include "../includes/scripts.php"; ?>
</body>

</html>