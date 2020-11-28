<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" href="register.css" type="text/css" charset="utf-8">
		<meta charset="UTF-8">
		<script src="jquery-3.1.1.min.js"></script>
		<script src="regCheck.js"></script>
		<title>Register</title>
    </head>
    <body>
		<div class=logo>
			<img class=logo src="logo.png" alt="Logo">
		</div>
		<div class=centrebox>
			<br>
			<br>
			<div class=title>
				<h1 class=title> UTP - Register</h1>
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
				<p class=register>Please fill out the form below:</p>
				<form name="reggy"  action="reg.php" method="post" onsubmit="return validateForm()">
				  <label class=labelly>Desired Username</label><input class=inputty type="username" name="username" value=""><br>
				  <label class=labelly>Your Email</label><input class=inputty type="email" name="email" value=""><br>
				  <label class=labelly>Desired Password</label><input class=inputty type="password" name="password1" id="Password1" value=""><br>
				  <label class=labelly>Repeat Password</label><input class=inputty type="password" name="password2" id="Password2" value="" onChange="checkPasswordMatch();"><br>
				  <label class=labelly>Your Household name</label><input class=inputty type="household" name="household" value=""><br>
				  <div class="printCheck" id="printCheck">
				  </div>
				  <input class=button type="submit" value="Register"><br>
				  <input class=button2 type="reset">
				</form>
			</div>

		</div>
			<br>
			<br>
        <div class=bottom>
            <p class=bottom> 
		Works of Utku
            </p>
        </div>
    </body>
</html>
