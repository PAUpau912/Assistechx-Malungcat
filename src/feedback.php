<?php
class Feedback {
    public $ticket_id;
    public $content;
    public $created_at;

    public function save() {
        $db = Database::getInstance();
        $query = "INSERT INTO feedback (ticket_id, content, created_at) VALUES (?, ?, ?)";
        $stmt = $db->prepare($query);
        
        // Bind parameters
        $stmt->bind_param("iss", $this->ticket_id, $this->content, $this->created_at);
        
        // Execute query
        $stmt->execute();
        
        // Close statement
        $stmt->close();
    }

    public static function findByTicket($ticket_id) {
        $db = Database::getInstance();
        $query = "SELECT * FROM feedback WHERE ticket_id = ?";
        $stmt = $db->prepare($query);
        
        // Bind parameter
        $stmt->bind_param("i", $ticket_id);
        
        // Execute query
        $stmt->execute();
        
        // Get result
        $result = $stmt->get_result();
        
        // Fetch all results as an associative array
        $feedbacks = [];
        while ($row = $result->fetch_assoc()) {
            $feedbacks[] = $row;
        }
        
        // Close statement
        $stmt->close();
        
        return $feedbacks;
    }

    public static function countFeedbackByUser($userId) {
        $db = Database::getInstance();  // Assuming Database is your DB connection
        $query = "SELECT COUNT(*) as total FROM feedback WHERE user_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $userId); // Bind the user ID
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['total'];
    }public static function getReportedFeedbackByUser($userId) {
        $db = Database::getInstance();
        // Join feedback with ticket table to get subject, status, and created_at
        $query = "
            SELECT feedback.*, ticket.title, ticket.status AS ticket_status, ticket.created_at AS ticket_created_at
            FROM feedback
            INNER JOIN ticket ON feedback.ticket_id = ticket.id
            WHERE feedback.user_id = ? AND ticket.reported = 1
        ";
        $stmt = $db->prepare($query);
        
        if ($stmt === false) {
            die('MySQL prepare error: ' . $db->error);
        }
    
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $feedbacks = [];
        
        while ($row = $result->fetch_assoc()) {
            $feedbacks[] = $row;  // Or create Feedback objects instead of raw data
        }
    
        return $feedbacks;
    }
    
}

?>