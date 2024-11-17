<?php
//セッションの開始
session_start();

//セッションの中身を削除
$_SESSION = array();

//セッションを破壊
session_destroy();
?>

<p>ログアウトしました</p>
<a href="index.php">ホーム画面へ</a>