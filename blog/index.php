<?php

//DBへ接続
require_once "db_connect_blog.php";
$dbh = db_connect();

//noを降順ににてpostを取得
$stmt = $dbh->query("SELECT * FROM post ORDER BY no DESC");
$posts = $stmt->fetchAll();

//$postsを引数にしてfor分を回し、一つずつ投稿を取得する
for ($i = 0; $i < count($posts); $i++) {
    $stmt = $dbh->query("SELECT * FROM comment WHERE post_no={$posts[$i]['no']} ORDER BY no DESC");
    $posts[$i]['comments'] = $stmt->fetchAll();
}
require "t_index.php";
?>