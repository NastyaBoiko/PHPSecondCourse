<?php

namespace Scr\Persons\Employee;

class ClassTeacher extends Teacher {
    private $groups = [];

    public function __construct($firstName, $lastName, $email, $subjects, $groups = []) {
        parent::__construct($firstName, $lastName, $email, $subjects);
        $this->groups = $groups;
    }

    public function addGroup($group) {
        array_push($this->groups, $group);
    }

    public function printMyGroups() {
        array_map(function($group) {
            echo "<br/>Классный руководитель: " . $this->getFirstName() . "<br/>";
            echo "Группа: " . $group->getName() . "<br>";
            $group->printStudents();
        }, $this->groups);
    }
}