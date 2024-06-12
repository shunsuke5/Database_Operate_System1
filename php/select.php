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
    print_r($result);

} catch (PDOException $e) {
    echo "接続に失敗しました";
    echo $e->getMessage();
}