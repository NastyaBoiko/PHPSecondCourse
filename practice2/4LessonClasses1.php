<?php

class User {
    public $firstName;
    public $lastName;
    public $email;

    public function sayAboutMe() {
        echo "Имя: $this->firstName<br>Фамилия: $this->lastName<br>";
    }
}

$tom = new User();
$tom->firstName = "Tom";
$tom->lastName = "Marley";
$tom->email = "Marley.com";
$tom->sayAboutMe();
 
$bob = new User();
$bob->firstName = "Bob";
$bob->lastName = "Nossom";
$bob->email = "Bob.com";
$bob->sayAboutMe();

class Car {
    public $brand;
    public $model;
    public $type;
    public $color;
    public $weight;
    public $year;
    public $price;

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

$car1 = new Car();
$car1->brand = "Hyundai";
$car1->model = "Solaris";
$car1->type = "Легковая";
$car1->color = "Black";
$car1->weight = 350;
$car1->year = 2013;
$car1->price = 1000000;
$car1->getInfo();
$car1->getWeight();
$car1->getPrice();
echo "<br>";

$car2 = new Car();
$car2->brand = "Hyundai";
$car2->model = "Creta";
$car2->type = "Легковая";
$car2->color = "Yellow";
$car2->weight = 450;
$car2->year = 2018;
$car2->price = 2000000;
$car2->getInfo();
$car2->getWeight();
$car2->getPrice();
echo "<br>";


$car3 = new Car();
$car3->brand = "Hyundai";
$car3->model = "Accent";
$car3->type = "Легковая";
$car3->color = "Red";
$car3->weight = 550;
$car3->year = 2019;
$car3->price = 1900000;
$car3->getInfo();
$car3->getWeight();
$car3->getPrice();
echo "<br>";

$car4 = new Car();
$car4->brand = "Kia";
$car4->model = "Rio";
$car4->type = "Легковая";
$car4->color = "Grey";
$car4->weight = 300;
$car4->year = 2019;
$car4->price = 2200000;
$car4->getInfo();
$car4->getWeight();
$car4->getPrice();
echo "<br>";

$car5 = new Car();
$car5->brand = "Kia";
$car5->model = "K5";
$car5->type = "Легковая";
$car5->color = "Grey";
$car5->weight = 300;
$car5->year = 2020;
$car5->price = 3400000;
$car5->getInfo();
$car5->getWeight();
$car5->getPrice();
echo "<br>";

$sum = $car1->price + $car2->price + $car3->price + $car4->price + $car5->price;
echo "Общая стоимость: $sum рублей";