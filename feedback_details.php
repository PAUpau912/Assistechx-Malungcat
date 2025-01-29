<?php
require_once './src/Database.php';
require_once './src/feedback.php';
include 'user_header.php';

$db = Database::getInstance();

// Fetch reported feedback for the logged-in user
$feedbacks = Feedback::getReportedFeedbackByUser($user->id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>User Dashboard - Helpdesk</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container {
      margin-top: 30px;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      text-align: left;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f8f9fa;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #d1e7fd;
    }

    h2 {
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
<div id="wrapper">
    <!-- Sidebar -->
    <?php include 'user_sidebar.php'; ?>
    <div class="container">
        <h2>Reported Feedback</h2>

        <?php if (!empty($feedbacks)): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Feedback</th>
            </tr>
            </thead>
            <tbody>
        <?php 
            foreach ($feedbacks as $feedback) {
                echo "<tr>";
                // Accessing array elements correctly with keys
                echo "<td>" . $feedback['ticket_id'] . "</td>";
                echo "<td>" . $feedback['title'] . "</td>";
                echo "<td>" . $feedback['ticket_status'] . "</td>";
                echo "<td>" . $feedback['ticket_created_at'] . "</td>";
                echo "<td>" . $feedback['content'] . "</td>";
                echo "</tr>";
            }
        ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No reported feedback found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
