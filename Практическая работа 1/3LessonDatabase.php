<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пользователи</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php
        $conn = mysqli_connect("localhost", "root", "", "boiko");
        // Удаление пользователя
        if (isset($_GET['id'])) {
            $userid = $_GET['id'];
            $sqlDel = "DELETE FROM user where id = $userid";
            if (mysqli_query($conn, $sqlDel)) {
                echo "Пользователь с id $userid удален";
                // header("Location: " . basename(__FILE__));
                // exit();
            } else {
                echo "Ошибка соединения с базой данных";
            };
        }

    ?>
        <h1 class="title">Пользователи</h1>

        <h3>Добавление пользователя</h3>
        <form action="#" method="post">
            <p>
                <label>Имя: <input type="text" name="username"/></label>
            </p>
            <p>
                <label>Логин: <input type="text" name="userlogin"/></label>
            </p>
            <p>
                <label>Дата рождения: <input type="date" name="userdate"/></label>
            </p>
            <p>
                <label>Возраст: <input type="number" name="userage"/></label>
            </p>
            <input type="hidden" name="add"/>
            <input type="submit" value="Добавить">
        </form>

    <?php
    // Добавление пользователя
            if (isset($_GET['name'])) {
                echo "Пользователь {$_GET['name']} добавлен";
            }
            if (isset($_POST['add'])) {

                $username = trim(strip_tags($_POST['username']));
                $userlogin = trim(strip_tags($_POST['userlogin']));
                $userdate = trim(strip_tags($_POST['userdate']));
                $userage = trim(strip_tags($_POST['userage']));

                $sqlInsert = "INSERT INTO user (`name`, `login`, `birthday`, `age`) VALUES ('$username', '$userlogin', '$userdate', $userage)";
                try {
                    if (mysqli_query($conn, $sqlInsert)) {
                        header("Location: " . basename(__FILE__) . "?name=$username");
                        exit();
                    } else {
                        echo "Ошибка соединения с базой данных";
                    };
            } catch (Exception $e) {
                echo "Что-то пошло не так";
            }
        } elseif (isset($_POST['update'])) {

            $username = trim(strip_tags($_POST['username']));
            $userlogin = trim(strip_tags($_POST['userlogin']));
            $userdate = trim(strip_tags($_POST['userdate']));
            $userage = trim(strip_tags($_POST['userage']));
            $userid = $_POST['userid'];

            // var_dump($_POST);
            // $sqlUpdate = "UPDATE user SET name = '$username', age = '$userage' WHERE id = '$userid'";
            $sqlUpdate = "UPDATE user SET ";
            if (!empty($username)) {
                $sqlUpdate .= "name = '$username'";
            }
            if (!empty($userlogin)) {
                $sqlUpdate .= ", login = '$userlogin'";
            }
            if (!empty($userdate)) {
                $sqlUpdate .= ", birthday = '$userdate'";
            }
            if (!empty($userage)) {
                $sqlUpdate .= ", age = '$userage'";
            }
            $sqlUpdate .= " WHERE id = $userid";

            if (mysqli_query($conn, $sqlUpdate)) {
                echo "Пользователь c id $userid обновлен";
                header("Location: " . basename(__FILE__));
                exit();
            } else {
                echo "Ошибка соединения с базой данных";
            };
        }
    ?>

    
    <?php
        $query = 'SELECT * FROM user';
        $res = mysqli_query($conn, $query);
        foreach ($res as $key => $row) {
            ?>
            <h2 class="title__user"><?php echo "Пользователь " . ++$key;?></h2>
            <div class="row"><?php echo "Имя: {$row['name']}";?></div>
            <div class="row"><?php echo "login: {$row['login']}";?></div>
            <div class="row"><?php echo "Дата рождения: {$row['birthday']}";?></div>
            <div class="row"><?php echo "Возраст: {$row['age']}";?></div>
            <a href=<?php echo basename(__FILE__) . "?id=" . $row['id'];?> class="button btn-red">Удалить</a>
            <a href=<?php echo "update.php?id=" . $row['id'];?> class="button btn-green">Изменить</a>
            <?php
        }
    ?>
    
</body>
</html>
