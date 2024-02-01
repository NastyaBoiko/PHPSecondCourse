<?php

use \Scr\Base\User;
use \Scr\Persons\Students\Student;
use \Scr\Persons\Employee\Manager;
use \Scr\Persons\Employee\Teacher;

spl_autoload_register(function ($class) {
    $pathArray = explode("\\", $class);
    require_once implode("/", $pathArray) . ".php";
});

// Для быстрого создания json
$persons = [
    ["type" => "User", "firstName" => "Tommy", "lastName" => "Marley", "email" => "Marley@mail.com"],
    ["type" => "Student", "firstName" => "Bob", "lastName" => "Nossom", "email" => "Bob@mail.com", "cource" => 4, "groupe" => "ИВ2-22"],
    ["type" => "Student", "firstName" => "Alice", "lastName" => "Berry", "email" => "Berry@mail.com", "cource" => 3, "groupe" => "ИВ2-21"],
    ["type" => "Teacher", "firstName" => "Mary", "lastName" => "Lock", "email" => "Lock@mail.com", "subjects" => ['русский', 'литература']],
    ["type" => "Teacher", "firstName" => "Josh", "lastName" => "Washington", "email" => "Washington@mail.com", "subjects" => ['английский']],
    ["type" => "Manager", "firstName" => "Lenny", "lastName" => "Lockster", "email" => "Lockster@mail.com", "position" => "завуч", "jobDuties" => ['организация учебного процесса', 'выполнение учебных программ']],
    ["type" => "Manager", "firstName" => "Helen", "lastName" => "Marine", "email" => "Marine@mail.com", "position" => "директор", "jobDuties" => ['организация образовательной (учебно-воспитательной) работы', ' создание режима соблюдения норм и правил']]
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


<?php

$objUsers = [];

foreach($users as $user) {
    $objFields = get_object_vars($user);
    $userType = $objFields['type'];
    unset($objFields['type']);
    
    if ($userType == "Student") {
        $objUser = new Student(...array_values($objFields));
    } else if ($userType == "Teacher") {
        $objUser = new Teacher(...array_values($objFields));
    } else if ($userType == "Manager") {
        $objUser = new Manager(...array_values($objFields));
    } else {
        $objUser = new User(...array_values($objFields));

    }
    array_push($objUsers, $objUser);

}

// array_map(fn($obj) => $obj->sayAboutMe(), $objUsers);
foreach ($objUsers as $key => $obj) {
    $obj->sayAboutMe();
    echo "<a href=\"" . basename(__FILE__) . "?id=$key\">Удалить</a><br>";
    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?php echo $key;?>"/>
        <br>
        <button type="submit">Удалить</button>
    </form>
    
    <?php
}
?>

</body>
</html>