<?php
//セッションの開始
session_start();

//フォームから値を受け取る
$email = $_POST['email'];

//DBへ接続
require_once "db_connect.php";
$dbh = db_connect();

//メールを格納するSQLの作成
$sql = "SELECT * FROM user WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->execute();
$member = $stmt->fetch();

//指定したハッシュ値がパスワードに合致しているかチェック
if (password_verify($_POST['password'], $member['password'])) {
    //DBユーザー情報をセッションに保存
    $_SESSION['id'] = $member['id'];
    $_SESSION['name'] = $member['name'];
    $msg = "ログインしました" .  "ID:" . $member['id'] . "ユーザー名:" . $member['name'];
    $link = '<a href="index.php">ホーム画面へ</a>';
} else {
    $msg = 'メールアドレスもしくはパスワードが間違っています';
    $link = '<a href="login_form.html">戻る</a>';
}

?>

<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>