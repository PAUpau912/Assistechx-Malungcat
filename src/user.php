<?php
require_once 'Database.php';

class User {
    public $id = null;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $password = '';
    public $role = '';
    public $avatar = '';
    public $lastPassword = '';
    public $created_at = ''; // Add created_at field

    private $db = null;

    public function __construct($data = null) {
        $this->name = $data['name'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->role = $data['role'] ?? null;
        $this->lastPassword = $data['password'] ?? null;
        $this->created_at = $data['created_at'] ?? null; // Ensure created_at is set
        $this->db = Database::getInstance();
    }

    public function save(): User {
        $sql = "INSERT INTO users (name, email, phone, password, role, last_password) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssss", $this->name, $this->email, $this->phone, $this->password, $this->role, $this->lastPassword);

        if (!$stmt->execute()) {
            throw new Exception("Failed to insert user: " . $stmt->error);
        }

        $id = $this->db->insert_id;
        return self::find($id);
    }

    public static function find($id): ?User {
        $sql = "SELECT * FROM users WHERE id = ?";
        $self = new static;
        $stmt = $self->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows < 1) {
            return null;
        }

        $self->populateObject($res->fetch_object());
        return $self;
    }

    public static function findAll(): array {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $users = [];
        $self = new static;
        $res = $self->db->query($sql);

        if ($res->num_rows < 1) {
            return [];
        }

        while ($row = $res->fetch_object()) {
            $user = new static;
            $user->populateObject($row);
            $users[] = $user;
        }

        return $users;
    }

    public static function updateRole($id, $role): bool {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->bind_param("si", $role, $id);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update role: " . $stmt->error);
        }

        return true;
    }

    private function populateObject($object): void {
        foreach ($object as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
?>
