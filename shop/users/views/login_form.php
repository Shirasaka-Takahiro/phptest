<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ログインフォーム</title>
<body>
<h1>ログインページ</h1>
<form action="login.php" method="post">
<div>
    <label>
        メールアドレス：
        <input type="text" name="mail" required>
    </label>
</div>
<div>
    <label>
        パスワード：
        <input type="password" name="pass" required>
    </label>
</div>
<input type="submit" value="ログイン">
</form>
</body>
</html>