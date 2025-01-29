<?php
session_start();
require_once './src/Database.php';

// Check if the ticket_id is set
if (isset($_POST['ticket_id'])) {
    $ticket_id = $_POST['ticket_id'];
    $db = Database::getInstance();

    // Update the reported field to 1
    $query = "UPDATE ticket SET reported = 1 WHERE id = ?";
    $stmt = $db->prepare($query);
    if ($stmt === false) {
        die('Error preparing query: ' . $db->error);
    }

    $stmt->bind_param("i", $ticket_id);

    if ($stmt->execute()) {
        // Redirect to admin.php after successful reporting
        header("Location: admin.php");
        exit();
    } else {
        echo "Error reporting ticket: " . $stmt->error;
    }
} else {
    echo "No ticket ID provided.";
}
?>
