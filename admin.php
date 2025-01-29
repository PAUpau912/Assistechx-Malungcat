<?php
include './header.php';
require_once './src/ticket.php';
require_once './src/requester.php';
require_once './src/team.php';
require_once './src/user.php';

$ticket = new Ticket();

//reported tickets
$reportedTickets = $ticket::findByReported();
// Initialize classes
$requester = new Requester();
$team = new Team();
$user = new User();

// Fetch only reported tickets
$allTickets = Ticket::findByReported();  // Fetch only reported tickets

// Optionally, fetch a specific ticket if ticket_id is set in the query string
$specificTicket = null;
if (isset($_GET['ticket_id'])) {
    $ticketId = $_GET['ticket_id'];
    $specificTicket = $ticket::find($ticketId);
}

// Get Status Button Color Style
function getStatusColor($status) {
    $statusColors = [
        'open' => 'background-color: #007bff; color: white;',
        'closed' => 'background-color: #28a745; color: white;',
        'solved' => 'background-color: #ffc107; color: black;',
        'unassigned' => 'background-color: #6c757d; color: white;',
    ];
    
    return $statusColors[$status] ?? 'background-color: #343a40; color: white;';  // Default black
}
?>

<div id="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Reports</li>
        </ol>

        <!-- Table for all reported tickets -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Subject</th>
                                <th>Requester</th>
                                <th>Team</th>
                                <th>Agent</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($allTickets)): ?>
                            <?php foreach ($allTickets as $ticket): ?>
                               <tr>
                                <td><?php echo $ticket->id; ?></td>
                                <td><?php echo $ticket->title?></td>
                                <td><?php echo $ticket->requester_name ?? 'N/A';?></td>
                                <td><?php echo $team::find($ticket->team)->department;?></td>
                                <td><?php echo $team::find($ticket->team_member)->name;?></td>
                                <td>
                                    <button class = "btn" style = "<?php echo getStatusColor($ticket->status);?>">
                                        <?php echo $ticket->status;?>
                                    </button>
                                </td>
                                <td><?php echo (new DateTime ($ticket->created_at))->format('l, F j, Y g:i A');?></td>
                                <td width="100px">
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button"
                                                class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item" href="view.php">View</a>
                                                <form action="reported_ticket.php" method="POST">
                                                    <input type="hidden" name="ticket_id" value="<?php echo $ticket->id; ?>">
                                                    <button type="submit" class="btn">Report</button>
                                                </form>
                                                <a class="dropdown-item" onclick="return confirm('Are you sure to delete')"
                          href="?del=<?php echo $ticket->id; ?>">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                               </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No reported tickets found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright © 2024 AssisTechX. All rights reserved.</span>
            </div>
        </div>
    </footer>
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

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
