<?php

//DBへ接続
require_once "db_connect_udon.php";
$dbh = db_connect();

//SQLの準備
$stmt = $dbh->prepare("INSERT INTO udon VALUES (?,?)");
//SQLの実行
$stmt->execute(array($_POST['name'], $_POST['price']));
?>
レコードを追加しました