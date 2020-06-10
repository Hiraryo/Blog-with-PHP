<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>公開情報の編集</title>
  </head>
  <center>
  <body bgcolor="#99FF99">
    <h1>公開情報の編集</h1>
    <?php
    $filename = 'password.txt';
    // fopenでファイルを開く（'r'は読み込みモードで開く）
    $fp = fopen($filename, 'r');
    // fgetsでファイルを読み込み、変数に格納
    $pass = fgets($fp);
    // fcloseでファイルを閉じる
    fclose($fp);
	  try {

  	     //PDOクラスのオブジェクトの作成
           $dbh = new PDO('sqlite:blog.db','','');
         
         if (isset($_POST["id"]) && !isset($_POST["title"]) && !isset($_POST["contents"])) {
	   
             //実行するSQL文を$sqlに格納
             //index.phpから転送されたidを元に対象記事を抽出する
           $sql='select * from posts where id=?';
             //prepareメソッドでSQL文の準備
           $sth = $dbh->prepare($sql);
             //prepareした$sthを実行　SQL文の？部に格納する変数を指定
           $sth->execute(array($_POST["id"]));

           if ($row = $sth->fetch()) {
               $_POST["title"] = $row['title'];
               $_POST["contents"] = $row['contents'];
           }

         } elseif (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["contents"])) {
           if (!isset($_POST["password"]) || $_POST["password"] != $pass) {
             echo '<p>パスワードが違います</p>';
           }
           else {
         
               //実行するSQL文を$sqlに格納
             $sql='update posts set title=?, contents=? where id=?';
               //prepareメソッドでSQL文の準備
             $sth = $dbh->prepare($sql);
               //prepareした$sthを実行　SQL文の？部に格納する変数を指定
             $sth->execute(array($_POST["title"], $_POST["contents"], $_POST["id"]));

	     if ($sth) {
	       echo "記事１件を更新しました";
	     } else {
	       echo "記事１件の更新に失敗しました";
	     }

           }
         }
       
         $dbh = null;
       
	} Catch (PDOException $e) {
	  print "エラー!: " . $e->getMessage() . "<br/>";
	  die();
	}

   ?>
       
    <p><a href="admin_index.php">管理者トップページに戻る</a></p>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <dl>
	<dt>タイトル：</dt>
	<dd><input type="text" name="title" value="<?php echo $_POST["title"] ?>" size="60" /></dd>
	<dt>本文：<br>(URLを入力する場合は、<br>&lt;a href="https://hogehoge.co.jp">サイト名&lt;/a&gt;<br>と入力してください。)</dt>
	<dd><textarea name="contents" rows="10" cols="60"><?php echo $_POST["contents"] ?></textarea></dd>
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
