<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Code Blaze - Login</title>

  <link rel="stylesheet" href="assets/css/style_login.css" />
  <link rel="icon" type="image/x-icon" href="" />
</head>

<body>
  <div class="container_login">
    <form method="post" action="sv_login.php">
      <p class="title_login"><b>Login Page</b></p>

      <p class="email">Email</p>
      <input class="input" type="text" placeholder="Type Your Email..." id="email" name="email" required>

      <p class="password">Password</p>
      <input class="input" type="password" placeholder="Type Your Password..." id="password" name="password"
        required><br />

      <input class="button_login" type="submit" value="Login" name="submit" />
    </form>
  </div>
</body>

</html>