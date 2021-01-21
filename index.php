<html>
<head>
   <meta charset="utf-8">
   <title>Monster_Buster(モンバス)の最新情報</title>
   <link rel="stylesheet" type="text/css" href="index.css">
</head>
<li>学生証番号：853806</li>
      <li>名前：平井崚太</li>
      <li>工夫した点</li>
      <ol style="border: dashed; border-color: red">
         <li>ブログのタイトルや内容の装飾をこだわりました。</li>
         <li>投稿日時のテキスト色をグラデーションにし、投稿内容の右下に右斜めに表示するところもこだわりました。</li>
         <li>管理者でログインすることで記事を投稿できたり、編集、削除ができるようにしました。</li>
         <li>投稿ページ、編集ページ、削除ページのそれぞれの背景の色を区別することで、今自分がどこのページにいるのかを視覚的にわかるようにしました。</li>
         <li>さらに削除ページは「注意して作業するように」ということで背景色を濃い赤色にしました。（原色の赤は目が疲れるため、目に優しい赤色を一つずつ試して決めました。）</li>
         <li>そして各ページの配色は目が疲れないように配慮しました。</li>
         <li>削除ページのタイトルと内容の部分は編集できないようにしました。</li>
         <li>投稿ページの内容でHTML記述でURLを入力し投稿すると、トップページで入力したURLをクリックするとしっかりリンクできるようにしました。</li>
         <li>投稿ページの改行情報をトップページでも継承するようにしました。</li>
         <li>投稿ページで改行せずに1行で入力しようとしても、テキストエリアの端に達した場合、自動的に改行するようにしました。</li>
         <li>ログインの際に必要なパスワードはソースコードに直接書かず、password.txtというテキストファイルから読み込むようにしました。これによりパスワードを変更する場合は、このテキストファイルの内容を変更するだけでよくなり、作業効率を向上させました。</li>
      </ol>
<center>
<body bgcolor="#87CEEB">
   <div class="top">
   <span class="title1">Monster_Buster(モンバス)の最新情報</span>
</div>

<a href="login.php">管理者ログイン</a>
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
      <pre><p><?php echo $row['contents'] ?><br></p></pre>
        <span id="day2">(<?php echo $time[0]."年".$time[1]."月". $time[2]."日 ".$time[3].":".$time[4].":".$time[5] ?>)</span>
     </div>
     <hr/>
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
