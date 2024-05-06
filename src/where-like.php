<?php
$dbname = $_ENV['MYSQL_DATABASE'];
$dsn = "mysql:dbname={$dbname};host=mysql;charset=utf8mb4";
$user = 'root';
$password = $_ENV['MYSQL_PASSWORD'];

try {
    $pdo = new PDO($dsn, $user, $password);

    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
    } else {
        $keyword = NULL;
    }

    $sql = 'SELECT name, furigana FROM users WHERE furigana LIKE :keyword';

    $stmt = $pdo->prepare($sql);

    $partial_match = "%{$keyword}%";

    $stmt->bindValue(':keyword', $partial_match, PDO::PARAM_STR);

    $stmt->execute();
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
    <form action="where-like.php" method="get" class="search-form">
        <input type="text" placeholder="ふりがなで検索" name="keyword">
        <input type="submit" value="検索">
    </form>
    <table>
        <tr>
            <th>氏名</th>
            <th>ふりがな</th>
            <?php
            foreach ($results as $result) {
                echo "<tr><td>{$result['name']}</td><td>{$result['furigana']}</td></tr>";
            }
            ?>
        </tr>
    </table>
</body>

</html>