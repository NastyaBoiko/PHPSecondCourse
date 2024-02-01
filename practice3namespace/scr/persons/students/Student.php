<?php

namespace Scr\Persons\Students;

use \Scr\Base\User;


class Student extends User {
    private $cource, $groupe;
    private static $numberStudents = 0;

    public function __construct($firstName, $lastName, $email, $cource, $groupe) {
        self::$numberStudents++;
        parent::__construct($firstName, $lastName, $email);
        $this->cource = $cource;
        $this->groupe = $groupe;
    }

    // Сеттеры
    public function setCource($cource) {
        $this->cource = $cource;
    }
    public function setGroupe($groupe) {
        $this->groupe = $groupe;
    }

    // Геттеры
    public function getCource() {
        return $this->cource;
    }
    public function getGroupe() {
        return $this->groupe;
    }
    public static function getNumberStudents() {
        return self::$numberStudents;
    }

    public function sayAboutMe() {
        parent::sayAboutMe();
        echo "Курс: $this->cource<br>Группа: $this->groupe<br>Является студентом<br>";
    }
    public static function printStudentInfo($student) {
        echo "<br>Имя: {$student->getFirstName()}<br>Фамилия: {$student->getLastName()}<br>Курс: $student->cource<br>Группа: $student->groupe<br>";
    }
    
    public function __destruct() {
        self::$numberStudents--;
    }
}