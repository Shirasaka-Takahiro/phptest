<h1>ログインページ</h>
<?php
//セッションスタート
session_start();

//ログインしているユーザー名を格納
$name = $_SESSION['name'];

//ログインしているときの処理
if (isset($_SESSION['id'])) {
    //ログインしているとき
    $msg = 'こんにちは' . htmlspecialchars($name, \ENT_QUOTES, 'UTF-8') . 'さん';
    $link = '<a href="logout.php">ログアウト</a>';
} else {
    //ログインしていないとき;
    $msg = 'ログインしていません';
    $link = '<a href="login_form.html">ログイン</a>';
    $signup = '<a href="signup.html">新規登録</a>';
}
?>
<h1><?php echo $msg; ?></h1>
<p><?php echo $link; ?></p>
<p><?php echo $signup; ?></p>