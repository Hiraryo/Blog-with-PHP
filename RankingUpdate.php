<html>
    <head>
        <title>PHP Test</title>
    </head>
    <body>
        <?php
        try{
          $dbh = new PDO('sqlite:ranking.db','','');   //PDOクラスのオブジェクトの作成
           $sth = $dbh->prepare("select * from ranking order by score desc");   //prepareメソッドでSQL文の準備
           $sth->execute();   //準備したSQL文の実行

           //取得したデータを出力
           foreach ($sth as $value) {
             //scoreを降順にソートしたものをブラウザに表示(デバッグ)
             echo "$value[score]<br>";
           }
          } Catch (PDOException $e) {
           print "エラー!: " . $e->getMessage() . "<br/>";
           die();
          }
        ?>
    </body>
</html>
