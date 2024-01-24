<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php
    
        $conn = mysqli_connect("localhost", "root", "", "boiko");
        $query = 'SELECT * FROM user';
        $res = mysqli_query($conn, $query);?>
        <h1 class="title">Пользователи</h1>

        <?php
        foreach ($res as $key => $row) {
            ?>
            <h2 class="title__user"><?php echo "Пользователь " . ++$key;?></h2>
            <div class="row"><?php echo "id: {$row['id']}";?></div>
            <div class="row"><?php echo "name: {$row['name']}";?></div>
            <div class="row"><?php echo "login: {$row['login']}";?></div>
            <div class="row"><?php echo "data: {$row['birthday']}";?></div>
            <?php
        }
    ?>
    
</body>
</html>
