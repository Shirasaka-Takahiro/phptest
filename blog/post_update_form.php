<?php
//DBへ接続
require_once "db_connect_blog.php";
$dbh = db_connect();

//GETリクエストからタイトルを取得
$title = htmlspecialchars($_GET['title']);

//更新対象の投稿を取得するSQLの準備
$stmt =  $dbh->prepare("SELECT * FROM post WHERE title=?");
$stmt->execute(array($title));
$row = $stmt->fetch();
$content = htmlspecialchars($row['content']);

//編集用ファイルの読み込み
require 't_post_update_form.php';
?>