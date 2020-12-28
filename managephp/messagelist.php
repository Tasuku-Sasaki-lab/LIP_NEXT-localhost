<!--メッセージ一覧を表示する機能ページ-->
<?php include "login.php" ?>

<?php
if(isset($_POST['messagelist'])) {
  $USER = 'root';
  $PW = 'pass';
  $dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";

  $name = $_SESSION["NAME"];
  try{
    $res = "";
    //メッセージの送信者の一覧を表示
    $pdo = new PDO($dnsinfo,$USER,$PW);
    $sql = "SELECT * FROM chatmessage  WHERE username = ?;"; //DESC ORDER BY datenow
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($name));

    $i = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      if(strpos($res,$row['senduser'])){
        $i +=1;
        continue;
      }
      $res .=<<<_CARD
      <!-- メッセージ相手一覧Card  style="background-color:gray; border-radius:2vw;border:1px solid black;"-->
      <div class="mt-1 messageuser">
        <a class="" onclick="messagedisplay('{$row['senduser']}')"  data-toggle="modal" data-target="#chatmodal" data-dismiss="modal"><h4 class="card-title">
        <i class="far fa-comment mr-3 ml-2"></i>{$row['senduser']}<i class="fas fa-arrow-right mr-5 ml-2 rightarrow">メッセージを表示</i></h4>
        </a>
      </div>
      <!-- メッセージ相手一覧Card -->
      _CARD;
      $i +=1;
    }

    if ($i==0){
      $res .=<<<_CARD
      <!-- 表示するメッセージがないとき（新規登録時など）  style="background-color:gray; border-radius:2vw;border:1px solid black;"-->
      <div class="mt-1 text-center" style="color:red;">
        表示するメッセージはありません。
      </div>
      _CARD;
    }
    echo $res;
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
 ?>
