<table border="1">
<tr><th>名前</th><th>価格</th><th>操作</th></tr>
<?php
  
//DBへ接続
require_once "db_connect_udon.php";
$dbh = db_connect();

//SQLの準備
$stmt = $dbh->query("SELECT * FROM udon");
while ($row = $stmt->fetch()) {
    $name = htmlspecialchars($row['name']);
    $price = htmlspecialchars($row['price']);
    echo "<tr><td>$name</td><td>$price 円</td><td><a href='udon_update.php?name=$name'>修正</a><a href='udon_delete.php?name=$name' onclick=\"return confirm('削除してもよろしいですか？')\">削除</a></td></tr>";
}
?>
</table>