<?php

class User {
    public $firstName, $lastName, $email;

    public function __construct($firstName, $lastName, $email) {
        $this->firstName = strlen($firstName) > 128 ? substr($firstName, 0, 128) : $firstName;
        $this->lastName = strlen($lastName) > 128 ? substr($lastName, 0, 128) : $lastName;
        $this->email = $email;
    }

    public function sayAboutMe() {
        echo "Имя: $this->firstName<br>Фамилия: $this->lastName<br>";
    }
}

$tom = new User("Tommy", "Marley", "Marley.com");
$tom->sayAboutMe();
 
$bob = new User("Bob", "Nossom", "Bob.com");
$bob->sayAboutMe();

class Car {
    public $brand;
    public $model;
    public $type;
    public $year;
    public $price;
    public $weight;
    public $color;
    // Перенос public сюда не работает на PHP 7.4
    public function __construct($brand, $model, $type, $year, $price, $weight = 0, $color = "Black") {
        $this->brand = $brand;
        $this->model = $model;
        $this->type = $type;
        $this->color = $color;
        $this->weight = $weight;
        $this->year = $year;
        $this->price = $price;
    }

    public function getInfo() {
        echo "Модель: $this->model<br>";
    }

    public function getWeight() {
        echo "Вес: $this->weight<br>";
    }

    public function getPrice() {
        echo "Цена: $this->price рублей<br>";
    }
}

echo "<br>";
// Добавить ключи
$cars = [
    ["Hyundai", "Solaris", "Легковая", 2013, 1000000, 350],
    ["Hyundai", "Creta", "Внедорожник", 2018, 2000000, 450, "Yellow"],
    ["Hyundai", "Accent", "Легковая", 2019, 1900000, 550, "Red"],
    ["Kia", "Rio", "Легковая", 2019, 2200000, 300, "Grey"],
    ["Kia", "K5", "Легковая", 2020, 3400000, 400, "Grey"]
];
$objCars = [];
foreach ($cars as $car) {
    array_push($objCars, new Car(...$car));
}
// Через map переделать
$objCars[0]->getInfo();
$objCars[1]->getInfo();
$objCars[2]->getInfo();
$objCars[3]->getInfo();
$objCars[4]->getInfo();
