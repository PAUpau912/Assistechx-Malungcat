<?php
    include 'user_header.php';  // Include header with navigation

    $err = '';
    $msg = '';

    // Assuming $user is an instance of stdClass, manually fetching user data
    // Example: $user = getUserData($_SESSION['user_id']);  // You should fetch the logged-in user's data

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];
    
        // Validation
        if (empty($name) || empty($email)) {
            $err = "Please fill in all fields.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err = "Please enter a valid email.";
        } else {
            try {
                // Update user information
                $user->name = $name;
                $user->email = $email;
    
                // Update password if new password is provided
                if (!empty($new_password)) {
                    // Hash and set the new password
                    $user->password = password_hash($new_password, PASSWORD_DEFAULT);
                }
    
                // Assuming you're using PDO to interact with the database
                $pdo = new PDO("mysql:host=localhost;dbname=assistechx", "root", ""); // Adjust credentials
                $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id");
                $stmt->bindParam(':name', $user->name);
                $stmt->bindParam(':email', $user->email);
                $stmt->bindParam(':password', $user->password);
                $stmt->bindParam(':id', $user->id);  // Assuming $user->id is the unique identifier for the user
    
                if ($stmt->execute()) {
                    $msg = "Profile updated successfully!";
                } else {
                    $err = "Failed to update profile in the database.";
                }
            } catch (Exception $e) {
                $err = "Failed to update profile: " . $e->getMessage();
            }
        }
    }
?>    

<style>
    .btn_y {
      color: white;
      border: none;
      margin-left: 5px;
      background-color: black;
    }

    .btn_y:hover {
        box-shadow: 0 0 5px #00c3cc, 0 0 20px #3372e3, 0 0 40px #7426ef;
        background:  #7426ef;
    }

</style>

<div id="wrapper">
  <!-- Sidebar -->
  <?php include 'user_sidebar.php'; ?>

  <div id="content-wrapper">
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="user_dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Settings</li>
      </ol>

      <div class="card mb-3">
        <div class="card-header">
          <h3>Update Your Profile</h3>
        </div>
        <div class="card-body">
          <?php if (!empty($err)) : ?>
            <div class="alert alert-danger text-center my-3" role="alert">
              <strong>Failed!</strong> <?php echo $err; ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($msg)) : ?>
            <div class="alert alert-success text-center my-3" role="alert">
              <strong>Success!</strong> <?php echo $msg; ?>
            </div>
          <?php endif; ?>

          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
              <label for="name" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Name</label>
              <div class="col-sm-8">
                <input type="text" name="name" class="form-control" value="<?php echo $user->name; ?>" placeholder="Enter name">
              </div>
            </div>

            <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
              <label for="email" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Email</label>
              <div class="col-sm-8">
                <input type="email" name="email" class="form-control" value="<?php echo $user->email; ?>" placeholder="Enter email">
              </div>
            </div>

            <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
              <label for="new_password" class="col-sm-12 col-lg-2 col-md-2 col-form-label">New Password</label>
              <div class="col-sm-8">
                <input type="password" name="new_password" class="form-control" placeholder="Enter new password (leave blank if not changing)">
              </div>
            </div>

            <div class="text-center">
              <button type="submit" name="submit" class="btn_y btn-lg btn-primary">Update Profile</button>
            </div>
          </form>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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