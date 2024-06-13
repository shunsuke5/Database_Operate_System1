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
    foreach($result as $key => $val) {
        // echo $val['name'] . "&nbsp";
        // echo $val['color'] . "<br>";
        echo <<< 'EOD'
        <p><?= $val['name'] ?></p>
        <p><?= $val['color'] ?></P>
        EOD;
    }

} catch (PDOException $e) {
    echo "接続に失敗しました";
    echo $e->getMessage();
}