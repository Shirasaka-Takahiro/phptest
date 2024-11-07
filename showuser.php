<?php
require_once "db_connect.php";

try {
    //データベースに接続
    $dbh = db_connect();

    //例外などを投げるように設定
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //ユーザー情報の取得
    $stm = $dbh->prepare('SELECT id, name, email FROM user');
    $stm->execute();
}catch (Exception $e) {
    $dbh->rollback();
    echo "ユーザー情報の取得失敗：" . $e->getMessage();
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ユーザー表示</title>
    </head>
    <body>
        <h1>ユーザー一覧</h1>
        <?php
        while ($row = $stm->fetch()) {
            echo "<p>ID:" . $row['id'] . "</p>";
            echo "<p>Name:" . $row['name'] . "</p>";
            echo "<p>E-mail:" . $row['email'] . "</p>"; 
        }
        //初期化
        $stm = null;
        ?>
    </body>
</html>