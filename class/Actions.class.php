
<?php
class Actions {
    private $table = 'actions';
    private $db;
    
    public function __construct() {
        $this->db = new Db();
        $this->db->idModule = 25;
    }
    
    public function getAll() {
        try {
            $this->db->sql = "SELECT * FROM {$this->table} ORDER BY `action`";
            return $this->db->getAll();
        } catch (Exception $e) {
            return ['error' => true, 'msg' => $e->getMessage()];
        }
    }
    
    public function getById($id) {
        try {
            $this->db->sql = "SELECT * FROM {$this->table} WHERE id = ?";
            $this->db->values = [$id];
            return $this->db->get();
        } catch (Exception $e) {
            return ['error' => true, 'msg' => $e->getMessage()];
        }
    }
    
    public function create($data) {
        try {
            $this->db->sql = "INSERT INTO {$this->table} (action, description) VALUES (?, ?)";
            $this->db->values = [$data['action'], $data['description']];
            return $this->db->add();
        } catch (Exception $e) {
            return ['error' => true, 'msg' => $e->getMessage()];
        }
    }
}
