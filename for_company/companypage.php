<?php include 'login_for_company.php';?>
<?php include  'getdata_for_company.php';?>

<?php
if(isset($_SESSION["companyID"])){
	$USER = 'root';
	$PW = 'pass';
	$dnsinfo = "mysql:dbname=lip-next;host=localhost;charset=utf8";

	$internshipID=$_GET["page"];

	try{
		$pdo =new PDO($dnsinfo,$USER,$PW);
		$sql="SELECT*FROM internship WHERE internshipID='".$internshipID."';";
		$stmt=$pdo->prepare($sql);
		$stmt->execute(null);

		$pagelay="";

		$row=$stmt->fetch(PDO::FETCH_ASSOC);

		$pagelay.=<<<_INF
<div class="pt-5" >
    <div class="pt-3">
    <h3>インターン詳細</h3>
    </div>
    <div class="pt-5" style="text-align: center;">
    <img src="{$_SESSION["companylogo"]}" alt="のロゴマーク" class="logo">
    <h3 class="mt-4 text-center" style="color:black;"><a href="{$_SESSION["companyurl"]}"  target="_blank" rel="noopener noreferrer">{$_SESSION["companyname"]}<i class="fas fa-link ml-2"></i></a></h3>
    </div>
    <div class="row text-center pt-5">
      <div class="col-12">
        <h4 class="mb-4">企業情報</h4>
        <p>{$_SESSION["companyinfo"]}</p>
        <hr class="mt-4 mb-4">
        <h4 class="mb-4">募集タイプ</h4>
        <p>{$row['internshiptype']}</p>
        <hr class="mt-4 mb-4">
        <h4 class="mb-4">{$row['internshiptype']}内容</h4>
        <p>{$row["internshipoutline"]}</p>
        <hr class="mt-4 mb-4">
        <h4 class="mb-4">どんな学生に合っているか</h4>
        <p>{$row["internshipfor"]}</p>
        <hr class="mt-4 mb-4">
      </div>
      <div class="col-12">
        <h4 class="mb-4">職種</h4>
        <p>{$row["internshipfield"]}</p>
        <hr class="mt-4 mb-4">
        <h4 class="mb-4">{$row['internshiptype']}給与</h4>
        <p>{$row["internshipsalary"]}</p>
        <hr class="mt-4 mb-4">
        <h4 class="mb-4">勤務地</h4>
        <p>{$row["internshiplocation"]}</p>
        <hr class="mt-4 mb-4">
        <h4 class="mb-4">{$row["internshipcondition"]}</h4>
		</div>
	</div>
	</div>
_INF;


	}catch(PDOException $e){
		$pagelay=$e->getMessage();
		echo $pagelay;
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

	<!-- jQueryをCDNから読み込み -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

	<!-- MDB-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.css" rel="stylesheet"/>
    <!-- MDB-->
    <script type="text/javascript" src="shttps://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.js"></script>


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

	<div class="container">
	<div class="row pt-4">
      <p class="col-1"></p>
      <div class="col-10">
        <?php echo $pagelay;?>
      </div>
      <p class="col-1"></p>
    </div>

	</div>
	<!--FOOTER-->
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
	<!--FOOTER終わり-->

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
