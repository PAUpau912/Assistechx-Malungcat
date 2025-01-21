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
$allTickets = Ticket::findByReported(true);  // Fetch only reported tickets

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

        <!-- Check if a specific ticket was selected to show details -->
        <?php foreach($allTickets as $ticket):?>
            <div class="card mb-3">
                <div class="card-body">
                    <h4>Ticket Details</h4>
                    <p><strong>Ticket ID:</strong> <?php echo $ticket->id; ?></p>
                    <p><strong>Subject:</strong><a href="./ticket-details.php?id=<?php echo $ticket->id?>"><?php echo $ticket->title?></a></p>
                    <p><strong>Requester:</strong> 
                        <?php 
                        $requesterObj = $requester::find($ticket->requester);
                        echo $requesterObj ? $requesterObj->name : 'N/A'; 
                        ?>
                    </p>
                    <p><strong>Team:</strong> 
                    <td>
                        <?php 
                        // Attempt to find the team
                        $teamObj = $team::find($ticket->team);
                        
                        // Check if the team was found and display its name, otherwise show 'No Team Assigned'
                        echo $teamObj ? $teamObj->name : 'No Team Assigned'; 
                        ?>
                    </td>
                    </p>
                    <p><strong>Agent:</strong> 
                        <?php 
                        $userObj = $user::find($ticket->team_member);
                        echo $userObj ? $userObj->name : 'N/A'; 
                        ?>
                    </p>
                    <p><strong>Status:</strong> 
                        <button class="btn" style="<?php echo getStatusColor($ticket->status); ?>">
                            <?php echo $ticket->status; ?>
                        </button>
                    </p>
                    <p><strong>Created At:</strong> <?php echo (new DateTime($ticket->created_at))->format('l, F j, Y g:i A'); ?></p>
                </div>
            </div>
        <?php endforeach;?>

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
