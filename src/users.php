<?php
$dbname = $_ENV['MYSQL_DATABASE'];
$dsn = "mysql:dbname={$dbname};host=mysql;charset=utf8mb4";
$user = 'root';
$password = 'password';

try {
    $pdo = new PDO($dsn, $user, $password);
    $sql = 'SELECT * FROM users';
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
    <table class="all-column">
        <tr>
            <th>ID</th>
            <th>氏名</th>
            <th>ふりがな</th>
            <th>メールアドレス</th>
            <th>年齢</th>
            <th>住所</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
        <?php
        foreach ($results as $result) {
            $table_row = "
                <tr>
                <td>{$result['id']}</td>
                <td>{$result['name']}</td>
                <td>{$result['furigana']}</td>
                <td>{$result['email']}</td>
                <td>{$result['age']}</td>
                <td>{$result['address']}</td>
                <td><a href='update.php?id={$result['id']}'>編集</a></td>
                <td><a href='delete.php?id={$result['id']}'>削除</a></td>
                </tr>
            ";
            echo $table_row;
        }
        ?>
    </table>
</body>

</html>