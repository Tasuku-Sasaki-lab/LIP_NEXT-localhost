<?php
	if(isset($_POST["getmessage"])){
		$USER = 'root';
		$PW = 'pass';
		$dnsinfo = "mysql:dbname=lip-next;host=localhost;charset=utf8";

		$userID=$_POST["getmessage"];


	   
		try{
			$res="";
			$pdo = new PDO($dnsinfo,$USER,$PW);

			$sql="SELECT*FROM user WHERE userID='".$userID."'"; //WHERE mail='".$email."'
			$stmt=$pdo->prepare($sql);
			$stmt->execute(null);

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$profile=array('username'=>'名前','useruniversity'=>'大学',
		'userundergraduate'=>'学部','userdepartment'=>'学科','usergraduateyear'=>'卒業年',
		'userschoolyear'=>'学年','userselfappeal'=>'自己アピール','userareaofinterest'=>'興味のある職種',
		'userclubinhighschool'=>'高校時代の部活','usercurrentactivity'=>'サークル');

        foreach ($row as $key=>$valu) {
            if ($key=='userID'|$key=='usermail'||$key=='userpasswd'||$key=='userphonenumber'||$key=='usercondition'||$key=='usersignupday') {
                continue;
            }
			if($valu!=null){//$valu==0(null in year)
				if(($key=='usergraduateyear'||$key=='userschoolyear')&&$valu==0){
					$res.=<<<_CARD
			<p class="col-md-1"></p>
			<div class="col-md-10">
			<div><small class="text-primary text-muted"> {$profile[$key]}</small></div>
			<div class="border-bottom">登録されていません</div>
			</div>
			<p class="col-md-1"></p>			
			_CARD;
				}else{
                $res.=<<<_CARD
			<p class="col-md-1"></p>
			<div class="col-md-10">
			<div><small class="text-primary text-muted"> {$profile[$key]}</small></div>
			<div class="border-bottom">{$valu}</div>
			</div>
			<p class="col-md-1"></p>			
			_CARD;
				}
            }else{
				$res.=<<<_CARD
			<p class="col-md-1"></p>
			<div class="col-md-10">
			<div><small class="text-primary text-muted"> {$profile[$key]}</small></div>
			<div class="border-bottom">登録されていません</div>
			</div>
			<p class="col-md-1"></p>			
			_CARD;
			}
    		}
			echo $res;

		}catch(PDOException $e){
			$res=$e->getMessage();
			echo $res;
		}

	}else{
		$res="post通信できませんでした。";
		echo $res;
	}
?>