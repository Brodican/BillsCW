<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <title>logintest</title>
    </head>
    <body>
	<?php
// 		session_start();		
// 		error_reporting(E_ALL);
// 		ini_set("display_errors", 1);
// 		$username = $_POST['username'];
// 		$password = $_POST['password'];
// 		echo $username . "<br>";
// 		echo $password . "<br>";
// 			$db = new SQLite3('bills.db');
// 			$querysalt = $db->query("SELECT salt, encrypted_pass FROM users WHERE username='$username';");
// 			$queryID = "";
// 			while ($row = $querysalt->fetchArray()) {
// 				echo "inloop";
// 				$salt = $row["salt"];
// 				$encrypted_p = sha1($salt."--".$password);
// 				if($encrypted_p ==  $row["encrypted_pass"]){
// 					echo $row["salt"] . "<br>";
// 					echo "come on in fam";
// 					$queryID = $db->query("SELECT * FROM users WHERE username='$username' AND encrypted_pass='$encrypted_p';");
// 				}
// 			}
// 			while ($row = $queryID->fetchArray()) {
// 				$_SESSION["ID"] = $row["ID"];
// 				$_SESSION["household"] = $row["household"];
// 				echo "Row ID is". $row["ID"];
// 				echo "Your ID is". $_SESSION["ID"];
// 			}		
// 			header("Location: Bills.php");
// 			exit();
		session_start();		
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		$db = new SQLite3('bills.db');
		$pquerysalt = $db->prepare("SELECT salt, encrypted_pass FROM users WHERE username=:username;");
		$username = $_POST['username'];
		$password = $_POST['cpassword'];
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
			    alert('Username or old password incorrect');
			    window.location.href='Account.php';
			    </script>";    
			}
			while ($row = $queryID->fetchArray()) {
				$uID = $row["ID"];
				$_SESSION["username"] = $row["username"];
 				$_SESSION["household"] = $row["household"];
 				$newpassword = $_POST["password1"];
 				echo "newpass: " . $newpassword . "<br>";
 				$salt = sha1(time());
 				$new_encrypted_pass = sha1($salt."--".$newpassword);
				$pupdateshare = $db->prepare("UPDATE users SET encrypted_pass=:newenpass WHERE ID=:uID");
				$pupdateshare->bindParam(':newenpass', $new_encrypted_pass);
				$pupdateshare->bindParam(':uID', $uID);
				$pupdateshare->execute(); 
				$pupdateshare1 = $db->prepare("UPDATE users SET salt=:newsalt WHERE ID=:uID");
				$pupdateshare1->bindParam(':newsalt', $salt);
				$pupdateshare1->bindParam(':uID', $uID);
				$pupdateshare1->execute(); 
			}
			header("Location: Login.php");
 			exit();
		?>
    </body>
</html>