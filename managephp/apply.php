<!--インターンシップ申し込み機能ページ-->
<?php include "login.php" ?>
<?php
if(isset($_POST['applydata'])) {
  $USER = 'root';
  $PW = 'pass';
  $dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";

  $textmessage = $_POST["textmessage"];
  $senduser = $_POST["senduser"];
  $name = $_SESSION["NAME"];
  try{
    $pdo = new PDO($dnsinfo,$USER,$PW);
    $sql = "INSERT INTO chatmessage(username,message,datenow,senduser) VALUES(?,?,now(),?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($name,$textmessage,$senduser));

    $res = "OK";
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
?>
