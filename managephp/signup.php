<!--新規登録機能ページ-->
<?php
require '.\password_compat-master\lib\password.php';   // password_hash()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
// セッション開始
//session_start();
if(!isset($_SESSION)){
session_start();
}

$USER = 'root';
$PW = 'pass';
$dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";

//データベースに接続
try {
  $pdo = new PDO($dnsinfo,$USER,$PW);
} catch (\Exception $e) {
  $res = $e->getMessage();
}

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage2 = "";
$signUpMessage = "";

// 登録ボタンが押された場合
if (isset($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["username"])) {  // 値が空のとき
        $errorMessage2 = 'ユーザーIDが未入力です。';
    }
    else if (empty($_POST["usermail"])) {
        $errorMessage2 = 'メールアドレスが未入力です。';
    }else if (empty($_POST["password"])) {
        $errorMessage2 = 'パスワードが未入力です。';
    }else if (empty($_POST["password2"])) {
        $errorMessage2 = 'パスワードが未入力です。';
    }

    if (!empty($_POST["username"]) && !empty($_POST["usermail"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] === $_POST["password2"]) {
        // 入力したユーザIDとパスワードを格納
        $username = $_POST["username"];
        $usermail = $_POST["usermail"];
        $password = $_POST["password"];
        // 2. ユーザIDとパスワードが入力されていたら認証する

        // 3. エラー処理
        try {
            //既にメールアドレスが存在しているかの確認
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM loginmanagement WHERE mail=?");
            $stmt->execute(array($usermail));
            $result = $stmt->fetch(PDO::FETCH_NUM);
            $res = (int)$result[0];
            if (!$res){
              $stmt = $pdo->prepare("INSERT INTO loginmanagement(name,mail,password) VALUES (?,?, ?)");
              $stmt->execute(array($username,$usermail, password_hash($password, PASSWORD_DEFAULT)));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
              $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる
              $_SESSION["NAME"] = $username;
              $_SESSION["MAIL"] = $row['mail'];
              $_SESSION["PHONENUMBER"] = $row['phonenumber'];
              $_SESSION["UNIVERSITY"] = $row['university'];
              $_SESSION["UNDERGRADUATE"] = $row['undergraduate'];
              $_SESSION["DEPARTMENT"] = $row['department'];
              $_SESSION["GRADUATEYEAR"] = $row['graduateyear'];
              $_SESSION["SCHOOLYEAR"] = $row['schoolyear'];
              $_SESSION["SELFAPPEAL"] = $row['selfappeal'];
              $_SESSION["AREAOFINTEREST"] = $row['areaofinterest'];
              $_SESSION["CLUBINHIGHSCHOOL"] = $row['clubinhighschool'];
              $_SESSION["CURRENTACTIVITY"] = $row['currentactivity'];
              header("Location: user.php");  // メイン画面へ遷移
              exit();  // 処理終了

              $signUpMessage = '登録が完了しました。まず初めにプロフィールを完成させてください。';  // ログイン時に使用するIDとパスワード
            }else{
              $errorMessage2 = '既にメールアドレスは存在します。';
            }
        } catch (PDOException $e) {
            $errorMessage2 = 'データベースエラー';
             //$e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
             //echo $e->getMessage();
        }
    } else if($_POST["password"] != $_POST["password2"]) {
        $errorMessage2 = 'パスワードに誤りがあります。';
    }

    //新規登録失敗の時にもう一度新規登録モーダルを表示
    $script1 = <<<EOM
    <script type="text/javascript">
    //console.log('{$errorMessage2}');
    //location.href = "main.php";
    document.getElementById("sighupbtn").click();
    </script>
    EOM;
}
?>
