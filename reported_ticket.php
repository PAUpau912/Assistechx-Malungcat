<?php
include 'header.php';

require_once './src/Database.php';
$db = Database::getInstance();

// Handle Feedback Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ticket_id']) && isset($_POST['feedback'])) {
    $ticket_id = $_POST['ticket_id'];
    $feedback = trim($_POST['feedback']);

    if (!empty($feedback)) {
        // Insert new feedback into the database
        $query = "INSERT INTO feedback (ticket_id, content) VALUES (?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("is", $ticket_id, $feedback);

        if ($stmt->execute()) {
            $feedbackMessage = "Feedback submitted successfully.";
        } else {
            $feedbackMessage = "There was an error submitting your feedback: " . $stmt->error;
        }
    }
}

// Retrieve all reported tickets
$query = "
    SELECT t.id, t.title, tf.content AS feedback, t.status, t.created_at
    FROM ticket t
    LEFT JOIN feedback tf ON t.id = tf.ticket_id
    WHERE t.reported = 1
    ORDER BY t.created_at ASC
";
$stmt = $db->prepare($query);
if ($stmt->execute()) {
    $result = $stmt->get_result();
    $reportedTickets = $result->fetch_all(MYSQLI_ASSOC);
} else {
    die("Error fetching reported tickets: " . $stmt->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Reported Tickets</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body id="page-top">
        <div class="container-fluid">
            <h3 class="mt-4">Reported Tickets</h3>

            <?php if (isset($feedbackMessage)): ?>
                <div class="alert alert-info"><?php echo $feedbackMessage; ?></div>
            <?php endif; ?>

            <!-- Feedback Form -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h5>Add Feedback for Ticket</h5>
                    <form action="reported_ticket.php" method="POST">
                        <div class="form-group">
                            <label for="ticket_id">Ticket ID</label>
                            <input type="number" name="ticket_id" id="ticket_id" class="form-control" placeholder="Enter Ticket ID" required>
                        </div>
                        <div class="form-group">
                            <label for="feedback">Feedback</label>
                            <textarea name="feedback" class="form-control" rows="3" placeholder="Enter your feedback here" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit Feedback</button>
                    </form>
                </div>
            </div>

            <!-- Reported Tickets Table -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <?php if (count($reportedTickets) > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Ticket ID</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Date Reported</th>
                                    <th>Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reportedTickets as $ticket): ?>
                                    <tr>
                                        <td><?php echo $ticket['id']; ?></td>
                                        <td><?php echo $ticket['title']; ?></td>
                                        <td><?php echo $ticket['status']; ?></td>
                                        <td><?php echo date("F j, Y, g:i a", strtotime($ticket['created_at'])); ?></td>
                                        <td>
                                            <?php if (!empty($ticket['feedback'])): ?>
                                                <?php echo $ticket['feedback']; ?>
                                            <?php else: ?>
                                                No feedback yet.
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No reported tickets found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
