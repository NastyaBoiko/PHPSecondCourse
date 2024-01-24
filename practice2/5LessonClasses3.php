<?php

class User {
    private $firstName, $lastName, $email;

    public function __construct($firstName, $lastName, $email) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public function sayAboutMe() {
        echo "Имя: $this->firstName<br>Фамилия: $this->lastName<br>";
    }

    private function isNameCorrect() {
        return strlen($this->firstName) <= 128;
    }

    public function isEmailCorrect() {
        $dogSymbol = strpos($this->email, '@');
        $lastPointSymbol = strpos($this->email, '.');

        if ($dogSymbol) {
            if ($dogSymbol < $lastPointSymbol) {
                return true;
            }
        } else {
            return false;
        }
    }
}

$tom = new User("Tommy", "Marley", "Marleymail.com");
$tom->isEmailCorrect();