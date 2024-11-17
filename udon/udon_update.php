<?php
//GETリクエストからnameを取得
$name = htmlspecialchars($_GET['name']);

//DBへ接続
require_once "db_connect_udon.php";
$dbh = db_connect();

//SQLの準備
$stmt = $dbh->prepare("SELECT * FROM udon WHERE name = ?");
$stmt->execute(array($name));
$row = $stmt->fetch();
$price = htmlspecialchars($row['price']);
?>

<form method="post" action="udon_update2.php">
  名前<br>
  <input type="text" name="name" value="<?php echo $name; ?>">
  価格<br>
  <input type="text" name="price" value="<?php echo $price; ?>">
  <input type="hidden" name="old_name" value="<?php echo $name; ?>">
  <input type="submit">
</form>