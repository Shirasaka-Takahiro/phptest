<?php
  require 'common.php';
  require 'db_connect_shop.php';

  //DBへ接続
  $dbh = db_connect();

  //セッション開始
  session_start();

  //emailの格納
  $email = $_SESSION['email'];

  $stmt = $dbh->query("SELECT * FROM goods");
  $goods = $stmt->fetchAll();
  require 't_index.php';
?>