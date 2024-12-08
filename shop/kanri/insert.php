<?php 
require 'common.php';
require 'db_connect_shop.php';

//DBへ接続
$dbh = db_connect();

//ログインしていない場合はログインページを表示する
if (!isset($_SESSION['user_id'])) {
    echo  "ログインしてください。";
    header('Location: ../users/views/login_form.php');
    exit;
}

//各変数の初期化
$error = $name = $comment = $price = '';

//入力データを取得
if (@$_POST['submit']) {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user_id']; //ログイン中のユーザーID
    if (!$name) $error .= '商品名がありません<br>';
    if (!$comment) $error .= '商品説明がありません<br>';
    if (!$price) $error .= '価格がありません<br>';
    if (preg_match('/\D/', $price)) $error .= '価格が不正です。<br>';
    if (!$error) {
        $dbh -> query("INSERT INTO goods(name, comment, price, user_id) VALUES('$name','$comment', '$price', $user_id)");
        header('Location: index.php');
        exit();
    }
}
require 't_insert.php';

?>