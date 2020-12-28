<!--ブックマーク一覧を表示する機能ページ-->
<?php include "login.php" ?>

<?php
if(isset($_POST['bookmarklist'])) {
  $USER = 'root';
  $PW = 'pass';
  $dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";

  $name = $_SESSION["NAME"];
  try{
    $res = "";
    $pdo = new PDO($dnsinfo,$USER,$PW);
    $sql = "SELECT * FROM bookmark WHERE username = ?"; //DESC ORDER BY datenow  WHERE username = ?;
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($name));

    $i = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $enterprise = $row['enterprise'];
      if(strpos($res,$row['enterprise'])){
        $i +=1;
        continue;
      }
      $res .=<<<_CARD
      <!-- メッセージ相手一覧Card  style="background-color:gray; border-radius:2vw;border:1px solid black;"  target="_blank" rel="noopener noreferrer"-->
      <div class="mt-1 bookmarkuser">
        <a class="black-text"  href="enterprisepage.php?page={$enterprise}"><h4 class="card-title">
        {$enterprise}<i class="fas fa-arrow-right mr-5 ml-2 rightarrow">詳細を表示</i></h4>
        </a>
      </div>
      <!-- メッセージ相手一覧Card -->
      _CARD;

      $i +=1;
    }

    if ($i==0){
      $res .=<<<_CARD
      <!-- 表示するブックマークがないとき（新規登録時など）  style="background-color:gray; border-radius:2vw;border:1px solid black;"-->
      <div class="mt-1 text-center" style="color:red;">
        表示するブックマークはありません。
      </div>
      _CARD;
    }
    echo $res;
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
?>
