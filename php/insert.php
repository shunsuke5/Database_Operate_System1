<title>データ追加操作:結果ページ</title>

<?php

$dsn = 'mysql:dbname=test;host=127.0.0.1';
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO($dsn, $user, $password);

    $stmt = $dbh->prepare("INSERT INTO fruit VALUES (:fruit, :color);");
    $stmt->bindValue(":fruit", $_POST['fruit'], PDO::PARAM_STR);
    $stmt->bindValue(":color", $_POST['color'], PDO::PARAM_STR);
    $isQuerySuccess = $stmt->execute();
    if ($isQuerySuccess) {
        echo "新たにデータを追加しました。";
    } else {
        echo "クエリが失敗しました";
    }

} catch (PDOException $e) {
    echo "データベース接続に失敗しました";
    echo $e->getMessage();
}

?>

<form action="../index.html" method="post">
    <button>戻る</button>
</form>