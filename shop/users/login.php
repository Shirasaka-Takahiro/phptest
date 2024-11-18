<?php
require 'db_connect_shop.php';

//DBへ接続
$dbh = db_connect();

session_start();


require_once './views/login_form.php';
?>