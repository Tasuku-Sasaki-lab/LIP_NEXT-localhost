<?php require 'login_for_company.php';?>

<!--HTML-->
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=devise-width,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>企業用ログインページ</title>
	 <!-- Font Awesome -->
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    	<!-- Bootstrap core CSS -->
    	<link href="../static/css/bootstrap.min.css" rel="stylesheet">
    	<!-- Material Design Bootstrap -->
		<link href="../static/css/mdb.min.css" rel="stylesheet">
    	<!-- Your custom styles (optional) -->
    	<link href="../static/css/style.min.css" rel="stylesheet">

		<link href="../static/css/additional.css" rel="stylesheet">

		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

		<!-- MDB-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.css" rel="stylesheet"/>
    <!-- MDB-->
    <script type="text/javascript" src="shttps://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.js"></script>



	</head>

	<body>
		<div class="container">
		<form method="POST">
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" name="mail" class="form-control" id="form1Example1" />
    <label class="form-label" for="form1Example1">メールアドレス</label>
  </div>

  <div class="form-outline mb-4">
	<input type="password" name="password" class="form-control" id="form1Example2" />
    <label class="form-label" for="form1Example2">パスワード</label>
  </div>
	
  <!-- Email input -->
  <!--
  <div class="form-outline mb-4">
    <input type="email" id="form1Example1" class="form-control" />
    <label class="form-label" for="form1Example1">Email address</label>
  </div>
-->


  <!-- Password input -->
  <!--
  <div class="form-outline mb-4">
    <input type="password" id="form1Example2" class="form-control" />
    <label class="form-label" for="form1Example2">Password</label>
  </div>
-->


  <!-- 2 column grid layout for inline styling -->
  <!--
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
     
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          value=""
          id="form1Example3"
          checked
        />
        <label class="form-check-label" for="form1Example3"> Remember me </label>
      </div>
    </div>

    <div class="col">
      <a href="#!">Forgot password?</a>
    </div>
  </div>
-->

  <!-- Submit button -->
  <button type="submit" name="login" class="btn btn-primary btn-block">ログイン</button>
</form>
		</div>

		<!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="../static/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../static/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../static/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../static/js/mdb.min.js"></script>
    <!-- Initializations -->
    <script type="text/javascript">
      // Animations initialization
      new WOW().init();
    </script>
	
	</body>
</html>