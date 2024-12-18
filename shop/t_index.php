<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Noodle Shop</title>
<link rel="stylesheet" href="shop.css">
</head>
<body>
<h1>Noodle Shop</h1>
<div class="base">
  <a href="./users/show_tmp_register_form.php" target="_blank">会員登録</a>
  <a href="./users/views/login_form.php" target="_blank">ログイン</a>
  <h1><?php echo $msg ?></h1>
</div>
<table>
  <?php foreach ($goods as $g) { ?>
    <tr>
      <td>
        <?php echo img_tag($g['code']) ?>
      </td>
      <td>
        <p class="goods"><?php echo $g['name'] ?></p>
        <p><?php echo nl2br($g['comment']) ?></p>
      </td>
      <td width="80">
        <p><?php echo $g['price'] ?> 円</p>
        <form action="cart.php" method="post">
          <select name="num">
            <?php
              for ($i = 0; $i <= 9; $i++) {
                echo "<option>$i</option>";
              }
            ?>
          </select>
          <input type="hidden" name="code" value="<?php echo $g['code'] ?>">
          <input type="submit" name="submit" value="カートへ">
        </form>
      </td>
    </tr>
  <?php } ?>
</table>
</body>
</html>