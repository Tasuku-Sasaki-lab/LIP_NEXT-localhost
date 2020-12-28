<!--インターンシップを検索する機能ページ-->
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

//var_dump($_POST['fields']);
//var_dump($_POST['types']);
//var_dump($_POST['regions']);


//インターンシップを探すモーダルで検索した時の処理
if(isset($_POST['fields']) && is_array($_POST['fields']) && isset($_POST['regions']) && isset($_POST['types'])) {
  $fieldvalue = $_POST['fields'];
  $regionsvalue = $_POST['regions'][0];
  $typesvalue = $_POST['types'][0];
  $fieldvaluelength = count($fieldvalue);
  try{
    $res = "";
    $i2=0;
    foreach( $_POST['fields'] as $value){
      $sql = "SELECT * FROM internships2 WHERE Field='{$value}'  AND  region='{$regionsvalue}' AND InternshipType ='{$typesvalue}' ORDER BY PublicationDay DESC ;";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(null);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if(strpos($res,$row['InternshipName'])){
          continue;
        }
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
        $i2 = $i2+1;
        }
    }
    if ($i2==0){
      $res .=<<<_CARD
      <div class="alert alert-info mb-5 mt-5" role="alert">一致する検索結果はありません。検索条件を変えてもう一度やり直してください。</div>
      _CARD;
    }
    /*
    $res .=<<<_BUTTON
    <form class="row pt-5" action="main.php#addinternship" method="post">
      <div class="col-4"></div>
      <button  class="btn btn-outline-primary btn-rounded waves-effect col-4" type="submit" name="addpartially" value=1>もっと見る</button>
      <div class="col-4"></div>
    </form>
    _BUTTON;
    */
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
else if(isset($_POST['fields']) && is_array($_POST['fields']) && isset($_POST['regions'])) {
  $fieldvalue = $_POST['fields'];
  $regionsvalue = $_POST['regions'][0];
  $fieldvaluelength = count($fieldvalue);
  try{
    $res = "";
    $i2=0;
    foreach( $_POST['fields'] as $value){
      $sql = "SELECT * FROM internships2 WHERE Field='{$value}' AND region='{$regionsvalue}' ORDER BY PublicationDay DESC ;";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(null);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if(strpos($res,$row['InternshipName'])){
          continue;
        }
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
        $i2 = $i2+1;
        }
    }
    if ($i2==0){
      $res .=<<<_CARD
      <div class="alert alert-info mb-5 mt-5" role="alert">一致する検索結果はありません。検索条件を変えてもう一度やり直してください。</div>
      _CARD;
    }
    /*
    $res .=<<<_BUTTON
    <form class="row pt-5" action="main.php#addinternship" method="post">
      <div class="col-4"></div>
      <button  class="btn btn-outline-primary btn-rounded waves-effect col-4" type="submit" name="addpartially" value=1>もっと見る</button>
      <div class="col-4"></div>
    </form>
    _BUTTON;
    */
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
else if(isset($_POST['fields']) && is_array($_POST['fields']) && isset($_POST['types'])) {
  $fieldvalue = $_POST['fields'];
  $typesvalue = $_POST['types'][0];
  try{
    $res = "";
    $i2=0;
    foreach( $_POST['fields'] as $value){
      $sql = "SELECT * FROM internships2 WHERE Field='{$value}' AND InternshipType ='{$typesvalue}' ORDER BY PublicationDay DESC ;";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(null);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if(strpos($res,$row['InternshipName'])){
          continue;
        }
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
        $i2 = $i2+1;
        }
    }
    if ($i2==0){
      $res .=<<<_CARD
      <div class="alert alert-info mb-5 mt-5" role="alert">一致する検索結果はありません。検索条件を変えてもう一度やり直してください。</div>
      _CARD;
    }
    /*
    $res .=<<<_BUTTON
    <form class="row pt-5" action="main.php#addinternship" method="post">
      <div class="col-4"></div>
      <button  class="btn btn-outline-primary btn-rounded waves-effect col-4" type="submit" name="addpartially" value=1>もっと見る</button>
      <div class="col-4"></div>
    </form>
    _BUTTON;
    */
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
else if(isset($_POST['types']) && isset($_POST['regions'])) {
  $typesvalue = $_POST['types'][0];
  $regionsvalue = $_POST['regions'][0];
  try{
    $res = "";
    $i2=0;
    $sql = "SELECT * FROM internships2 WHERE region='{$regionsvalue}' AND InternshipType ='{$typesvalue}' ORDER BY PublicationDay DESC ;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(null);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      if(strpos($res,$row['InternshipName'])){
        continue;
      }
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
      $i2 = $i2+1;
      }
    if ($i2==0){
      $res .=<<<_CARD
      <div class="alert alert-info mb-5 mt-5" role="alert">一致する検索結果はありません。検索条件を変えてもう一度やり直してください。</div>
      _CARD;
    }
    /*
    $res .=<<<_BUTTON
    <form class="row pt-5" action="main.php#addinternship" method="post">
      <div class="col-4"></div>
      <button  class="btn btn-outline-primary btn-rounded waves-effect col-4" type="submit" name="addpartially" value=1>もっと見る</button>
      <div class="col-4"></div>
    </form>
    _BUTTON;
    */
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
else if(isset($_POST['fields']) && is_array($_POST['fields'])) {
  $fieldvalue = $_POST['fields'];
  $fieldvaluelength = count($fieldvalue);
  try{
    $res = "";
    $i2=0;
    foreach( $_POST['fields'] as $value){
      $sql = "SELECT * FROM internships2 WHERE Field='{$value}' ORDER BY PublicationDay DESC ;";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(null);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if(strpos($res,$row['InternshipName'])){
          continue;
        }
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
        $i2 = $i2+1;
        }
    }
    if ($i2==0){
      $res .=<<<_CARD
      <div class="alert alert-info mb-5 mt-5" role="alert">一致する検索結果はありません。検索条件を変えてもう一度やり直してください。</div>
      _CARD;
    }
    /*
    $res .=<<<_BUTTON
    <form class="row pt-5" action="main.php#addinternship" method="post">
      <div class="col-4"></div>
      <button  class="btn btn-outline-primary btn-rounded waves-effect col-4" type="submit" name="addpartially" value=1>もっと見る</button>
      <div class="col-4"></div>
    </form>
    _BUTTON;
    */
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
else if(isset($_POST['regions'])) {
  $regionsvalue = $_POST['regions'][0];
  try{
    $res = "";
    $i2=0;
    $sql = "SELECT * FROM internships2 WHERE region='{$regionsvalue}' ORDER BY PublicationDay DESC ;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(null);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      if(strpos($res,$row['InternshipName'])){
        continue;
      }
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
      $i2 = $i2+1;
    if ($i2==0){
      $res .=<<<_CARD
      <div class="alert alert-info mb-5 mt-5" role="alert">一致する検索結果はありません。検索条件を変えてもう一度やり直してください。</div>
      _CARD;
    }
    /*
    $res .=<<<_BUTTON
    <form class="row pt-5" action="main.php#addinternship" method="post">
      <div class="col-4"></div>
      <button  class="btn btn-outline-primary btn-rounded waves-effect col-4" type="submit" name="addpartially" value=1>もっと見る</button>
      <div class="col-4"></div>
    </form>
    _BUTTON;
    */
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
else if(isset($_POST['types'])) {
  $typesvalue = $_POST['types'][0];
  try{
    $res = "";
    $i2=0;
    $sql = "SELECT * FROM internships2 WHERE InternshipType ='{$typesvalue}' ORDER BY PublicationDay DESC ;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(null);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      if(strpos($res,$row['InternshipName'])){
        continue;
      }

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

      $i2 = $i2+1;
      }
    if ($i2==0){
      $res .=<<<_CARD
      <div class="alert alert-info mb-5 mt-5" role="alert">一致する検索結果はありません。検索条件を変えてもう一度やり直してください。</div>
      _CARD;
    }
    /*
    $res .=<<<_BUTTON
    <form class="row pt-5" action="main.php#addinternship" method="post">
      <div class="col-4"></div>
      <button  class="btn btn-outline-primary btn-rounded waves-effect col-4" type="submit" name="addpartially" value=1>もっと見る</button>
      <div class="col-4"></div>
    </form>
    _BUTTON;
    */
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}
else if(isset($_POST['searchfield'])) {
  $searchtext = $_POST['searchtext'];
  try{
    $res = "";
    $i2=0;

    $sql = "SELECT * FROM internships2 WHERE InternshipName LIKE '%{$searchtext}%' OR Field LIKE '%{$searchtext}%' OR InternshipOutline LIKE '%{$searchtext}%' OR InternshipLocation LIKE '%{$searchtext}%' OR InternshipFor LIKE '%{$searchtext}%' ORDER BY PublicationDay DESC ;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(null);
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
      $i2 = $i2+1;
      }
      if ($i2==0){
        $res .=<<<_CARD
        <div class="alert alert-info mb-5 mt-5" role="alert">一致する検索結果はありません。検索条件を変えてもう一度やり直してください。</div>
        _CARD;
      }
  }catch(PDOException $e){
    $res = $e->getMessage();
  }
}

?>
