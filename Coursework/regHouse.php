<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <title>logintest</title>
    </head>
    <body>
	<?php
		session_start();		
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		$db = new SQLite3('bills.db');/*
		$pquerysalt = $db->prepare("SELECT salt, encrypted_pass FROM users WHERE username=:username;");
		$username = $_SESSION['username'];
		$enpassword = $_SESSION['enpassword'];
		$email = $_SESSION["email"];
		
		$housepass = $_POST["password1"];
		
		$pquerysalt->bindParam(':username', $username);
		$querysalt = $pquerysalt->execute();
			$queryID = "";
			while ($row = $querysalt->fetchArray()) {
				$salt = $row["salt"];
				$encrypted_pass = sha1($salt."--".$password);
				if($encrypted_pass ==  $row["encrypted_pass"]){
 					$pqueryID = $db->prepare("SELECT * FROM users WHERE username=:username AND encrypted_pass=:encrypted_pass;");
 					$pqueryID->bindParam(':username', $username, SQLITE3_TEXT);
					$pqueryID->bindParam(':encrypted_pass', $encrypted_pass, SQLITE3_TEXT);
					$queryID = $pqueryID->execute();
				}
			}
			if(empty($queryID)) {
			    echo "<script>
			    alert('Username or password incorrect');
			    window.location.href='Login.php';
			    </script>";    
			}
			while ($row = $queryID->fetchArray()) {
				$_SESSION["ID"] = $row["ID"];
				$_SESSION["username"] = $row["username"];
 				$_SESSION["household"] = $row["household"];
			}
			*/
			
		    //$stmt = $db->prepare("INSERT INTO users (username, email, salt, encrypted_pass, household, housepass_salt, enc_housepass) VALUES (:username, :email, :salt, :encrypted_pass, :household, :housepass_s, :e_housepass)");
		    // Prepares statement for insertion with values to be bound
		    
		    $username = $_SESSION["username"];
		    $house_password = $_POST["password1"];
		    $household = $_SESSION["household"];
		    $email = $_SESSION["email"];
		    $user_salt = $_SESSION["salt"];
		    $encrypted_pass = $_SESSION["enpassword"]; // Not passing text password in session
		    $house_salt = sha1(time());
			$e_housepass = sha1($house_salt."--".$house_password);
			
			$db->exec("INSERT INTO users (username, email, salt, encrypted_pass, household, housepass_salt, enc_housepass) VALUES ('$username', '$email', '$salt', '$encrypted_pass', '$household', '$housepass_s', '$e_housepass')");
		    
		    /*$stmt->bindParam(':username', $username);
		    $stmt->bindParam(':email', $email);
		    $stmt->bindParam(':salt', $user_salt);
		    $stmt->bindParam(':encrypted_pass', $encrypted_pass);
 		    $stmt->bindParam(':household', $household);
 		    $stmt->bindParam(':housepass_s', $house_salt);
		    $stmt->bindParam(':e_housepass', $e_housepass);
		    
		    // Binding insertion params to values recieved from user
		    $stmt->execute();*/
		    
		    echo "username : " . $username . "<br>";
		    echo "email : " . $email . "<br>";
		    echo "enpass : " . $encrypted_pass . "<br>";
		    echo "username : " . $username . "<br>";
		    
		    
		    
		    $pqueryID = $db->prepare("SELECT * FROM users WHERE username=:username AND encrypted_pass=:encrypted_pass;");
		    $pqueryID->bindParam(':username', $username, SQLITE3_TEXT);
		    $pqueryID->bindParam(':encrypted_pass', $encrypted_pass, SQLITE3_TEXT);
		    $queryID = $pqueryID->execute();

		    while ($row = $queryID->fetchArray()) {
			    $_SESSION["ID"] = $row["ID"];
			    $_SESSION["username"] = $row["username"];
			    $_SESSION["household"] = $row["household"];
		    }
		    
		    
		    header("Location: Bills.php");
		    exit();
		?>
    </body>
</html>