<?php
namespace Scr\Persons\Employee;

use \Scr\Base\User;

class Manager extends User {
    private $position, $jobDuties = [];
    public function __construct($firstName, $lastName, $email, $position, $jobDuties) {
        parent::__construct($firstName, $lastName, $email);
        $this->position = $position;
        $this->jobDuties = $jobDuties;
    }
    public function sayAboutMe() {
        parent::sayAboutMe();
        $strDuties = implode( ", ", $this->jobDuties);
        echo "Должность: $this->position<br>Обязанности: $strDuties<br>Является администрацией<br>";
    }
}