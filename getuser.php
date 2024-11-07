<?php
require_once "db_connect.php";

//データベースに接続
$dbh = db_connect();

//例外などを投げるように設定
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//ユーザー情報の取得
$stm = $dbh->prepare('SELECT name FROM user');
#$stm->bindValue(":id", $id, PDO::PARAM_INT);
$stm->execute();

while ($row = $stm->fetchAll()) {
    print_r($row);
}

//初期化
$stm = null;