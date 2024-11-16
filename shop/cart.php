<?php
require 'db_connect_shop.php';

//DBへ接続
$dbh = db_connect();

$rows = array();
$sum = 0;

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
if (@$_POST['submit']) {
    @$_SESSION['cart'][$_POST['code']] += $_POST['num'];
}
foreach($_SESSION['cart'] as $code => $num) {
    $stmt = $dbh->prepare("SELECT * FROM goods WHERE code=?");
    $stmt->execute(array($code));
    $row = $stmt->fetch();
    $stmt->closeCursor();
    $row['num'] = strip_tags($num);
    $sum += $num * $row['price'];
    $rows[]=$row;
}

require 't_cart.php'

?>