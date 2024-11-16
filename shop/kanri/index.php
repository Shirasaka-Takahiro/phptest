<?php
  require 'common.php';
  require 'db_connect_shop.php';

  //DBへ接続
  $dbh = db_connect();

  $stmt = $dbh->query("SELECT * FROM goods");
  $goods = $stmt->fetchAll();
  require 't_index.php';
?>