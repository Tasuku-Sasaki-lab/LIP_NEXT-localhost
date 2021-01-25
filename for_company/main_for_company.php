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

    <!-- 企業募集カード 新 -->
   <style>
   .bold {
     font-weight: bold;
   }
   .loop-cplist-inf {
     border-radius: 2vw;
     margin: 3vh 0;
     padding: 3vh 2vw;
     background-color: #d4f4ff;
   }
   .loop-cplist-inf p {
     margin: 0;
     text-align: left;
   }
   .loop-cplist-button {
     margin: 0 auto;
     background-size: 200% 100%;
     background-color: #d4f4ff;
     background-image: -webkit-linear-gradient(left, transparent 50%, rgba(51, 51, 51, 1) 50%);
     background-image: linear-gradient(to right, transparent 50%, rgba(51, 51, 51, 1) 50%);
     -webkit-transition: background-position .3s cubic-bezier(0.19, 1, 0.22, 1) .1s, color .5s ease 0s, background-color .5s ease;
     transition: background-position .3s cubic-bezier(0.19, 1, 0.22, 1) .1s, color .5s ease 0s, background-color .5s ease;
   }
   .loop-cplist-button:hover {
     background-color: #000;
     background-position: -100% 100%;
   }
   .loop-cplist-button a {
     text-decoration: none;
     display: block;
     text-align: center;
   }
   .cpweb {
     background-color: #d4f4ff;
   }
   .cpweb a {
     color: #000;
   }
   .cpweb:hover a {
     color: #fff;
   }
   .apply {
     background-color: #006094;
   }
   .apply a {
     color: #fff;
   }
   .cpweb, .apply {
     border-radius: 1vw;
   }
   @media screen and (max-width:767px){
     .loop-cplist-cpname  {
       font-size: 5vw;
       margin: 3vh 0;
       letter-spacing: 1px;
     }
     .loop-cplist-l, .loop-cplist-r {
       margin: 0 auto;
     }
     .loop-cplist-r {
       width: 97%;
     }
     .loop-cplist-pic-in {
       text-align: center;
     }
     .loop-cplist-pic-in img {
       width: 80%;
     }
     .loop-cplist-button-area {
       display: flex;
     }
     .loop-cplist-button {
       width: 47%;
     }
     .loop-cplist-button a {
       font-size: 3.5vw;
       font-weight: bold;
       padding: 3vw 1vw;
     }
   }
   @media screen and (min-width:767px){

     .loop-cplist-lr {
       display: flex;
       height: 100%;
     }
     .loop-cplist-cpname {
       font-size: 2.3vw;
       letter-spacing: 2px;
    ;   margin-top: 0;
     }
     .loop-cplist-l, .loop-cplist-r {
       margin: 0 auto;
     }
     .loop-cplist-l {
       width: 40%;
     }
     .loop-cplist-r {
       width: 60%;
     }
     .loop-cplist-pic-out {
       height: 100%;
     }
     .loop-cplist-pic-in {
       text-align: center;
       position: relative;
       top: 50%;
       transform: translateY(-50%);
     }
     .loop-cplist-pic-in img {
       width: 70%;
     }
     .loop-cplist-button-area {
       display: flex;
     }
     .loop-cplist-button {
       width: 40%;
     }
     .loop-cplist-button a {
       font-size: 1.4vw;
       font-weight: bold;
       padding: 1vw 1.5vw;
     }


   }


   /*マースオーバーした時に色が変わる*/
   .messageuser {
      background-color:white;
      padding: 10px;
      font-size: 18px;
      -webkit-transition: all 0.3s ease;
      -moz-transition: all 0.3s ease;
      -o-transition: all 0.3s ease;
      transition: all  0.3s ease;
      }
   .rightarrow {
       display:none;
       }
  .messageuser:hover {
      background-color: #ffc9d7;
      padding: 25px;
      font-size: 24px;
      }
      /*マウスオーバーしたらメッセージ表示*/
   .messageuser:hover  .rightarrow {
     display:block;
     margin-top: 12px;
   }

   /*マースオーバーした時に色が変わる*/
   .bookmarkuser {
      background-color:white;
      padding: 10px;
      font-size: 18px;
      -webkit-transition: all 0.3s ease;
      -moz-transition: all 0.3s ease;
      -o-transition: all 0.3s ease;
      transition: all  0.3s ease;
      }
   .rightarrow {
       display:none;
       }
  .bookmarkuser:hover {
      background-color:#b1eeff;
      padding: 25px;
      font-size: 24px;
      }
      /*マウスオーバーしたらメッセージ表示*/
   .bookmarkuser:hover  .rightarrow {
     display:block;
     margin-top: 12px;
   }


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
	<main>
	<div class="container">
   		<p class="pt-5"></p>
		<!--<h2 class="pt-5">インターン一覧</h2>-->
		<?php echo $res;?>

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