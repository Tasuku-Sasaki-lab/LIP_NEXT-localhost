timer1 = "";
/*時間を作る関数*/
function sleep(waitMsec) {
  var startMsec = new Date();
  // 指定ミリ秒間だけループさせる（CPUは常にビジー状態）
  while (new Date() - startMsec < waitMsec);
}

/*自動スクロールのスクリプト*/
var $scrollY = 0;
function autoScroll() {
  const spinner = document.getElementById('loading');
  var $sampleBox = document.getElementById("scroll-box");
  $sampleBox.scrollTop = ++$scrollY;
  $sampleBox.scrollTop = $sampleBox.scrollHeight;
  if ($scrollY < $sampleBox.scrollHeight - $sampleBox.clientHeight) {
    $scrolly = $sampleBox.scrollHeight - $sampleBox.clientHeight;
    spinner.classList.add('loaded');
    return;
    setTimeout("autoScroll()", 1);
  } else if ($scrollY == $sampleBox.scrollHeight - $sampleBox.clientHeight) {
    spinner.classList.add('loaded');
    return;
  } else {
    $scrollY = 0;
    $sampleBox.scrollTop = 0;
    setTimeout("autoScroll()", 1);
  }
}
/*
function autoScroll(){
  const spinner = document.getElementById('loading');
  spinner.classList.add('loaded');
  var speed = 1; //時間あたりに移動するpx量です。デフォルトでは1pxにしていますが、自由に変えてください
  var interval = 100; //移動する間隔です。デフォルトでは0.1秒おきにしていますが、自由に変えてください
  var scrollTop = document.body.scrollTop;
  setInterval(function() {
      var scroll = scrollTop + speed;
      scrollTop.scrollBy(0, scroll)
  },interval);
}
*/

/*メッセージ一覧を表示する関数*/
function messagelist() {
  var postdata2 = {
    "messagelist": "OK"
  };
  const spinner = document.getElementById('loading');
  spinner.classList.add('loaded');
  $.ajax({
    //POST通信
    type: "POST",
    //ここでデータの送信先URLを指定します。
    url: "managephp/messagelist.php",
    data: postdata2,
    //処理が成功したら
    success: function (data) {
      var myh2 = document.getElementById("messagelist");
      myh2.innerHTML = data;
    },
    error: function () {
      alert("error");
    }
  });
  return false;
}

/*メッセージを表示する関数*/
function messagedisplay(senduser) {
  var postdata = {
    "getmessage": senduser
  };
  const spinner = document.getElementById('loading');
  spinner.classList.add('loaded');
  $.ajax({
    //POST通信
    type: "POST",
    //ここでデータの送信先URLを指定します。
    url: "managephp/getchatmessage.php",
    data: postdata,
    //処理が成功したら
    success: function (data) {
      var myh2 = document.getElementById("scroll-box");
      myh2.innerHTML = data;
      var myh3 = document.getElementById("headersenduser");
      myh3.innerHTML = senduser;
      //メッセージの数をローカルストレージに保存
      //let messagecount = document.getElementById("messagecount").className;
      //localStorage.setItem(senduser, messagecount);
      autoScroll();
      //チャットの入力欄を複数行に自動調整  ここに書かないとajax通信後に動作しない
      $(function () {
        var $textarea = $('#textmessage');
        var lineHeight = parseInt($textarea.css('lineHeight'));
        $textarea.on('input', function (e) {
          var lines = ($(this).val() + '\n').match(/\n/g).length;
          $(this).height(lineHeight * lines);
        });
      });
    },
    error: function () {
      alert("error");
    }
  });
  return false;
}

/*メッセージを追加する関数*/
function addmessageclick() {
  let textmessage = document.getElementById("textmessage").value;
  if (textmessage.length == 0) {
    return;
  }
  let senduser = document.getElementById("sendusername1").className;
  var postdata = {
    "addchattext": textmessage,
    "senduser": senduser
  };
  //処理
  $.ajax({
    //POST通信
    type: "POST",
    //ここでデータの送信先URLを指定します。
    url: "managephp/addchattext.php",
    data: postdata,
    //処理が成功したら
    success: function (data) {
      messagedisplay(senduser);
    },
    error: function () {
      alert("error");
    }
  });
  var myh3 = document.getElementById("inputarea");
  myh3.innerHTML = `<!-- テキストエリア -->
<!--Textarea with icon prefix-->
<textarea id="textmessage" class="md-textarea form-control col-md-10 col-9 mb-3" rows="1" style="max-height:170px;border-radius:2vw;resize: none;"></textarea>
<a onclick="addmessageclick()"><i class="fas fa-paper-plane fa-2x col-md-2 col-3 mt-1 text-primary"></i></a>
`;
  return false;
}

/*メッセージを消去する関数*/
function deletemessage(classdate) {
  let senduser = document.getElementById("sendusername1").className;
  var postdata = {
    "classdate": classdate
  };
  const spinner = document.getElementById('loading');
  spinner.classList.add('loaded');
  $.ajax({
    //POST通信
    type: "POST",
    //ここでデータの送信先URLを指定します。
    url: "managephp/deletemessage.php",
    data: postdata,
    //処理が成功したら
    success: function (data) {
      messagedisplay(senduser);
    },
    error: function () {
      alert("error");
    }
  });
  return false;
}

//メッセージを更新する関数
function messagerenew() {
  let senduser = document.getElementById("sendusername1").className;
  messagedisplay(senduser);
  return;
}

/*ブックマーク一覧を表示する関数*/
function bookmarklist() {
  var postdata2 = {
    "bookmarklist": "OK"
  };
  const spinner = document.getElementById('loading');
  spinner.classList.add('loaded');
  $.ajax({
    //POST通信
    type: "POST",
    //ここでデータの送信先URLを指定します。
    url: "managephp/bookmarklist.php",
    data: postdata2,
    //処理が成功したら
    success: function (data) {
      var myh2 = document.getElementById("bookmarklist");
      myh2.innerHTML = data;
    },
    error: function () {
      alert("error2");
    }
  });
  return false;
}

/*申し込みする関数*/
function apply() {
  //let textmessage = document.getElementById("applyinfo").textContent;
  let senduser = document.getElementById("senduser-name").textContent;
  let textmessage = senduser + "に申し込みが完了しました。メッセージがくるまでしばらくお待ちください。";
  var postdata = {
    "applydata": "applydata",
    "senduser": senduser,
    "textmessage": textmessage
  }
  /*
  var postdata ={"applydata":"applydata",
  "name":name,
  "mail":mail,
  "phonenumber":phonenumber,
  "university":university,
  "undergraduate":undergraduate,
  "department":department,
  "graduateyear":graduateyear,
  "schoolyear":schoolyear,
  "selfappeal":selfappeal,
  "areaofinterest":areaofinterest,
  "clubinhighschool":clubinhighschool,
  "currentactivity":currentactivity
  };
  */
  //処理
  $.ajax({
    //POST通信
    type: "POST",
    //ここでデータの送信先URLを指定します。
    url: "managephp/apply.php",
    data: postdata,
    //処理が成功したら
    success: function (data) {
      alert("申し込みが完了しました。")
    },
    error: function () {
      alert("error");
    }
  });
  return false;
}

//モーダルにデータを受け渡す関数
function applyclick() {
  $('#applymodal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); //モーダルを呼び出すときに使われたボタンを取得
    var senduserName = button.data('senduser'); //data-whatever の値を取得
    //Ajaxの処理はここに
    var modal = $(this); //モーダルを取得
    modal.find('.senduser-name').text(senduserName); //モーダルのタイトルに値を表示
  })
}

/*プロフィールを変更する関数*/
function profilechangeclick() {
  let name = document.getElementById("name").value;
  //let mail = document.getElementById("mail").value;
  let phonenumber = document.getElementById("phonenumber").value;
  let university = document.getElementById("university").value;
  let undergraduate = document.getElementById("undergraduate").value;
  let department = document.getElementById("department").value;
  let graduateyear = document.getElementById("graduateyear").value;
  let schoolyear = document.getElementById("schoolyear").value;
  let selfappeal = document.getElementById("selfappeal").value;
  let areaofinterest = document.getElementById("areaofinterest").value;
  let clubinhighschool = document.getElementById("clubinhighschool").value;
  let currentactivity = document.getElementById("currentactivity").value;
  var postdata = {
    "profiledata": "profiledata",
    "name": name,
    //"mail":mail,
    "phonenumber": phonenumber,
    "university": university,
    "undergraduate": undergraduate,
    "department": department,
    "graduateyear": graduateyear,
    "schoolyear": schoolyear,
    "selfappeal": selfappeal,
    "areaofinterest": areaofinterest,
    "clubinhighschool": clubinhighschool,
    "currentactivity": currentactivity
  };
  //処理
  $.ajax({
    //POST通信
    type: "POST",
    //ここでデータの送信先URLを指定します。
    url: "managephp/profilechange.php",
    data: postdata,
    //処理が成功したら
    success: function (data) {
      console.log(data);
    },
    error: function () {
      alert("error");
    }
  });
  return false;
}

/*企業の募集一覧を表示する関数*/
function enterprisematterlist(param){
  var postdata ={"param2":param};
  const spinner = document.getElementById('loading');
  spinner.classList.add('loaded');
  $.ajax({
    //POST通信
    type: "POST",
    //ここでデータの送信先URLを指定します。
    url: "managephp/enterprisematter.php",
    data:postdata,
    //処理が成功したら
    success:function(data) {
      var myh2 = document.getElementById("enterprisematterlist");
      myh2.innerHTML = data;
  },error:function(){
    alert("error");
  }
});
return false;
}



//PHP Comet 処理重いので保留
/*
function messagedisplay2(){
var postdata ={"getmessage":"OK"};
//const spinner = document.getElementById('loading');
//spinner.classList.add('loaded');
$.ajax({
//POST通信
type: "POST",
//ここでデータの送信先URLを指定します。
url: "chat.php",
data:postdata,
//処理が成功したら
success:function(data) {
  var myh2 = document.getElementById("scroll-box");
  //alert(data);
  myh2.innerHTML = data;

autoScroll();
//setTimeout("autoScroll()", 100 );

},error:function(){
alert("error");
}
});
console.log("OK2");
//setTimeout("messagedisplay2()", 100 );
//setTimeout("messagedisplay2()", 100 );

//setTimeout( "messagedisplay()", 3000 );
return;
}
*/
