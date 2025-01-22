<?php
  include './header.php';
  require_once './src/requester.php';
  require_once './src/ticket.php';
  require_once './src/ticket-event.php';
  require './src/helper-functions.php';

  $err = '';
  $msg = '';

  # getting teams 
  $sql = "SELECT id, name FROM team ORDER BY name ASC";
  $res = $db->query($sql);
  $teams = [];
  while($row = $res->fetch_object()){
      $teams[] = $row;
  }

  if(isset($_POST['submit'])){
    
      $subject = $_POST['subject'];
      $comment = $_POST['comment']; 
      $team = $_POST['team'];
      $requester = $user->id; // Assuming $user is the currently logged-in user

      if(strlen($subject) < 1){
          $err = "Please enter title";
      } else if(strlen($comment) < 1){
          $err = "Please enter details";
      } else if($team == 'none'){
          $err = "Please select team";
      } else {
        try{
            $ticket = new Ticket([
                'title' => $subject,
                'body' => $comment,
                'team' => $team,
                'requester' => $requester
            ]); 
      
            $savedTicket = $ticket->save();

            $event = new Event([
                'ticket' => $savedTicket->id, 
                'user' => $user->id, 
                'body' => 'Ticket created'
            ]);
            $event->save();

            $msg = "Ticket generated successfully";
        } catch(Exception $e){
            $err = "Failed to generate ticket";
        }
      }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Other head elements here -->

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/zuu04issts7ddb54a5m429bzk4gcbpq2gh0f13856cht5x5r/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea',
        plugins: [
          'lists', 'link', 'wordcount',
        ],
        toolbar: 'undo redo | bold italic underline',
      });
    </script>
</head>

<body>
<div id="content-wrapper">

    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">New ticket</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header">
                <h3>Create a new ticket</h3>
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
                        <label for="requester" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Requester</label>
                        <div class="col-sm-8">
                            <input type="text" name="requester" class="form-control" id="" value="<?php echo $user->name?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
                        <label for="subject" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Title</label>
                        <div class="col-sm-8">
                            <input type="text" name="subject" class="form-control" id="" placeholder="Enter title">
                        </div>
                    </div>

                    <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
                        <label for="team" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Team</label>
                        <div class="col-sm-8">
                            <select name="team" class="form-control">
                                <option>--select--</option>
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
                                <option value="Customer Service">Customer Service</option>
                                <option value="Sales">Sales</option>
                                <option value="Human Resources">Human Resources</option>
                                <option value="Marketing">Marketing</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12">
                        <label for="comment" class="col-sm-12 col-lg-2 col-md-2 col-form-label">Details</label>
                            <div class="col-sm-8">
                                <textarea name="comment" class="form-control" id="" placeholder="Enter details" rows="10" cols="50"></textarea>
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
            <span>Copyright @ 2024 AssisTechX. All rights reserved.</span>
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
