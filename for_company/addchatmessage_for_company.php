<?php //include 'login_for_company.php';?>

<?php
//登録していく
if(isset($_POST["addchattext"])){
	$USER = 'root';
	$PW = 'pass';
	$dnsinfo = "mysql:dbname=lip-next;host=localhost;charset=utf8";

	$addchattext = $_POST["addchattext"];
	$chat_internshipID=$_POST["internshipID"];
	$chat_userID=$_POST["userID"];

	$addchattext = str_replace("<br/>", "\n", $addchattext);//改行を補正

	try{
		$pdo=new PDO($dnsinfo,$USER,$PW);
		$sql="INSERT INTO `chat`(`userID`, `InternshipID`, `messagetext`, `sendtime`, `sender`, `chatcondition`) VALUES (?,?,?,now(),'companysend','unread');";//chatconditonを実装
		$stmt=$pdo->prepare($sql);
		$stmt->execute(array($chat_userID,$chat_internshipID,$addchattext));

		$res="登録完了";
		echo $res;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}
?>
