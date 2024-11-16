<?php
require 'common.php';
require 'db_connect_shop.php';

//DBへ接続
$dbh = db_connect();

//商品を取得するクエリの準備
$stmt = $dbh->query("SELECT * FROM goods");
//$goodsに取得した商品を配列で格納
$goods = $stmt->fetchAll(); 

//ブラウザ表示用index.phpの読み込み
require 't_index.php';

?>