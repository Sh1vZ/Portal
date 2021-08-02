<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION)) {
  if ($_SESSION['loggedIn'] != true) {
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
              <h1>API</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data</h3>
                <br>
                <h4 id='msg'></h4>
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" onclick='postData()'>Add data</button>
                  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" onclick='deleteData()'>Delete data</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap" id='user'>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
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
    const api_url = "http://localhost:8080/api/";

    // Defining async function
    async function getapi(url) {
      const res = await fetch(`${url}user/get`);
      const data = await res.json();
      show(data);
    }
    getapi(api_url);

    function show(data) {
      let tab =
        `<tr>
          <th>#</th>
          <th>Name</th>
          <th>Adress</th>
          <th>Number</th>
         </tr>`;
      // Loop to access all rows 
      console.log(data);
      if (data.users != 0) {
        let a=1;
        for (let r of data.users) {
          tab += `<tr> 
      <td>${a++}</td>
      <td>${r.name} </td>
      <td>${r.adress}</td>
      <td>${r.number}</td> 
  </tr>`;
        }
      } else {
        tab += `<tr> 
      no records
  </tr>`;
      }
      // Setting innerHTML as tab variable
      document.getElementById("user").innerHTML = tab;
    }

    async function postData() {
      fetch(`${api_url}user/insert`, {
          method: 'POST'
        }).then(response => response.json())
        .then(data => {
          console.log(data);
          getapi(api_url);
          document.getElementById("msg").innerHTML = data.message;
        }).catch(err => {
          console.log(err);
        });
    }

    async function deleteData() {
      fetch(`${api_url}user/delete`, {
          method: 'DELETE'
        }).then(response => response.json())
        .then(data => {
          console.log(data);
          getapi(api_url);
          document.getElementById("msg").innerHTML = data.message;
        }).catch(err => {
          console.log(err);
        });
    }
  </script>
</body>

</html>