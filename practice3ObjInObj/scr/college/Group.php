<?php

namespace Scr\College;

class Group {
    private $name;
    private $students = [];

    public function __construct($name, $students) {
        $this->name = $name;
        $this->students = $students;
    }

    public function addStudent($student) {
        array_push($this->students, $student);
    }
}
