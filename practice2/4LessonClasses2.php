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
// Добавить ключи done
$cars = [
    ["brand" => "Hyundai", "model" => "Solaris", "type" => "Легковая", "year" => 2013, "price" => 1000000, "weight" => 350],
    ["brand" => "Hyundai", "model" => "Creta", "type" => "Внедорожник", "year" => 2018, "price" => 2000000, "weight" => 450, "color" => "Yellow"],
    ["brand" => "Hyundai", "model" => "Accent", "type" => "Легковая", "year" => 2019, "price" => 1900000, "weight" => 550, "color" => "Red"],
    ["brand" => "Kia", "model" => "Rio", "type" => "Легковая", "year" => 2019, "price" => 2200000, "weight" => 300, "color" => "Grey"],
    ["brand" => "Kia", "model" => "K5", "type" => "Легковая", "year" => 2020, "price" => 3400000, "weight" => 400, "color" => "Grey"]
];
$objCars = [];
foreach ($cars as $car) {
    array_push($objCars, new Car(...array_values($car)));
}
// Через map переделать
// $objCars[0]->getInfo();
// $objCars[1]->getInfo();

array_map(fn($objCar) => $objCar->getInfo(), $objCars);