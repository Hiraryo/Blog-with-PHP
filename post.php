<html>
  <head>
    <meta charset="utf-8">
	<title>最新情報の投稿</title>
	<link rel="stylesheet" type="text/css" href="post.css">
  </head>
  <center>
  <body bgcolor="#FF9966">
    <h1>最新情報の投稿</h1>
    <?php
	$filename = 'password.txt';
	// fopenでファイルを開く（'r'は読み込みモードで開く）
	$fp = fopen($filename, 'r');
	// fgetsでファイルを読み込み、変数に格納
	$pass = fgets($fp);
	// fcloseでファイルを閉じる
	fclose($fp);
   if (isset($_POST["title"]) && isset($_POST["contents"])) {
	if (!isset($_POST["password"]) || $_POST["password"] != $pass) {
		echo '<p>パスワードが違います</p>'; }
		else {
       try{
	 //タイムゾーンの指定
	 ini_set("date.timezone", "Asia/Tokyo");
	 //$timeへ成形した年月日および時刻データを格納
	 $time=date("Y.m.d-H:i:s");
	 
	 //PDOクラスのオブジェクトの作成
	 $dbh = new PDO('sqlite:blog.db',",");
	 //実行するSQL文を$sqlに格納
	 $sql='insert into posts (title, contents, date) values (?,?,?)';
	 //prepareメソッドでSQL文の準備
	 $sth = $dbh->prepare($sql);
	 //prepareした$sthを実行　SQL文の？部に格納する変数を指定
	 $sth->execute(array($_POST["title"], $_POST["contents"], $time));

	 if ($sth) {
	       echo "記事１件を投稿しました";
	 } else {
	       echo "記事１件の投稿に失敗しました";
	 }	 

       } Catch (PDOException $e) {
	 print "エラー!: " . $e->getMessage() . "<br/>";
	 die();
       }
   }
}
   $dbh = null;

?>
    <p><a href="admin_index.php">管理者トップページに戻る</a></p>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <dl>
	<dt>タイトル：</dt>
		<dd><input type="text" name="title" size="50" /></dd>
	<dt>本文：<br>(URLを入力する場合は、<br>&lt;a href="https://hogehoge.co.jp">サイト名&lt;/a&gt;<br>と入力してください。)</dt>
		<dd><div class="text-box"><textarea name="contents" rows="10" cols="90" wrap="hard"></textarea></div></dd>
		<dt>パスワード：</dt>
		<dd><input type="password" name="password" size="20"></dd>
      </dl>
      <input type="reset" value="リセット" />
      <input type="submit" value="送信" />
    </form>
  </body>
  </center>
</html>
