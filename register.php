<?php
require_once "db_connect.php";

//フォームからの値をそれぞれ代入
$name = $_POST['name'];
$email = $_POST['email'];
//ユーザー認証の際にハッシュ化は必須
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//DBへ接続
$dbh = db_connect();

//フォームに入力された名前が既に登録されているかチェック
//SQLの準備
$sql = "SELECT * FROM user WHERE name = :name";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':name', $name);
$stmt->execute(); 
$member = $stmt->fetchAll();

//判定を実施
if($member['name'] === $name) {
    $msg = "同じ名前のユーザーが存在します";
} else {
    //登録されていなければINSERT文実行
    $sql = "INSERT INTO user (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    $msg = 'ユーザー登録が完了しました';
    $link = '<a href="showuser.php">ユーザーを表示</a>';
}
?>

<h1><?php echo $msg; ?></h1>
<?php echo $link;?>