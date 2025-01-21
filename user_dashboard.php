<?php
include './user_header.php';
require_once './src/ticket.php';
require_once './src/requester.php';

$ticket = new Ticket();
$userTickets = $ticket::findByUserId($_SESSION['user']->id);

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    try {
        $ticket->delete($id);
        echo '<script>alert("Ticket deleted successfully");window.location = "./user_dashboard.php"</script>';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>

<style>
      .btn_n {
          display: flex;
          justify-content: center;
          align-items: center;
          font-size: 20px;
          max-width: 80%;
          height: 100px;
          margin-top: 250px;
          margin-left: 150px;
          color: white;
          background-color: black;
          border-radius: 25px;
      }
      .btn_n:hover {
        box-shadow: 0 0 5px #00c3cc, 0 0 20px #3372e3, 0 0 40px #7426ef;
        color:rgb(248, 248, 248);
        transform: scale(1.05);
      }
      .fa{
        margin-right: 10px;
      }
</style>

<div id="wrapper">
  <!-- Sidebar -->
  <?php include 'user_sidebar.php'; ?>

  <div id="content-wrapper">
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">New Ticket</li>
      </ol>
      <div class="text-center my-4">
        <a class="btn_n " href="./user_nticket.php"><i class="fa fa-plus"></i>New Ticket</a>
      </div>
    </div>
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright © 2024 AssisTechX. All rights reserved.</span>
        </div>
      </div>
    </footer>
  </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
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
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="js/sb-admin.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>
<script src="js/demo/chart-area-demo.js"></script>

<script src="//code.tidio.co/4rtzvsgruziogpjolqfobdjsedk3pfsw.js" async></script>

</body>
</html>