<?php
session_start();

require "../contact_lib/functions.php";

//メールアドレス等を記述したファイルの読み込み
require '../contact_lib/mailvars.php'; 


$_POST=checkInput($_POST);

//固定トークンを確認
if(isset($_POST['ticket'],$_SESSION['ticket'])){
	$ticket=$_POST['ticket'];
	if($ticket!==$_SESSION['ticket']){
		exit("Access Denied!");
	}
}else{
	//exit("Access Denied!(直接このページにはアクセスできません。");
	$dirname = dirname( $_SERVER[ 'SCRIPT_NAME' ] );
  $dirname = $dirname == DIRECTORY_SEPARATOR ? '' : $dirname;
  $url = ( empty( $_SERVER[ 'HTTPS' ] ) ? 'http://' : 'https://' ) . $_SERVER[ 'SERVER_NAME' ] . $dirname . '/contact.php';
  header( 'HTTP/1.1 303 See Other' );
  header( 'location: ' . $url );
  exit; //忘れないように
}

//変数にエスケープ処理したセッション変数の値を代入
$name = escape( $_SESSION[ 'name' ] );
$email = escape( $_SESSION[ 'email' ] ) ;
$tel =  escape( $_SESSION[ 'tel' ] ) ;
$subject = escape( $_SESSION[ 'subject' ] );
$body = escape( $_SESSION[ 'body' ] );

//メール本文の組み立て
$mail_body = 'コンタクトページからのお問い合わせ' . "\n\n";
$mail_body .=  date("Y年m月d日 H時i分") . "\n\n"; 
$mail_body .=  "お名前： " .$name . "\n";
$mail_body .=  "Email： " . $email . "\n"  ;
$mail_body .=  "お電話番号： " . $tel . "\n\n" ;
$mail_body .=  "＜お問い合わせ内容＞" . "\n" . $body;

//sendmail(mb-send_mail)を使ったメールの送信処理
//メールの宛先（名前<メールアドレス＞の形式。値はmailvars.phpに記載

$mailTo=mb_encode_mimeheader(MAIL_TO);

//Return -Pathに指定するメールアドレス
$returnMail=MAIL_RETURN_PATH;

//mbstringの日本語設定
mb_language('ja');
mb_internal_encoding('utf-8');

//送信者情報(FROM ヘッダー)の設定
$header="From: ".mb_encode_mimeheader($name)."<".$email."\n>";
$header.="Cc: ".mb_encode_mimeheader(MAIL_CC_NAME)."<".MAIL_CC.">\n";
$header.="Bcc: <".MAIL_BCC.">";

//メールの送信
if(ini_get('sefe_mode')){
//セーフモードがオンの時は第5引数（returnMAil)リターンパスが使えない
$result=mb_send_mail($name,$mailTo,$mail_body,$header);
}else{
	$result=mb_send_mail($mailTo,$subject,$mail_body,$header,'-f'.$returnMail);
}

if($result){
//成功した場合はsessionを破棄
$_SESSION=array();//初期化
session_destroy();
}else{
	//送信失敗
   // 処理はHTMLで
}
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=devise-width,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>コンタクトフォーム（確認）</title>
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
			<?php if($result):?>
				<h3>送信完了!</h3>
  				<p>お問い合わせいただきありがとうございます。</p>
  				<p>送信完了いたしました。</p>
			<?php else:?>
				<p>申し訳ございませんが、送信に失敗しました。</p>
				<p>しばらくしてもう一度お試しになるか、メールにてご連絡ください。</p>
				<p>ご迷惑をおかけして誠に申し訳ございません。</p>
			<?php endif;?>
		</div>
	</body>
</html>