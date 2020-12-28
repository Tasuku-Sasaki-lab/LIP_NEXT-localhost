<!--プロフィールを更新する機能ページ-->
<?php include "login.php" ?>

<?php
if(isset($_POST['profiledata'])) {
  $USER = 'root';
  $PW = 'pass';
  $dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";

  $name = $_POST["name"];
  //$mail = $_POST["mail"];
  $phonenumber = (int)$_POST["phonenumber"];
  $university = $_POST["university"];
  $undergraduate = $_POST["undergraduate"];
  $department = $_POST["department"];
  $graduateyear = (int)$_POST["graduateyear"];
  $schoolyear = (int)$_POST["schoolyear"];
  $selfappeal = $_POST["selfappeal"];
  $areaofinterest = $_POST["areaofinterest"];
  $clubinhighscool = $_POST["clubinhighschool"];
  $currentactivity = $_POST["currentactivity"];
  $areaofinterest = str_replace("<br/>", "\n", $areaofinterest);
  $username = $_SESSION["NAME"];
  $usermail = $_SESSION["MAIL"];

  try{
    $pdo = new PDO($dnsinfo,$USER,$PW);
    $sql = "UPDATE loginmanagement SET name=?,phonenumber=?,university=?,undergraduate=?,department=?,graduateyear=?,schoolyear=?,selfappeal=?,areaofinterest=?,clubinhighschool=?,currentactivity=? WHERE name = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($name,$phonenumber,$university,$undergraduate,$department,$graduateyear,$schoolyear,$selfappeal,$areaofinterest,$clubinhighscool,$currentactivity,$username));

    $stmt2 = $pdo->prepare('SELECT * FROM loginmanagement WHERE mail = ? ');
    $stmt2->execute(array($usermail));
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);
    $_SESSION["NAME"] = $row['name'];
    //$_SESSION["MAIL"] = $row['mail'];
    $_SESSION["PHONENUMBER"] = $row['phonenumber'];
    $_SESSION["UNIVERSITY"] = $row['university'];
    $_SESSION["UNDERGRADUATE"] = $row['undergraduate'];
    $_SESSION["DEPARTMENT"] = $row['department'];
    $_SESSION["GRADUATEYEAR"] = $row['graduateyear'];
    $_SESSION["SCHOOLYEAR"] = $row['schoolyear'];
    $_SESSION["SELFAPPEAL"] = $row['selfappeal'];
    $_SESSION["AREAOFINTEREST"] = $row['areaofinterest'];
    $_SESSION["CLUBINHIGHSCHOOL"] = $row['clubinhighschool'];
    $_SESSION["CURRENTACTIVITY"] = $row['currentactivity'];

    $res = "OK";
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
  echo $res;
}
?>
