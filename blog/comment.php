<?php
//DBへ接続
require_once "db_connect_blog.php";
$dbh = db_connect();

//各変数の初期化
$post_no = $error = $name = $content = '';

//コメントが投稿されたときの処理
if (@$_POST['submit']) {
    //post_noを格納
    $post_no = strip_tags($_POST['post_no']);
    //name(コメント投稿者名)を格納
    $name = strip_tags($_POST['name']);
    //contentを格納
    $content = strip_tags($_POST['content']);
    //nameがないときにエラー
    if (!$name) $error .='名前がありません。<br>';
    //コメントがないときにエラー
    if (!$content) $erro .='コメントがありません。<br>';
    //エラーがないときにDBへ登録
    $stmt = $dbh->prepare("INSERT INTO comment(post_no,name,content) VALUES(?,?,?)");
    $stmt -> execute(array($post_no,$name,$content));
    header('Location: index.php');
    exit();
} else {
    $post_no = strip_tags($_GET['no']);
}
require 't_comment.php';
?>