<?php
//セッション
session_start();

//セッションIDを更新　ハイジャック対策
session_regenerate_id(true);

require '../contact_lib\functions.php';

//初回以外でセッションに保存されていたらその値を引き継ぐ　そうでなければNULLで初期化
$name=isset($_SESSION['name'])?$_SESSION['name']:null;
$email=isset($_SESSION['email'])?$_SESSION['email']:null;
$email_check=isset($_SESSION['email_check'])?$_SESSION['email_check']:null;
$tel=isset($_SESSION['tel'])?$_SESSION['tel']:null;
$subject=isset($_SESSION['subject'])?$_SESSION['subject']:null;
$body=isset($_SESSION['body'])?$_SESSION['body']:null;
$error=isset($_SESSION['error'])?$_SESSION['error']:null;

//ここのエラー変数を初期化もしくは継承　error配列に格納されている
$error_name=isset($error['name'])?$error['name']:null;
$error_email=isset($error['email'])?$error['email']:null;
$error_email_check=isset($error['email_check'])?$error['email_check']:null;
$error_tel=isset($error['tel'])?$error['tel']:null;
$error_tel_fomat=isset($error['tel_fomat'])?$error['tel_fomat']:null;
$error_subject=isset($error['subject'])?$error['subject']:null;
$error_body=isset($error['body'])?$error['body']:null;

//CSRF対策の固定トークンを生成
if ( !isset( $_SESSION[ 'ticket' ] ) ) {
	//セッション変数にトークンを代入 適当な文字列と乱数をハッシュにしてとオークンとしている
	$_SESSION[ 'ticket' ] = sha1( uniqid( mt_rand(), TRUE ) );
	//セッションIDをハッシュにしてとオークンとしてもいいと思う
  }
   
  //トークンを変数に代入
  $ticket = $_SESSION[ 'ticket' ];
  ?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>お問い合わせフォーム</title>
		
		 <!-- Font Awesome -->
		 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    	<!-- Bootstrap core CSS -->
    	<link href="../static/css/bootstrap.min.css" rel="stylesheet">
    	<!-- Material Design Bootstrap -->
		<link href="../static/css/mdb.min.css" rel="stylesheet">
    	<!-- Your custom styles (optional) -->
    	<link href="../static/css/style.min.css" rel="stylesheet">

    	<link href="../static/css/additional.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
		<h2>お問い合わせフォーム</h2>
		<p>以下のフォームからお問い合わせください。</p>
		<form id="main_contact" method="POST" action="confirm.php">
			<div class="form-group">
			<label for="name">お名前（必須） 
        	<span class="error"><?php echo escape( $error_name ); ?></span>
      		</label>
      		<input type="text" class="form-control validate max50 required" id="name" name="name" placeholder="氏名" value="<?php echo escape($name); ?>">	
			</div>

			<div class="form-group">
      		<label for="email">Email（必須） 
        	<span class="error"><?php echo escape( $error_email ); ?></span>
      		</label>
			<input type="text" class="form-control validate mail required" id="email" name="email" placeholder="Email アドレス" value="<?php echo escape($email); ?>">
			</div>
			
			<div class="form-group">
      		<label for="email_check">Email（確認用 必須） 
        	<span class="error"><?php echo escape( $error_email_check ); ?></span>
      		</label>
      		<input type="text" class="form-control validate email_check required" id="email_check" name="email_check" placeholder="Email アドレス（確認のためもう一度ご入力ください。）" value="<?php echo escape($email_check); ?>">
			</div>
			
			<div class="form-group">
				<labal for="tel">お電話番号（半角英数字）
				<span class="error"><?php echo escape($error_tel);?></span>
				<span class="error"><?php echo escape($error_tel_fomat);?></span>
				</labal>
				<input type="text" class="form-control tel validate email_check required" id="tel" name="tel" value="<?php echo escape($tel);?>" placeholder="お電話番号（半角英数字でご入力ください）">
			</div>

			<div class="form-group">
				<label for="subject">件名（必須）
				<span class="error"><?php echo escape($error_subject);?></span>
				</label>
				<input type="text" class="form-control validate max100 required" id="subject" name="subject" placeholder="件名" value="<?php echo escape($subject); ?>">
			</div>

			<div class="form-group">
      		<label for="body">お問い合わせ内容（必須） 
        	<span class="error"><?php echo escape( $error_body ); ?></span>
      		</label>
      		<span id="count"> </span>/1000
      		<textarea class="form-control validate max1000 required" id="body" name="body" placeholder="お問い合わせ内容（1000文字まで）をお書きください" rows="3"><?php echo escape($body); ?></textarea>
			</div>
			
			<button type="submit" class="btn btn-success">確認画面へ</button>

			<!--確認ページへトークンをPOSTする、隠しフィールド「ticket」-->
			<input type="hidden" name="ticket" value="<?php echo escape($ticket); ?>">
		</form>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
			jQuery(function($){
  
  //エラーを表示する関数（error クラスの p 要素を追加して表示）
  function show_error(message, this$) {
    text = this$.parent().find('label').text() + message;
    this$.parent().append("<p class='error'>" + text + "</p>")
  }
  
  //フォームが送信される際のイベントハンドラの設定
  $("#main_contact").submit(function(){
    //エラー表示の初期化
    $("p.error").remove();
    $("div").removeClass("error");
    var text = "";
    $("#errorDispaly").remove();
    
    //メールアドレスの検証
    var email =  $.trim($("#email").val());
    if(email && !(/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/gi).test(email)){
      $("#email").after("<p class='error'>メールアドレスの形式が異なります</p>")
    }
    //確認用メールアドレスの検証
    var email_check =  $.trim($("#email_check").val());
    if(email_check && email_check != $.trim($("input[name="+$("#email_check").attr("name").replace(/^(.+)_check$/, "$1")+"]").val())){
      show_error("が異なります", $("#email_check"));
    }
    //電話番号の検証
    var tel = $.trim($("#tel").val());
    if(tel && !(/^\(?\d{2,5}\)?[-(\.\s]{0,2}\d{1,4}[-)\.\s]{0,2}\d{3,4}$/gi).test(tel)){
      $("#tel").after("<p class='error'>電話番号の形式が異なります（半角英数字でご入力ください）</p>")
    }
    
    //1行テキスト入力フォームとテキストエリアの検証
    $(":text,textarea").filter(".validate").each(function(){
      //必須項目の検証
      $(this).filter(".required").each(function(){
        if($(this).val()==""){
          show_error(" は必須項目です", $(this));
        }
      })  
      //文字数の検証
      $(this).filter(".max30").each(function(){
        if($(this).val().length > 30){
          show_error(" は30文字以内です", $(this));
        }
      })
      $(this).filter(".max50").each(function(){
        if($(this).val().length > 50){
          show_error(" は50文字以内です", $(this));
        }
      })
      $(this).filter(".max100").each(function(){
        if($(this).val().length > 100){
          show_error(" は100文字以内です", $(this));
        }
      })
      $(this).filter(".max1000").each(function(){
        if($(this).val().length > 1000){
          show_error(" は1000文字以内でお願いします", $(this));
        }
      }) 
    })
 
    //error クラスの追加の処理
    if($("p.error").length > 0){
      $("p.error").parent().addClass("error");
      $('html,body').animate({ scrollTop: $("p.error:first").offset().top-180 }, 'slow');
      return false;
    }
  }) 
  
  //テキストエリアに入力された文字数を表示
  $("textarea").on('keydown keyup change', function() {
    var count = $(this).val().length;
    $("#count").text(count);
    if(count > 1000) {
      $("#count").css({color: 'red', fontWeight: 'bold'});
    }else{
      $("#count").css({color: '#333', fontWeight: 'normal'});
    }
  });
})
		</script>

		<footer>
		<div class="text-center">
			<a href="main.php">HOME</a>
		</div>
		<!-- Copyright -->
		<div class="footer-copyright text-center py-3">© 2018 Copyright:
		<a href="https://re-vol.net/" target="_blank"> Re-VOL.Inc.</a>
		</div>
		
		<!-- Copyright -->

</footer>
	</body>
</html>