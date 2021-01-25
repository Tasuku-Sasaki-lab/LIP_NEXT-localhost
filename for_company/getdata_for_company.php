<?php
 require "login_for_company.php";
$companyID=$_SESSION['companyID'];

if(isset($companyID)){
	$USER = 'root';
	$PW = 'pass';
	$dnsinfo = "mysql:dbname=lip-next;host=localhost;charset=utf8";
   
	$pdo=new PDO($dnsinfo,$USER,$PW);
	//sqlの実行文はながいから、変数にしている。
	$sql="SELECT * FROM internship WHERE companyID ='".$companyID."';";
	//当該の会社のインターン情報だけ取得
	$stmt=$pdo->prepare($sql);
	$stmt->execute(null);
	$count = $stmt-> rowCount();
	$res="";
 
    if ($count!=0) {
        for ($i=0;$i<$count;$i++) {
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            $res.=<<<_CARD
      <!-- Card  --> <!-- mt-5 pt-4  border-radius:2vw;border:1px solid black; -->
      <div class="cplist-cp-box pt-3 pb-4 pl-2 pr-2 " style="background-color:white; ">
      <div class="loop-cplist-lr">
        <div class="loop-cplist-l">
          <div class="loop-cplist-pic-out">
            <div class="loop-cplist-pic-in">
               <img alt="" data-src="{$row['internshipimage']}" class=" lazyloaded" src="{$row['internshipimage']}"><noscript><img src="{$row['internshipimage']}" alt=""></noscript>
            </div>
          </div>
        </div>
        <div class="loop-cplist-r">
          <h3 class="loop-cplist-cpname text-center">{$row['internshipname']} <span class="loop-cplist-inf bold p-1">{$row['internshipcondition']}</span></h3>
          <div class="loop-cplist-inf">
            <P><span class="bold">募集タイプ</span>:{$row['internshiptype']}<br>
              <br>
              <span class="bold">企業概要</span>：{$row['internshipoutline']}<br>
              <br>
              <span class="bold">どんな学生に合っているか</span>：{$row['internshipfor']}<br>
              <br>
              <span class="bold">勤務地</span>　：{$row['internshiplocation']}<br>
              <span class="bold">募集職種</span>：{$row['internshipfield']}</p>
          </div>
         <form class="loop-cplist-button-area">
          <button class="loop-cplist-button cpweb"><a href="companypage.php?page={$row['internshipID']}">詳細</a></button><!--?でつないでるのはGET処理-->
          <button class="loop-cplist-button apply white-text"><a href="applying_user_list.php?internshipID={$row['internshipID']}">申し込み者</a></button>
          </form>
        </div>
        </div>
      </div>
      <!-- Card -->
      <hr class=" mt-5 pt-4">
      _CARD;
        }
    }else{
		$res.="募集中のインターンはありません";
	}


	


}else{
	$res="ログインからgetdata.phpに情報が渡せていません";
}
?>



