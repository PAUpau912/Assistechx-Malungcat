<?php
include './header.php';
if (!isset($_GET['id']) || strlen($_GET['id']) < 1 || !ctype_digit($_GET['id'])) {
    echo '<script> history.back()</script>';
    exit();
}

require_once './src/requester.php';
require_once './src/team.php';
require_once './src/ticket.php';
require_once './src/ticket-event.php';
require_once './src/team-member.php';
require_once './src/comment.php';

// Fetch the ticket ID from the URL
$ticketId = $_GET['id'];

// Fetch comments related to the ticket using the dynamic ticket ID
$sql = "SELECT c.*, tm.name AS team_member_name 
        FROM comments c 
        JOIN team tm ON c.team_member = tm.id 
        WHERE c.ticket = ? 
        ORDER BY c.created_at DESC";
$stmt = $db->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    echo "Error preparing the statement: " . $db->error;
    exit();
}

// Bind the parameter for ticket ID
$stmt->bind_param("i", $ticketId);

// Execute the statement
if ($stmt->execute()) {
    $result = $stmt->get_result();
} else {
    echo "Error executing the statement: " . $stmt->error;
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
</head>
<body>
<div id="content-wrapper">

    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Ticket details</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="comment">
                    <h3>Comment by Team Member <?= htmlspecialchars($row['team_member_name']) ?></h3>
                    <p><?= htmlspecialchars($row['body']) ?></p>
                    <?php if (!empty($row['image_path'])): ?>
                        <p><img src="<?= htmlspecialchars($row['image_path']) ?>" alt="Comment Image" style="max-width: 100%;"></p>
                    <?php endif; ?>
                    <small>Created at: <?= htmlspecialchars($row['created_at']) ?></small>
                </div>
                <?php endwhile; ?>
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

<?php include './footer.php'?>

</body>
</html>
