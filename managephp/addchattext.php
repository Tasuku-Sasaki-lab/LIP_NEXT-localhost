<!--チャットでメッセージを加える機能ページ-->
<?php include "login.php" ?>

<?php

//データベースに新しいメッセージを登録
if(isset($_POST['addchattext'])) {
  $USER = 'root';
  $PW = 'pass';
  $dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";

  $addchattext = $_POST["addchattext"];
  $senduser = $_POST["senduser"];
  $addchattext = str_replace("<br/>", "\n", $addchattext);
  $name = $_SESSION["NAME"];

  try{
    $pdo = new PDO($dnsinfo,$USER,$PW);
    $sql = "INSERT INTO chatmessage(username,message,datenow,senduser) VALUES(?,?,now(),?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($name,$addchattext,$senduser));
    $res = "OK";
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
 ?>
