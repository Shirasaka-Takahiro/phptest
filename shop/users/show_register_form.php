<?php
require 'db_connect_shop.php';

//DBへ接続
$dbh = db_connect();

session_start();

// URLクエリからregister_tokenを取得
$registerToken = filter_input(INPUT_GET, 'token');

//tokenに合致するユーザーを取得
$sql = "SELECT * FROM users WHERE register_token = :register_token AND status = :status";

//register_tokenが合致するユーザーを取得
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':register_token', $registerToken, \PDO::PARAM_STR);
$stmt->bindValue(':status', 'tentative', \PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(\PDO::FETCH_OBJ);

if (!$user) exit('無効なURLです');

//tokenの有効期限を24時間に設定する
$tokenValidPeriod = (new \DateTime()) ->modify("-24 hour")->format('Y-m-d H:i:s');

//仮登録が24時間以上の場合、有効期限切れとする
if ($user->register_token_sent_at < $tokenValidPeriod) exit('有効期限切れです');

//formに埋め込むcsrf token を生成
if (empty($_SESSION['_csrf_token'])) {
    $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
}

//本登録フォームを読み込む
require './views/register_form.php'

?>