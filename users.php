<?php
    include './header.php';
    require_once './src/user.php';

    $users = User::findAll();
    //print_r($users);die();
?>
<div id="content-wrapper">

  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Users</a>
      </li>
      <li class="breadcrumb-item active">Users</li>
    </ol>
    <a class="btn btn-primary my-3" href="./newuser.php"><i class="fa fa-plus"></i>Create New User</a>
    <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php foreach($users as $user): ?>
                            <tr>
                                <td><?php echo $user->name ?></td>

                                <!-- Dropdown form for role selection -->
                                <td>
                                  <form method="POST" action="./src/update-role.php">
                                      <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                                      <select name="role" class="form-control" onchange="this.form.submit()">
                                          <option value="staff" <?php echo $user->role === 'staff' ? 'selected' : ''; ?>>Staff</option>
                                          <option value="admin" <?php echo $user->role === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                          <option value="user" <?php echo $user->role === 'user' ? 'selected' : ''; ?>>User</option>
                                      </select>
                                  </form>
                                </td>
                                <td><?php echo $user->email ?></td>
                                <td><?php echo $user->phone ?></td>
                                <?php $date = new DateTime($user->created_at); ?>
                                <td><?php echo $date->format('l, F j, Y g:i A') ?></td>
                            </tr>
                          <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

  </div>
  <!-- /.container-fluid -->

  <!-- Sticky Footer -->
  <footer class="sticky-footer">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
      <span>Copyright © 2024 AssisTechX. All rights reserved.</span>
      </div>
    </div>
  </footer>

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="./index.php">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="js/demo/datatables-demo.js"></script>
<script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
