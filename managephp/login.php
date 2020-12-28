<!--ログイン機能ページ（パスワードライブラリはmain.phpに記述-->
<?php
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

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userinfo"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }
    if (!empty($_POST["userinfo"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userinfo = $_POST["userinfo"];
        // 2. ユーザIDとパスワードが入力されていたら認証する
        // 3. エラー処理
        try {
            $stmt = $pdo->prepare('SELECT * FROM loginmanagement WHERE mail = ? ');
            $stmt->execute(array($userinfo));
            $password = $_POST["password"];
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);
                    // 入力したIDのユーザー名を取得
                    $id = $row['id'];
                    // 4. 認証成功なら、セッションIDを新規に発行する
                    $_SESSION["NAME"] = $row['name'];
                    //$_SESSION["MAIL"] = $row['mail'];
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
                    if ($row['name']=="root"){
                      header("Location:black-dashboard-master\\examples\\dashboard.php");  // ログイン後のメイン画面へ遷移
                    }
                    else{
                      header("Location: user.php");  // ログイン後のメイン画面へ遷移
                    }
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }
    }

    //ログイン失敗の時にもう一度ログインモーダルを表示
    $script1 = <<<EOM
    <script type="text/javascript">
    //alert('ログインしてください。');
    //location.href = "main.php";
    document.getElementById("loginbtn").click();
    </script>
    EOM;
}
?>
