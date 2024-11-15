<?php
//DBへ接続
require_once "db_connect_blog.php";
$dbh = db_connect();

//更新用SQLの準備
$stmt = $dbh->prepare("UPDATE post SET title=?,content=? WHERE title=?");
$stmt->execute(array($_POST['title'], $_POST['content'], $_POST['old_title']));

//トップへ戻る
header('Location: index.php');
exit();

?>

$msg = "ログインしました" .  "ID:" . $member['id'] . "ユーザー名:" . $member['name'];