<!--チャットでメッセージを表示する機能ページ-->
<?php include "login.php"?>

<?php
//チャットメッセージをデータベースから全て取り出す
if(isset($_POST['getmessage'])) {
  $USER = 'root';
  $PW = 'pass';
  $dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";

  $name = $_SESSION["NAME"];
  $senduser = $_POST["getmessage"];
  $users = [$name,$senduser];

  try{
    $res = "";
    $pdo = new PDO($dnsinfo,$USER,$PW);
    $sql = "SELECT * FROM chatmessage WHERE (username = ? AND senduser = ?) OR (username = ? AND senduser = ?) ;"; //DESC ORDER BY datenow
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($users[0],$users[1],$users[1],$users[0]));

    $i = 0;
    $c = 0;
    $res .= "<div class='{$senduser}' id='sendusername1'></div>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $datetime = substr($row["datenow"],0, -3);
      $c +=1;
      if ($c==1){
        $res .=<<<_CARD
        <!-- メッセージセット style="background-color:rgba(0, 194, 66, 0.9);" -->
        <div class="card mt-4 " >
          <!-- Card content -->
          <div class="card-body">
            <!-- Title -->
            <!--<h5 class="card-title" id="sendusername"><a></a></h5>

            <hr>-->
            <!-- Text 改行を維持するためのスタイルを追加-->
            <p class="card-text black-text" style="font-size:16px;white-space: pre-wrap;">{$row["message"]}</p>
          </div>
        </div>
        <!-- メッセージセット-->
        <p class="text-center mt-2 mb-2">{$datetime}</p>
        _CARD;
        continue;
      }
      if ($row["username"]==$name){
        $res .=<<<_CARD
        <!-- メッセージセット -->
        <div class="card mt-4 ml-5" style="background-color:rgba(0,136,255,0.7);">
          <!-- Card content -->
          <div class="card-body" >
            <!-- Title -->
            <!--
            <h5 class="card-title"><a>自分</a></h5>
            <hr>-->
            <!-- Text  改行を維持するためのスタイルを追加-->
            <h2 class="card-text black-text" style="font-size:16px;white-space: pre-wrap;">{$row["message"]}</h2>
          </div>
        </div>
        <p class="text-left ml-5 mt-2 mb-2 ">{$datetime}</p>
        <p class="ml-5" ><a class="{$row["datenow"]}" onclick="deletemessage('{$row["datenow"]}')" id="{$row["datenow"]}"><i class="fas fa-backspace mr-2"></i>消去</p></a>
        <!-- メッセージセット -->
        _CARD;
      }else if ($row["username"]==$senduser){
        $res .=<<<_CARD
        <!-- メッセージセット -->
        <div class="card mt-4 mr-5">
          <!-- Card content -->
          <div class="card-body">
            <!-- Title -->
            <h5 class="card-title" id="sendusername"><a>{$senduser}</a></h5>
            <hr>
            <!-- Text 改行を維持するためのスタイルを追加-->
            <p class="card-text black-text" style="font-size:16px;white-space: pre-wrap;">{$row["message"]}</p>
          </div>
        </div>
        <!-- メッセージセット-->
        <p class="text-right mr-5 mt-2 mb-2">{$datetime}</p>
        _CARD;
        $i +=1;
      }
    }

    $res .=  "<div class='{$i}' id='messagecount'></div>";

    if ($c==0){
      $res .= "<h5 class='text-center mt-3 text-primary'>{$senduser}へのメッセージを入力してください。</h5>";
    }
    echo $res;
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
?>
