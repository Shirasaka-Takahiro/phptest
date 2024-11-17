<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>記事投稿 | Special Blog</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>
<form method="post" action="post_update.php">
  <div class="post">
    <h2>記事投稿</h2>
    <p>題名</p>
    <p><input type="text" name="title" size="40" value="<?php echo $title; ?>"></p>
    <p>本文</p>
    <p><textarea name="content" rows="8" cols="40"><?php echo $content; ?></textarea></p>
    <input type="hidden" name="old_title" value="<?php echo $title; ?>"> 
    <p><input name="submit" type="submit" value="編集"></p>
    <p><?php echo $error; ?></p>
  </div>
</form>
</body>
</html>