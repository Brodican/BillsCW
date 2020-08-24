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
		$db = new SQLite3('bills.db');
		
		session_start();		
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		$db = new SQLite3('bills.db');
		$pquerysalt = $db->prepare("SELECT housepass_salt, enc_housepass FROM users WHERE household=:household;");
		$username = $_SESSION['username'];
		$password = $_POST['password1'];
		$household = $_SESSION["household"];
		$pquerysalt->bindParam(':household', $household);
		$querysalt = $pquerysalt->execute();
			$queryID = "";
			$checky = 0;
			while ($row = $querysalt->fetchArray()) {
				    echo "In loop <br>";
				    $house_salt = $row["housepass_salt"];
				    $enc_pass = sha1($house_salt."--".$password);
				    
				    if($enc_pass ==  $row["enc_housepass"]){
				    
					$stmt = $db->prepare("INSERT INTO users (username, email, salt, encrypted_pass, household, housepass_salt, enc_housepass) VALUES (:username, :email, :salt, :encrypted_pass, :household, :housepass_s, :e_housepass)");
					// Prepares statement for insertion with values to be bound
					
					$checky = 1;
					
					$username = $_SESSION["username"];
					$house_password = $_POST["password1"];
					$household = $_SESSION["household"];
					$email = $_SESSION["email"];
					$user_salt = $_SESSION["salt"];
					$encrypted_pass = $_SESSION["enpassword"]; // Not passing text password in session
					$house_salt = $house_salt;
					$e_housepass = $enc_pass;
					
					$stmt->bindParam(':username', $username);
					$stmt->bindParam(':email', $email);
					$stmt->bindParam(':salt', $user_salt);
					$stmt->bindParam(':encrypted_pass', $encrypted_pass);
					$stmt->bindParam(':household', $household);
					$stmt->bindParam(':housepass_s', $house_salt);
					$stmt->bindParam(':e_housepass', $e_housepass);
					
					// Binding insertion params to values recieved from user
					$stmt->execute();

		                        $encrypted_pass = $_SESSION["enpassword"]; // Not passing text password in session
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

				}
			}
			    echo "<script>
			    alert('Password incorrect, try again');
 			    window.location.href='Register.php';
			    </script>";    
		?>
    </body>
</html>
