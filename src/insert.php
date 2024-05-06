<?php

$host = 'mysql';
$dbname = $_ENV['MYSQL_DATABASE'];

$dsn = "mysql:dbname={$dbname};host={$host};charset=utf8mb4";
$user = 'root';
$password = $_ENV['MYSQL_PASSWORD'];

if (isset($_POST['submit'])) {
    try {
        $pdo = new PDO($dsn, $user, $password);

        $sql = '
            INSERT INTO users (name, furigana, email, age, address)
            VALUES (:name, :furigana, :email, :age, :address)
        ';
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $_POST['user_name'], PDO::PARAM_STR);
        $stmt->bindValue(':furigana', $_POST['user_furigana'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $_POST['user_email'], PDO::PARAM_STR);
        $stmt->bindValue(':age', $_POST['user_age'], PDO::PARAM_INT);
        $stmt->bindValue(':address', $_POST['user_address'], PDO::PARAM_STR);

        $stmt->execute();

        header('Location: select.php');
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP+DB</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>ユーザ登録</h1>
    <p>ユーザの情報を入力してください。</p>
    <form action="insert.php" method="post">
        <div>
            <label for="user_name">お名前<span>【必須】</span></label>
            <input type="text" id="user_name" name="user_name" maxlength="60" required>

            <label for="user_furigana">ふりがな<span>【必須】</span></label>
            <input type="text" id="user_furigana" name="user_furigana" maxlength="60" required>

            <label for="user_email">メールアドレス<span>【必須】</span></label>
            <input type="email" id="user_email" name="user_email" maxlength="255" required>

            <label for="user_age">年齢</label>
            <input type="number" id="user_age" name="user_age" min="13" max="130">

            <label for="user_address">住所</label>
            <input type="text" id="user_address" name="user_address" maxlength="255">
        </div>
        <button type="submit" name="submit" value="insert">登録</button>
    </form>
</body>