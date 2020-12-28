<!--ブックマークを解除する機能ページ-->
<?php include "login.php" ?>

<?php
if(isset($_POST['param'])) {
  $USER = 'root';
  $PW = 'pass';
  $dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";

  $enterprise = $_POST["param"];
  $name = $_SESSION["NAME"];
  try{
    $pdo = new PDO($dnsinfo,$USER,$PW);
    $sql = "DELETE FROM bookmark WHERE username = ? AND enterprise = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($name,$enterprise));
    $res = "OK";
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
 ?>
