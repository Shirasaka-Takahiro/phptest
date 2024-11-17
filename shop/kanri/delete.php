<?php 
require 'common.php';
require 'db_connect_shop.php';

//DBへ接続
$dbh = db_connect();

$stmt = $dbh->query("DELETE FROM goods WHERE code={$_GET['code']}");
header('Location: index.php');

?>