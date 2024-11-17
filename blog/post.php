<?php
//DBへ接続
require_once "db_connect_blog.php";
$dbh = db_connect();

//各変数の初期化
$error = $title = $content = '';
//$postの処理
if (@$_POST['submit']) {
    //POSTのtitleを格納
    $title = $_POST['title'];
    //POSTのcontentを格納
    $content = $_POST['content'];
    //タイトルがなければエラー
    if (!$title) $error .= 'タイトルがありません。<br>';
    //タイトルが長すぎたらエラー
    if (mb_strlen($title) > 80) $error.= 'タイトルが長すぎます。<br>';
    //本文がなければエラー
    if (!$content) $error .= '本文がありません。<br>';
    //エラーがなければDBへ登録
    if (!$error) {
        $stmt = $dbh->query("INSERT INTO post(title,content) VALUES ('$title','$content')");
        header('Location: index.php');
        exit();
    }
}
require 't_post.php';
?>