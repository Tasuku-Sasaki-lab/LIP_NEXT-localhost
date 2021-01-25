<?php
session_start();

if (isset($_SESSION["companyID"])) {
    $errorMessage = "ログアウトしました。";
} else {
    $errorMessage = "セッションがタイムアウトしました。";
}

// セッションの変数のクリア
$_SESSION = array();

// セッションクリア
@session_destroy();

$no_login_url = "first_for_company.php";
header("Location: {$no_login_url}");
?>
