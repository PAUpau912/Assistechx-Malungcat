<?php
    include './header.php';
    require_once './src/ticket.php';
    require_once './src/requester.php';
    require_once './src/team.php';

    $ticket = new Ticket();
    $allTicket = $ticket::findAll();

    $team = new Team();

    if (isset($_GET['del'])) {
      $ticket::delete($_GET['del']);
    }
?>
<div id="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>
    <a class="btn btn-primary my-3" href="./ticket.php"><i class="fa fa-plus"></i> New Ticket</a>
    <div class="card mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th style="width: 5%;">ID</th>
              <th style="width: 20%;">Subject</th>
              <th style="width: 15%;">Requester</th>
              <th style="width: 20%;">Team</th>
              <th style="width: 15%;">Agent</th>
              <th style="width: 15%;">Created At</th>
              <th style="width: 10%;">Action</th>
            </tr>
          </thead>

            <tbody>
              <?php foreach($allTicket as $ticket):?>
              <tr>
                <td><?php echo $ticket->id?></td>
                <td><a href="./ticket-details.php?id=<?php echo $ticket->id?>"><?php echo $ticket->title?></a></td>
                <td>
                  <?php 
                    $requester = Requester::find($ticket->requester);
                    echo $requester ? $requester->name : 'Unknown'; 
                  ?>
                </td>
                <td><?php echo $team::find($ticket->team)->department;?></td>
                <td><?php echo $team::find($ticket->team_member)->name;?></td>
                <?php $date = new DateTime($ticket->created_at)?>
                <td><?php echo $date->format('l, F j, Y g:i A')?> </td>
                <td width="100px">
                  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a href="./ticket-details.php?id=<?php echo $ticket->id?>" class="dropdown-item" href="#">View</a>
                        <a class="dropdown-item" href="report_ticket.php?ticket_id=<?php echo $ticket->id; ?>">Report</a>
                        <a class="dropdown-item" onclick="return confirm('Are you sure to delete')"
                          href="?del=<?php echo $ticket->id; ?>">Delete</a>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <?php endforeach?>
            </tbody>
          </table>
        </div>
      </div>
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
</body>
</html>