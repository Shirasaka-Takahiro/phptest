<?php
require 'common.php';
require 'db_connect_shop.php';

//DBへ接続
$dbh = db_connect();

$error = $name = $address = $tel = '';
if (@$_POST['submit']) {
    //各変数の格納
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $tel = htmlspecialchars($_POST['tel']);
    //エラー処理
    if (!$name) $error .= 'お名前を入力してください<br>';
    if (!$address) $error .= '住所を入力してください<br>';
    if (!$tel) $error .= '電話番号を入力してください<br>';
    if (preg_match('/[^\d-]/', $tel)) $error .= '電話番号が正しくありません<br>';

    if (!$error) {
        $body = "商品が購入されました。\n\n"
        . "お名前： $name\n"
        . "ご住所： $address\n"
        . "電話番号： $tel\n\n";
        foreach($_SESSION['cart'] as $code => $num) {
            $stms = $dbh->prepare("SELECT * FROM goods WHERE code=?");
            $stmt->execute(array($code));
            $row = $stmt->fetch();
            $stmt->closeCursor();
            $body .="商品名： {$row['name']}\n"
              . "単価： {$row['price']} 円\n"
              . "数量： {$row['num']}\n\n";
        }
        $from = "newuser@localhost";
        $to = "newuser@localhost";
        mb_send_mail($to, '購入者メール', $body, "From: $from");
        $_SESSION['cart'] = null;
        require 't_buy_complete.php';
        exit();
    }
}
require 't_buy.php';
?>