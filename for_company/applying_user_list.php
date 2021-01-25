<?php include 'login_for_company.php';?>

<?php
if (isset($_SESSION['companyID'])) {
    $internshipID=$_GET["internshipID"];

    //申し込み社一覧を取り出す
    if (isset($internshipID)) {
        $USER = 'root';
        $PW = 'pass';
        $dnsinfo = "mysql:dbname=lip-next;host=localhost;charset=utf8";
   
        $pdo=new PDO($dnsinfo, $USER, $PW);
        //sqlの実行文はながいから、変数にしている。
        $sql="SELECT * FROM apply WHERE internshipID ='".$internshipID."';";
        //当該の会社のインターン情報だけ取得
        $stmt=$pdo->prepare($sql);
        $stmt->execute(null);
        $count = $stmt-> rowCount();
        $res="";

        if ($count==0) {
            $res.=<<<_CARD
		<h3 ><strong>申込者はまだいません。</strong></h3>
		_CARD;
        } else {
			$res_1="";
			$res_2="";
            for ($i=0;$i<$count;$i++) {
                $row=$stmt->fetch(PDO::FETCH_ASSOC);

                $pdo_2=new PDO($dnsinfo, $USER, $PW);
                //sqlの実行文はながいから、変数にしている。
                $sql_2="SELECT * FROM user WHERE userID ='".$row["userID"]."';";
                $stmt_2=$pdo->prepare($sql_2);
                $stmt_2->execute(null);
                $row_2=$stmt_2->fetch(PDO::FETCH_ASSOC);

				if($row['recruit']=="yes"){
					$res_1.=<<<_CARD
					<tr>
					<th scope="row">{$row_2['username']}</th>
					<th><button class="btn btn-primary" onclick="profiledisplay({$row_2['userID']})" data-toggle="modal" data-target="#accountmodal"> プロフィール</button></th>
					<th><button class="btn btn-primary" onclick="messagedisplay({$row_2['userID']},{$internshipID},'{$row_2['username']}')" data-toggle="modal" data-target="#chatmodal" >　チャット　</button></th>
					<th>採用済み</th>
					_CARD;

				}else{
                    $res_2.=<<<_CARD
				<tr>
					<th scope="row">{$row_2['username']}</th>
					<th><button class="btn btn-primary" onclick="profiledisplay({$row_2['userID']})" data-toggle="modal" data-target="#accountmodal"> プロフィール</button></th>
					<th><button class="btn btn-primary" onclick="messagedisplay({$row_2['userID']},{$internshipID},'{$row_2['username']}')" data-toggle="modal" data-target="#chatmodal" >　チャット　</button></th>
					<th><button class="btn btn-primary" onclick="recruit({$row_2['userID']})" >　採用する　</button></th>
_CARD;
				}
			}
			$res=$res_1.$res_2;	
        }
    }
}else{
	$no_login_url = "first_for_company.php?login=0";
	header("Location: {$no_login_url}");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=devise-width,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>申し込みユーザー一覧</title>
	 <!-- Font Awesome -->
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="../static/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../static/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="../static/css/style.min.css" rel="stylesheet">

    <link href="../static/css/additional.css" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

	<!-- MDB-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.css" rel="stylesheet"/>
    <!-- MDB-->
    <script type="text/javascript" src="shttps://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.js"></script>

</head>

<body>
	
        <!--チャットモーダル -->
		<div class="modal fade" id="chatmodal" tabindex="-1" role="dialog" aria-labelledby="chatmodallLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content" >

		<!-- チャットモーダルのローディング画面　-->
		
		<div id="loading">
            <div class="spinner"></div>
            <h2 class="mt-2 text-center white-text">少々お待ちください</h2>
          </div>
		
          <div class="modal-header row">
            <h4 class="modal-title col-9" id=""><strong id="headersenduser">名前が入る</strong></h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
		</div>

          <div class="modal-body" id="scroll-box">
            <!--　ここにサーバーから取ってきたデータが入る　 -->
            <div class="" id="addmessage"></div>
          </div>

          <!--メッセージモーダルの下-->
          <div class="ml-2">
			<hr>
            <div class="row amber-textarea active-amber-textarea ml-2" id="inputarea">
              <textarea id="textmessage"  class="md-textarea form-control col-md-10 col-9 mb-3" rows="1" style="max-height:170px;border-radius:2vw;resize: none;"></textarea>
              <a onclick="addmessageclick()"><i class="fas fa-paper-plane fa-2x col-md-2 col-3 mt-1 text-primary" id="sendicon"></i></a>
			</div>
          </div>
        </div>
      </div>
    </div>
	<!--チャット一覧モーダル終了-->

	<!--プロフィールモーダル-->
	<div class="modal fade" id="accountmodal" tabindex="-1" role="dialog" aria-labelledby="accountmodalTitle" aria-hidden="true">
	 
	 <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
	 <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
	 	<div class="modal-content">
		 
		 <div class="modal-header">
              <h4 class="modal-title text-center" id="accountmodalTitle"><strong><i class="far fa-user-circle mr-3 ml-3"></i>プロフィール</strong></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

		 <div class="modal-body row" id="scroll-box-2">
		 <!--ここにサーバーからのデーtがが入る-->
		 <p class="col-md-1"></p>
			<div class="col-md-10">
			<div><small class="text-primary text-muted"> 名前</small></div>
			<div class="border-bottom">タスク</div>
			</div>
		 </div>
		 
		 </div>
	</div>
	</div>
	<!--プロフィールモーダル終了-->

	<script type="text/javascript">
	timer1="";
	/*時間を作る関数*/
	function sleep(waitMsec){
		var startMsec=new Date();
		while(new Date() -startMsec < waitMsec);
	}

	/*自動スクロールのスクリプト*/
	var $scrollY = 0;
            function autoScroll() {
              const spinner = document.getElementById('loading');

              var $sampleBox = document.getElementById("scroll-box");
              $sampleBox.scrollTop = ++$scrollY;
              $sampleBox.scrollTop = $sampleBox.scrollHeight;

              //console.log($sampleBox.scrollHeight);
              //console.log($sampleBox.clientHeight);
              //console.log($scrollY)
              //console.log($sampleBox.scrollTop)

              if( $scrollY < $sampleBox.scrollHeight - $sampleBox.clientHeight ){
                $scrolly=$sampleBox.scrollHeight - $sampleBox.clientHeight;
                //console.log($sampleBox.scrollHeight - $sampleBox.clientHeight);
                //console.log($scrollY);
                //console.log("OK");
                spinner.classList.add('loaded');
                //console.log("Finish");
                return;
                setTimeout( "autoScroll()", 1 );
              }else if($scrollY == $sampleBox.scrollHeight - $sampleBox.clientHeight){
                spinner.classList.add('loaded');
                //console.log("Finish");
                return;
              }else{
                  $scrollY = 0;
                  $sampleBox.scrollTop =0;
                  setTimeout( "autoScroll()", 1 );
            }
		  }
		  
	/*メッセージを表示する関数*/
	function messagedisplay(userID,internshipID,username) {
var postdata = {
  "userID": userID,
  "internshipID":internshipID,
  "username":username
};

const spinner = document.getElementById('loading');
spinner.classList.add('loaded');
$.ajax({
  
  //POST通信
  type: "POST",
  //ここでデータの送信先URLを指定します。
  url: "getchatdata_for_company.php",
  data: postdata,
  //処理が成功したら
  success: function (data) {
	  //console.log("OK1");
	var myh2 = document.getElementById("scroll-box");
	myh2.innerHTML = data;
	var myh3 = document.getElementById("headersenduser");
	myh3.innerHTML = username;

	//メッセージの数をローカルストレージに保存
	//let messagecount = document.getElementById("messagecount").className;
	//localStorage.setItem(senduser, messagecount);
	autoScroll();
	//チャットの入力欄を複数行に自動調整  ここに書かないとajax通信後に動作しない
	$(function () {
	  var $textarea = $('#textmessage');
	  var lineHeight = parseInt($textarea.css('lineHeight'));
	  $textarea.on('input', function (e) {
		var lines = ($(this).val() + '\n').match(/\n/g).length;
		$(this).height(lineHeight * lines);
	  });
	});
  },
  error: function () {
	alert("error");
  }
});
return false;
}

		
	/*メッセージを追加する関数*/
	function addmessageclick(){
		let textmessage=document.getElementById("textmessage").value;//入力内容をvalueで取得
		if(textmessage.length==0){
			return;
		}
		var internshipID=<?php echo $internshipID;?>;

		let userID=document.getElementById("sendusername1").className;//クラス名前で送る人を取得？;
		let username=document.getElementById("headersenduser").textContent;


		var postdata ={"addchattext":textmessage,"userID":userID,"internshipID":internshipID};
		//$.post({
              //ここでデータの送信先URLを指定します。
              //"addchattext.php?",
              //postdata,
              //処理
		
		$.ajax({
			//POST通信
			type:"POST",
			//ここでurlの指定
			url:"addchatmessage_for_company.php",
			data:postdata,
			//処理が成功したら
			success:function(data){
				messagedisplay(userID,internshipID,username);
			},error:function(){
				alert("error_addchattext");
			}
		});

		var myth3=document.getElementById("inputarea");
		myth3.innerHTML=`<!-- テキストエリア -->
            <!--Textarea with icon prefix-->
            <textarea id="textmessage" class="md-textarea form-control col-md-10 col-9 mb-3" rows="1" style="max-height:170px;border-radius:2vw;resize: none;"></textarea>
            <a onclick="addmessageclick()"><i class="fas fa-paper-plane fa-2x col-md-2 col-3 mt-1 text-primary"></i></a>
            <!--<label for="form22">メッセージを入力</label>-->
            `;
            return false;
	}	



		/*メッセージを消去する関数*/
		function deletemessage(id){
          //let classdate = document.getElementById("thismessage").className;
          //let classdate = classdate;
          //let valuedate = $('#thismessage').val();
		  //console.log(id);
		  
		  let username=document.getElementById("headersenduser").textContent;
		  var internshipID=<?php echo $internshipID;?>;
		  let userID=document.getElementById("sendusername1").className;

          var postdata ={"id":id};
          const spinner = document.getElementById('loading');
          spinner.classList.add('loaded');
          $.ajax({
            //POST通信
            type: "POST",
            //ここでデータの送信先URLを指定します。
            url: "deletechatmessage_for_company.php",
            data:postdata,
            //処理が成功したら
            success:function(data) {

            messagedisplay(userID,internshipID,username);

          },error:function(){
            alert("error-delete");
          }
        });
       //console.log("OK1");

        //setTimeout( "messagedisplay()", 3000 );
        return false;
        }

		
		function messagerenew(){
          let senduser = document.getElementById("sendusername1").className;
          messagedisplay(senduser);
          return;
		}
		
		
		//プロフィールを表示させる関数
		function profiledisplay(userID){
			var postdata = {
    "getmessage": userID
  };

  $.ajax({
	  //POST通信
	  type:"POST",
	   //ここでデータの送信先URLを指定します。
	   url: "getprofiledata_for_company.php",
    data: postdata,
	//処理が成功したら
	success:function(data){
		console.log("OK2");
		var myh4=document.getElementById("scroll-box-2");
		myh4.innerHTML=data;

	},error:function(){
		alert("error at ajax");
	}
  });
		  return false;
		}

	//採用する関数
	function recruit(userID){
		var result=window.confirm('採用しますか？　OKを押すと採用取り消しすることはできません。');
		if(result){
			var internshipID=<?php echo $internshipID;?>;

			var postdata={
				"userID":userID,
				"internshipID":internshipID
			};

			$.ajax({
			//POST通信
			type:"POST",
			url:"recruit.php",
			data:postdata,
			
			//処理が成功したらリロード
			success:function(data){
				//reroad キャッシュを残す
				window.location.reload(false);
			},
			error:function(){
				alert("error");
			}
			});

		}else{
			return true;
		}
		return false;
	}

	</script>

	<!-- Navbar primary-color　透過させない方法をききたい-->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
      <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="main_for_company.php" >
          <strong>ホーム</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" target="_blank" href="">利用案内</a>
            </li>
			<!--
            <li class="nav-item">
              <a class="nav-link" href="companypage.php">会社紹介ページ</a>
			</li>
			-->
			<li class="nav-item">
              <a class="nav-link"  type="submit" href="logout_for_company.php">ログアウト</a>
            </li>
          </ul>
        </div>

      </div>
    </nav>
    <!-- Navbar -->


	<div class="container">
	<p class="pt-5 pb-2"></p>
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">名前</th>
				<th scope="col">プロフィール</th>
				<th scope="col">チャット</th>
				<th scope="col">採用する</th>
			</tr>
		</thead>

		<tbody>
		<?php echo $res;?>
		</tbody>

	</table>
	</div>



	<!--Footer-->
    <footer class="page-footer font-small mt-4 footerinfo" style="background-color:black;">
      <div class="pt-3"></div>
      <div class="text-center pt-4">
        <h2 class="text-center">ロゴマーク・株式会社Re-VOL.Inc.</h2>
        <p class="feature-title font-bold mb-1 mt-3" style="font-size:18px;"><span style="background: linear-gradient(transparent 50%, #0099FF 95%);">
          Re-VOL.Inc.(リボル)は神戸の学生をEMPOWERする企業です。</span></p>
      </div>

      <div class="row mt-4">
        <div class="col-md-1"></div>
        <div class="col-md-5 mt-3" style="font-size:15px;">
          <p class="mt-1 text-center">神戸市中央区小野柄通3丁目1-11 芙蓉ビル 302</p>
          <p class="mt-1 text-center">設立:2019年3月4日</p>
          <p class="mt-1 text-center">資本金:6,000,000円</p>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-3" style="font-size:15px;">
          <p class="font-bold mt-1 text-md-left text-center"><i class="fas fa-info fa-x mr-4" aria-hidden="true"></i><a href="https://re-vol.net/">企業ページ</a></p>
          <p class="font-bold mt-1 text-md-left text-center"><i class="fas fa-reply fa-x mr-4" aria-hidden="true"></i><a href="../contact/contact.php">お問い合わせ</a></p>
          <p class="font-bold mt-1 text-md-left text-center"><i class="fas fa-shield-alt fa-x mr-4" aria-hidden="true"></i><a href="privacypolicy_for_company.php">個人情報保護方針</a></p>
          <p class="font-bold mt-1 text-md-left text-center"><i class="fas fa-check fa-x mr-4" aria-hidden="true"></i><a href="userpolicy_for_company.php">利用規約</a></p>
        </div>
        <div class="col-md-1"></div>
      </div>

      <!--Copyright-->
      <div class="footer-copyright py-3 pt-2 text-center" >
        © 2020 Copyright:
        <a href="https://re-vol.net/" target="_blank"> Re-VOL.Inc. </a>
      </div>
      <!--/.Copyright-->
    </footer>
    <!--/.Footer-->

	 <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="../static/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../static/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../static/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../static/js/mdb.min.js"></script>
    <!-- Initializations -->
    <script type="text/javascript">
      // Animations initialization
      new WOW().init();
    </script>
</body>
</html>