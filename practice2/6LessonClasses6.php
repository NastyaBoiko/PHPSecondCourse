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

class Teacher extends User {
    private $subjects = [];

    public function __construct($firstName, $lastName, $email, $subjects) {
        parent::__construct($firstName, $lastName, $email);
        $this->subjects = $subjects;
    }
    public function sayAboutMe() {
        parent::sayAboutMe();
        $strSubj = implode( ", ", $this->subjects);
        echo "Предметы: $strSubj<br>Является преподавателем<br>";
    }
}

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


$tom = new User("Tommy", "Marley", "Marley@mail.com");
$toms = User::createAdmin("Toms", "Maaarley", "Maaarley@mail.com");
// var_dump($toms->getRole());
$bob = new Student("Bob", "Nossom", "Bob@mail.com", 4, "ИВ2-22");
$alice = new Student("Alice", "Berry", "Berry@mail.com", 3, "ИВ2-21");
// $mary = new Student("Mary", "Lock", "Lock@mail.com", 2, "ИВ2-23");
$mary = new Teacher("Mary", "Lock", "Lock@mail.com", ['русский', 'литература']);
$lenny = new Manager("Lenny", "Lockster", "Lockster@mail.com", "завуч", ['организация учебного процесса', 'выполнение учебных программ']);
$mary->sayAboutMe();
$lenny->sayAboutMe();
echo '<br>';
// $josh = new Student("Josh", "Washington", "Washington@mail.com", 4, "ИВ2-21");

// var_dump($tom);
// echo "<br>";
// var_dump($bob);
User::makeAdmin($bob);
// Student::makeAdmin($bob); тоже работает
// var_dump($bob->getRole());
$bob->sayAboutMe();
$alice->sayAboutMe();
Student::printStudentInfo($alice);
echo Student::getNumberStudents();

echo "<br>";
echo "<br>";

$persons = [
    new User("Tommy", "Marley", "Marley@mail.com"),
    new Student("Bob", "Nossom", "Bob@mail.com", 4, "ИВ2-22"),
    new Student("Alice", "Berry", "Berry@mail.com", 3, "ИВ2-21"),
    new Teacher("Mary", "Lock", "Lock@mail.com", ['русский', 'литература']),
    new Teacher("Josh", "Washington", "Washington@mail.com", ['английский']),
    new Manager("Lenny", "Lockster", "Lockster@mail.com", "завуч", ['организация учебного процесса', 'выполнение учебных программ']),
    new Manager("Helen", "Marine", "Marine@mail.com", "директор", ['организация образовательной (учебно-воспитательной) работы', ' создание режима соблюдения норм и правил'])
];

// Сортировка
usort($persons, function($person1, $person2) {
    return strcmp($person1->getFirstName(), $person2->getFirstName());
});

foreach ($persons as $person) {
    echo $person->sayAboutMe();
}

echo "<br>Розыгрыш<br><br>";

$number = rand(1, count($persons)) - 1;
echo "Победитель:";
$persons[$number]->sayAboutMe();