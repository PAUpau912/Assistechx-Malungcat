<?php
require_once './header.php';
require_once './src/team.php';
require './src/helper-functions.php';

$err = '';
$msg = '';


if(isset($_POST['submit'])){
    
    $name = $_POST['name'];
    $department = $_POST['department'];


    if(strlen($name) < 1) {
      $err = "Please enter team name";
  } elseif($department == '') {
      $err = "Please select a department"; // Ensure a department is selected
  } else {
      try {
          $team = new Team([
              'name' => $name,
              'department' => $department  // Include department in the data
          ]);
          $team->save();
          $msg = "Team generated successfully";
      } catch(Exception $e) {
      }
  }
}
// class User {
//     public $id = null;
//     public $name = '';
//     public $email = '';
//     public $phone = '';
//     public $password = '';
//     public $role = '';
//     public $avatar = '';
//     public $lastPassword = '';
//     private $db = null;

//     public function __construct($data = null) {
//         $this->name = $data['name'] ?? null;
//         $this->email = $data['email'] ?? null;
//         $this->phone = $data['phone'] ?? null;
//         $this->password = $data['password'] ?? null;
//         $this->role = $data['role'] ?? null;
//         $this->lastPassword = $data['password'] ?? null;
//         $this->db = Database::getInstance();
//     }

//     public function save(): User {
//         $sql = "INSERT INTO users (name, email, phone, password, role, last_password) 
//                 VALUES (?, ?, ?, ?, ?, ?)";
//         $stmt = $this->db->prepare($sql);
//         $stmt->bind_param("ssssss", $this->name, $this->email, $this->phone, $this->password, $this->role, $this->lastPassword);

//         if (!$stmt->execute()) {
//             throw new Exception("Failed to insert user: " . $stmt->error);
//         }

//         $id = $this->db->insert_id;
//         return self::find($id);
//     }

//     public static function find($id): ?User {
//         $sql = "SELECT * FROM users WHERE id = ?";
//         $self = new static;
//         $stmt = $self->db->prepare($sql);
//         $stmt->bind_param("i", $id);
//         $stmt->execute();
//         $res = $stmt->get_result();

//         if ($res->num_rows < 1) {
//             return null;
//         }

//         $self->populateObject($res->fetch_object());
//         return $self;
//     }

//     public static function findAll(): array {
//         $sql = "SELECT * FROM users ORDER BY id DESC";
//         $users = [];
//         $self = new static;
//         $res = $self->db->query($sql);

//         if ($res->num_rows < 1) {
//             return [];
//         }

//         while ($row = $res->fetch_object()) {
//             $user = new static;
//             $user->populateObject($row);
//             $users[] = $user;
//         }

//         return $users;
//     }

//     public static function updateRole($id, $role): bool {
//         $db = Database::getInstance();
//         $stmt = $db->prepare("UPDATE users SET role = ? WHERE id = ?");
//         $stmt->bind_param("si", $role, $id);

//         if (!$stmt->execute()) {
//             throw new Exception("Failed to update role: " . $stmt->error);
//         }

//         return true;
//     }

//     private function populateObject($object): void {
//         foreach ($object as $key => $value) {
//             if (property_exists($this, $key)) {
//                 $this->$key = $value;
//             }
//         }
//     }
// }
?>
<div id="content-wrapper">

    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Members</a>
            </li>
            <li class="breadcrumb-item active">New Member</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header">
                <h3>Create a new member</h3>
            </div>
            <div class="card-body">
                <?php if(strlen($err) > 1) :?>
                <div class="alert alert-danger text-center my-3" role="alert"> <strong>Failed! </strong> <?php echo $err;?></div>
                <?php endif?>

                <?php if(strlen($msg) > 1) :?>
                <div class="alert alert-success text-center my-3" role="alert"> <strong>Success! </strong> <?php echo $msg;?></div>
                <?php endif?>

                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
                        <label for="name" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="" placeholder="Enter name">
                        </div>
                    </div>
                    <!-- Department Dropdown -->
                    <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
                        <label for="department" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Department</label>
                        <div class="col-sm-8">
                            <select name="department" class="form-control" id="department">
                                <option value="">Select a department</option>
                                <option value="Administration">Administration</option>
                                <option value="Operations">Operations</option>
                                <option value="Data Analysis">Data Analysis</option>
                                <option value="Project Management">Project Management</option>
                                <option value="Cloud Computing">Cloud Computing</option>
                                <option value="Web Development">Web Development</option>
                                <option value="Technical Support">Technical Support</option>
                                <option value="Security">Security</option>
                                <option value="Finance">Finance</option>
                                <option value="IT">IT</option>
                                <option value="Software Development">Software Development</option>
                                <option value="Legal">Legal</option>
                                <option value="Procurement">Procurement</option>
                                <option value="Research and Development">Research and Development</option>
                                <option value=" Customer Service">Customer Service</option>
                                <option value="Sales">Sales</option>
                                <option value="Human Resources">Human Resources</option>
                                <option value="Marketing">Marketing</option>

                            </select>
                        </div>
                    </div>
                   
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-lg btn-primary"> Create</button>
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
            <span>Copyright © Synchlab Coding</span>
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
