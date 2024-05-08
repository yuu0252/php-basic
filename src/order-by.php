<?php
$dbname = $_ENV['MYSQL_DATABASE'];
$host = 'mysql';

$dsn = "mysql:dbname={$dbname};host={$host};charset=utf8mb4";
$user = 'root';
$password = $_ENV['MYSQL_PASSWORD'];

try {
    $pdo = new PDO($dsn, $user, $password);

    if (isset($_GET['order'])) {
        $order = $_GET['order'];
    } else {
        $order = NULL;
    }

    if ($order == "asc") {
        $sql = 'SELECT id, name, age FROM users ORDER BY age ASC';
    } else if ($order === "desc") {
        $sql = 'SELECT id, name, age FROM users ORDER BY age DESC';
    } else {
        $sql = 'SELECT id, name, age FROM users ORDER BY id';
    }


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
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="sort">
        <a href="order-by.php?order=asc" class="sort-btn">年齢順（昇順）</a>
        <a href="order-by.php?order=desc" class="sort-btn">年齢順（降順）</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>氏名</th>
            <th>年齢</th>
        </tr>
        <?php
        foreach ($results as $result) {
            $table_row = "
                <tr>
                <td>{$result['id']}</td>
                <td>{$result['name']}</td>
                <td>{$result['age']}</td>
                </tr>
            ";
            echo $table_row;
        }
        ?>
    </table>

</body>

</html>