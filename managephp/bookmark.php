<!--ブックマークする機能ページ-->
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
    $sql = "INSERT INTO bookmark(username,enterprise) VALUES(?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($name,$enterprise));
    $res = "OK";
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
 ?>
