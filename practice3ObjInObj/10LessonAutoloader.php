<?php

use \Scr\Base\User;
use \Scr\Persons\Students\Student;
use \Scr\Persons\Employee\Manager;
use \Scr\Persons\Employee\Teacher;
use \Scr\College\Group;
use \Scr\Persons\Employee\ClassTeacher;
use \Scr\College\College;

spl_autoload_register();

// Для быстрого создания json
$persons = [
    ["type" => "Student", "firstName" => "Tommy", "lastName" => "Marley", "email" => "Marley@mail.com", "cource" => 2, "groupe" => "22"],
    ["type" => "Student", "firstName" => "Bob", "lastName" => "Nossom", "email" => "Bob@mail.com", "cource" => 4, "groupe" => "22"],
    ["type" => "Student", "firstName" => "Alice", "lastName" => "Berry", "email" => "Berry@mail.com", "cource" => 3, "groupe" => "22"],
    ["type" => "Student", "firstName" => "Abby", "lastName" => "Yellow", "email" => "Yellow@mail.com", "cource" => 1, "groupe" => "21"],
    ["type" => "Student", "firstName" => "Morris", "lastName" => "Red", "email" => "Red@mail.com", "cource" => 1, "groupe" => "23"],
    ["type" => "Student", "firstName" => "Klark", "lastName" => "White", "email" => "White@mail.com", "cource" => 3, "groupe" => "21"],
    ["type" => "Student", "firstName" => "Billy", "lastName" => "Black", "email" => "Black@mail.com", "cource" => 2, "groupe" => "21"],
    ["type" => "ClassTeacher", "firstName" => "Mary", "lastName" => "Lock", "email" => "Lock@mail.com", "subjects" => ['русский', 'литература'], "groupe" => ["22", "23", "24", "ИВ2-22"]],
    ["type" => "ClassTeacher", "firstName" => "Josh", "lastName" => "Washington", "email" => "Washington@mail.com", "subjects" => ['английский'], "groupe" => ["21" ]]
];
if (!file_exists('users.json')) {
    file_put_contents('users.json', json_encode($persons, JSON_UNESCAPED_UNICODE));
}

$users = json_decode(file_get_contents('users.json'));

if (isset($_POST['type'])) {
    array_push($users, $_POST);
    file_put_contents('users.json', json_encode($users, JSON_UNESCAPED_UNICODE));
    header("Location: " . basename(__FILE__));
    exit();
} else if (isset($_GET['id'])) {
    unset($users[$_GET['id']]);
    file_put_contents('users.json', json_encode(array_values($users), JSON_UNESCAPED_UNICODE));
    header("Location: " . basename(__FILE__));
    exit();
} else if (isset($_POST['id'])) {
    unset($users[$_POST['id']]);
    file_put_contents('users.json', json_encode(array_values($users), JSON_UNESCAPED_UNICODE));
    header("Location: " . basename(__FILE__));
    exit();
}

$objUsers = [];
$objGroups = [];
$college = new College('RTK');

// Создание классных руководителей
foreach($users as $key => $user) {
    // Преобразуем объекты в массив:
    $objFields = get_object_vars($user);
    $userType = $objFields['type'];
    unset($objFields['type']);
    
    if ($userType == "ClassTeacher") {
        // Создаем классного руководителя и добавляем его в колледж и массив, который выводит в конце всех
        $objClassTeacher = new ClassTeacher($objFields["firstName"], $objFields["lastName"], $objFields["email"], $objFields["subjects"]);
        $college->addClassTeacher($objClassTeacher);
        $objUsers[$key] = $objClassTeacher;

        // Создаем группу, чьим руководителем является созданный ClassTeacher, добавляем эту группу классному руководителю, добавляем 
        $classTeacherGroupes = $objFields['groupe'];

        foreach ($classTeacherGroupes as $classTeacherGroupe) {
            $objGroupe = new Group($classTeacherGroupe);
            $objClassTeacher->addGroup($objGroupe);
            array_push($objGroups, $objGroupe);
        }
    }
}
// Сортировка, чтобы группы в селекте выводились по порядку
usort($objGroups, function($group1, $group2) {
    return strcmp($group1->getName(), $group2->getName());
});

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
        <select name="groupe">
        <?php
        foreach ($objGroups as $key => $groupSelect)  {
        ?>
            <option value="<?php echo $groupSelect->getName();?>"><?php echo $groupSelect->getName();?></option>
        <?php
        }
        ?>
        </select>
        <br>
        <br>

        <button type="submit">Добавить</button>
    </form>


<?php


foreach($users as $key => $user) {
    $objFields = get_object_vars($user);
    $userType = $objFields['type'];
    unset($objFields['type']);
    
    if ($userType == "Student") {
        $objUser = new Student(...array_values($objFields));
        foreach ($objGroups as $group) {
            if ($group->getName() == $objUser->getGroupe()) {
                $group->addStudent($objUser);
            }
        }
    } else if ($userType == "ClassTeacher") {
        continue;
    }
    $objUsers[$key] = $objUser;
}

$college->printCollege();?>


</body>
</html>