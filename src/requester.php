<?php
class Requester {
    public $id = null;
    public $name = '';
    public $email = '';
    public $phone = '';
    private $db = null;

    public function __construct($data = null) {
        if ($data) {
            $this->name = $data['name'] ?? null;
            $this->email = $data['email'] ?? null;
            $this->phone = $data['phone'] ?? null;
        }
        $this->db = Database::getInstance();
    }

    public function save(): Requester {
        $sql = "INSERT INTO requester (name, email, phone) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $this->name, $this->email, $this->phone);
        $stmt->execute();

        if ($stmt->affected_rows < 1) {
            throw new Exception("Failed to insert requester");
        }

        $id = $this->db->insert_id;
        return self::find($id);
    }

    public static function find($id): ?Requester {
        $sql = "SELECT * FROM requester WHERE id = ?";
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
        $sql = "SELECT * FROM requester ORDER BY id DESC";
        $requesters = [];
        $self = new static;
        $res = $self->db->query($sql);

        if ($res->num_rows < 1) {
            return [];
        }

        while ($row = $res->fetch_object()) {
            $requester = new static;
            $requester->populateObject($row);
            $requesters[] = $requester;
        }

        return $requesters;
    }

    public static function findByColumn($data): array {
        $validColumns = ['name', 'email', 'phone'];
        $field = key($data);
        $value = $data[$field];

        if (!in_array($field, $validColumns)) {
            throw new Exception("Invalid column name");
        }

        $sql = "SELECT * FROM requester WHERE $field LIKE ? ORDER BY id DESC";
        $requesters = [];
        $self = new static;
        $stmt = $self->db->prepare($sql);
        $likeValue = "%$value%";
        $stmt->bind_param("s", $likeValue);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows < 1) {
            return [];
        }

        while ($row = $res->fetch_object()) {
            $requester = new static;
            $requester->populateObject($row);
            $requesters[] = $requester;
        }

        return $requesters;
    }

    public static function delete($id): bool {
        $sql = "DELETE FROM requester WHERE id = ?";
        $self = new static;
        $stmt = $self->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    private function populateObject($object): void {
        if ($object) {
            foreach ($object as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }
}
?>
