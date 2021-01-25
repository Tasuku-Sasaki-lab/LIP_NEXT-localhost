<?php
if(isset($_POST["id"])){
	$USER = 'root';
	$PW = 'pass';
	$dnsinfo = "mysql:dbname=lip-next;host=localhost;charset=utf8";

	$chatid=$_POST["id"];

	try{
		$pdo=new PDO($dnsinfo,$USER,$PW);
		$sql="DELETE FROM chat WHERE chatid='".$chatid."';";
		$stmt=$pdo->prepare($sql);
		$stmt->execute(null);

		$res="";
		echo $res;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}
?>