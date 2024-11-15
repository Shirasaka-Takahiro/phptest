<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Special Blog</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>
<h1>Special Blog</h1>
<?php foreach ($posts as $post) { ?>
    <div class="post">
      <h2><?php echo $post['title']; ?></h2>
      <p><?php echo $post['content']; ?></p>
      <?php foreach ($post['comments'] as $comment) {?>
        <div class="comment">
        <h3><?php echo $comment['name']; ?></h3>
        <p><?php echo $comment['content']; ?></p>
        </div>
      <?php }?>
      <p><a href="post_update_form.php?title=<?php echo $post['title']; ?>">編集</a><a href="post_delete.php?title=<?php echo $post['title']; ?>" onclick="return confirm('削除してよろしいですか？')">削除</a></p>
      <p class="commment_link">
        投稿日：<?php echo $post['time']; ?>
        <a href="comment.php?no=<?php echo $post['no'] ?>">コメント</a>
      </p>
    </div>
<?php }?>
<h1><a href="post.php">投稿</a></h1>
</body>
</html>