<h1>削除するデータの「NAME」を入力してください。</h1>
<form action="" method="post">
    <label for="name">NAME</label>
    <input name="name" type="text" required>
    <button>削除</button>
</form>

<?php

$dsn = "mysql:dbname=test;host=127.0.0.1";
$user = "root";
$password = "root";

try {
    $dbh = new PDO($dsn, $user, $password);
    $stmt = $dbh->prepare("DELETE FROM fruit WHERE name = :name");
    $stmt->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<form action="../index.html" method="post">
    <button>戻る</button>
</form>