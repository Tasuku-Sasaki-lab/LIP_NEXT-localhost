<!--チャットでメッセージを消去する機能ページ-->
<?php include "login.php" ?>

<?php
if(isset($_POST['classdate'])) {
  $USER = 'root';
  $PW = 'pass';
  $dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";

  $name = $_SESSION["NAME"];
  $valuedate = $_POST["classdate"];
  try{
    $res = "";
    $pdo = new PDO($dnsinfo,$USER,$PW);
    $sql = "DELETE FROM chatmessage WHERE datenow = ? AND username = ?"; //DESC ORDER BY datenow
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($valuedate,$name));
    echo $res;
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
?>
