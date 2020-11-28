<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" href="login.css" type="text/css" charset="utf-8">
		<meta charset="UTF-8">
		<title>Login</title>
    </head>
    <body>
	  <div class=logo>
		  <img class=logo src="logo.png" alt="Logo">
	  </div>
	  <div class=centrebox>
	      <br>
	      <br>
	      <div class=title>
		      <h1 class=title>Login</h1>
	      </div>
	      <br>
	      <br>
	      <br>
	      <br>
	      <br>
	      <br>
	      <br>
	      <div class=secondbox>
		      <a class=button href="Main.php">Main Page</a>
	      </div>
	      <div class=firstbox>
		  <form action="auth.php" method="post">
		      <label class=labelly>Username</label><input type="username" name="username" value=""><br>
		      <label class=labelly>Password</label><input type="password" name="password" value="">
		      <br>
		      <br>
		      <input class=button type="submit" value="Login"><br>
		      <input class=button type="reset">
		  </form>
		  <form action="Register.php">
		      <input class=button type="submit" value="Register">
		  </form>
	      </div>
	  </div>
        <div class=bottom>
            <p class=bottom> 
				Works of Utku
            </p>
        </div>
    </body>
</html>
