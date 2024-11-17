<?php 
require 'common.php';
require 'db_connect_shop.php';

//DBへ接続
$dbh = db_connect();

$error = '';

if (@$_POST['submit']) {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $price = $_POST['price'];
    if (!$name) $error .= '商品名がありません<br>';
    if (!$comment) $error .= '商品説明がありません<br>';
    if (!$price) $error .= '価格がありません<br>';
    if (preg_match('/\D/', $price)) $error .= '価格が不正です。<br>';
    if (!$error) {
        $dbh->query("UPDATE goods SET name='$name', comment='$comment', price='$price' WHERE code='$code'");
        header('Location: index.php');
        exit();
    }
    } else {
        $code = $_GET['code'];
        $stmt = $dbh->query("SELECT * FROM goods WHERE code=$code");
        $row = $stmt->fetch();
        $name = $row['name'];
        $comment = $row['comment'];
        $price = $row['price'];
    }
    require 't_edit.php';
?>