<!--　トップページ　 created by Hirokazu Niimoto-->
<!--ログインが外れないようにはしないといけない-->
<?php //include "managephp/getdata.php"?>
<?php include "managephp/signup.php" ?>
<?php include "managephp/login.php"?>
<?php
/** JavaScript出力開始 */
//echo <<<EOM

//EOM;
/** JavaScript出力終了 */
 ?>


 <?php
 
 //スライドショーの機能
 $USER='root';
 $PW='pass';
 $dnsinfo="mysql:dbname=internshiptest;host=localhost;charset=utf8";
 $orderPattern = "new";

	$pdo=new PDO($dnsinfo,$USER,$PW);
	//$sql=INSERT INTO companies VALUES(ID,'Name','Logo')
	$sql="SELECT * FROM companies;";
	$stmt=$pdo->prepare($sql);
	$stmt->execute(null);
	$count = $stmt-> rowCount();
	$res="";

	$res.=<<<_LOGO
	<div class="row mb-5">
	_LOGO;

    for ($i=1;$i<=3;$i++) {
        $res.=<<<_LOGO
	<div id="carouselExampleSlidesOnly" class="carousel slide col-4 pr-0 pl-0" data-ride="carousel">
	<div class="carousel-inner">
	_LOGO;

	$row=$stmt->fetch(PDO::FETCH_ASSOC);
		$res.=<<<_LOGO
	<div class="carousel-item active">
	<img class="d-block w-100" src="{$row['Logo']}">
	</div>
	_LOGO;

    if ($i!=3) {
        for ($j=1;$j<=ceil($count/3)-1;$j++) {
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            $res.=<<<_LOGO
	<div class="carousel-item">
		<img class="d-block w-100" src="{$row['Logo']}">
	</div>
	_LOGO;
        }
    }else{
		for ($j=1;$j<=$count-2*ceil($count/3)-1;$j++) {
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            $res.=<<<_LOGO
	<div class="carousel-item">
		<img class="d-block w-100" src="{$row['Logo']}">
	</div>
	_LOGO;
        }
	}

        $res.=<<<_LOGO
	</div>
	</div>
	_LOGO;
    }
	$res.=<<<_LOGO
	</div>	
	_LOGO;
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>アプリ名</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="static/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="static/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="static/css/style.min.css" rel="stylesheet">

    <link href="static/css/additional.css" rel="stylesheet">

    <style type="text/css">
      @media (min-width: 800px) and (max-width: 850px) {
        .navbar:not(.top-nav-collapse) {
          background: #1C2331 !important;
        }
      }
      .navbar{background-color:rgba(0,136,255,0.7);}

    </style>


  </head>
  <body>

    <!-- ローディング画面-->
    <div id="loading">
      <div class="spinner"></div>
      <h2 class="mt-2 text-center white-text">少々お待ちください</h2>
    </div>

        <form class="" action="" method="post">
          <!--ログインモーダル-->
          <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">ログイン</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body mx-3">
                <div class="md-form mb-5">
                  <i class="fas fa-envelope prefix grey-text"></i>
                  <input type="email" id="defaultForm-email" class="form-control validate" name="userinfo">
                  <label data-error="wrong" data-success="right" for="defaultForm-email">メールアドレス</label>
                </div>

                <div class="md-form mb-4">
                  <i class="fas fa-lock prefix grey-text"></i>
                  <input type="password" id="defaultForm-pass" class="form-control validate" name="password">
                  <label data-error="wrong" data-success="right" for="defaultForm-pass">パスワード</label>
                </div>

              </div>

              <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary" type="submit" name="login">ログイン</button>
                <p class="mt-3 ml-2">または</p>
                <!--<button class="btn btn-primary ml-2">新規登録</button>-->
                <a href="" class="" data-dismiss="modal" data-toggle="modal" data-target="#modalRegisterForm">新規登録</a>
              </div>

              <div class="pt-2">
                <?php echo $errorMessage ?>
              </div>
            </div>

          </div>
        </div>
          <!--ログインモーダル終わり-->
      </form>

        <form class="" action="main.php" method="post">
          <!--新規登録モーダル-->
          <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">新規登録</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body mx-3">
                <div class="md-form mb-5">
                  <i class="fas fa-user prefix grey-text"></i>
                  <input type="text" id="orangeForm-name" class="form-control validate" name="username">
                  <label data-error="wrong" data-success="right" for="orangeForm-name">ユーザー名</label>
                </div>
                <div class="md-form mb-5">
                  <i class="fas fa-envelope prefix grey-text"></i>
                  <input type="email" id="orangeForm-email" class="form-control validate" name="usermail">
                  <label data-error="wrong" data-success="right" for="orangeForm-email">メールアドレス</label>
                </div>

                <div class="md-form mb-4">
                  <i class="fas fa-lock prefix grey-text"></i>
                  <input type="password" id="orangeForm-pass1" class="form-control validate" name="password">
                  <label data-error="wrong" data-success="right" for="orangeForm-pass1">パスワード</label>
                </div>

                <div class="md-form mb-4">
                  <i class="fas fa-lock prefix grey-text"></i>
                  <input type="password" id="orangeForm-pass2" class="form-control validate" name="password2">
                  <label data-error="wrong" data-success="right" for="orangeForm-pass2">パスワード（確認）</label>
                </div>

              </div>
              <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-deep-orange" name="signUp">登録</button>
              </div>

              <div class="pt-2">
                <?php echo $errorMessage ?>
              </div>
            </div>
          </div>
        </div>
          <!--新規登録モーダル終わり-->

        </form>

        
    <!-- Navbar primary-color-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
      <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="main.php" >
          <strong>アプリ名</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="outline.php" >利用案内</a>
			</li>
			<!--
            <li class="nav-item">
              <a class="nav-link" href="search.php" >検索</a>
			</li>
	         -->
            <!--
            <li class="nav-item">
              <a class="nav-link" href="" target="_blank">アカウント</a>
            </li>
		  -->
		  <!--
            <li class="nav-item">
              <a class="nav-link" href="" target="_blank">問い合わせ</a>
			</li>
	    -->
            <li class="nav-item">
              <a class="nav-link" href="" target="_blank">会社一覧</a>
            </li>
          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="https://www.facebook.com/sharer/sharer.php?u=" class="nav-link">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="https://twitter.com/share" class="nav-link">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link border border-light rounded" data-toggle="modal" data-target="#modalLoginForm">
                <i class="fas fa-sign-in-alt mr-2"></i>ログイン
              </a>
            </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->



    <!-- Full Page Intro -->  <!--https://photohito.k-img.com/uploads/photo130/user129768/a/7/a74efb58fa3d98eedb1a35afa7b7bcb5/a74efb58fa3d98eedb1a35afa7b7bcb5_l.jpg    background-attachment: fixed;-->
    <div class="view full-page-intro" style="background-image: url('https://careergarden.jp/dtp-designer/wp-content/blogs.dir/388/files/4a2631ded52c08e466396b3f7a2c6f97.jpg');background-color:rgba(0,98,255,0.4); background-repeat: no-repeat; background-size: cover;">


      <!-- Mask & flexbox options--> <!--mask rgba-black-light-->
      <div class="mask rgba-black-light d-flex justify-content-center align-items-center ">

        <!-- Content -->
        <div class="container">

          <!--Grid row-->
          <div class="row wow fadeIn pt-5 white-text">

            <!--Grid column-->
            <div class="col-md-12  mb-5 pt-5 text-center text-md-left">

              <p class="pt-5"></p>
              <h1 class="apptitle font-weight-bold text-center white-text">アプリ名</h1>

              <!--<hr class="hr-light">-->

              <!--
              <h3 class="pt-5 text-center appcopy">
                <strong>キャッチコピー</strong>
              </h3>
            -->


              <!--d-none d-md-block-->
              <p class="mt-5 pt-2 text-center appexplain white-text">
				<strong>すべては学生のために。<br>私たちがあなたにできることは、就活の選択肢を増やすことです。
				<br>こうして生まれたのが、アプリ名です。
              </p>


	  		<!--インターンシップを探す　モーダル
              <div class="pt-1"></div>
              <div class="row pt-3">
                <p class="col-md-4 col-1"></p>
                <button class="btn btn-primary btn-lg col-md-4 col-10" data-toggle="modal" data-target="#exampleModalCenter">インターンシップを探す
                  <i class="fas fa-search ml-2"></i>
                </button>
                <p class="col-md-4 col-1"></p>
			  </div>
			インターンシップを探すモーダル　終了-->
              
              <div class="row icon1 pt-2">
                <p class="col-md-5"></p>
                <a href="#allinternship" class="col-md-2 text-center text-light"><i class="fas fa-3x fa-angle-double-down yureru-j"></i></a>
                <p class="col-md-5"></p>
              </div>



            </div>
            <!--Grid column-->


          </div>
          <!--Grid row-->

        </div>
        <!-- Content -->


      </div>
      <!-- Mask & flexbox options-->


    </div>
    <!-- Full Page Intro -->



    <a name="allinternship" class="pt-5"></a>
    <p class="pt-4"></p>

    <!--Main layout-->
    <main>
      <div class="container">
<!--スライド始まり-->
<?php echo $res;?>
<!--スライド終わり-->


<div class="row mt-4">
<h2 class=" col-12 text-center text-secondary mt-5">２つのプログラム</h2>
<!-- Card -->
<div class="card col-lg-6 col-sm-12 mt-4 border border-secondary">

<!-- Card image -->
<!--<img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/43.jpg" alt="Card image cap">-->

<!-- Card content -->
<div class="card-body">

  <!-- Title -->
  <h4 class="card-title text-secondary"><a>LIP(Long Internship Program)</a></h4>
  
  <!-- Card image -->
  <!--
  <img src="https://i0.wp.com/ardent.jp/rentoffice-consultation-center/wp-content/uploads/2019/06/190520-1701_24l.jpg?fit=640%2C425&ssl=1" class="img-fluid" alt="Responsive image">
	-->
  <!-- Text -->
  <p class="card-text"><strong>実務でしか得られない経験がある</strong></p>
  <p class="card-text">LIP(Long Internship Program)は、長期インターンシップを通して、夢を持つ学生に力を与えるプログラムです。</p>
  <p class="card-text">神戸で唯一長期インターンを紹介しています。自分にあった企業を見つけて参加できます。</p>
  <!-- Button -->
  <!--<a href="#" class="btn btn-primary">Button</a>-->

</div>

</div>
<!-- Card -->



<!-- Card -->
<div class="card col-lg-6 col-sm-12 mt-4 border border-secondary">

  <!-- Card content -->
  <div class="card-body">

    <!-- Title -->
	<h4 class="card-title text-secondary"><a>LIP SUMMIT</a></h4>
	<!-- Card image -->
	<!--
	<img src="https://i0.wp.com/ardent.jp/rentoffice-consultation-center/wp-content/uploads/2019/06/190520-1701_24l.jpg?fit=640%2C425&ssl=1" class="img-fluid" alt="Responsive image">
	-->
    <!-- Text -->
	<p class="card-text"><strong>アイデアを実務で試せる。</strong></p>
	<p class="card-text">一日完結型のイベント</p>
	<p class="card-text">学生からフィードバックやアイデアを聞きたい企業が、学生を集めたミーティングを開き、そこへ学生が参加します。新商品,サービス,戦略の企画、フィードバックします</p>
    <!-- Button -->
    <!--<a href="#" class="btn btn-primary">Button</a>-->

  </div>
</div>
</div>


<!-- 活用の流れ始まり-->
<div class="row">
	<h2 class=" col-12 text-center text-primary mt-5">アプリ名活用の流れ</h2>
	<div class="card col-lg-3 col-md-6 col-sm-12 border border-primary">
		<div class="card-body">
			<h4 class="card-title text-center text-primary">ログイン</h4>
			<i class="far fa-id-card fa-7x blue-text"></i><!--中央ぞろえにしたい-->
			<p class="card-text">プロフィールを充実させることで採用成功率が上昇します。</p>
		</div>
	</div>

	<div class="card col-lg-3 col-md-6 col-sm-12 border border-primary">
		<div class="card-body">
			<h4 class="card-title text-center text-primary">探す</h4>
			<i class="fas fa-search fa-7x blue-text text-center"></i><!--中央ぞろえにしたい-->
			<p class="card-text">20社に会社のインターンや１dayイベントのなから自分にあったものを探しましょう。</p>
		</div>
	</div>

	<div class="card col-lg-3 col-md-6 col-sm-12 border border-primary">
		<div class="card-body">
			<h4 class="card-title text-center text-primary">申し込む</h4>
			<i class="far fa-envelope fa-7x blue-text"></i><!--中央ぞろえにしたい-->
			<p class="card-text">申し込み方法は長期インターンと1dayイベントによって異なります。</p>
		</div>
	</div>

	<div class="card col-lg-3 col-md-6 col-sm-12 border border-primary">
		<div class="card-body">
			<h4 class="card-title text-center text-primary">働く</h4>
			<i class="fas fa-laptop fa-7x blue-text"></i><!--中央ぞろえにしたい-->
			<p class="card-text">採用されたら実際に働きましょう！見知らぬ世界にであうかも。</p>
		</div>
	</div>
</div>
<!-- 利用の流れ終了-->

<!--応募の方法始まり-->
<div class="row">
	<h2 class=" col-12 text-center text-secondary mt-5">応募のやり方</h2>
	<div class="card col-lg-6 col-sm-12 mt-4 border-secondary">
<!-- Card content -->
<div class="card-body">

  <!-- Title -->
  <h4 class="card-title text-secondary"><a>LIP(Long Internship Program)の場合</a></h4>
  <!-- Text -->
  <p class="card-text">応募ボタンをおすと、企業とのチャットが開かれます。チャットで志望動機やスキルを伝えましょう。面接日時の
	  セッティング等もチャットで行います。
  </p>
</div>

</div>
<!-- Card -->



<!-- Card -->
<div class="card col-lg-6 col-sm-12 mt-4 border-secondary">

  <!-- Card content -->
  <div class="card-body">

    <!-- Title -->
	<h4 class="card-title text-secondary"><a>1dayイベントの場合</a></h4>
	 <!-- Text -->
	<p class="card-text">応募ボタンを押すと、応募が完了します。
		会社はあなたのプロフィールをもとに採用かを判断します。プロフィール欄を充実させておきましょう。
	</p>
  </div>
</div>
</div>

</div>
    </main>
    <!--Main layout-->

    <!--Footer-->
    <footer class="page-footer text-center font-small mt-4 wow fadeIn " >

      <!-- Social icons -->

          <div class="col-1 pt-3"></div>
          <div class="col-12">
            <!--Section: More-->
            <section class="">

              <div class="row features-small mt-5 wow fadeIn">

              <!--
                <div class="col-xl-3 col-lg-6">
                  <div class="row ml-md-5 ml-3">
                    <div class="col-2">
                      <i class="fas fa-sitemap fa-2x mb-1 " aria-hidden="true"></i>
                    </div>
                    <div class="col-10 mb-2">
                      <h5 class="feature-title font-bold mb-1 ">アプリ名</h5>
                      <ul class="pt-3 text-left" style="list-style:none;">
                        <li class="mt-2"><a href="#">トップページ</a></li>
                        <li class="mt-2"><a href="#">検索ページ</a></li>
                        <li class="mt-2"><a href="#">アカウントページ</a></li>
                        <li class="mt-2"><a href="#">お問い合わせページ</a></li>
                        <li class="mt-2"><a href="#">ログインページ</a></li>
                      </ul>

                    </div>
                  </div>
                </div>
              -->

                <!--Grid column-->
                <div class="col-md-3 col-12">
                  <!--Grid row-->
                  <div class="row ml-md-5 ml-2">
                    <div class="col-2">
                      <i class="fas fa-info fa-2x mb-1 " aria-hidden="true"></i>
                    </div>
                    <div class="col-10 mb-2">
                      <h5 class="feature-title font-bold mb-1">企業情報</h5>
					  <a href="https://re-vol.net/" target="_blank" class="grey-text mt-2">株式会社Re-VOL.</a>
                    </div>
                  </div>
                  <!--/Grid row-->
                </div>
                <!--/Grid column-->

                <!--Grid column-->
                <div class="col-md-3 col-12">
                  <!--Grid row-->
                  <div class="row ml-md-0 ml-2">
                    <div class="col-2">
                      <i class="fas fa-reply fa-2x mb-1 " aria-hidden="true"></i>
                    </div>
                    <div class="col-10 mb-2">
                      <h5 class="feature-title font-bold mb-1">お問い合わせ</h5>
                      <a href="contact/contact.php" target="_blank" class="grey-text mt-2">お問い合わせリンク</a>
                    </div>
                  </div>
                  <!--/Grid row-->
                </div>
                <!--/Grid column-->

                <!--Grid column-->
                <div class="col-md-3 col-12">
                  <!--Grid row-->
                  <div class="row mr-md-5 ml-md-0 ml-2">
                    <div class="col-2">
                      <i class="fas fa-shield-alt fa-2x mb-1" aria-hidden="true"></i>
                    </div>
                    <div class="col-10 mb-2">
                      <h5 class="feature-title font-bold mb-1">個人情報保護方針</h5>
                      <a href="privacy_policy.php" target="_blank" class="grey-text mt-2">リンク</a>
                    </div>
                  </div>
                  <!--/Grid row-->
                </div>
				<!--/Grid column-->
				
				<!--Grid column-->
                <div class="col-md-3 col-12">
                  <!--Grid row-->
                  <div class="row mr-md-5 ml-md-0 ml-2">
                    <div class="col-2">
                      <i class="fas fa-shield-alt fa-2x mb-1" aria-hidden="true"></i>
                    </div>
                    <div class="col-10 mb-2">
                      <h5 class="feature-title font-bold mb-1">利用規約</h5>
                      <a href="user_policy.php" target="_blank" class="grey-text mt-2">リンク</a>
                    </div>
                  </div>
                  <!--/Grid row-->
                </div>
                <!--/Grid column-->
				
              </div>
              <!--/First row-->


            </section>
            <!--Section: More-->
          </div>

          <!--
          <div class="col-12 pt-4">
            <a href="https://www.facebook.com/mdbootstrap" target="_blank">
              <i class="fab fa-facebook-f mr-3"></i>
            </a>

            <a href="https://twitter.com/MDBootstrap" target="_blank">
              <i class="fab fa-twitter mr-3"></i>
            </a>

            <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
              <i class="fab fa-youtube mr-3"></i>
            </a>

            <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
              <i class="fab fa-google-plus-g mr-3"></i>
            </a>

            <a href="https://dribbble.com/mdbootstrap" target="_blank">
              <i class="fab fa-dribbble mr-3"></i>
            </a>

            <a href="https://pinterest.com/mdbootstrap" target="_blank">
              <i class="fab fa-pinterest mr-3"></i>
            </a>

            <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
              <i class="fab fa-github mr-3"></i>
            </a>

            <a href="http://codepen.io/mdbootstrap/" target="_blank">
              <i class="fab fa-codepen mr-3"></i>
            </a>

          </div> -->







      <!--Copyright-->
      <div class="footer-copyright py-3 pt-2" >
        © 2020 Copyright:
        <a href="https://re-vol.net/" target="_blank"> Re-VOL.Inc. </a>
      </div>
      <!--/.Copyright-->

    </footer>
    <!--/.Footer-->





    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="static/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="static/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="static/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="static/js/mdb.min.js"></script>
    <!-- Initializations -->
    <script type="text/javascript">
      // Animations initialization
      new WOW().init();

      //ローディング画面
      window.onload = function() {

        const spinner = document.getElementById('loading');

        /*javascriptでわざとロードを遅くする処理（ローディング画面を見るため）
        // ビジーwaitを使う方法
        function sleep(waitMsec) {
          var startMsec = new Date();

          // 指定ミリ秒間だけループさせる（CPUは常にビジー状態）
          while (new Date() - startMsec < waitMsec);
        }

        sleep(5000);
        */

        spinner.classList.add('loaded');
      }
    </script>
  </body>
</html>
