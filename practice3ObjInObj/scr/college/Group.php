<?php

namespace Scr\College;

class Group {
    private $name;
    private $students = [];

    public function __construct($name, $students = []) {
        $this->name = $name;
        $this->students = $students;
    }

    public function addStudent($student) {
        array_push($this->students, $student);
    }

    public function printStudents() {
        array_map(fn($student) => $student->sayAboutMe(), $this->students);
    }

    // Геттеры
    public function getName() {
        return $this->name;
    }
    public function getStudents() {
        return $this->students;
    }
}
