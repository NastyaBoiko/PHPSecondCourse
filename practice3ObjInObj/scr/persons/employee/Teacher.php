<?php

namespace Scr\Persons\Employee;

use \Scr\Base\User;

class Teacher extends User {
    private $subjects = [];

    public function __construct($firstName, $lastName, $email, $subjects) {
        parent::__construct($firstName, $lastName, $email);
        $this->subjects = $subjects;
    }
    public function sayAboutMe() {
        parent::sayAboutMe();
        $strSubj = implode( ", ", $this->subjects);
        echo "Предметы: $strSubj<br>Является преподавателем<br>";
    }
}
