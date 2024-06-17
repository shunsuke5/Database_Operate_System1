<html lang="ja">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>データベース操作Webアプリ</title>
<h1>データベース簡易操作システム</h1>

<div class="add">
    <h2>データを追加する</h2>
    <form action="" method="post">
        <label for="add_name">名前:</label>
        <input name="add_name" type="text" required>
        <label for="add_color">色:</label>
        <input name="add_color" type="text" required>
        <button>送信</button>
    </form>
</div>

<div class="delete">
    <h2>データを削除する</h2>
    <form action="" method="post">
        <label for="delete_name">名前:</label>
        <input name="delete_name" type="text" required>
        <button>送信</button>
    </form>
</div>

<?php

$dsn = 'mysql:dbname=test;host=127.0.0.1';
$user = 'root';
$password = 'root';

// データベース表示処理
try {
    $dbh = new PDO($dsn, $user, $password);
    echo '接続に成功しました<br>';

    $stmt = $dbh->query("SELECT * FROM fruit");
    if(!$stmt) { echo "クエリが失敗しました"; }
    $result = $stmt->fetchAll();
?>

<link rel="stylesheet" href="../style.css">

<table>
    <tr>
        <th scope="col">NAME</th>
        <th scope="col">COLOR</th>
    </tr>

    <?php foreach($result as $key => $val): ?>
        <tr>
            <th scope="row"><?= $val['name'] ?></th>
            <td><?= $val['color'] ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<?php
} catch (PDOException $e) {
    echo "データベース接続に失敗しました";
    echo $e->getMessage();
}

// データ追加処理
try {
    $dbh = new PDO($dsn, $user, $password);

    if (isset($_POST['add_name']) && isset($_POST['add_color'])) {
        $stmt = $dbh->prepare("INSERT INTO fruit VALUES (:name, :color);");
        $stmt->bindValue(":name", $_POST['add_name'], PDO::PARAM_STR);
        $stmt->bindValue(":color", $_POST['add_color'], PDO::PARAM_STR);
        $isQuerySuccess = $stmt->execute();
        if ($isQuerySuccess) {
            echo "新たにデータを追加しました。";
        } else {
            echo "クエリが失敗しました";
        }
    }

} catch (PDOException $e) {
    echo "データベース接続に失敗しました";
    echo $e->getMessage();
}

// データ削除処理
try {
    if (isset($_POST['delete_name'])) {
        $dbh = new PDO($dsn, $user, $password);
        $stmt = $dbh->prepare("DELETE FROM fruit WHERE name = :name");
        $stmt->bindValue(":name", @$_POST['delete_name'], PDO::PARAM_STR);
        $result = $stmt->execute();
        if (!$result) {
            echo "クエリが失敗しました";
        } else {
            echo "クエリが成功しました";
        }
    }

} catch (PDOException $e) {
    echo "データベース接続に失敗しました";
    echo $e->getMessage();
}