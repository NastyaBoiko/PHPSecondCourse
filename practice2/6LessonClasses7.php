<?php
$users = json_decode(file_get_contents('users.json'));

if (isset($_POST['type'])) {
    array_push($users, $_POST);
    file_put_contents('users.json', json_encode($users, JSON_UNESCAPED_UNICODE));
    header("Location: 6LessonClasses7.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
    <h1>Форма добавления студента</h1>
    <form action="#" method="post">
        <input type="hidden" name="type" value="Student"/>

        <label for="firstName">Имя:</label>
        <input name="firstName" id="firstName" type="text" required>
        <br>
        <br>

        <label for="lastName">Фамилия:</label>
        <input name="lastName" id="lastName" type="text" required>
        <br>
        <br>

        <label for="email">Email:</label>
        <input name="email" id="email" type="text" required>
        <br>
        <br>

        <label for="cource">Курс:</label>
        <input name="cource" id="cource" type="number" required>
        <br>
        <br>

        <label for="groupe">Группа:</label>
        <input name="groupe" id="groupe" type="text" required>
        <br>
        <br>


        <button type="submit">Добавить</button>
        <!-- ["type" => "Student", "firstName" => "Bob", "lastName" => "Nossom", "email" => "Bob@mail.com", "cource" => 4, "groupe" => "ИВ2-22"], -->
    </form>
</body>
</html>

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

// Для быстрого создания json
// $persons = [
//     ["type" => "User", "firstName" => "Tommy", "lastName" => "Marley", "email" => "Marley@mail.com"],
//     ["type" => "Student", "firstName" => "Bob", "lastName" => "Nossom", "email" => "Bob@mail.com", "cource" => 4, "groupe" => "ИВ2-22"],
//     ["type" => "Student", "firstName" => "Alice", "lastName" => "Berry", "email" => "Berry@mail.com", "cource" => 3, "groupe" => "ИВ2-21"],
//     ["type" => "Teacher", "firstName" => "Mary", "lastName" => "Lock", "email" => "Lock@mail.com", "subjects" => ['русский', 'литература']],
//     ["type" => "Teacher", "firstName" => "Josh", "lastName" => "Washington", "email" => "Washington@mail.com", "subjects" => ['английский']],
//     ["type" => "Manager", "firstName" => "Lenny", "lastName" => "Lockster", "email" => "Lockster@mail.com", "position" => "завуч", "jobDuties" => ['организация учебного процесса', 'выполнение учебных программ']],
//     ["type" => "Manager", "firstName" => "Helen", "lastName" => "Marine", "email" => "Marine@mail.com", "position" => "директор", "jobDuties" => ['организация образовательной (учебно-воспитательной) работы', ' создание режима соблюдения норм и правил']]
// ];
// file_put_contents('users.json', json_encode($persons, JSON_UNESCAPED_UNICODE));

$objUsers = [];

foreach($users as $user) {
    $objFields = get_object_vars($user);
    $userType = $objFields['type'];
    unset($objFields['type']);

    $objUser = new $userType(...array_values($objFields));
    array_push($objUsers, $objUser);
}

array_map(fn($obj) => $obj->sayAboutMe(), $objUsers);