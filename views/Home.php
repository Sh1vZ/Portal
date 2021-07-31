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
							<h1>Data</h1>
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

								<div class="card-tools">
									<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add data</button>
								</div>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0" style="height: 300px;">
								<table class="table table-head-fixed text-nowrap">
									<thead>
										<tr>
											<th>ID</th>
											<th>Code</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Nr 1</th>
											<th>%</th>
											<th>NR 2</th>
											<th>Expiry Date</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php
										require '../vendor/autoload.php';
										$data = Data::all()->sortByDesc('created_at');
										$count = Data::all()->count();
										if ($count == 0) {
											echo 'No records';
										} else {
											foreach ($data as $dat) {
										?>
												<tr>
													<td><?= $dat['idRecord'] ?></td>
													<td><?= $dat['code'] ?></td>
													<td><?= $dat['startDate'] ?></td>
													<td><?= $dat['endDate'] ?></td>
													<td><?= $dat['nr1'] ?></td>
													<td><?= $dat['percent'] ?></td>
													<td><?= $dat['nr2'] ?></td>
													<td><?= $dat['expireDate'] ?></td>
													<td>
														<button class='btn btn-primary' onclick="getData(<?= $dat['id'] ?>)">Edit</button>
														<a href="../controllers/data.php?delete=<?= $dat['id'] ?>" class='btn btn-danger'>Delete</a>
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
									<li class="nav-item">
										<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Import</a>
									</li>
								</ul>
							</div>
							<div class="card-body">
								<div class="tab-content" id="custom-tabs-one-tabContent">
									<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
										<form action="../controllers/data.php" method='post'>
											<div class="row">
												<div class="form-group col-md-6">
													<label>ID:</label>
													<div class="input-group">
														<input type="text" name='id' class="form-control" placeholder="ID">
													</div>
												</div>
												<div class="form-group col-md-6">
													<label>Code:</label>
													<div class="input-group">
														<input type="text" name='code' class="form-control" placeholder="Code">
													</div>
												</div>
												<div class="form-group col-md-6">
													<label>Date Start:</label>
													<div class="input-group date" id="reservationdate" data-target-input="nearest">
														<input type="text" name='dateStart' class="form-control datetimepicker-input" data-target="#reservationdate" />
														<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<label>Date End:</label>
													<div class="input-group date" id="reservationdate1" data-target-input="nearest">
														<input type="text" name='dateEnd' class="form-control datetimepicker-input" data-target="#reservationdate1" />
														<div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-4">
													<label>Nr 1:</label>
													<div class="input-group">
														<input type="number" name='nr1' class="form-control" placeholder="Nr 1">
													</div>
												</div>
												<div class="form-group col-md-4">
													<label>%</label>
													<div class="input-group">
														<input type="text" class="form-control" value='%' disabled>
													</div>
												</div>
												<div class="form-group col-md-4">
													<label>Nr 2:</label>
													<div class="input-group">
														<input type="number" name='nr2' class="form-control" placeholder="Nr 2">
													</div>
												</div>
												<div class="form-group col-md-12">
													<label>Date Expirey:</label>
													<div class="input-group date" id="reservationdate2" data-target-input="nearest">
														<input type="text" name='dateExp' class="form-control datetimepicker-input" data-target="#reservationdate1" />
														<div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
											</div>
											<center>
												<button type="submit" name="insertData" class="btn btn-primary">Insert</button>
											</center>
										</form>
									</div>
									<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
										<div class="row">
											<form action="../controllers/upload.php" class="dropzone dz-clickable col-md-12" id="my-awesome-dropzone" style='border-style: dotted; height:200px'>
												<div class="dz-message">Drop UNL file here or click to upload.
												</div>
											</form>
										</div>
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
										<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Edit</a>
									</li>
								</ul>
							</div>
							<div class="card-body">
								<div class="tab-content" id="custom-tabs-one-tabContent">
									<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
										<form action="../controllers/data.php" id='editForm' method='post'>
											<div class="row">
												<div class="form-group col-md-6">
													<label>ID:</label>
													<div class="input-group">
														<input type="text" name='id' id='id' class="form-control" placeholder="ID">
													</div>
												</div>
												<div class="form-group col-md-6">
													<label>Code:</label>
													<div class="input-group">
														<input type="text" name='code' id='code' class="form-control" placeholder="Code">
													</div>
												</div>
												<div class="form-group col-md-6">
													<label>Date Start:</label>
													<div class="input-group date" id="reservationdate3" data-target-input="nearest">
														<input type="text" name='dateStart' id='dateStart' class="form-control datetimepicker-input" data-target="#reservationdate3" />
														<div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<label>Date End:</label>
													<div class="input-group date" id="reservationdate3" data-target-input="nearest">
														<input type="text" name='dateEnd' id='dateEnd' class="form-control datetimepicker-input" data-target="#reservationdate3" />
														<div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-4">
													<label>Nr 1:</label>
													<div class="input-group">
														<input type="number" name='nr1' id='nr1' class="form-control" placeholder="Nr 1">
													</div>
												</div>
												<div class="form-group col-md-4">
													<label>%</label>
													<div class="input-group">
														<input type="text" class="form-control" value='%' disabled>
													</div>
												</div>
												<div class="form-group col-md-4">
													<label>Nr 2:</label>
													<div class="input-group">
														<input type="number" name='nr2' id='nr2' class="form-control" placeholder="Nr 2">
													</div>
												</div>
												<div class="form-group col-md-12">
													<label>Date Expirey:</label>
													<div class="input-group date" id="reservationdate3" data-target-input="nearest">
														<input type="text" name='dateExp' id='dateExp' class="form-control datetimepicker-input" data-target="#reservationdate3" />
														<div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
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
		$('#reservationdate').datetimepicker({
			format: 'L'
		});
		$('#reservationdate1').datetimepicker({
			format: 'L'
		});
		$('#reservationdate2').datetimepicker({
			format: 'L'
		});
		$('#reservationdate3').datetimepicker({
			format: 'L'
		});
		$('#reservationdate3').datetimepicker({
			format: 'L'
		});
		$('#reservationdate3').datetimepicker({
			format: 'L'
		});
		Dropzone.options.myAwesomeDropzone = {
			init: function() {
				this.on("success", function(file, res) {
					location.reload();
				});
			}

		};

		const getData = (id) => {
			fetch(`../controllers/data.php?getId=${id}`, {
					method: 'GET'
				})
				.then(response => response.json())
				.then((data) => {
					val = data.data
					$('#modalEdit').modal('show');
					$('#editForm').attr('action', `../controllers/data.php?id=${id}`);
					$('#id').val(val[1]);
					$('#code').val(val[2]);
					$('#dateStart').val(val[3]);
					$('#dateEnd').val(val[4]);
					$('#nr1').val(val[5]);
					$('#nr2').val(val[7]);
					$('#dateExp').val(val[8]);
				})
				.catch((err) => {
					console.log(err);
				})
		}
	</script>
</body>

</html>