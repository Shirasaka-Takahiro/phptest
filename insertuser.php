<?php
require_once "db_connect.php";

try {
    //データベースに接続
    $dbh = db_connect();

    //例外などを投げるように設定
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //トランザクションの開始
    $dbh->beginTransaction();

    //SQLの準備
    $sql = $dbh->exec("INSERT INTO user (id, name, email) VALUES ('6', 'test6', 'test@example.com')");

    //トランザクションの実行
    $dbh->commit();
} catch (Exception $e) {
    $dbh->rollback();
    echo "トランザクション失敗：" . $e->getMessage();
}

//ユーザー情報の取得
$stm = $dbh->prepare('SELECT name,id, email FROM user');
#$stm->bindValue(":id", $id, PDO::PARAM_INT);
$stm->execute();

while ($row = $stm->fetchAll()) {
    print_r($row);
}

//初期化
$stm = null;
//トランザクションここまで