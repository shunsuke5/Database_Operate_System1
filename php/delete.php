<title>データ削除操作:結果ページ</title>
<h1>削除するデータの「NAME」を入力してください。</h1>
<form action="" method="post">
    <label for="name">NAME:</label>
    <input name="name" type="text" required>
    <button>削除</button>
</form>

<?php

include 'select.php';

$dsn = "mysql:dbname=test;host=127.0.0.1";
$user = "root";
$password = "root";

try {
    $dbh = new PDO($dsn, $user, $password);
    $stmt = $dbh->prepare("DELETE FROM fruit WHERE name = :name");
    $stmt->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
    $result = $stmt->execute();
    if (!$result) {
        echo "クエリが失敗しました";
    } else {
        echo "クエリが成功しました";
    }

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>