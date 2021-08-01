        <!-- Main Sidebar Container -->
        <?php session_start() ?>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
        	<!-- Brand Logo -->
        	<!-- Sidebar -->
        	<div class="sidebar">
        		<!-- Sidebar user panel (optional) -->
        		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        			<div class="info">
        				<a href="#" class="d-block"><?= $_SESSION['role'] ?></a>
        			</div>
        		</div>
        		<!-- Sidebar Menu -->
        		<nav class="mt-2">
        			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        				<li class="nav-item">
        					<a href="../views/Home.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'Home.php' ? 'active' : '') ?>">
        						<i class="nav-icon fas fa-home"></i>
        						<p>
        							Home
        						</p>
        					</a>
        				</li>
        				<li class="nav-item">
        					<a href="../views/Users.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'Users.php' ? 'active' : '') ?>">
        						<i class="nav-icon fas fa-users"></i>
        						<p>
        							Users
        						</p>
        					</a>
        				</li>
        				<li class="nav-item">
        					<a href="../views/Audit.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'Audit.php' ? 'active' : '') ?>">
        						<i class="nav-icon fas fa-user-shield"></i>
        						<p>
        							Audit
        						</p>
        					</a>
        				</li>
        				<li class="nav-item">
        					<a href="../views/Mail.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'Mail.php' ? 'active' : '') ?>">
									<i class="fas fa-envelope-open"></i>        						
									<p>
        							Mail
        						</p>
        					</a>
        				</li>
        			</ul>
        		</nav>
        		<!-- /.sidebar-menu -->
        	</div>
        	<!-- /.sidebar -->
        </aside>