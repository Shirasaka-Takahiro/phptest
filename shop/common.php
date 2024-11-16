<?php

//セッション開始
session_start();

// 画像タグの処理
function img_tag($code) {
    //商品コードが存在すれば商$nameに商品コード($code)を代入する
    if (file_exists("images/$code.jpg")) $name = $code;
    //それ以外の場合はnoimageを$nameの引数に入れる
    else $name = 'noimage';
    //画像のイメージをパスで返す
    return '<img src="images/' . $name . '.jpg" alt="">';
}

?>
