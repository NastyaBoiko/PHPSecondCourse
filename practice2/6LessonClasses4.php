<?php

class User {
    private $firstName, $lastName, $email;

    public function __construct($firstName, $lastName, $email) {
        $this->firstName = $this->correctName($firstName);
        $this->lastName = $this->correctName($lastName);
        $this->email = $this->isEmailCorrect($email) ? $email : "";
    }

    public function sayAboutMe() {
        echo "<br>Имя: $this->firstName<br>Фамилия: $this->lastName<br>";
    }

    private function isNameCorrect($name) {
        if (strlen($name) <= 128) {
            return true;
        } else {
            echo "Некорректное имя / фамилия!";
            return false;
        }
    }

    public function isEmailCorrect($email) {
        $dogSymbol = strrpos($email, '@');
        $lastPointSymbol = strrpos($email, '.');

        if ($dogSymbol && $dogSymbol < $lastPointSymbol) {
            return true;
        } else {
            echo "$this->firstName  - Некорректный email!";
            return false;
        }
    }

    // Сеттеры
    public function setFirstName($name) {
        $this->firstName = $this->correctName($name);
	}
    public function setLastName($name) {
        $this->lastName = $this->correctName($name);
	}
    public function setEmail($email) {
        if ($this->isEmailCorrect($email)) {
            $this->email = $email;
        }
	}

    // Геттеры
    public function getFirstName() {
        return $this->firstName;
    }
    public function getLastName() {
        return $this->lastName;
    }
    public function getEmail() {
        return $this->email;
    }

    private function correctName($name) {
        $name = strip_tags($name);
        return strlen($name) > 128 ? substr($name, 0, 128) : $name;
    }
}

class Student extends User {
    private $cource, $groupe;

    public function __construct($firstName, $lastName, $email, $cource, $groupe) {
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

    public function sayAboutMe() {
        parent::sayAboutMe();
        echo "Курс: $this->cource<br>Группа: $this->groupe<br>";
    }
}

$tom = new User("Tommy", "Marley", "Marley@mail.com");
$bob = new Student("Bob", "Nossom", "Bob@mail.com", 4, "ИВ2-22");
$alice = new Student("Alice", "Berry", "Berry@mail.com", 3, "ИВ2-21");

var_dump($tom);
echo "<br>";
var_dump($bob);
$bob->sayAboutMe();
$alice->sayAboutMe();