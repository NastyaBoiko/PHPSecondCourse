<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        $conn = mysqli_connect("localhost", "root", "", "boiko");
        $query = 'SELECT * FROM user';
        $res = mysqli_query($conn, $query);
        foreach ($res as $row) {
            echo "id: {$row['id']}<br>";
            echo "name: {$row['name']}<br>";
            echo "login: {$row['login']}<br>";
            echo "data: {$row['birthday']}<br>";
        }
    ?>
    
</body>
</html>
