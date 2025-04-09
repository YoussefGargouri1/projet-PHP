<?php
require_once 'DBclass.php';

class Section {
    private $db;

    public function __construct() {
        $this->db = (new Database())->Connect();
    }

    public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM section");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO section (designation, description) VALUES (:designation, :description)");
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM section WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
