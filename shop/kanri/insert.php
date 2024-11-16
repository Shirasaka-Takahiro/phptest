<?php 
require 'common.php';
require 'db_connect_shop.php';

//DBへ接続
$dbh = db_connect();

$error = $name = $comment = $price = '';

if (@$_POST['submit']) {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $price = $_POST['price'];
    if (!$name) $error .= '商品名がありません<br>';
    if (!$comment) $error .= '商品説明がありません<br>';
    if (!$price) $error .= '価格がありません<br>';
    if (preg_match('/\D/', $price)) $error .= '価格が不正です。<br>';
    if (!$error) {
        $dbh -> query("INSERT INTO goods(name, comment, price) VALUES('$name','$comment', '$price')");
        header('Location: index.php');
        exit();
    }
}
require 't_insert.php';

?>