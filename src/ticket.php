<?php
require_once 'Database.php';

class Ticket
{
    public $title = '';
    public $body = '';
    public $requester = null;
    public $team = null;
    public $team_member = null;
    public $status = '';
    public $priority = '';
    public $rating = '';

    private $db = null;

    public function __construct($data = null)
    {
        $this->title =  isset($data['title']) ? $data['title'] : null;
        $this->body = isset($data['body']) ? $data['body'] : null;
        $this->requester = isset($data['requester']) ? $data['requester'] : null;
        $this->team = isset($data['team']) ? $data['team'] : null;
        $this->team_member = isset($data['team_member']) ? $data['team_member'] : null;
        $this->status = isset($data['status']) ? $data['status'] : 'open';
        $this->priority = isset($data['priority']) ? $data['priority'] : 'low';

        $this->db = Database::getInstance();

        return $this;
    }

    public static function findByReported() {
        $db = Database::getInstance();

        $query = "SELECT ticket.*,requester.name AS requester_name,users.name AS team_member_name
                  FROM ticket
                  LEFT JOIN requester ON ticket.requester = requester.id
                  LEFT JOIN users on ticket.team_member = users.id
                  WHERE ticket.reported = 1";

        $stmt = $db->prepare($query);

        if ($stmt === false) {
            return [];
        }
        $stmt->execute();

        $result = $stmt->get_result();

        if(!$result){
            throw new Exception("Failed to fetch reported tickets:" .$db->error);
        }
        $tickets = [];
        while ($ticket = $result->fetch_object()){
            $tickets[] = $ticket;
        } 
        return $tickets;
    }

    public static function updateReportedTicket($ticketId){
        $db = Database::getInstance();

        $updatetQuery = "UPDATE ticket SET reported = 1 WHERE id =?";
        $stmt=$db->prepare($updatetQuery);

        if(!$stmt){
            throw new Exception("Statemetn preparation failed:".$db-error);
        }

        $stmt->bind_param("i",$ticketId);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            return true;
        } else {
            throw new Exception("failed to report the ticket or no change made.");
        }
    }

    public static function reportedTicket($ticketId){
        $db = Database::getInstance();

        $query = "UPDATE ticket SET reported = 1 WHERE id = ?";
        $stmt = $db->prepare($query);
        if(!$stmt){
            die("Error preparing statement: ".$db->error);
        }
        $stmt->bind_param("i", $ticketId);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            return true;
        }
        return false;
    }

    public function save(): Ticket
    {
        $sql = "INSERT INTO ticket (title, body, requester, team, team_member, status, priority)
                VALUES ('$this->title', '$this->body', '$this->requester', '$this->team', '$this->team_member', '$this->status', '$this->priority')";

        if ($this->db->query($sql) === false) {
            throw new Exception($this->db->error);
        }
        $id = $this->db->insert_id;
        return self::find($id);
    }

    public static function find($id): ?Ticket
    {
        $sql = "SELECT * FROM ticket WHERE id = '$id'";
        $self = new static;
        $res = $self->db->query($sql);
    
        if (!$res || $res->num_rows < 1) {
            return null; // Return null instead of throwing an exception.
        }
    
        $self->populateObject($res->fetch_object());
        return $self;
    }

    public static function findAll(): array
    {
        $sql = "SELECT * FROM ticket ORDER BY id DESC";
        $tickets = [];
        $self = new static;
        $res = $self->db->query($sql);

        if ($res->num_rows < 1) {
            return new static;
        }

        while ($row = $res->fetch_object()) {
            $ticket = new static;
            $ticket->populateObject($row);
            $tickets[] = $ticket;
        }

        return $tickets;
    }

    public static function findByStatus($status): array
    {
        $sql = "SELECT * FROM ticket WHERE status = '$status' ORDER BY id DESC";
        $self = new static;
        $tickets = [];
        $res = $self->db->query($sql);
    
        if ($res) {
            while ($row = $res->fetch_object()) {
                $ticket = new static;
                $ticket->populateObject($row);
                $tickets[] = $ticket;
            }
        }
    
        return $tickets; // Return an empty array if no results are found.
    }
    
    public static function changeStatus($id, $status): bool
    {
        $self = new static;
        $sql = "UPDATE ticket SET status = '$status' WHERE id = '$id'";
        return $self->db->query($sql);
    }

    public static function delete($id): bool
    {
        // Fetch the ticket details
        $ticket = self::find($id);
        if ($ticket) {
            $sql = "INSERT INTO archived_tickets (id, title, body, requester, team, team_member, status, priority, rating, created_at)
                    VALUES ('$ticket->id', '$ticket->title', '$ticket->body', '$ticket->requester', '$ticket->team', '$ticket->team_member', '$ticket->status', '$ticket->priority', '$ticket->rating', NOW())";
            $self = new static;
            $self->db->query($sql);
        }

        $sql = "DELETE FROM ticket WHERE id = '$id'";
        $self = new static;
        return $self->db->query($sql);
    }

    public static function setRating($id, $rating): bool
    {
        $sql = "UPDATE ticket SET rating = '$rating' WHERE id = '$id'";
        $self = new static;
        return $self->db->query($sql);
    }

    public static function setPriority($id, $priority): bool
    {
        $sql = "UPDATE ticket SET priority = '$priority' WHERE id = '$id'";
        $self = new static;
        return $self->db->query($sql);
    }

    public function displayStatusBadge(): string
    {
        $badgeType = '';
        if ($this->status == 'open') {
            $badgeType = 'danger';
        } else if ($this->status == 'pending') {
            $badgeType = 'warning';
        } else if ($this->status == 'solved') {
            $badgeType = 'success';
        } else if ($this->status == 'closed') {
            $badgeType = 'info';
        }

        return '<div class="badge badge-' . $badgeType . '" role="badge"> ' . ucfirst($this->status) . '</div>';
    }

    public function populateObject($object): void
    {
        foreach ($object as $key => $property) {
            $this->$key = $property;
        }
    }

    public function update($id): Ticket
    {
        $sql = "UPDATE ticket set team_member = '$this->team_member', title = '$this->title',`body` = '$this->body',
                requester`='$this->requester', team`= '$this->team', status`= '$this->status', priority`='$this->priority'
                WHERE id = '$id'";

        if ($this->db->query($sql) === false) {
            throw new Exception($this->db->error);
        }

        return self::find($id);
    }

    public function unassigned()
    {
        $sql = "SELECT * FROM ticket WHERE team_member = '' ORDER BY id DESC";

        $self = new static;
        $tickets = [];
        $res = $self->db->query($sql);

        while ($row = $res->fetch_object()) {
            $tickets[] = $row;
        }

        return $tickets;
    }

    public static function findByMember($member)
    {
        $sql = "SELECT * FROM ticket WHERE team_member = '$member' ORDER BY id DESC";
        
        $self = new static;
        $tickets = [];
        $res = $self->db->query($sql);
        
        while($row = $res->fetch_object()){
            $ticket = new static;
            $ticket->populateObject($row);
            $tickets[] = $ticket;
        }

        return $tickets;
    }

    public static function findByUserId($userId): array
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM ticket WHERE requester = '$userId' ORDER BY id DESC";
        $tickets = [];
        $res = $db->query($sql);

        while ($row = $res->fetch_object()) {
            $ticket = new static;
            $ticket->populateObject($row);
            $tickets[] = $ticket;
        }

        return $tickets;
    }

    public static function archived(): array
    {
        $sql = "SELECT * FROM archived_tickets ORDER BY id DESC";
        $self = new static;
        $tickets = [];
        $res = $self->db->query($sql);

        while ($row = $res->fetch_object()) {
            $ticket = new static;
            $ticket->populateObject($row);
            $tickets[] = $ticket;
        }

        return $tickets;
    }

    public static function findByTeam($teamId): array
{
    $sql = "SELECT * FROM team WHERE team_id = ?";
    $self = new static;
    $stmt = $self->db->prepare($sql);
    $stmt->bind_param('i', $teamId);
    $stmt->execute();
    $result = $stmt->get_result();

    $members = [];
    while ($row = $result->fetch_object()) {
        $member = new self();
        $member->populateObject($row);
        $members[] = $member;
    }

    return $members;
}

public static function countReportedTicketsByUser($userId) {
    $db = Database::getInstance();
    $stmt = $db->prepare("SELECT COUNT(*) AS count FROM ticket WHERE id = ? AND reported = 1");
    if (!$stmt) {
        die("Database error: " . $db->error); // Debugging message
    }

    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['count'] ?? 0;
}
   // Method to count reported tickets
   public static function countReported() {
    $db = Database::getInstance();  // Assuming Database is your DB connection
    $query = "SELECT COUNT(*) as total FROM ticket WHERE reported = 1";
    $result = $db->query($query);
      // Check if query was successful
      if ($result === false) {
        throw new Exception("Failed to execute query: " . $db->error);
    }

    $data = $result->fetch_assoc(); // Safe to call now
    return $data['total'];
}
public static function findById($ticket_id) {
    $db = Database::getInstance();

    if (!$db) {
        die("Database connection failed.");
    }

    // Use the correct table: `tickets`
    $query = "SELECT * FROM ticket WHERE id = ?";
    $stmt = $db->prepare($query);

    if (!$stmt) {
        die("SQL error: " . $db->error);
    }

    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Execution error: " . $stmt->error);
    }

    return $result->fetch_object(); // Returns a single ticket object
}

public static function findByTicket($ticket_id) {
    $db = Database::getInstance();

    if (!$db) {
        die("Database connection failed.");
    }

    // Fetch feedbacks related to the given ticket_id
    $query = "SELECT * FROM feedback WHERE ticket_id = ?";
    $stmt = $db->prepare($query);

    if (!$stmt) {
        die("SQL error: " . $db->error);
    }

    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Execution error: " . $stmt->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC); // Returns an array of feedbacks
}
public static function getReportedFeedbackByUser($userId) {
    $db = Database::getInstance();
    // Join feedback with ticket table to get subject, status, and created_at
    $query = "
        SELECT feedback.*, ticket.subject, ticket.status AS ticket_status, ticket.created_at AS ticket_created_at
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
