<?php
  require 'common.php';
  require 'db_connect_shop.php';

  //DBへ接続
  $dbh = db_connect();

  //セッション開始
  session_start();
  
  //ログイン中のユーザーID
  $user_id = $_SESSION['user_id']; 
  $email = $_SESSION['email'];

  $stmt = $dbh->query("SELECT * FROM goods WHERE user_id = $user_id");
  $goods = $stmt->fetchAll();
  require 't_index.php';
?>