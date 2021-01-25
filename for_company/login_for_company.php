<?php
require '../password_compat-master\lib\password.php';   // password_verfy()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用

// セッション開始
//session_start();
if(!isset($_SESSION)){
	session_start();
	}

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "pass";  // ユーザー名のパスワード
$db['dbname'] = "lip-next";  // データベース名
	
// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if(isset($_POST['login'])){
	 // 1. ユーザIDの入力チェック
	 if (empty($_POST["mail"])) {  // emptyは値が空のとき
        $errorMessage = '会社名が未入力です。';
	}

	if(!empty($_POST['mail'])){
		//会社名を格納
		$mail=$_POST['mail'];
		  // 2. ユーザIDとパスワードが入力されていたら認証する
		  $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

		
		//エラー処理
		try{
			$pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

			//sqlの実行文はながいから、変数にしている。
			$sql="SELECT * FROM company WHERE companymail ='".$mail."';";
			//当該の会社のインターン情報だけ取得
			$stmt=$pdo->prepare($sql);
			$stmt->execute(null);
			
			$password = $_POST["password"]; 

			if($row=$stmt->fetch(PDO::FETCH_ASSOC)){

				//var_dump($row);
				if (password_verify($password, $row['companypasswd'])) {
                    session_regenerate_id(true);
					/*
                    // 入力したIDのユーザー名を取得
                    $id = $row['id'];
                    //$sql = "SELECT * FROM userData WHERE id = $id";  //入力したIDからユーザー名を取得
                    //$sql = "SELECT name FROM loginmanagement WHERE name = $userinfo or mail = $userinfo";
                    //$stmt = $pdo->query($sql);
                    //foreach ($stmt as $row) {
                    //    $row['name'];  // ユーザー名
					//}*/
					$_SESSION["companyID"] = $row['companyID'];
					$_SESSION["companyname"] = $row['companyname'];
					$_SESSION["companyinfo"] = $row['companyinfo'];
					$_SESSION["companylogo"] = $row['companylogo'];
					$_SESSION["companyurl"] = $row['companyurl'];
					$_SESSION["companybusiness"] = $row['companybusiness'];
					$_SESSION["companymail"] = $row['companymail'];
					$_SESSION["companypasswd"] = $row['companypasswd'];
					
                    header("Location: main_for_company.php");  // メイン画面へ遷移
					exit();  // 処理終了
					
                 } else {
                    // 認証失敗
					$errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
				 }
					
                
			}
		}catch(PDORow $e){
			$errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
		}

	}
	

}

?>

