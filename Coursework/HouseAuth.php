<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" href="register.css" type="text/css" charset="utf-8">
		<meta charset="UTF-8">
		<script src="jquery-3.1.1.min.js"></script>
		<script src="regCheck.js"></script>
		<title>Register House</title>
    </head>
    <body>
	  <div class=logo>
		  <img class=logo src="logo.png" alt="Logo">
	  </div>
	  <div class=centrebox>
	      <br>
	      <br>
	      <div class=title>
		      <h1 class=title> UTP - House Login</h1>
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
		  <form action="authHouse.php" method="post">
		      <label class=labelly>Password</label><input class=inputty type="password" name="password1" id="Password1" value=""><br>
		      <br>
		      <br>
		      <input class=button type="submit" value="Login"><br>
		      <input class=button type="reset">
		  </form>
		  <form action="Register.php">
		      <input class=button type="submit" value="Back to Register">
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