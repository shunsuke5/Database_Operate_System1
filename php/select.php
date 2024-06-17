<title>データ表示ページ</title>

<?php

$dsn = 'mysql:dbname=test;host=127.0.0.1';
$user = 'root';
$password = 'root';

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
    echo "接続に失敗しました";
    echo $e->getMessage();
}
?>

<form action="../index.html" method="post">
    <button>戻る</button>
</form>