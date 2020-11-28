

<!DOCTYPE html>
<html>
    <head>
        <title>demo1</title>
    </head>
    <body>
    <?php
	session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	// So errors show up
	$db = new SQLite3('bills.db');
	$checkArr = $db->query("SELECT * FROM users");
	$username = $_POST["username"];
	$password = $_POST["password1"];
	$household = $_POST["household"];
	$email = $_POST["email"];
	
	$_SESSION["household"] = $household;
	
	while ($row = $checkArr->fetchArray()) {
	    if($row["username"] == $username) {
		echo "Username: " . $username;
		echo "<script>
		alert('Username taken');
		window.location.href='Register.php';
		</script>";  		
	    }
	    if($row["email"] == $email) {
		echo "Email: " . $username;
		echo "<script>
		alert('Email taken');
		window.location.href='Register.php';
		</script>";  
	    }
	}
	if(1==1) {
		    $db = new SQLite3('bills.db');
		    // Prepares statement for insertion with values to be bound
		    $username = $_POST["username"];
		    $password = $_POST["password1"];
		    $household = $_POST["household"];
		    $email = $_POST["email"];
		    $salt = sha1(time());
		    $encrypted_pass = sha1($salt."--".$password);
		    $checkArr = $db->query("SELECT * FROM users");
		    while ($row = $checkArr->fetchArray()) {
		    
		      if($row["household"] == $household) {
		      
		      
		      
			  $_SESSION["username"] = $username;
			  $_SESSION["salt"] = $salt;
			  $_SESSION["enpassword"] = $encrypted_pass;
			  $_SESSION["email"] = $email;
			  

			  
			  echo "<script>
			  alert('Please enter the password of the existing household');
			  window.location.href='HouseAuth.php';
			  </script>";  
			  
		      }
		      
		    }
		    
		    // Table is empty
		    $_SESSION["username"] = $username;
		    $_SESSION["salt"] = $salt;
		    $_SESSION["enpassword"] = $encrypted_pass;
		    $_SESSION["email"] = $email;
		    
		    echo "Username: " . $username . "<br>";
		    echo "enpassword: " . $encrypted_pass . "<br>";
      
		    
		    echo "<script>
		    alert('Please make a password for your household');
		    window.location.href='HouseRegister.php';
		    </script>"; 
		    
	}

	
// 	header("Location: Login.php");
// 	exit();
    ?>
    </body>
</html>
