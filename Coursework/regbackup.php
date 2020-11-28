
<!DOCTYPE html>
<html>
    <head>
        <title>demo1</title>
    </head>
    <body>
    <?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	// So errors show up
	$db = new SQLite3('bills.db');
	$checkArr = $db->query("SELECT * FROM users");
	$username = $_POST["username"];
	$password = $_POST["password1"];
	$household = $_POST["household"];
	$email = $_POST["email"];
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
	    if($row["household"] == $household) {
		echo "Email: " . $username;
		echo "<script>
		alert('Please enter the password of the existing household');
		window.location.href='HouseLogin.php';
		</script>";  
	    }
	}
	if(1==1) {
		    $db = new SQLite3('bills.db');
		    $stmt = $db->prepare("INSERT INTO users (username, email, salt, encrypted_pass, household) VALUES (:username, :email, :salt, :encrypted_pass, :household)");
		    // Prepares statement for insertion with values to be bound
		    $username = $_POST["username"];
		    $password = $_POST["password1"];
		    $household = $_POST["household"];
		    $email = $_POST["email"];
		    $salt = sha1(time());
		    $encrypted_pass = sha1($salt."--".$password);
		    $stmt->bindParam(':username', $username);
		    $stmt->bindParam(':email', $email);
		    $stmt->bindParam(':salt', $salt);
		    $stmt->bindParam(':encrypted_pass', $encrypted_pass);
// 		    $stmt->bindParam(':household', $household);
		    // Binding insertion params to values recieved from user
		    $stmt->execute();
		    // Executes insertion statement
	}
	while ($row = $checkArr->fetchArray()) {
	    if($row["household"] == $household) {
		echo "Email: " . $username;
		echo "<script>
		alert('Please enter the password of the existing household');
		window.location.href='HouseLogin.php';
		</script>";  
	    }
	}
	
	header("Location: Login.php");
	exit();
    ?>
    </body>
</html>