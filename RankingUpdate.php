<!DOCTYPE html>
<html>
    <head>
        <title>PHP Test</title>
    </head>
    <body align="center">
        <?php
        try{
          $dbh = new PDO('sqlite:ranking.db','','');   //PDOクラスのオブジェクトの作成
           $sth = $dbh->prepare("select * from ranking order by score desc");   //prepareメソッドでSQL文の準備
           $sth->execute();   //準備したSQL文の実行
          } Catch (PDOException $e) {
           print "エラー!: " . $e->getMessage() . "<br/>";
           die();
          }
        ?>
        <table border="2" align="center">
          <caption>Monster_Buster ハイスコアランキング</caption>
          <tr bgcolor='#CCFFFF'>
            <th width="80">順位</th>
            <th width="200">プレイヤー</th>
            <th width="200">スコア</th>
            <th width="100">ステージLV</th>
          </tr>
          <!-- 取得したデータを連想配列を使い、-->
          <?php
            $i = 0;
            foreach ($sth as $key => $value) {
              $i++;
          ?>
         <tr>
           <td>
             <?php echo $i.'位' ?>  <!-- 順位を表示 -->
           </td>
           <td>
             <?php echo $value[name].' さん' ?>  <!-- プレイヤー名を表示し、語尾に「 さん」を付ける -->
           </td>
           <td>
             <?php echo $value[score].' pt' ?>  <!-- スコアを表示し、語尾に「 pt」を付ける -->
           </td>
           <td>
             <?php echo 'Lv.'.$value[stagelv] ?>  <!-- 先頭に「Lv.」を付け、ステージレベルを表示する -->
           </td>
         </tr>
         <?php } ?> <!-- foreachの閉じ括弧 -->
        </table>
    </body>
</html>
