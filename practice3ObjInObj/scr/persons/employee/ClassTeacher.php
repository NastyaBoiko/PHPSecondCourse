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
            echo "<br><div style=\"background-color:#f0bfb0;\">Классный руководитель: " . $this->getFirstName() . "</div>";
            echo "<div style=\"background-color:#f0bfb0;\">Группа: " . $group->getName() . "</div>";
            $group->printStudents();
        }, $this->groups);
    }
}