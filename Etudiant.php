<?php
require_once 'DBclass.php';

class Etudiant {
    private $db;

    public function __construct() {
        $this->db = (new Database())->Connect();
    }

    public function findAllWithSection() {
        $stmt = $this->db->prepare("
            SELECT e.*, s.designation as section_name 
            FROM etudiant e 
            LEFT JOIN section s ON e.section_id = s.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function findByName($search) {
        $stmt = $this->db->prepare("
            SELECT e.*, s.designation as section_name
            FROM etudiant e
            LEFT JOIN section s ON e.section_id = s.id
            WHERE e.name LIKE :search
        ");
        $search = "%$search%";
        $stmt->bindParam(':search', $search);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO etudiant (name, birthday, image, section_id) VALUES (:name, :birthday, :image, :section_id)");
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM etudiant WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
