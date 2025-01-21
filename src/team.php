<?php
class Team {
    public $id = null;
    public $name = '';
    public $department = '';  // Add department property
    public $created_at = null;  // Add created_at property
    public $availability = '';
    private $db = null;

    public function __construct($data = null) {
        $this->name = $data['name'] ?? null;
        $this->department = $data['department'] ?? null; // Make sure to handle department
        $this->db = Database::getInstance();
    }

    public function save(): Team {
        // Include department in save query
        $sql = "INSERT INTO team (name, department) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $this->name, $this->department); // Bind both name and department
        $stmt->execute();

        if ($stmt->affected_rows < 1) {
            throw new Exception("Failed to insert team");
        }

        $id = $this->db->insert_id;
        return self::find($id);
    }

    public static function find($id): ?Team {
        $sql = "SELECT * FROM team WHERE id = ?";
        $self = new static;
        $stmt = $self->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows < 1) {
            return null; // Return null if no team is found
        }

        $self->populateObject($res->fetch_object());
        return $self;
    }

    public static function findAll(): array {
        $sql = "SELECT * FROM team ORDER BY id DESC";
        $teams = [];
        $self = new static;
        $res = $self->db->query($sql);

        if ($res->num_rows < 1) {
            return []; // Return an empty array if no teams are found
        }

        while ($row = $res->fetch_object()) {
            $team = new static;
            $team->populateObject($row);
            $teams[] = $team;
        }

        return $teams;
    }

    public static function delete($id): bool {
        $sql = "DELETE FROM team WHERE id = ?";
        $self = new static;
        $stmt = $self->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    private function populateObject($object): void {
        foreach ($object as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        // Convert created_at to DateTime object if it exists
        if (isset($this->created_at)) {
            $this->created_at = new DateTime($this->created_at);
        }
    }
}
?>
