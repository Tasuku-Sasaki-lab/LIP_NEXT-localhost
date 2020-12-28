<!-- ユーザーログイン後のページ　created by Hirokazu Niimoto ←（゜Д゜)ﾊｧ?　-->

<?php include "managephp/getinternshipdata.php"?>
<?php include "managephp/searchinternshipdata.php"?>
<?php include "managephp/login.php" ?>

<?php
//session_start();
if(!isset($_SESSION["NAME"])) {
	$no_login_url = "main.php?login=0";
	header("Location: {$no_login_url}");
	exit;
}
?>

<!--ログの書き込み-->
<?php
$filename = "userphpLog.txt"; //ログファイル名
$time = date("Y/m/d H:i"); //アクセス時刻
$ip = "172.217.25.110" ;//getenv("REMOTE_ADDR"); //IPアドレス
//$host = getenv("REMOTE_HOST"); //ホスト名
$username = $_SESSION["NAME"];
$referer = getenv("HTTP_REFERER"); //リファラ（遷移元ページ）
if($referer == "") {
  $referer = "refererなし";
}
//ログ本文        ",". $host.
$log = $time .",". $ip . ",".$username . ",". $referer."\n";
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

    /*追加のCSS*/
    @media screen and (max-width:480px){
      .apptitle{font-size:40px;
                position: relative;}
      .apptitle:after{
        content: "";
        display: block;
        height: 4px;
        background: -webkit-linear-gradient(to right, rgba(0, 55, 143, 0.9), transparent);
        background: linear-gradient(to right, rgba(0, 55, 143, 0.9), transparent);
                        }
      .appcopy{font-size: 30px;}
      .appexplain{font-size: 20px;}
      .logo{width:70%;}
    }

    @media screen and (max-width: 1300px) and (min-width: 480px){
      .apptitle{
                font-size:75px;
                position: relative;
                }
      .apptitle:after{
                content: "";
                display: block;
                height: 4px;
                background: -webkit-linear-gradient(to right, rgba(0, 55, 143, 0.9), transparent);
                background: linear-gradient(to right, rgba(0, 55, 143, 0.9), transparent);
              }
      .appcopy{font-size: 20px;}
      .appexplain{font-size: 25px;}
      .watchallintern{font-size: 25px;}
      .logo{width:50%;}
    }
    @media screen and (min-width:1301px){
      .apptitle{font-size:90px;}
      .appcopy{font-size: 40px;}
      .appexplain{font-size: 35px;}
    }

    /*navbar のサイズを固定pc　*/
    @media screen and (min-width:992px){
      .navbar{
        height:10%;
      }
    }

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

    <!--メッセージ一覧モーダル-->
    <div class="modal fade" id="chatlistmodal" tabindex="-1" role="dialog" aria-labelledby=""
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id=""><strong><i class="far fa-envelope mr-3 ml-3"></i>メッセージ一覧</strong></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body" id="messagelist">
            <!--　ここにサーバーから取ってきたデータが入る　 -->
          </div>

          <div class="modal-footer" ><!--style="background-color:#EEEEEE;"-->
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close mr-3"></i>閉じる</button>
          </div>
        </div>
      </div>
    </div>
    <!--チャット一覧モーダル-->

    <!--ブックマーク一覧モーダル-->
    <div class="modal fade" id="bookmarklistmodal" tabindex="-1" role="dialog" aria-labelledby=""
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id=""><strong><i class="far fa-bookmark mr-3 ml-3"></i>ブックマーク一覧</strong></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body" id="bookmarklist">
            <!--　ここにサーバーから取ってきたデータが入る　 -->
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close mr-3"></i>閉じる</button>
          </div>
        </div>
      </div>
    </div>
    <!--ブックマーク一覧モーダル-->

    <!--チャットモーダル -->
    <div class="modal fade" id="chatmodal" tabindex="-1" role="dialog" aria-labelledby=""
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content" >
          <div class="modal-header row">
            <h4 class="modal-title col-9" id=""><a type="button" onclick="messagelist()" data-dismiss="modal" data-toggle="modal" data-target="#chatlistmodal" class="ml-3 mr-4"><i class="fas fa-arrow-left"></i></a><strong id="headersenduser">メッセージ</strong></h4>
            <button type="button" class="close" onclick="messagerenew()" aria-label="Close">
              <span aria-hidden="true"><i class="fas fa-redo mr-3 mt-1"></i></span> <!--&laquo; &times; -->
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

    <!--アカウントモーダル-->
    <div class="modal fade" id="accountmodal" tabindex="-1" role="dialog" aria-labelledby="accountmodalTitle"
    aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title text-center" id="accountmodalTitle"><strong><i class="far fa-user-circle mr-3 ml-3"></i>プロフィールの設定</strong></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body row">

            <p class="col-md-1"></p>
            <div class="md-form col-md-10">
              <input value="<?php echo $_SESSION["NAME"] ?>" style="font-size:20px;" type="text" id="name" class="form-control mt-2 mb-2">
              <label for="name" style="font-size:20px;" class="ml-2">ユーザー名</label>
            </div>
            <p class="col-md-1"></p>

            <p class="col-md-1"></p>
            <div class="md-form col-md-10">
              <input value="<?php echo $_SESSION["PHONENUMBER"] ?>" style="font-size:20px;" type="number" id="phonenumber" class="form-control mt-2 mb-2">
              <label for="phonenumber" style="font-size:20px;" class="ml-2">電話番号（半角数字）</label>
            </div>
            <p class="col-md-1"></p>

            <p class="col-md-1"></p>
            <div class="md-form col-md-10">
              <input value="<?php echo $_SESSION["UNIVERSITY"] ?>" style="font-size:20px;" type="text" id="university" class="form-control mt-2 mb-2">
              <label for="university" style="font-size:20px;" class="ml-2">大学</label>
            </div>
            <p class="col-md-1"></p>

            <p class="col-1"></p>
            <div class="md-form col-md-10">
              <input value="<?php echo $_SESSION["UNDERGRADUATE"] ?>" style="font-size:20px;" type="text" id="undergraduate" class="form-control mt-2 mb-2">
              <label for="undergraduate" style="font-size:20px;" class="ml-2">学部</label>
            </div>
            <p class="col-md-1"></p>

            <p class="col-md-1"></p>
            <div class="md-form col-md-10">
              <input value="<?php echo $_SESSION["DEPARTMENT"] ?>" style="font-size:20px;" type="text" id="department" class="form-control mt-2 mb-2">
              <label for="department" style="font-size:20px;" class="ml-2">学科</label>
            </div>
            <p class="col-md-1"></p>

            <p class="col-md-1"></p>
            <div class="md-form col-md-10">
              <input value="<?php echo $_SESSION["GRADUATEYEAR"] ?>" style="font-size:20px;" type="number" id="graduateyear" class="form-control mt-2 mb-2" >
              <label for="graduateyear" style="font-size:20px;" class="ml-2">卒業年（半角数字）</label>
            </div>
            <p class="col-md-1"></p>

            <p class="col-md-1"></p>
            <div class="md-form col-md-10">
              <input value="<?php echo $_SESSION["SCHOOLYEAR"] ?>"  style="font-size:20px;" type="number" id="schoolyear" class="form-control mt-2 mb-2">
              <label for="schoolyear" style="font-size:20px;" class="ml-2">学年（半角数字）</label>
            </div>
            <p class="col-md-1"></p>

            <p class="col-md-1"></p>
            <div class="md-form mb-4 pink-textarea active-pink-textarea col-md-10">
              <textarea maxlength='200' id="selfappeal" class="md-textarea form-control mt-2 mb-2" rows="8"><?php echo $_SESSION["SELFAPPEAL"] ?></textarea>
              <label for="selfappeal" id="selfappeallabel" style="font-size:20px;" class="ml-2 number">自己アピール（２００字以内）</label>
              <!-- テキストエリアの文字数をチェックするスクリプト 　onChange="wordcountcheck()"　←これをテキストエリアに付与
              <script type="text/javascript">
                function wordcountcheck(){
                  let selfappeallength = document.getElementById("selfappeal").value.length;
                  if (selfappeallength==200){
                    document.getElementById("selfappeallabel").innerHTML="自己アピール（２００字です）"
                  }
                }
              </script>
            -->
            </div>
            <p class="col-md-1"></p>

            <p class="col-md-1"></p>
            <div class="md-form col-md-10">
              <input value="<?php echo $_SESSION["AREAOFINTEREST"] ?>" style="font-size:20px;" type="text" id="areaofinterest" class="form-control mt-2 mb-2">
              <label for="areaofinterest" style="font-size:20px;" class="ml-2">興味のある業界</label>
            </div>
            <p class="col-md-1"></p>

            <p class="col-md-1"></p>
            <div class="md-form col-md-10">
              <input value="<?php echo $_SESSION["CLUBINHIGHSCHOOL"] ?>" style="font-size:20px;" type="text" id="clubinhighschool" class="form-control mt-2 mb-2">
              <label for="clubinhighschool" style="font-size:20px;" class="ml-2">高校時代の部活</label>
            </div>
            <p class="col-md-1"></p>

            <p class="col-md-1"></p>
            <div class="md-form col-md-10">
              <input value="<?php echo $_SESSION["CURRENTACTIVITY"] ?>" style="font-size:20px;" type="text" id="currentactivity" class="form-control mt-2 mb-2">
              <label for="currentactivity" style="font-size:20px;" class="ml-2">現在の部活・サークル</label>
            </div>
            <p class="col-md-1"></p>

          </div>
          <div class="modal-footer">
            <form class="" action="index.html" method="post">
              <button onclick="profilechangeclick()" class="btn btn-primary" data-dismiss="modal">設定を保存</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--アカウントモーダル終わり-->

    <!--応募申し込みモーダル -->
    <div class="modal fade" id="applymodal" tabindex="-1" role="dialog" aria-labelledby=""
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content" >
          <div class="modal-header ">
            <h4 class="modal-title" id="exampleModalLongTitle"><a type="button" onclick="messagerenew()" class="ml-2 mr-4"><i class="fas fa-redo"></i></a><strong id="senduser-name" class="senduser-name">メッセージ</strong></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="scroll-box">
            <h4 class="text-center  text-primary">以下のアカウント情報で申し込みます。よろしければ「申し込み」を押してください。</h4>
            <ul id="applyinfo">
              <li class="mt-4" style="font-size:20px;">名前：<?php echo $_SESSION["NAME"] ?></li>
              <li class="mt-2" style="font-size:20px;">メールアドレス：<?php echo $_SESSION["MAIL"] ?></li>
              <li class="mt-2" style="font-size:20px;">電話番号：<?php echo $_SESSION["PHONENUMBER"] ?></li>
              <li class="mt-2" style="font-size:20px;">大学：<?php echo $_SESSION["UNIVERSITY"] ?></li>
              <li class="mt-2" style="font-size:20px;">学部：<?php echo $_SESSION["UNDERGRADUATE"] ?></li>
              <li class="mt-2" style="font-size:20px;">学科：<?php echo $_SESSION["DEPARTMENT"] ?></li>
              <li class="mt-2" style="font-size:20px;">卒業年：<?php echo $_SESSION["GRADUATEYEAR"] ?></li>
              <li class="mt-2" style="font-size:20px;">学年：<?php echo $_SESSION["SCHOOLYEAR"] ?></li>
              <li class="mt-2" style="font-size:20px;">自己アピール：<?php echo $_SESSION["SELFAPPEAL"] ?></li>
              <li class="mt-2" style="font-size:20px;">興味のある業界：<?php echo $_SESSION["AREAOFINTEREST"] ?></li>
              <li class="mt-2" style="font-size:20px;">高校の時の部活：<?php echo $_SESSION["CLUBINHIGHSCHOOL"] ?></li>
              <li class="mt-2" style="font-size:20px;">現在の部活・サークル：<?php echo $_SESSION["CURRENTACTIVITY"] ?></li>
            </ul>

            <div class="" id="addmessage"></div>

          </div>
          <div class="modal-footer pt-1">
            <button type="submit" class="btn btn-primary text-center" onclick="apply()" name="chatsend" data-dismiss="modal"><i class="mr-3 far fa-paper-plane"></i>申し込み</button>
            <button type="button" class="btn btn-secondary "  data-dismiss="modal" ><i class="fas fa-window-close mr-3"></i>閉じる</button>
          </div>
        </div>
      </div>
    </div>

    <!--インターンシップを探すモーダル-->
    <div class="modal fade" id="searchinternship" tabindex="-1" role="dialog" aria-labelledby=""
    aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title text-center" id=""><strong><i class="fas fa-search mr-3 ml-3"></i>検索条件を設定してください</strong></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body row">
            <div class="col-md-2 col-md-2"></div>
            <form class="col-md-8 col-md-8" action="user.php#allinternship" method="POST">
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

                  <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input type" id="defaultUnchecked16" value="長期インターンシップ" name=types[]>
                      <label class="custom-control-label " for="defaultUnchecked16">長期インターンシップ</label>
                  </div>

                  <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input type" id="defaultUnchecked17" value="OneDayイベント" name=types[]>
                      <label class="custom-control-label" for="defaultUnchecked17">OneDayイベント</label>
                  </div>

                </div>

                <p class="mt-4">または</p>

                <div class="md-form md-outline mt-2">
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
        <a class="navbar-brand" href="user.php" >
          <strong>LIP-NEXT</strong>
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
              <a class="nav-link" href="outline.php">利用案内</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="enterpriselistpage.php">企業一覧</a>
            </li>
          </ul>
          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item mr-2">
              <a class="nav-link" onclick="messagelist()" data-toggle="modal" data-target="#chatlistmodal">
                <i class="fas fa-envelope fa-2x"></i>
              </a>
            </li>
            <li class="nav-item dropdown mt-1">
              <!-- Basic dropdown -->
              <a  class="nav-link border border-light rounded dropdown-toggle"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="navbarDropdownMenuLink-333">
                ようこそ、<?php
                echo $_SESSION['NAME'];
                 ?> さん
              </a>
              <div class="dropdown-menu float-right" id="navbarDropdownMenuLink-333">
                <a class="dropdown-item" data-toggle="modal" data-target="#accountmodal"><i class="far fa-user-circle mr-2 ml-2"></i>プロフィール</a>
                <a class="dropdown-item" onclick="messagelist()" data-toggle="modal" data-target="#chatlistmodal" ><i class="far fa-envelope mr-2 ml-2"></i>メッセージ</a>
                <a class="dropdown-item" onclick="bookmarklist()" data-toggle="modal" data-target="#bookmarklistmodal"><i class="far fa-bookmark mr-2 ml-2"></i>ブックマーク</a>
                <div class="dropdown-divider"></div>
                <a href="managephp/logout.php" type="submit" class="dropdown-item text-info"><i class="fas fa-sign-out-alt ml-2 mr-2"></i>ログアウト</a>
              </div>
              <!-- Basic dropdown -->
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar -->

    <!-- Full Page Intro -->  <!--background-attachment: fixed; paper_00027.jpg  p0308_l.jpg p0097_l.jpg  https://careergarden.jp/dtp-designer/wp-content/blogs.dir/388/files/4a2631ded52c08e466396b3f7a2c6f97.jpg-->
    <div class="view full-page-intro top" style="background-image: url('static/img/p0308_l.jpg'); hbackground-color:rgba(0,98,255,0.4); background-repeat: no-repeat; background-size: cover;" >　<!---->
      <!--mask rgba-black-light-->
      <div class="mask rrgba-black-light d-flex justify-content-center align-items-center">
        <div class="container">
          <div class="row wow fadeIn pt-5 white-text">
            <div class="col-md-12  mb-5 pt-5 text-center text-md-left">
              <p class="pt-2 black-text ml-md-5 appexplain"><strong>インターンシップをより身近に</strong></p>
              <h1 class="apptitle font-weight-bold text-center black-text">LIP-NEXT</h1>
              <!--<p class="mt-3 pt-2 text-center appexplain black-text">
                <strong>インターンシップをより身近に</strong>
              </p>-->
              <div class="pt-3"></div>
              <div class="row pt-4">
                <p class="col-md-4 col-1"></p>
                <button class="btn btn-primary btn-lg col-md-4 col-10" data-toggle="modal" data-target="#searchinternship">インターンシップを探す
                  <i class="fas fa-search ml-2"></i>
                </button>
                <p class="col-md-4 col-1"></p>
              </div>
              <h3 class="text-center pt-5 watchallintern black-text">全てのインターンシップを見る</h3>
              <div class="row icon1 pt-2">
                <p class="col-md-5"></p>
                <a href="#allinternship" class="col-md-2 text-center text-dark"><i class="fas fa-3x fa-angle-double-down yureru-j"></i></a>
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

    <!--Main layout-->
    <main>
      <div class="container">
        <section class="mt-5">
          <form class="row " action="user.php#allinternship" method="post">
            <p class=""></p>
            <p class=""></p>
            <p class="ml-4 mt-3">並べ替え</p>
            <button class="btn btn-outline-primary btn-rounded waves-effect  ml-4"  type="submit" name="popular">人気</button>
            <button class="btn btn-outline-primary btn-rounded waves-effect ml-4"  type="submit" name="new">新着</button>
          </form>

          <hr>

          <!--インターンシップのデータを表示する-->
          <?php echo $res; ?>

        </section>
      </div>
    </main>
    <!--Main layout-->

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
          <p class="font-bold mt-1 text-md-left text-center"><i class="fas fa-reply fa-x mr-4" aria-hidden="true"></i><a href="contact/contact.php">お問い合わせ</a></p>
          <p class="font-bold mt-1 text-md-left text-center"><i class="fas fa-shield-alt fa-x mr-4" aria-hidden="true"></i><a href="privacy_policy.php">個人情報保護方針</a></p>
          <p class="font-bold mt-1 text-md-left text-center"><i class="fas fa-check fa-x mr-4" aria-hidden="true"></i><a href="user_policy.php">利用規約</a></p>
        </div>
        <div class="col-md-1"></div>
      </div>

      <!--
      <div class="col-12">
        <section class="pb-4">
          <div class="row features-small mt-5">
            <div class="col-md-3 col-12">
              <div class="row ml-md-5 ml-1">
                <div class="col-2">
                  <i class="fas fa-info fa-2x mb-1" aria-hidden="true"></i>
                </div>
                <div class="col-10 mb-2">
                  <h5 class="feature-title font-bold mb-1"><a href="https://re-vol.net/">企業情報</a></h5>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-12">
              <div class="row ml-md-0 ml-1">
                <div class="col-2">
                  <i class="fas fa-reply fa-2x mb-1 " aria-hidden="true"></i>
                </div>
                <div class="col-10 mb-2">
                  <h5 class="feature-title font-bold mb-1"><a href="contact/contact.php">お問い合わせ</a></h5>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-12">
              <div class="row mr-md-5 ml-md-0 ml-1">
                <div class="col-2">
                  <i class="fas fa-shield-alt fa-2x mb-1" aria-hidden="true"></i>
                </div>
                <div class="col-10 mb-2">
                  <h5 class="feature-title font-bold mb-1"><a href="privacy_policy.php">個人情報保護方針</a></h5>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-12">
              <div class="row mr-md-5 ml-md-0 ml-1">
                <div class="col-2">
                  <i class="fas fa-check fa-2x mb-1" aria-hidden="true"></i>
                </div>
                <div class="col-10 mb-2">
                  <h5 class="feature-title font-bold mb-1"><a href="user_policy.php">利用規約</a></h5>
                </div>
              </div>
            </div>

          </div>
        </section>
        </div>
      -->

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
    <!-- 追加のJavaScript-->
    <script type="text/javascript" src="static/js/additional.js"></script>
  </body>
</html>
