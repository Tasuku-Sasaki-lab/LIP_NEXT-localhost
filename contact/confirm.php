<?php 
session_start();

require '../contact_lib/functions.php';

if(isset($_POST['ticket'],$_SESSION['ticket'])){
	$ticket=$_POST['ticket'];
	if($ticket!==$_SESSION['ticket']){
		exit('Acces Denid!');
	}
}else{
	exit('Access Denied（直接このページにはアクセスできません）' );
}

//POSTされたデータを変数に代入
$name=isset($_POST['name'])?$_POST['name']:null;
$email=isset($_POST['email'])?$_POST['email']:null;
$email_check=isset($_POST['email_check'])?$_POST['email_check']:null;
$tel=isset($_POST['tel'])?$_POST['tel']:null;
$subject=isset($_POST['subject'])?$_POST['subject']:null;
$body=isset($_POST['body'])?$_POST['body']:null;

//POSTされたデータを整形（前後にあるホワイトスペースを削除）
$name=trim($name);
$email = trim($email);
$email_check = trim( $email_check );
$tel = trim( $tel );
$subject = trim( $subject );
$body = trim( $body );

//エラーメッセージを保存する配列の初期化
$error=array();

//値の検証（入力内容が条件を満たさない場合はエラーメッセージを配列 $error に設定）
if($name==''){
	$error['name']="＊お名前は必須項目です";
	//制御文字でないことと文字数をチェック
}else if(preg_match('/\A[[:^cntrl:]]{1,30}\z/u',$name)==0){
	$error['name']="*お名前は30文字以内でお願いします。";
}

if($email==''){
	$error['email']="＊メールアドレスは必須項目です";
}else{//メールアドレスを正規表現でチェック
	$pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/uiD';
  if ( !preg_match( $pattern, $email ) ) {
    $error['email'] = '*メールアドレスの形式が正しくありません。';
  }
}

if($email_check==''){
	$error['email_check']="＊確認用メールアドレスは必須項目です";
}else if($email_check!==$email){
	$error['email_check'] = '*メールアドレスが一致しません。';
}

if ( preg_match( '/\A[[:^cntrl:]]{0,30}\z/u', $tel ) == 0 ) {
	$error['tel'] = '*電話番号は30文字以内でお願いします。';
  }
  if ( $tel != '' && preg_match( '/\A\(?\d{2,5}\)?[-(\.\s]{0,2}\d{1,4}[-)\.\s]{0,2}\d{3,4}\z/u', $tel ) == 0 ) {
	$error['tel_format'] = '*電話番号の形式が正しくありません。';
  }
  if ( $subject == '' ) {
	$error['subject'] = '*件名は必須項目です。';
	//制御文字でないことと文字数をチェック
  } else if ( preg_match( '/\A[[:^cntrl:]]{1,100}\z/u', $subject ) == 0 ) {
	$error['subject'] = '*件名は100文字以内でお願いします。';
  }
  if ( $body == '' ) {
	$error['body'] = '*内容は必須項目です。';
	//制御文字（タブ、復帰、改行を除く）でないことと文字数をチェック
  } else if ( preg_match( '/\A[\r\n\t[:^cntrl:]]{1,1050}\z/u', $body ) == 0 ) {
	$error['body'] = '*内容は1000文字以内でお願いします。';
  }

  //POSTされたデータとエラーの配列をセッション変数に保存
$_SESSION['name']=$name;
$_SESSION['email']=$email;
$_SESSION[ 'email_check' ] = $email_check;
$_SESSION[ 'tel' ] = $tel;
$_SESSION[ 'subject' ] = $subject;
$_SESSION[ 'body' ] = $body;
$_SESSION[ 'error' ] = $error;

//チェックの結果にエラーがある場合は入力フォームに戻す
if(count($error)>0){
	//エラーがある場合 kutoriga nyuuryokuapurriniなったのかな
	//親ディレクトリのパスを取得 'SERVER_NAME'現在のスクリプトが実行されているサーバーのホスト名です
	$dirname=dirname($_SERVER['SCRIPT_NAME']);
	$dirname = $dirname == DIRECTORY_SEPARATOR ? '' : $dirname;
  $url = ( empty( $_SERVER[ 'HTTPS' ] ) ? 'http://' : 'https://' ) . $_SERVER[ 'SERVER_NAME' ] . $dirname . '/contact.php';
  header( 'HTTP/1.1 303 See Other' );
  header( 'location: ' . $url );
  exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
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
		<h2>お問い合わせ確認画面</h2>
		<p>以下の内容でよろしければ「送信する」をクリックしてください。<br>
内容を変更する場合は「戻る」をクリックして入力画面にお戻りください。</p>
		<div class="table-responsive">
			<table class="table table-bordered">
				<caption>ご入力内容</caption>
				<tbody>
					<tr>
						<td>
							お名前
						</td>
						<td>
							<?php echo $name;?>
						</td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $email;?></td>
					</tr>
					<tr>
						<td>お電話番号</td>
						<td><?php echo $tel;?></td>
					</tr>
					<tr>
						<td>件名</td>
						<td><?php echo $subject;?></td>
					</tr>
					<tr>
						<td>お問い合わせ内容</td>
						<td><?php echo nl2br(escape($body));?></td>//改行文字の前にHTMLの改行タグを入れる
					</tr>					
				</tbody>
			</table>
		</div>

		<form action="contact.php" method="POST" class="confirm">
			<button class="btn btn-secondary">戻る</button>
		</form>

		<form action="complete.php" method="POST" class="confirm">
			<input type="hidden" name="ticket" value="<?php echo escape($ticket);?>">
			<button class="btn btn-success">送信</button>
		</form>

	</div>
</body>
</html>
