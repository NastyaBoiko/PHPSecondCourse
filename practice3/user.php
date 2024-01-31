<?php

class User {
    private $firstName, $lastName, $email, $role = "User";

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

    public static function makeAdmin($user) {
        $user->role = 'Admin';
    }

    public static function createAdmin($firstName, $lastName, $email) {
        $admin = new User($firstName, $lastName, $email);
        self::makeAdmin($admin);
        return $admin;
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
    public function getRole() {
        return $this->role;
    }

    private function correctName($name) {
        $name = strip_tags($name);
        return strlen($name) > 128 ? substr($name, 0, 128) : $name;
    }
}