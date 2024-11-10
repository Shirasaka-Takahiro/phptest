<table border="1">
<tr><th>名前</th><th>価格</th></tr>
<?php

//DBへ接続
require_once "db_connect_udon.php";
$dbh = db_connect();

//SQLの準備
$stmt = $dbh->query("SELECT * FROM udon");

//名前と価格を取り出して、表示する
while ($row=$stmt->fetch()) {
    $name = htmlspecialchars($row['name']);
    $price = htmlspecialchars($row['price']);
    echo "<tr><td>$name</td><td>$price 円</td><td><a href='udon_update.php?name=$name'>修正</a></td></tr>";
}
?>
</table>