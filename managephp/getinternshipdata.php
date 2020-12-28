<!--インターンシップのデータを表示する機能ページ-->
<?php
$count = 0;

$USER = 'root';
$PW = 'pass';
$dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";

//データベースに接続
try {
  $pdo = new PDO($dnsinfo,$USER,$PW);
} catch (\Exception $e) {
  $res = $e->getMessage();
}

if(isset($_POST['new'])) {
  try{
    $sql = "SELECT * FROM internships2 ORDER BY PublicationDay DESC;";// LIMIT 2
    $stmt = $pdo->prepare($sql);
    $stmt->execute(null);
    $res = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      if($row['InternshipType']=="長期インターンシップ"){
        $InternshipTypeNumber=0;
      }else if ($row['InternshipType']=="OneDayイベント"){
        $InternshipTypeNumber=1;
      }

      $res .=<<<_CARD
      <!-- Card -->
      <!-- Card  --> <!-- mt-5 pt-4  border-radius:2vw;border:1px solid black; -->
      <div class="cplist-cp-box pt-1 pb-3 pl-2 pr-2 " style="background-color:white; ">
      <div class="loop-cplist-lr">
        <div class="loop-cplist-l">
          <div class="loop-cplist-pic-out">
            <div class="loop-cplist-pic-in mt-4">
              <img alt="" data-src="{$row['InternshipImage']}" class=" lazyloaded" src="{$row['InternshipImage']}"><noscript><img src="{$row['InternshipImage']}" alt=""></noscript>
            </div>
          </div>
        </div>
        <div class="loop-cplist-r">
          <h3 class="loop-cplist-cpname text-center"><strong>{$row['InternshipName']}</strong></h3>
          <p class="mt-4 text-center">{$row['InternshipType']}</p>
          <div class="loop-cplist-inf">
            <p><span class="bold">企業概要</span>：{$row['InternshipOutline']}<br>
              <br>
              <span class="bold">どんな学生に合っているか</span>：{$row['InternshipFor']}<br>
              <br>
              <span class="bold">勤務地</span>　：{$row['InternshipLocation']}<br>
              <span class="bold">募集職種</span>：{$row['Field']}</p>
          </div>
          <div class="loop-cplist-button-area">
            <button class="loop-cplist-button cpweb"><a href="enterprisepage{$InternshipTypeNumber}.php?page={$row['InternshipName']}">詳細はこちらから</a></button>
            <button class="loop-cplist-button apply white-text" onclick="applyclick()" data-toggle="modal" data-target="#applymodal" data-senduser="{$row['InternshipName']}"><a>申し込みはこちらから</a></button>
          </div>
        </div>
        </div>
      </div>
      <!-- Card -->

      <hr class="mt-3 pt-3">
      <!-- Card -->
      _CARD;
    }
    /*
    $res .=<<<_BUTTON
    <form class="row pt-3" action="user.php#addinternship" method="post">
      <div class="col-md-4 col-2"></div>
      <button  class="btn btn-outline-primary btn-rounded waves-effect col-md-4 col-8" type="submit" name="addnew" value=2>もっと見る</button>
      <div class="col-md-4 col-2"></div>
    </form>
_BUTTON;
  */
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
else if(isset($_POST['popular'])){
  try{
    $sql = "SELECT * FROM internships2 ORDER BY Popular DESC;";//LIMIT 2
    $stmt = $pdo->prepare($sql);
    $stmt->execute(null);
    $res = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      if($row['InternshipType']=="長期インターンシップ"){
        $InternshipTypeNumber=0;
      }else if ($row['InternshipType']=="OneDayイベント"){
        $InternshipTypeNumber=1;
      }

      $res .=<<<_CARD
      <!-- Card -->
      <!-- Card  --> <!-- mt-5 pt-4  border-radius:2vw;border:1px solid black; -->
      <div class="cplist-cp-box pt-1 pb-3 pl-2 pr-2 " style="background-color:white; ">
      <div class="loop-cplist-lr">
        <div class="loop-cplist-l">
          <div class="loop-cplist-pic-out">
            <div class="loop-cplist-pic-in mt-4">
              <img alt="" data-src="{$row['InternshipImage']}" class=" lazyloaded" src="{$row['InternshipImage']}"><noscript><img src="{$row['InternshipImage']}" alt=""></noscript>
            </div>
          </div>
        </div>
        <div class="loop-cplist-r">
          <h3 class="loop-cplist-cpname text-center"><strong>{$row['InternshipName']}</strong></h3>
          <p class="mt-4 text-center">{$row['InternshipType']}</p>
          <div class="loop-cplist-inf">
            <p><span class="bold">企業概要</span>：{$row['InternshipOutline']}<br>
              <br>
              <span class="bold">どんな学生に合っているか</span>：{$row['InternshipFor']}<br>
              <br>
              <span class="bold">勤務地</span>　：{$row['InternshipLocation']}<br>
              <span class="bold">募集職種</span>：{$row['Field']}</p>
          </div>
          <div class="loop-cplist-button-area">
            <button class="loop-cplist-button cpweb"><a href="enterprisepage{$InternshipTypeNumber}.php?page={$row['InternshipName']}">詳細はこちらから</a></button>
            <button class="loop-cplist-button apply white-text" onclick="applyclick()" data-toggle="modal" data-target="#applymodal" data-senduser="{$row['InternshipName']}"><a>申し込みはこちらから</a></button>
          </div>
        </div>
        </div>
      </div>
      <!-- Card -->

      <hr class="mt-3 pt-3">
      <!-- Card -->
      _CARD;
    }
    /*
    $res .=<<<_BUTTON
    <form class="row pt-3" action="user.php#addinternship" method="post">
      <div class="col-md-4 col-2"></div>
      <button  class="btn btn-outline-primary btn-rounded waves-effect col-md-4 col-8" type="submit" name="add" value=2>もっと見る</button>
      <div class="col-md-4 col-2"></div>
    </form>
_BUTTON;
*/
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
//人気インターンシップの追加
else if(isset($_POST['add'])){
  $USER = 'root';
  $PW = 'pass';
  $dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";
  $count = $_POST['add'];
  $count = $count + 1;
  try{
    $sql = "SELECT * FROM internships2 ORDER BY Popular DESC;"; //LIMIT {$count}
    $stmt = $pdo->prepare($sql);
    $stmt->execute(null);
    $res = "";
    $i = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      //追加したカードに飛ぶリンクをつけるためのアルゴリズム

      if($row['InternshipType']=="長期インターンシップ"){
        $InternshipTypeNumber=0;
      }else if ($row['InternshipType']=="OneDayイベント"){
        $InternshipTypeNumber=1;
      }

      if ($i==($count-1)){
        $res .=<<<_CARD
        <a name="addinternship" class="pt-5"></a> <!-- ←追加したカードに飛ぶリンク -->

        <!-- Card -->
        <!-- Card  --> <!-- mt-5 pt-4  border-radius:2vw;border:1px solid black; -->
        <div class="cplist-cp-box pt-1 pb-3 pl-2 pr-2 " style="background-color:white; ">
        <div class="loop-cplist-lr">
          <div class="loop-cplist-l">
            <div class="loop-cplist-pic-out">
              <div class="loop-cplist-pic-in mt-4">
                <img alt="" data-src="{$row['InternshipImage']}" class=" lazyloaded" src="{$row['InternshipImage']}"><noscript><img src="{$row['InternshipImage']}" alt=""></noscript>
              </div>
            </div>
          </div>
          <div class="loop-cplist-r">
            <h3 class="loop-cplist-cpname text-center"><strong>{$row['InternshipName']}</strong></h3>
            <p class="mt-4 text-center">{$row['InternshipType']}</p>
            <div class="loop-cplist-inf">
              <p><span class="bold">企業概要</span>：{$row['InternshipOutline']}<br>
                <br>
                <span class="bold">どんな学生に合っているか</span>：{$row['InternshipFor']}<br>
                <br>
                <span class="bold">勤務地</span>　：{$row['InternshipLocation']}<br>
                <span class="bold">募集職種</span>：{$row['Field']}</p>
            </div>
            <div class="loop-cplist-button-area">
              <button class="loop-cplist-button cpweb"><a href="enterprisepage{$InternshipTypeNumber}.php?page={$row['InternshipName']}">詳細はこちらから</a></button>
              <button class="loop-cplist-button apply white-text" onclick="applyclick()" data-toggle="modal" data-target="#applymodal" data-senduser="{$row['InternshipName']}"><a>申し込みはこちらから</a></button>
            </div>
          </div>
          </div>
        </div>
        <!-- Card -->

        <hr class=" mt-5 pt-4">
        _CARD;
      }else{

        $res .=<<<_CARD
        <!-- Card -->
        <!-- Card  --> <!-- mt-5 pt-4  border-radius:2vw;border:1px solid black; -->
        <div class="cplist-cp-box pt-1 pb-3 pl-2 pr-2 " style="background-color:white; ">
        <div class="loop-cplist-lr">
          <div class="loop-cplist-l">
            <div class="loop-cplist-pic-out">
              <div class="loop-cplist-pic-in mt-4">
                <img alt="" data-src="{$row['InternshipImage']}" class=" lazyloaded" src="{$row['InternshipImage']}"><noscript><img src="{$row['InternshipImage']}" alt=""></noscript>
              </div>
            </div>
          </div>
          <div class="loop-cplist-r">
            <h3 class="loop-cplist-cpname text-center"><strong>{$row['InternshipName']}</strong></h3>
            <p class="mt-4 text-center">{$row['InternshipType']}</p>
            <div class="loop-cplist-inf">
              <p><span class="bold">企業概要</span>：{$row['InternshipOutline']}<br>
                <br>
                <span class="bold">どんな学生に合っているか</span>：{$row['InternshipFor']}<br>
                <br>
                <span class="bold">勤務地</span>　：{$row['InternshipLocation']}<br>
                <span class="bold">募集職種</span>：{$row['Field']}</p>
            </div>
            <div class="loop-cplist-button-area">
              <button class="loop-cplist-button cpweb"><a href="enterprisepage{$InternshipTypeNumber}.php?page={$row['InternshipName']}">詳細はこちらから</a></button>
              <button class="loop-cplist-button apply white-text" onclick="applyclick()" data-toggle="modal" data-target="#applymodal" data-senduser="{$row['InternshipName']}"><a>申し込みはこちらから</a></button>
            </div>
          </div>
          </div>
        </div>
        <!-- Card -->

        <hr class="mt-3 pt-3">
        <!-- Card -->
        _CARD;
      }
      $i = $i + 1;
    }
    /*
    $res .=<<<_BUTTON
    <form class="row pt-3" action="user.php#addinternship" method="post">
      <div class="col-md-4 col-2"></div>
      <button  class="btn btn-outline-primary btn-rounded waves-effect col-md-4 col-8" type="submit" name="add" value={$count}>もっと見る</button>
      <div class="col-md-4 col-2"></div>
    </form>
    _BUTTON;
    */
  }
catch(PDOException $e){
    $res = $e->getMessage();
}
}
//新しいインターンシップの追加
else if(isset($_POST['addnew'])){
  $USER = 'root';
  $PW = 'pass';
  $dnsinfo = "mysql:dbname=internshiptest;host=localhost;charset=utf8";
  $count = $_POST['addnew'];
  $count = $count + 1;

  try{
  $pdo = new PDO($dnsinfo,$USER,$PW);
  $sql = "SELECT * FROM internships2 ORDER BY PublicationDay DESC;";//LIMIT {$count}
  $stmt = $pdo->prepare($sql);
  $stmt->execute(null);
  $res = "";
  $i = 0;
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    //追加したカードに飛ぶリンクをつけるためのアルゴリズム

    if($row['InternshipType']=="長期インターンシップ"){
      $InternshipTypeNumber=0;
    }else if ($row['InternshipType']=="OneDayイベント"){
      $InternshipTypeNumber=1;
    }

    if ($i==($count-1)){
      $res .=<<<_CARD
      <a name="addinternship" class="pt-5"></a> <!-- ←追加したカードに飛ぶリンク -->

      <!-- Card -->
      <!-- Card  --> <!-- mt-5 pt-4  border-radius:2vw;border:1px solid black; -->
      <div class="cplist-cp-box pt-1 pb-3 pl-2 pr-2 " style="background-color:white; ">
      <div class="loop-cplist-lr">
        <div class="loop-cplist-l">
          <div class="loop-cplist-pic-out">
            <div class="loop-cplist-pic-in mt-4">
              <img alt="" data-src="{$row['InternshipImage']}" class=" lazyloaded" src="{$row['InternshipImage']}"><noscript><img src="{$row['InternshipImage']}" alt=""></noscript>
            </div>
          </div>
        </div>
        <div class="loop-cplist-r">
          <h3 class="loop-cplist-cpname text-center"><strong>{$row['InternshipName']}</strong></h3>
          <p class="mt-4 text-center">{$row['InternshipType']}</p>
          <div class="loop-cplist-inf">
            <p><span class="bold">企業概要</span>：{$row['InternshipOutline']}<br>
              <br>
              <span class="bold">どんな学生に合っているか</span>：{$row['InternshipFor']}<br>
              <br>
              <span class="bold">勤務地</span>　：{$row['InternshipLocation']}<br>
              <span class="bold">募集職種</span>：{$row['Field']}</p>
          </div>
          <div class="loop-cplist-button-area">
            <button class="loop-cplist-button cpweb"><a href="enterprisepage{$InternshipTypeNumber}.php?page={$row['InternshipName']}">詳細はこちらから</a></button>
            <button class="loop-cplist-button apply white-text" onclick="applyclick()" data-toggle="modal" data-target="#applymodal" data-senduser="{$row['InternshipName']}"><a>申し込みはこちらから</a></button>
          </div>
        </div>
        </div>
      </div>
      <!-- Card -->

      <hr class=" mt-5 pt-4">
      _CARD;
    }else{

      $res .=<<<_CARD
      <!-- Card -->
      <!-- Card  --> <!-- mt-5 pt-4  border-radius:2vw;border:1px solid black; -->
      <div class="cplist-cp-box pt-1 pb-3 pl-2 pr-2 " style="background-color:white; ">
      <div class="loop-cplist-lr">
        <div class="loop-cplist-l">
          <div class="loop-cplist-pic-out">
            <div class="loop-cplist-pic-in mt-4">
              <img alt="" data-src="{$row['InternshipImage']}" class=" lazyloaded" src="{$row['InternshipImage']}"><noscript><img src="{$row['InternshipImage']}" alt=""></noscript>
            </div>
          </div>
        </div>
        <div class="loop-cplist-r">
          <h3 class="loop-cplist-cpname text-center"><strong>{$row['InternshipName']}</strong></h3>
          <p class="mt-4 text-center">{$row['InternshipType']}</p>
          <div class="loop-cplist-inf">
            <p><span class="bold">企業概要</span>：{$row['InternshipOutline']}<br>
              <br>
              <span class="bold">どんな学生に合っているか</span>：{$row['InternshipFor']}<br>
              <br>
              <span class="bold">勤務地</span>　：{$row['InternshipLocation']}<br>
              <span class="bold">募集職種</span>：{$row['Field']}</p>
          </div>
          <div class="loop-cplist-button-area">
            <button class="loop-cplist-button cpweb"><a href="enterprisepage{$InternshipTypeNumber}.php?page={$row['InternshipName']}">詳細はこちらから</a></button>
            <button class="loop-cplist-button apply white-text" onclick="applyclick()" data-toggle="modal" data-target="#applymodal" data-senduser="{$row['InternshipName']}"><a>申し込みはこちらから</a></button>
          </div>
        </div>
        </div>
      </div>
      <!-- Card -->

      <hr class="mt-3 pt-3">
      <!-- Card -->
      _CARD;

  $i = $i + 1;
  }
  }
  /*
  $res .=<<<_BUTTON
  <form class="row pt-3" action="user.php#addinternship" method="post">
    <div class="col-md-4 col-2"></div>
    <button  class="btn btn-outline-primary btn-rounded waves-effect col-md-4 col-8" type="submit" name="addnew" value={$count}>もっと見る</button>
    <div class="col-md-4 col-2"></div>
  </form>
_BUTTON;
*/
}
catch(PDOException $e){
    $res = $e->getMessage();
  }
}
//最初のアクセスはここを表示する
else {
  try{
    $sql = "SELECT * FROM internships2 ORDER BY popular DESC;"; //LIMIT 2
    $stmt = $pdo->prepare($sql);
    $stmt->execute(null);
    $res = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      if($row['InternshipType']=="長期インターンシップ"){
        $InternshipTypeNumber=0;
      }else if ($row['InternshipType']=="OneDayイベント"){
        $InternshipTypeNumber=1;
      }

      $res .=<<<_CARD
      <!-- Card -->
      <!-- Card  --> <!-- mt-5 pt-4  border-radius:2vw;border:1px solid black; -->
      <div class="cplist-cp-box pt-1 pb-3 pl-2 pr-2 " style="background-color:white; ">
      <div class="loop-cplist-lr">
        <div class="loop-cplist-l">
          <div class="loop-cplist-pic-out">
            <div class="loop-cplist-pic-in mt-4">
              <img alt="" data-src="{$row['InternshipImage']}" class=" lazyloaded" src="{$row['InternshipImage']}"><noscript><img src="{$row['InternshipImage']}" alt=""></noscript>
            </div>
          </div>
        </div>
        <div class="loop-cplist-r">
          <h3 class="loop-cplist-cpname text-center"><strong>{$row['InternshipName']}</strong></h3>
          <p class="mt-4 text-center">{$row['InternshipType']}</p>
          <div class="loop-cplist-inf">
            <p><span class="bold">企業概要</span>：{$row['InternshipOutline']}<br>
              <br>
              <span class="bold">どんな学生に合っているか</span>：{$row['InternshipFor']}<br>
              <br>
              <span class="bold">勤務地</span>　：{$row['InternshipLocation']}<br>
              <span class="bold">募集職種</span>：{$row['Field']}</p>
          </div>
          <div class="loop-cplist-button-area">
            <button class="loop-cplist-button cpweb"><a href="enterprisepage{$InternshipTypeNumber}.php?page={$row['InternshipName']}">詳細はこちらから</a></button>
            <button class="loop-cplist-button apply white-text" onclick="applyclick()" data-toggle="modal" data-target="#applymodal" data-senduser="{$row['InternshipName']}"><a>申し込みはこちらから</a></button>
          </div>
        </div>
        </div>
      </div>
      <!-- Card -->

      <hr class="mt-3 pt-3">
      <!-- Card -->
      _CARD;
    }
    /*
    $res .= <<<_BUTTON
    <form class="row pt-3" action="user.php#addinternship" method="post">
      <div class="col-md-4 col-2"></div>
      <button  class="btn btn-outline-primary btn-rounded waves-effect col-md-4 col-8" type="submit" name="add" value=2>もっと見る</button>
      <div class="col-md-4 col-2"></div>
    </form>
    _BUTTON;
    */
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}

?>
