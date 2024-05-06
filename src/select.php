<?php
$dbname = $_ENV['MYSQL_DATABASE'];
$dsn = "mysql:dbname={$dbname};host=mysql;charset=utf8mb4";
$user = 'root';
$password = $_ENV['MYSQL_PASSWORD'];

try {
    $pdo = new PDO($dsn, $user, $password);

    $sql = 'SELECT id, name FROM users';

    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit($e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <table>
        <tr>
            <th>ID</th>
            <th>氏名</th>
            <?php
            foreach ($results as $result) {
                echo "<tr><td>{$result['id']}</td><td>{$result['name']}</td></tr>";
            }
            ?>
        </tr>
    </table>
</body>

</html>