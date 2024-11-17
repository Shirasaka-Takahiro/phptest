<?php 
require 'db_connect_shop.php';

session_start();

//csrf_tokenを取得
$csrfToken = filter_input(INPUT_POST, '_csrf_token');

//csrf_tokenの検証
if (
    empty($csrfToken)
    || empty($_SESSION['_csrf_token'])
    || $csrfToken !== $_SESSION['_csrf_token']
) {
    exit('不正なリクエストです');
}

//本来はここでemailのバリデーションをかける
$email = filter_input(INPUT_POST, 'email');

//DBへ接続
$dbh = db_connect();

//emailがusersテーブルに登録済みか確認
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $email, \PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(\PDO::FETCH_OBJ);

// ユーザーがいる場合、本登録済みユーザーなら新規登録処理はせずにメール送信完了画面を表示
// 「登録済みです」と表示するのは、そのメールアドレスを知っている別人がこのメールアドレスを入力した場合に、
// 「このメールアドレスは登録済みである」という情報を与えてしまうので避けたい
if ($user && $user->status !== 'tentative') {
    require './views/email_sent.php';
    exit();
}

if (!$user) {
    // ユーザーがいなければ、仮登録としてテーブルにインサート
    $sql = "INSERT INTO users(email, register_token, register_token_sent_at ) VALUES (:email, :register_token, :register_token_sent_at)";
} else {
    // 既に仮登録済みのユーザーがいる場合、register_tokenの再発行と有効期限のリセットを行う
    // 有効期限切れで再度仮登録する場合はこちらの処理になる
    $sql = "UPDATE users SET register_token = :register_token, register_token_sent_at = :register_token_sent_at WHERE email = :email";
}  

//register tokenの生成
$registerToken = bin2hex(random_bytes(32));

// 仮登録とメール送信は原子性を保ちたいため、トランザクションを設置する
// メール送信に失敗した場合は、仮登録も失敗させる

try {
    $dbh->beginTransaction();

    //ユーザーを仮登録
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
    $stmt->bindValue('register_token', $registerToken, \PDO::PARAM_STR);
    $stmt->bindValue(':register_token_sent_at', (new \DateTime())->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
    $stmt->execute();

    //日本語が文字化けしないように設定
    mb_language("japanese");
    mb_internal_encoding("UTF-8");

    //URL
    $url = "http://test.com/phptest/shop/users/show_register_form.php?token={$registerToken}";

    $subject = '仮登録が完了しました';

    $body = <<<EOD
    会員登録ありがとうございます！
    24時間以内に下記URLへアクセスし、本登録を完了してください。
    {$url}
    EOD;

    //From
    $From = "From: user@smtp.example.com";
    //text/htmlを指定し、html形式で送ることも可能
    $headers .= "Content-Type : text/plain";

    //mb_send_mailは成功したらtrue、失敗したらfalseを返す
    $isSent = mb_send_mail($email, $subject, $body, $headers);

    if(!$isSent) throw new \Exception('メール送信に失敗しました');

    //送信に成功したら仮登録を確定
    $dbh->commit();

} catch(\Exception $e) {
    $dbh->rollBack();

    exit($e->getMessage());
}

// 送信済み画面を表示
require './views/email_sent.php';

?>