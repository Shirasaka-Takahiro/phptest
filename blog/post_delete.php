<?php
//DBへ接続
require_once "db_connect_blog.php";
$dbh = db_connect();

//削除用SQLの準備
$stmt = $dbh->prepare("DELETE FROM post WHERE title=?");
$stmt->execute(array($_GET['title']));

//トップへ戻る
header('Location: index.php');
exit();

?>