<?php require 'login_for_company.php';?>

<?php
if(isset($_SESSION["companyID"])){
if (isset($_POST['userID'])) {
    //チャットメッセージをデータベースから全て取り出す
    $USER = 'root';
    $PW = 'pass';
    $dnsinfo = "mysql:dbname=lip-next;host=localhost;charset=utf8";
    $orderPattern = "new";

    //$companyID=$_SESSION["companyID"];
	$userID = $_POST["userID"];
	$internshipID=$_POST["internshipID"];
	$username=$_POST['username'];
	


    try {
		$chat="";
		$pdo = new PDO($dnsinfo,$USER,$PW);
		//$sql = "INSERT INTO chatmessage(username,message,datenow) VALUES(?,?,now())";
		//echo $sql;
		$sql = "SELECT * FROM chat WHERE userID='".$userID."' AND internshipID='".$internshipID."';"; //DESC ORDER BY datenow
		$stmt = $pdo->prepare($sql);
		$stmt->execute(null);

		$i=0;
		$c=0;

		
		$chat .= "<div class='{$userID}' id='sendusername1'></div>";
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){


			$datetime = substr($row["sendtime"],0, -3);
	  
			$c +=1;
	  
			
	  
	  
	  
			if ($row["sender"]=='companysend'){
			  $chat .=<<<_CARD
			  <!-- メッセージセット -->
			  <div class="card mt-4 ml-5" style="background-color:rgba(0,136,255,0.7);">
				<!-- Card content -->
				<div class="card-body" >
				  <!-- Title -->
				  <!--
				  <h5 class="card-title"><a>自分</a></h5>
				  <hr>-->
				  <!-- Text  改行を維持するためのスタイルを追加-->
				  <h2 class="card-text black-text" style="font-size:16px;white-space: pre-wrap;">{$row["messagetext"]}</h2>
				</div>
			  </div>
	  
			  <p class="text-left ml-5 mt-2 mb-2 ">{$datetime}</p>
			  <p class="ml-5" ><a class="{$row["sendtime"]}" onclick="deletemessage('{$row["chatid"]}')" id="{$row["chatid"]}"><i class="fas fa-backspace mr-2"></i>消去</p></a>
	  
			  <!-- メッセージセット -->
_CARD;
			}else if ($row["sender"]=='usersend'){
	  
			  $chat .=<<<_CARD
			  <!-- メッセージセット -->
			  <div class="card mt-4 mr-5">
				<!-- Card content -->
				<div class="card-body">
				  <!-- Title -->
				  <h5 class="card-title" id="sendusername"><a>{$username}</a></h5>
	  
				  <hr>
				  <!-- Text 改行を維持するためのスタイルを追加-->
				  <p class="card-text black-text" style="font-size:16px;white-space: pre-wrap;">{$row["messagetext"]}</p>
				</div>
			  </div>
			  <!-- メッセージセット-->
			  <p class="text-right mr-5 mt-2 mb-2">{$datetime}</p>
_CARD;
	  
			  $i +=1;
	  
			}
	  
	  
			//<a class="pl-5 ml-5" onclick="deletemessage()" value="{$row["datenow"]}" id="thismessage" name="thismessage"><i class="fas fa-backspace mr-2"></i>消去</a>
			/*
			$res .= <<<_DIV1
			<div class="" id="addmessage"></div>
			_DIV1;*/
		  }
	  
	  
	  
	  
	  
		 
	  
		  $chat .=  "<div class='{$i}' id='messagecount'></div>";
	  
		  if ($c==0){
			$chat .= "<h5 class='text-center mt-3 text-primary'>{$username}へのメッセージを入力してください。</h5>";
		  }
	  
		  echo $chat;
	}
	catch(PDOException $e){
		$caht=$e->getMessage();
		echo $chat;
	}
}else{
	$chat="senduserをpoatdataで送れていない";
	echo $chat;
}
}else{
	$no_login_url = "first_for_company.php?login=0";
	header("Location: {$no_login_url}");
	exit;
}
?>