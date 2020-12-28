<!--企業の募集一覧を表示する機能ページ-->
<?php
if(isset($_POST['param2'])) {
  $USER = 'root';
  $PW = 'pass';
  $dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";

  //データベースに接続
  try {
    $pdo = new PDO($dnsinfo,$USER,$PW);
  } catch (\Exception $e) {
    $res = $e->getMessage();
  }

  $enterprisename = $_POST['param2'];
  try{
    $res = "";
    $sql = "SELECT * FROM internships2  WHERE InternshipName = ?;"; //DESC ORDER BY datenow
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($enterprisename));

    $i = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

      /*if(strpos($res,$row['InternshipName'])){
        $i +=1;
        continue;
      }*/

      if($row['InternshipType']=="長期インターンシップ"){
        $res .=<<<_CARD
        <!-- メッセージ相手一覧Card  style="background-color:gray; border-radius:2vw;border:1px solid black;"-->
        <div class="mt-1 enterprisematter">
          <a class="" href="enterprisepage0.php?page={$row['InternshipName']}"><h4 class="card-title black-text">
          <i class="fas fa-check mr-3 ml-2"></i>インターンシップ<i class="fas fa-arrow-right mr-5 ml-2 rightarrow">詳細を表示</i></h4>
          </a>
        </div>
        <!-- メッセージ相手一覧Card -->
        _CARD;
      }else if ($row['InternshipType']=="OneDayイベント"){
        $res .=<<<_CARD
        <!-- メッセージ相手一覧Card  style="background-color:gray; border-radius:2vw;border:1px solid black;"-->
        <div class="mt-1 enterprisematter">
          <a class="" href="enterprisepage1.php?page={$row['InternshipName']}"><h4 class="card-title black-text">
          <i class="fas fa-calendar-day mr-3 ml-2"></i>１dayイベント<i class="fas fa-arrow-right mr-5 ml-2 rightarrow">詳細を表示</i></h4>
          </a>
        </div>
        <!-- メッセージ相手一覧Card -->
        _CARD;
      }

      $i +=1;
    }

    if ($i==0){
      $res .=<<<_CARD
      <!-- 表示するメッセージがないとき（新規登録時など）  style="background-color:gray; border-radius:2vw;border:1px solid black;"-->
      <div class="mt-1 text-center" style="color:red;">
        募集中の案件はありません。
      </div>
      _CARD;
    }

    echo $res;
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}

?>
