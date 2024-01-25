<?php

class User {
    private $firstName, $lastName, $email;

    public function __construct($firstName, $lastName, $email) {
        $this->firstName = $this->isNameCorrect($firstName) ? $firstName : "";
        $this->lastName = $this->isNameCorrect($lastName) ? $lastName : "";
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
        if ($this->isNameCorrect($name)) {
            $this->firstName = $name;
        }
	}
    public function setLastName($name) {
        if ($this->isNameCorrect($name)) {
            $this->firstName = $name;
        }
	}
    public function setEmail($email) {
        if ($this->isEmailCorrect($email)) {
            $this->email = $email;
        }
	}
}

$tom = new User("Tommy", "Marley", "Marley@mail.com");
$bob = new User("Bob", "Nossom", "Bob@mail.com");
var_dump($tom);
echo "<br>";
var_dump($bob);

$tom->sayAboutMe();
$bob->sayAboutMe();