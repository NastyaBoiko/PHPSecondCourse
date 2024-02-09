<?php

namespace Src\Controllers;

class MainController 
{
    public function main()
    {
        echo 'Главная страница';
    }

    public function sayHello(string $name) 
    {
        echo 'Привет, ' . $name;
    } //hello/name

    public function len(string $string) 
    {
        echo 'Длина строки: ' . mb_strlen($string);
    }
}