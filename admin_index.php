<html>
<head>
   <meta charset="utf-8">
   <title>Monster_Buster(モンバス)の最新情報</title>
   <link rel="stylesheet" type="text/css" href="index.css">
</head>
<center>
<body bgcolor="#87CEEB">
   <div class="top">
      <span class="title1">Monster_Buster(モンバス)の最新情報</span>
      <span class="title2">(管理者でログイン中)</span>
</div>
<p>
<a href="post.php">記事を投稿する</a><br>
<a href="index.php">公開されている様子を確認する</a>
<p>
<hr/>

<?php
try{
  $dbh = new PDO('sqlite:blog.db','','');   //PDOクラスのオブジェクトの作成
   $sth = $dbh->prepare("select * from posts order by date desc");   //prepareメソッドでSQL文の準備
   $sth->execute();   //準備したSQL文の実行

   while ($row = $sth->fetch()) {
     //テーブルの内容を１行ずつ処理
     $time = preg_split("/[\s.:-]+/",$row['date']);
?>
     <h3><?php echo $row['title'] ?></h3>
     <div class="contents">
      <span class="contents-title">記事内容</span>
      <pre><p><?php echo $row['contents']?><br></p></pre>
        <span id="day2">(<?php echo $time[0]."年".$time[1]."月". $time[2]."日 ".$time[3].":".$time[4].":".$time[5] ?>)</span>
     </div>
     <hr/>
     <form action="edit.php" method="post">
         <p>
         <input type="submit" value="編集" >
         <input type="hidden" name="id" value="<?php echo $row['id'] ?>" >
         </p>
      </form>
      <form action="delete.php" method="post">
         <p>
         <input type="submit" value="削除" >
         <input type="hidden" name="id" value="<?php echo $row['id'] ?>" >
         </p>
      </form>
<?php
   }
} Catch (PDOException $e) {
   print "エラー!: " . $e->getMessage() . "<br/>";
   die();
}
?>

</body>
</center>
</html>
