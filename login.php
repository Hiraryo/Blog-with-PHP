<html>
<head>
   <meta charset="utf-8">
   <title>管理者ログイン</title>
   <link rel="stylesheet" type="text/css" href="index.css">
</head>
<center>
<body bgcolor="#87CEEB">
   <div class="top">
      <h1>管理者ログイン</h1>
</div>
<?php
$filename = 'password.txt';
// fopenでファイルを開く（'r'は読み込みモードで開く）
$fp = fopen($filename, 'r');
// fgetsでファイルを読み込み、変数に格納
$pass = fgets($fp);
// fcloseでファイルを閉じる
fclose($fp);

if (!isset($_POST["password"]) || $_POST["password"] != $pass) {
    echo '<p>ログインするには、パスワードを入力してください。</p>';
  }else{
    echo '<p>管理者ログインに成功しました。<p>';
    print '<a href="admin_index.php?aaa=' . $file . '">管理者専用編集ページへ</a><br />';
  }
?>
<p>
<a href="index.php">Monster_Buster(モンバス)の最新情報ページに戻る</a>
</p>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <dl>
	<dt>パスワード：</dt>
	<dd><input type="password" name="password" size="20" /></dd>
      </dl>
      <input type="hidden" name="id" value="<?php echo $_POST["id"] ?>" />
      <input type="reset" value="リセット" />
      <input type="submit" value="送信" />
    </form>
</body>
</center>
</html>