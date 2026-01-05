<?php

class StudentController {
    private $student;
    private $blade;

    public function __construct($student, $blade) {
        $this->student = $student;
        $this->blade = $blade;
    }

    public function index() {
        $students = $this->student->all();
        echo $this->blade->make('students.index', compact('students'))->render();
    }

    public function create() {
        echo $this->blade->make('students.create')->render();
    }

    public function store() {
        $this->student->create($_POST['name'], $_POST['email'], $_POST['course']);
        header("Location: index.php");
    }

    public function edit($id) {
        $student = $this->student->find($id);
        echo $this->blade->make('students.edit', compact('student'))->render();
    }

    public function update($id) {
        $this->student->update(
            $id,
            $_POST['name'],
            $_POST['email'],
            $_POST['course']
        );
        header("Location: index.php");
    }

    public function delete($id) {
        $this->student->delete($id);
        header("Location: index.php");
    }
}
