<?php include "getdata_for_company.php" ;
if(!isset($_SESSION["companyID"])) {
	$no_login_url = "first_for_company.php?login=0";
	header("Location: {$no_login_url}");
	exit;
}
?>


<!DOCTYPE html>
<html lang="ja" dir="ltr">
	<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>アプリ名</title>
	<!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="../static/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../static/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="../static/css/style.min.css" rel="stylesheet">

    <link href="../static/css/additional.css" rel="stylesheet">

	<!-- MDB-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.css" rel="stylesheet"/>
    <!-- MDB-->
    <script type="text/javascript" src="shttps://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.js"></script>

	
    <!-- jQueryをCDNから読み込み -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>


	
	<!--
    <style type="text/css">
      @media (min-width: 800px) and (max-width: 850px) {
        .navbar:not(.top-nav-collapse) {
          background: #1C2331 !important;
        }
      }
      .navbar{background-color:rgba(0,136,255,0.7);}

    </style>
	-->
	<style>
		.long{
			background-color:#d4f4ff;
			
		}
		/*.day{
			color: white;
			background-color:#006094;
		}*/
	</style>

    

 


    <!-- jQueryをCDNから読み込み -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>



	</head>
	<body>
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

	<!--Main-->
	<main >
	<div class="container">
   		<p class="pt-5"></p>

<!--採用の流れ-->
	<div class="row">
	<h2 class=" col-12 text-center text-primary mt-5"><!--インターン採用の流れ--></h2>
	<div class="card col-lg-3 col-md-6 col-sm-12 long">
		<div class="card-body d-flex align-items-center">
			<h4 class=" text-center ">長期インターン</h4>
			
		</div>
	</div>

	<div class="card col-lg-3 col-md-6 col-sm-12 long">
		<div class="card-body">
			<h4 class="card-title text-center ">1,学生を確認</h4>
			<i class="far fa-id-card fa-7x text-center"></i><!--中央ぞろえにしたい-->
			<p class="card-text">インターンに申し込んだ学生を確認してください。プロフィールボタンでより詳しい情報が見れます。</p>
		</div>
	</div>

	<div class="card col-lg-3 col-md-6 col-sm-12 long">
		<div class="card-body">
			<h4 class="card-title text-center">2,チャット・面接選考</h4>
			<i class="fas fa-comments fa-7x "></i><!--中央ぞろえにしたい-->
			<p class="card-text">チャットボタンを使って学生にコンタクトが取れます。チャットで面接日時を込めてください。</p>
		</div>
	</div>

	<div class="card col-lg-3 col-md-6 col-sm-12 long">
		<div class="card-body">
			<h4 class="card-title text-center">3,採用</h4>
			<i class="far fa-thumbs-up fa-7x "></i><!--中央ぞろえにしたい-->
			<p class="card-text">採用が決定した学生の採用ボタンを押してください。<strong class="text-warning">一度採用ボタンを押すと変更できないので注意してください。</strong></p>
		</div>
	</div>

	<p class="pt-1"></p>
	<!--1DAYイベント-->
	<div class="card col-lg-3 col-md-6 col-sm-12 long">
		<div class="card-body d-flex align-items-center">
			<h4 class=" text-center ">1DAYイベント</h4>
			
		</div>
	</div>
	<div class="card col-lg-3 col-md-6 col-sm-12 long">
		<div class="card-body">
			<h4 class="card-title text-center ">1,学生を確認</h4>
			<i class="far fa-id-card fa-7x  text-center"></i><!--中央ぞろえにしたい-->
			<p class="card-text">インターンに申し込んだ学生を確認してください。プロフィールボタンでより詳しい情報が見れます。</p>
		</div>
	</div>


	<div class="card col-lg-3 col-md-6 col-sm-12 border long">
		<div class="card-body">
			<h4 class="card-title text-center ">2,プロフィール選考</h4>
			<i class="fas fa-clipboard-list fa-7x "></i><!--中央ぞろえにしたい-->
			<p class="card-text"><strong class="text-warning">１DAYイベントは基本的にプロフィールでの選考です。</strong>学生への質問はチャットを使って行ってください。</p>
		</div>
	</div>

	<div class="card col-lg-3 col-md-6 col-sm-12 border long">
		<div class="card-body">
			<h4 class="card-title text-center">3,採用</h4>
			<i class="far fa-thumbs-up fa-7x"></i><!--中央ぞろえにしたい-->
			<p class="card-text">採用が決定した学生の採用ボタンを押してください。<strong class="text-warning">一度採用ボタンを押すと変更できないので注意してください。</strong></p>
		</div>
	</div>

</div>
	<!--採用の流れ-->	

	</div>
	</main>
	<!--Main終わり-->

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