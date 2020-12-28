<!--ログアウト機能ページ-->
<?php
session_start();

if (isset($_SESSION["NAME"])) {
    $errorMessage = "ログアウトしました。";
} else {
    $errorMessage = "セッションがタイムアウトしました。";
}

// セッションの変数のクリア
$_SESSION = array();

// セッションクリア
@session_destroy();

$no_login_url = "../main.php";
header("Location: {$no_login_url}");
?>
