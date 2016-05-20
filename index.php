<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Diagtest Sign In</title>
	<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
      <link rel="stylesheet" href="css/style.css">
</head>
<body>
      <div class="login-form">
            <h1>Diagtest</h1>
            <form method="post" action="dashboard/login.php">
                  <div class="form-group">
                        <input class="form-control" type="text" placeholder="Username" name="username" id="UserName">
                        <i class="fa fa-user"></i>
                  </div>
                  <div class="form-group">
                        <input class="form-control" type="password" placeholder="Password" name="password" id="Password">
                        <i class="fa fa-lock"></i>
                  </div>
                  <button type="submit" class="log-btn" name="signin" id="SignIn">Sign In</button>
            </form>
      </div>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="js/index.js"></script>
</body>
</html>