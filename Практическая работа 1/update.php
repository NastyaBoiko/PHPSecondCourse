<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение пользователя</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
        <?php
        // 
            if (isset($_GET['id'])) {
                $userid = $_GET['id'];
            }
            $conn = mysqli_connect("localhost", "root", "", "boiko");
            $query = "SELECT * FROM user WHERE id = $userid";
            $res = mysqli_query($conn, $query);

        ?>
        <h3>Изменение пользователя c id = <?php echo $userid;?></h3>
        <form action="3LessonDatabase.php" method="post">
        <?php
        foreach ($res as $key => $row) {
        ?>
            <p>
                <label>Имя: <input type="text" name="username" value="<?php echo $row['name'];?>"/></label>
            </p>
            <p>
                <label>Логин: <input type="text" name="userlogin" value="<?php echo $row['login'];?>"/></label>
            </p>
            <p>
                <label>Дата рождения: <input type="date" name="userdate" value="<?php echo $row['birthday'];?>"/></label>
            </p>
            <p>
                <label>Возраст: <input type="number" name="userage" value="<?php echo $row['age'];?>"/></label>
            </p>
            <input type="hidden" name="userid" value="<?php echo $userid;?>"/>
            <input type="hidden" name="update"/>
            <input type="submit" value="Изменить">
        </form>
        <?php
        }
        ?>
</body>
</html>