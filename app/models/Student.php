<?php

class Student {
    private $db;

    // Dependency Injection
    public function __construct($db) {
        $this->db = $db;
    }

    public function all() {
        $stmt = $this->db->prepare("SELECT * FROM students");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $email, $course) {
        $stmt = $this->db->prepare(
            "INSERT INTO students (name, email, course) VALUES (?, ?, ?)"
        );
        return $stmt->execute([$name, $email, $course]);
    }

    public function update($id, $name, $email, $course) {
        $stmt = $this->db->prepare(
            "UPDATE students SET name=?, email=?, course=? WHERE id=?"
        );
        return $stmt->execute([$name, $email, $course, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM students WHERE id=?");
        return $stmt->execute([$id]);
    }
}
