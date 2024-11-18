<?php
require 'db_connect_shop.php';

//DBへ接続
$dbh = db_connect();

session_start();

$request = filter_input_array(INPUT_POST);

//csrf token が正しければOK
if (
    empty($request['_csrf_token'])
    || empty($_SESSION['_csrf_token'])
    || $request['_csrf_token'] !== $_SESSION['_csrf_token']
) {
    exit('不正なリクエストです');
}

//statusの更新
$sql = "UPDATE users SET password = :password, register_token_verified_at = :register_token_verified_at, status = :status WHERE register_token = :register_token";

//テーブルに登録するパスワードをハッシュ化
$hashedPassword = password_hash($request['password'], PASSWORD_BCRYPT);

//仮登録ユーザーを本登録(パスワードを登録し、ステータスを本登録ステータスにする)
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':password', $hashedPassword, \PDO::PARAM_STR);
$stmt->bindValue(':register_token_verified_at', (new \DateTime())->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
$stmt->bindValue(':status', 'public', \PDO::PARAM_STR);
$stmt->bindValue(':register_token', $request['register_token'], \PDO::PARAM_STR);
$stmt->execute();

echo '本登録が完了しました'

?>