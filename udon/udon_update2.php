<?php

//DBへ接続
require_once "db_connect_udon.php";
$dbh = db_connect();

//SQLの準備
$stmt = $dbh->prepare("UPDATE udon SET name=?,price=? WHERE name=?");
$stmt->execute(array($_POST['name'], $_POST['price'], $_POST['old_name']))
?>
レコードを修正しました