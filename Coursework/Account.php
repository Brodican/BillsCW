<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" href="login.css" type="text/css" charset="utf-8">
		<meta charset="UTF-8">
		<script src="jquery-3.1.1.min.js"></script>
		<script src="regCheck.js"></script>
		<title>Account</title>
    </head>
    <body>
	  <div class=logo>
		  <img class=logo src="logo.png" alt="Logo">
	  </div>
	  <div class=centrebox>
	      <br>
	      <br>
	      <br>
	      <br>
	      <br>
	      <br>
	      <br>
	      <br>
	      <br>
	      <div class=secondbox>
				<a class=button1 href="Bills.php">Go to bills</a><br>
				<a class=button1 href="Main.php">Main Page</a><br>
				<a class=button1 href="Games.php">Games</a><br>
				<a class=button1 href="logout.php">Logout</a><br>
	      </div>
	      <div class=firstbox>
		  <form name="reggy"  action="authUpdate.php" method="post" onsubmit="return validateForm()">
		      <label class=labelly>Username</label><input class=inputty type="username" name="username" value=""><br>
		      <label class=labelly>Current Password</label><input class=inputty type="password" name="cpassword" value=""><br>
		      <label class=labelly>Desired Password</label><input class=inputty type="password" name="password1" id="Password1" value=""><br>
		      <label class=labelly>Repeat Password</label><input class=inputty type="password" name="password2" id="Password2" value="" onChange="checkPasswordMatch();"><br>
		      <br>
		      <br>
				  <div class="printCheck" id="printCheck">
				  </div>
		      <input class=button type="submit" value="Update"><br>
		      <input class=button type="reset">
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