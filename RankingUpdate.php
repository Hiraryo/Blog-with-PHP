<html>
    <head>
        <title>PHP Test</title>
    </head>
    <body>
        <?php
          $data[] = array('year' => 1999, 'volume' => 12, 'author_id' => 1);
          $data[] = array('year' => 1990, 'volume' => 9, 'author_id' => 2);
          $data[] = array('year' => 2004, 'volume' => 15, 'author_id' => 2);
          $data[] = array('year' => 2008, 'volume' => 18, 'author_id' => 1);
          $data[] = array('year' => 1982, 'volume' => 8, 'author_id' => 3);

          //列方向の配列を得る
          foreach ($data as $key => $row) {
            $year[$key] = $row['year'];
            $volume[$key] = $row['volume'];
            $edition[$key] = $row['author_id'];
          }

          //データをyearの降順、volumeの昇順にソートする。
          //$dataを最後のパラメータとして渡し、同じキーでソートする。
          array_multisort($year, SORT_DESC, $volume, SORT_ASC, $data);
        ?>
        <?php
          foreach ($data as $key => $row) {
            echo $row['year'];
            echo "<br />";
          }
        ?>
    </body>
</html>
