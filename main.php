<!--　ログイン前のメインページ　 created by Hirokazu Niimoto ←（゜Д゜)ﾊｧ?　-->

<?php include './password_compat-master\lib\password.php';   // password_verfy()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用?>

<?php include "managephp/getinternshipdata.php"?>
<?php include "managephp/searchinternshipdata.php"?>
<?php include "managephp/signup.php"?>
<?php include "managephp/login.php"?>

<?php
if(isset($_GET['login']) && ($_GET['login']==0) ){
  $script1 = <<<EOM
  <script type="text/javascript">
  //alert('ログインしてください。');
  //location.href = "main.php";
  document.getElementById("loginbtn").click();
  var myh3 = document.getElementById("loginmodalmessage");
  myh3.innerHTML = "閲覧するにはログインしてください";
  </script>
  EOM;
  $_SESSION["logincount"] = 1;
}
?>

<!--ログの書き込み-->
<?php
$filename = "mainphpLog.txt"; //ログファイル名
$time = date("Y/m/d H:i"); //アクセス時刻
$ip = getenv("REMOTE_ADDR"); //IPアドレス
//$host = getenv("REMOTE_HOST"); //ホスト名
$referer = getenv("HTTP_REFERER"); //リファラ（遷移元ページ）

if($referer == "") {
  $referer = "refererなし";
}
//ログ本文        ",". $host.
$log = $time .",". $ip . ",". $referer."\n";
//ログをページの先頭に書き込むする関数
function file_prepend($path, $data)
{
    if (!$fp = fopen($path, 'c+b')) { return false; }
    flock($fp, LOCK_EX);
    $data = $data . stream_get_contents($fp);
    rewind($fp);
    $result = fwrite($fp, $data);
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
    return $result;
}
//ログ書き込み
file_prepend($filename,$log);
 ?>


<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>LIP-NEXT</title>
    <!-- タイトルのアイコン　-->
    <link rel="shortcut icon" href="static\img\favicon.ico">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="static/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="static/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="static/css/style.min.css" rel="stylesheet">
    <!-- 追加のCSS　-->
    <link href="static/css/additional.css" rel="stylesheet">

    <style type="text/css">
      @media (min-width: 800px) and (max-width: 850px) {
        .navbar:not(.top-nav-collapse) {
          background: #1C2331 !important;
        }
      }
      .navbar{background-color:rgba(0,136,255,0.7);}

    </style>

    <style>
    /*企業募集カード 新*/
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
      .loop-cplist-l {
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
        margin-top: 0;
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

    /*追加のCSS*/

    /*Bootstrapレスポンシブ対応の謎の余白を消す*/
    .footerinfo{
      overflow: hidden;
    }

    </style>

    <!-- jQueryをCDNから読み込み (上で読み込む)-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

  </head>

  <body>
    <!-- ローディング画面-->
    <div id="loading">
      <div class="spinner"></div>
      <h2 class="mt-2 text-center white-text">少々お待ちください</h2>
    </div>

    <!--ログインモーダル-->
    <form class="" action="" method="post">
      <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby=""
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
            <div class="pt-2 pb-4 text-center" style="font-size:20px;color:red;" id="loginmodalmessage">
              <?php echo $errorMessage ?>
            </div>
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
            <a href="" class="" data-dismiss="modal" data-toggle="modal" data-target="#modalRegisterForm" id="sighupbtn">新規登録</a>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--ログインモーダル終わり-->

  <!--新規登録モーダル-->
  <form class="" action="" method="post">
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby=""
    aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold ">新規登録</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body mx-3">
            <div class="pt-2 pb-4 text-center" style="font-size:20px;color:red;" id="signupmodalmessage">
              <?php echo $errorMessage2 ?>
            </div>
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
            <!--
            <div class="md-form mb-5">
              <i class="fas fa-user prefix grey-text"></i>
              <input type="text" id="orangeForm-name" class="form-control validate" name="university">
              <label data-error="wrong" data-success="right" for="orangeForm-name">大学</label>
            </div>
            <div class="md-form mb-5">
              <i class="fas fa-user prefix grey-text"></i>
              <input type="text" id="orangeForm-name" class="form-control validate" name="undergraduate">
              <label data-error="wrong" data-success="right" for="orangeForm-name">学部</label>
            </div>
          -->
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
            <button class="btn btn-deep-orange" name="signUp" type="submit">登録</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--新規登録モーダル終わり-->

  <!--インターンシップを探すモーダル-->
  <div class="modal fade" id="searchinternship" tabindex="-1" role="dialog" aria-labelledby=""
  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center" id="searchinternship"><strong><i class="fas fa-search mr-3 ml-3"></i>検索条件を設定してください</strong></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
          <div class="col-md-2 col-md-2"></div>
          <form class="col-md-8 col-md-8" action="main.php#allinternship" method="POST">
            <!--タブ切り替え-->
            <ul class="nav nav-tabs" role="tablist">
              <!--一つ目のタブ-->
              <li class="nav-item">
                <a href="#selectfield" class="nav-link active" data-toggle="tab" role="tab">職種</a>
              </li>
              <!--二つ目のタブ-->
              <li class="nav-item">
                <a href="#selectregion" class="nav-link" data-toggle="tab" role="tab">地域</a>
              </li>
              <!--三つ目のタブ-->
              <li class="nav-item">
                <a href="#selecttype" class="nav-link" data-toggle="tab" role="tab">募集タイプ</a>
              </li>
            </ul>
            <!--タブのコンテンツ-->
            <div class="tab-content">
              <!--一つ目のコンテンツ-->
              <div class="tab-pane fade show active mt-3" id="selectfield" role="tabpanel">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked1" value="エンジニア" name=fields[]>
                    <label class="custom-control-label " for="defaultUnchecked1">エンジニア</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked2" value="" name=fields[]>
                    <label class="custom-control-label" for="defaultUnchecked2">デザイン・アート</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked3" name=fields[]>
                    <label class="custom-control-label" for="defaultUnchecked3">編集・ライティング</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked4" value="マーケティング" name=fields[]>
                    <label class="custom-control-label" for="defaultUnchecked4">マーケティング・PR</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked5" name=fields[]>
                    <label class="custom-control-label" for="defaultUnchecked5">セールス・事業開発</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked6" value="コンサルティング" name=fields[]>
                    <label class="custom-control-label" for="defaultUnchecked6">コンサルティング</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked7" name=fields[]>
                    <label class="custom-control-label" for="defaultUnchecked7">メディカル系</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked8" name=fields[]>
                    <label class="custom-control-label" for="defaultUnchecked8">その他</label>
                </div>
              </div>
              <!--二つ目のコンテンツ-->
              <div class="tab-pane fade mt-3" id="selectregion" role="tabpanel">

                <!--地域のチェックボックスを一つだけ選ばせるスクリプト-->
                <script type="text/javascript">
                jQuery(function($){
                  $(function(){
                    $('.regions').on('click', function() {
                      if ($(this).prop('checked')){
                          // 一旦全てをクリアして再チェックする
                          $('.regions').prop('checked', false);
                          $(this).prop('checked', true);
                      }
                    });
                  });
                });
                </script>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input regions" id="defaultUnchecked9" value="北海道" name=regions[]>
                    <label class="custom-control-label " for="defaultUnchecked9">北海道</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input regions" id="defaultUnchecked10" value="東北" name=regions[]>
                    <label class="custom-control-label" for="defaultUnchecked10">東北</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input regions " id="defaultUnchecked11" name=regions[] value="関東">
                    <label class="custom-control-label" for="defaultUnchecked11">関東</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input regions" id="defaultUnchecked12" value="中部" name=regions[]>
                    <label class="custom-control-label" for="defaultUnchecked12">中部</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input regions" id="defaultUnchecked13" value="近畿" name=regions[]>
                    <label class="custom-control-label" for="defaultUnchecked13">近畿</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input regions" id="defaultUnchecked14" value="中国・四国" name=regions[]>
                    <label class="custom-control-label" for="defaultUnchecked14">中国・四国</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input regions" id="defaultUnchecked15" value="九州" name=regions[]>
                    <label class="custom-control-label" for="defaultUnchecked15">九州</label>
                </div>
                <!--
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input regions" id="defaultUnchecked8" name=fields[]>
                    <label class="custom-control-label" for="defaultUnchecked8">その他</label>
                </div>
              -->
              </div>
              <!--三つ目のコンテンツ-->
              <div class="tab-pane fade show mt-3" id="selecttype" role="tabpanel">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input type" id="defaultUnchecked16" value="" name=type[]>
                    <label class="custom-control-label " for="defaultUnchecked16">長期インターンシップ</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input type" id="defaultUnchecked17" value="" name=type[]>
                    <label class="custom-control-label" for="defaultUnchecked17">OneDayイベント</label>
                </div>

                <!--募集選択のチェックボックスを一つだけ選ばせるスクリプト-->
                <script type="text/javascript">
                jQuery(function($){
                  $(function(){
                    $('.type').on('click', function() {
                      if ($(this).prop('checked')){
                          // 一旦全てをクリアして再チェックする
                          $('.type').prop('checked', false);
                          $(this).prop('checked', true);
                      }
                    });
                  });
                });
                </script>

              </div>
              <div class="md-form md-outline mt-4">
                <input type="text" id="form1" class="form-control" name="searchtext">
                <label for="form1"><i class="fas fa-search ml-2 mr-2"></i>キーワードで検索</label>
              </div>
            </div>

            <hr>

            <button type="submit" class="btn btn-primary" name="searchfield" id="searchfield">上記の条件で探す</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mr-3 fas fa-times"></i>閉じる</button>
          </form>
          <div class="col-md-2 col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
  <!--インターンシップを探すモーダル終わり-->

  <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">
      <a class="navbar-brand" href="main.php" >
        <strong>LIP-NEXT</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="outline.php">利用案内</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="enterpriselistpage.php">企業一覧</a>
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
            <a href="" class="nav-link border border-light rounded" data-toggle="modal" data-target="#modalLoginForm" id="loginbtn">
              <i class="fas fa-sign-in-alt mr-2"></i>ログイン
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

    <!-- Full Page Intro -->  <!--https://photohito.k-img.com/uploads/photo130/user129768/a/7/a74efb58fa3d98eedb1a35afa7b7bcb5/a74efb58fa3d98eedb1a35afa7b7bcb5_l.jpg    background-attachment: fixed;-->
    <div class="view full-page-intro" style="background-image: url('https://careergarden.jp/dtp-designer/wp-content/blogs.dir/388/files/4a2631ded52c08e466396b3f7a2c6f97.jpg');background-color:rgba(0,98,255,0.4); background-repeat: no-repeat; background-size: cover;">
      <div class="mask rgba-black-light d-flex justify-content-center align-items-center ">
        <div class="container">
          <div class="row wow fadeIn pt-5 white-text">
            <div class="col-md-12  mb-5 pt-5 text-center text-md-left">
              <p class="pt-5"></p>
              <h1 class="apptitle font-weight-bold text-center white-text">LIP-NEXT</h1>
              <p class="mt-5 pt-2 text-center appexplain white-text">
                <strong>説明 </strong>
              </p>
              <div class="pt-1"></div>
              <div class="row pt-3">
                <p class="col-md-4 col-1"></p>
                <button class="btn btn-primary btn-lg col-md-4 col-10" data-toggle="modal" data-target="#searchinternship">インターンシップを探す
                  <i class="fas fa-search ml-2"></i>
                </button>
                <p class="col-md-4 col-1"></p>
              </div>
              <h3 class="text-center pt-5 watchallintern">全てのインターンシップを見る</h3>
              <div class="row icon1 pt-2">
                <p class="col-md-5"></p>
                <a href="#allinternship" class="col-md-2 text-center text-light"><i class="fas fa-3x fa-angle-double-down yureru-j"></i></a>
                <p class="col-md-5"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Full Page Intro -->

    <a name="allinternship" class="pt-5"></a>
    <p class="pt-4"></p>

    <!--Main layout  style="background-color:#d4f4ff;"-->
    <main>
      <div class="container">
        <section class="mt-5">
          <form class="row " action="main.php#allinternship" method="post">
            <p class=""></p>
            <p class=""></p>
            <p class="ml-4 mt-3">並べ替え</p>
            <button class="btn btn-outline-primary btn-rounded waves-effect ml-4"  type="submit" name="popular">人気</button>
            <button class="btn btn-outline-primary btn-rounded waves-effect ml-4"  type="submit" name="new">新着</button>
          </form>

          <hr>

          <?php echo $res; ?>

        </section>
      </div>
    </main>

    <!--Footer-->
    <footer class="page-footer text-center font-small mt-4 footerinfo">
      <footer class="page-footer font-small mt-4" style="background-color:black;">
        <div class="pt-3"></div>
        <div class="text-center pt-4">
          <h2 class="text-center">ロゴマーク・株式会社Re-VOL.Inc.</h2>
          <p class="feature-title font-bold mb-1 mt-3" style="font-size:18px;"><span style="background: linear-gradient(transparent 50%, #0099FF 95%);">
            Re-VOL.Inc.(リボル)は神戸の学生をEMPOWERする企業です。</span></p>
        </div>
        <div class="row mt-4">
          <div class="col-md-1"></div>
          <div class="col-md-5 mt-3" style="font-size:15px;">
            <p class="feature-title font-bold mt-1 text-center">神戸市中央区小野柄通3丁目1-11 芙蓉ビル 302</p>
            <p class="feature-title font-bold mt-1 text-center">設立:2019年3月4日</p>
            <p class="feature-title font-bold mt-1 text-center">資本金:6,000,000円</p>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-3" style="font-size:15px;">
            <p class="feature-title font-bold mt-1 text-md-left text-center"><i class="fas fa-info fa-x mr-4" aria-hidden="true"></i><a href="https://re-vol.net/">企業ページ</a></p>
            <p class="feature-title font-bold mt-1 text-md-left text-center"><i class="fas fa-reply fa-x mr-4" aria-hidden="true"></i><a href="contact/contact.php">お問い合わせ</a></p>
            <p class="feature-title font-bold mt-1 text-md-left text-center"><i class="fas fa-shield-alt fa-x mr-4" aria-hidden="true"></i><a href="privacy_policy.php">個人情報保護方針</a></p>
            <p class="feature-title font-bold mt-1 text-md-left text-center"><i class="fas fa-check fa-x mr-4" aria-hidden="true"></i><a href="user_policy.php">利用規約</a></p>
          </div>
          <div class="col-md-1"></div>
        </div>


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
    <!--追加の JavaScript -->
    <script type="text/javascript" src="static/js/additionaBeforeLogin.js"></script>

    <?php
    //ログイン失敗時にもう一度モーダルを表示するスクリプト（login.php）
    echo $script1
    ?>

  </body>
</html>
