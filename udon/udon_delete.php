<?php

//DBへ接続
require_once "db_connect_udon.php";
$dbh = db_connect();

//SQLの準備
$stmt = $dbh->prepare("DELETE FROM udon WHERE name=?");
$stmt->execute(array($_GET['name']));
?>
レコードを削除しました