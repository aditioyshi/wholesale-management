<?php
	session_start();
	//$_SEESION["pass"] = "True";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login | Wholesale</title>
  <link rel="stylesheet" href="css/style.css">
</head>


<body class="align">

  <div class="site__container">

    <div class="grid__container">

      <form action="login.php" method="post" class="form form--login">
        <div class="form__field">
          <label class="fontawesome-user" for="login__username"><span class="hidden">Username</span></label>
          <input id="login__username" name="userid" type="text" class="form__input" placeholder="Username" required>
        </div>

        <div class="form__field">
          <label class="fontawesome-lock" for="login__password"><span class="hidden">Password</span></label>
          <input id="login__password" name="pass" type="password" class="form__input" placeholder="Password" required>
        </div>

        <div class="form__field">
          <input type="submit" name="login" value="Log In">
        </div>
      </form

    </div>

  </div>

</body>

</html>