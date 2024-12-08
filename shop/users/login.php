<?php

require 'db_connect_shop.php';

//DBへ接続
$dbh = db_connect();

session_start();

//ブラウザからメールアドレスを取得
$email = $_POST['email'];

//emailを取得するSQLの作成
$sql = "SELECT * from users WHERE email = :email";
//SQLの実行
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->execute();

//実行したSQLをuser関数へ格納
$user = $stmt->fetch();

//下記条件でログイン認証処理
//1. emailが存在しない
//　→エラー
//2. パスワードが一致しない
//　→エラー
//3. ステータスがpublicではない
//　→エラー
//4. パスワードが一致し、ステータスもpublic
//　→ログイン
//5. something went wrong(例外処理)
//　→エラー

try {
    //パスワードの取得
    $input_password = $_POST['password'];

    //1.emailが存在しない
    if (!$email) {
        $msg = "メールアドレスが登録されていません。新規登録してください";
        header('Location: ../index.php');
    }

    //2. パスワードが一致しない場合エラー
    if (!password_verify($input_password, $user['password'])) {
        $msg = "パスワードが一致しません。正しいパスワードを入力してください";
        header('Location: ./views/login_form.php');
    }
    
    //3. ステータスがpublicではない
    if ($user['status'] !== 'public' ) {
        $msg = '仮登録ユーザーです。本登録を済ませてください。';
        header('Location: ./views/login_form.php');
    }

    //4. パスワードが一致し、ステータスもpublic
    if (password_verify($input_password, $user['password']) && $user['status'] == 'public') {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email']; 
        $msg = 'ログインしました。';
        header('Location: ../kanri/index.php');
    }

} catch(Exception $e) {
    //5. something went wrong(例外処理)
    error_log('ログイン処理中にエラーが発生しました。:' . $e->getMessage());
    header('Location: ./views/login_form.php');
    
}


?>