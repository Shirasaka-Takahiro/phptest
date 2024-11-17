<?php
session_start();

// formに埋め込むcsrf tokenの生成
if (empty($_SESSION['_csrf_token'])) {
    $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
}

//仮登録フォームの読み込み
require './views/tmp_register_form.php';

?>