<?php

namespace Scr\College;

class College {
    private $name;
    private $classTeachers = [];

    public function __construct($name, $classTeachers = []) {
        $this->name = $name;
        $this->classTeachers = $classTeachers;
    }
    public function addClassTeacher($teacher) {
        array_push($this->classTeachers, $teacher);
    }
    // каждой группы есть свой классный руководитель, поэтому можно вывести классных руководлителей со списком их групп
    public function printCollege() {
        array_map(function($classTeacher) {
            $classTeacher->printMyGroups();
        }, $this->classTeachers);
    }
}