<!DOCTYPE html>
<html>
    <head>
        <title>newlist</title>
    </head>
    <body>
    <?php include 'security.php';?>
    <?php
	session_start();
// 	ini_set('display_errors', 1);
// 	ini_set('display_startup_errors', 1);
// 	error_reporting(E_ALL);
 	$db = new SQLite3('bills.db');
 	$stmtb = $db->prepare("INSERT INTO bills (user_ID, bill, price, category, household, created, complete) VALUES (:user_ID, :content, :price, :category, :household, :created, :complete)");
	$user_ID = $_SESSION["ID"];
	$household = $_SESSION["household"];
	$content = $_POST["bill"];
	$price = $_POST["price"];
	$category = $_POST["category"];
	$option = $_POST["housey"];
	$issuer_ID = $_SESSION["ID"];
	$issuer_name = $_SESSION["username"];
	$conf = "Unpaid";
	$created = date("Y/m/d");	
	$checkoffs = 0;
// 	$stmtb->bindParam(':user_ID', $user_ID);
// 	$stmtb->bindParam(':content', $content);
// 	$stmtb->bindParam(':price', $price);
// 	$stmtb->bindParam(':category', $category);
// 	$stmtb->bindParam(':household', $household);
// 	$stmtb->bindParam(':created', $created);
// 	$stmtb->bindParam(':checkoffs', $checkoffs);
// 	$stmtb->execute();
//  	$stmtl = $db->prepare("INSERT INTO links (user_ID, bill_ID, checkoff) VALUES (:user_ID, :bill_ID, :checkoff)");
	$allusers = $db->query("SELECT username FROM users WHERE household = '$household';");
 	$shares = $_POST["shares"];
 	$count = 0;
 	$checkArr = $db->query("SELECT * FROM mainbills WHERE household = '$household';");
 	while ($row = $checkArr->fetchArray()) {
	    if($row["bill"] == $content) {
		echo "<script>
		alert('Bill with same name exists');
		window.location.href='Bills.php';
		</script>";  		
		exit();
	    }
	}
	if(empty($content)) {
	  echo "<script>";
	  echo "alert('You need to give the bill a name!');";
	  echo "</script>";
	}
	elseif(empty($price)) {
	  echo "<script>";
	  echo "alert('You need to give the bill a price!');";
	  echo "</script>";
	}
	elseif(empty($shares) && $option == "Some") {
	  echo "<script>";
	  echo "alert('You need to share the bill with some housemates!');";
	  echo "</script>";
	}
  	elseif($option == "All") {
  	
	    $pinsertMain = $db->prepare("INSERT INTO mainbills (issuer_ID, issuer_name, bill, price, category, household, created, confirmed) VALUES (:issuer_ID, :issuer_name, :content, :price, :category, :household, :created, :confirmed)");
	    	    
	    $pinsertMain->bindParam(':issuer_ID', $issuer_ID);
	    $pinsertMain->bindParam(':issuer_name', $issuer_name);
	    $pinsertMain->bindParam(':content', $content);
	    $pinsertMain->bindParam(':price', $price);
	    $pinsertMain->bindParam(':category', $category);
	    $pinsertMain->bindParam(':household', $household);
	    $pinsertMain->bindParam(':created', $created);
	    $pinsertMain->bindParam(':confirmed', $conf);
	    $pinsertMain->execute();   	    
	    
 	    while (($uprow = $allusers->fetchArray())) {
		foreach($uprow as $value) {
		    $queryID = $db->prepare("SELECT * FROM users WHERE username=:username;");
		    $queryID->bindParam(':username', $value);
		    $userID = $queryID->execute();
		    
		    $tracky = 0;
		    
		    while ($row = $userID->fetchArray()) {
		    
			    $stmtb = $db->prepare("INSERT INTO bills (user_ID, bill, price, category, household, created, complete) VALUES (:user_ID, :content, :price, :category, :household, :created, :complete)");
			    $user_ID = $row["ID"];
			    $household = $_SESSION["household"];
			    $content = $_POST["bill"];
			    $price = $_POST["price"];
			    $category = $_POST["category"];
			    $date = date("Y/m/d");	
			    $stmtb->bindParam(':user_ID', $user_ID);
			    $stmtb->bindParam(':content', $content);
			    $stmtb->bindParam(':price', $price);
			    $stmtb->bindParam(':category', $category);
			    $stmtb->bindParam(':household', $household);
			    $stmtb->bindParam(':created', $created);
			    $stmtb->bindParam(':checkoffs', $checkoffs);
			    $stmtb->execute();
			    
			    $uId = $row["ID"];
			    $to = $row["email"];
			    
			    $queryBillID = $db->prepare("SELECT ID FROM bills WHERE bill=:bill AND user_ID=:uId AND household=:house;");
			    $queryBillID->bindParam(':bill', $content);
			    $queryBillID->bindParam(':uId', $uId);
			    $queryBillID->bindParam(':house', $household);
    
			    $billID = $queryBillID->execute();
			    $bill_ID;
			    while ($row = $billID->fetchArray()) {
				    $bill_ID = $row["ID"];
				    $check = 0;
				    $db->exec("INSERT INTO links (user_ID, bill_ID, checkoff) VALUES ('$user_ID', '$bill_ID', '$check');");
			    }
			    


			    $count++;			
	    
			    $message = "You have a new bill to pay: " . $content . ". The price is: £" . $price;
			    $subject = "New Bill: " . $content;
    
			    mail($to, $subject, $message);
			    
		    }
		    break;
		}
 	    }
  	}
  	else {
  	
	    $pinsertMain = $db->prepare("INSERT INTO mainbills (issuer_ID, issuer_name, bill, price, category, household, created, confirmed) VALUES (:issuer_ID, :issuer_name, :content, :price, :category, :household, :created, :confirmed)");
	    
	    $pinsertMain->bindParam(':issuer_ID', $issuer_ID);
	    $pinsertMain->bindParam(':issuer_name', $issuer_name);
	    $pinsertMain->bindParam(':content', $content);
	    $pinsertMain->bindParam(':price', $price);
	    $pinsertMain->bindParam(':category', $category);
	    $pinsertMain->bindParam(':household', $household);
	    $pinsertMain->bindParam(':created', $created);
	    $pinsertMain->bindParam(':confirmed', $conf);
	    $pinsertMain->execute();  	
	    
 	$share_arr = explode(", ", $shares);

	    foreach($share_arr as $value) {
		    $queryID = $db->prepare("SELECT * FROM users WHERE username=:username;");
		    $queryID->bindParam(':username', $value);
		    $userID = $queryID->execute();
		    
		    while ($row = $userID->fetchArray()) {
		    
			    $stmtb = $db->prepare("INSERT INTO bills (user_ID, bill, price, category, household, created, complete) VALUES (:user_ID, :content, :price, :category, :household, :created, :complete)");
			    $user_ID = $row["ID"];
			    $household = $_SESSION["household"];
			    $content = $_POST["bill"];
			    $price = $_POST["price"];
			    $category = $_POST["category"];
			    $date = date("Y/m/d");	
			    $stmtb->bindParam(':user_ID', $user_ID);
			    $stmtb->bindParam(':content', $content);
			    $stmtb->bindParam(':price', $price);
			    $stmtb->bindParam(':category', $category);
			    $stmtb->bindParam(':household', $household);
			    $stmtb->bindParam(':created', $created);
			    $stmtb->bindParam(':checkoffs', $checkoffs);
			    $stmtb->execute();
			    
			    $uId = $row["ID"];
			    $to = $row["email"];
			    
			    $queryBillID = $db->prepare("SELECT ID FROM bills WHERE bill=:bill AND user_ID=:uId AND household=:house;");
			    $queryBillID->bindParam(':bill', $content);
			    $queryBillID->bindParam(':uId', $uId);
			    $queryBillID->bindParam(':house', $household);
    
			    $billID = $queryBillID->execute();
			    $bill_ID;
			    while ($row = $billID->fetchArray()) {
				    $bill_ID = $row["ID"];
				    $check = 0;
				    $db->exec("INSERT INTO links (user_ID, bill_ID, checkoff) VALUES ('$user_ID', '$bill_ID', '$check');");
			    }
			    


			    $count++;			
	    
			    $message = "You have a new bill to pay: " . $content . ". The price is: £" . $price;
			    $subject = "New Bill: " . $content;
    
			    mail($to, $subject, $message);
		    }
	    }
	}
	$newPrice = $price/$count;						
	$db->exec("UPDATE bills SET price = '$newPrice' WHERE bill = '$content';");
	
	
echo "<div id='change'>
	<h1></h1>
	<div id='change1'>
	<table>
	  <caption class=captiony>- Users in your household: -</caption>";
		    
			    session_start();
			    $household = $_SESSION["household"];
			    $db = new SQLite3('bills.db');
			    $results = $db->query("SELECT * FROM users WHERE household = '$household';");
			    echo "<table>";
			    echo "  
				<th class=titley>Their Username</th>
				  ";
			    while ($row = $results->fetchArray()) {
				echo "<tr class=hovvy><td>" . h($row['username']) . "</td></tr>";
			    }
			    echo "</table>";				
		    
echo	"</table>
	</div>
	<br><br>
	<div id='changejoin'>
	    <div id='change2'>
	    <table>
	      <caption class=captiony>- Bills of your household: -</caption>";
			
				session_start();
				$household = $_SESSION["household"];
				$currID = $_SESSION["ID"];
				$db = new SQLite3('bills.db');
				$results = $db->query("SELECT * FROM mainbills WHERE household = '$household';");
				$count1 = 0;
				echo "<table>";
				echo "  
				    <th class=titley>Issuer</th>
				    <th class=titley>Name of Bill</th>
				    <th class=titley>Price of Bill</th>
				    <th class=titley>Status</th>
				    ";
				while ($row = $results->fetchArray()) {
				    $count1--;
				    $inID = h($row['ID']);
				    $ihtimal = "";
				    $confy = h($row['confirmed']);
				    if(($currID == $row['issuer_ID']) && ($confy == "Unconfirmed")) {
					$ihtimal = "<button id='".$count1."' class='confbutton'>Confirm</button>";
				    }
				    else {
					$ihtimal = h($row['confirmed']);
				    }
				    echo "<tr class=hovvy><td>". h($row['issuer_name']) . "</td><td>". h($row['bill']) ."</td><td>". h($row['price']) ."</td><td>". 
				    $ihtimal . 
				    "<input hidden id='billID".$count1."' value='$inID'>" .
				    "</td><td>" .
				    "</td></tr>";
				}
				echo "</table>";	
// 							    session_start();
// 							    $household = $_SESSION["household"];
// 							    $db = new SQLite3('bills.db');
// 							    $results = $db->query("SELECT * FROM mainbills WHERE household = '$household';");
// 							    echo "<table>";
// 							    echo "  
// 								<th class=titley>Issuer</th>
// 								<th class=titley>Name of Bill</th>
// 								<th class=titley>Price of Bill</th>
// 								<th class=titley>Status</th>
// 								";
// 							    while ($row = $results->fetchArray()) {
// 								echo "<tr class=hovvy><td>". h($row['issuer_name']) . "</td><td>". h($row['bill']) ."</td><td>". h($row['price']) ."</td><td>". h($row['confirmed']) . "</td></tr>";
// 							    }
// 							    echo "</table>";
			
echo "	    </table>
	    </div>
	    <br><br>
	    <div id='change3'>
	    <table>";
		    
			    session_start();
			    
			    $uID = $_SESSION["ID"];
			    $db = new SQLite3('bills.db');
			    $billIDs;
			    $results = $db->query("SELECT bill_ID FROM links WHERE user_ID = '$uID';");
			    while ($row = $results->fetchArray()) {
				    $billIDs[] = $row['bill_ID'];
			    }
			    $impArr = "('".implode("','",$billIDs)."')";
			    $presults = $db->query("SELECT * FROM bills WHERE ID IN " . $impArr. ";");	
			    $count2 = 0;
			    echo "<table>";
			    echo "<caption class=captiony>- Your owed shares: -</caption>";
			    echo "  
				    <th class=titley>Name of Bill</th>
				    <th class=titley>Bill Amount</th>
				    <th class=titley>Date Created</th>
				    <th class=titley>Pay the Bill</th>
				    ";
			    while ($row = $presults->fetchArray()) {
			    
				$count2++;
				  
				    $inID = h($row['ID']);

				    echo "<tr class=hovvy><td value='$inID'>" . h($row['bill']) . "</td><td>" . h($row['price']) . "</td><td>" . h($row['created']) . "</td><td>" .
					"<input type='text' id='amount".$count2."' name='amount' value=''><br/>" . 
					"<input hidden id='billID".$count2."' value='$inID'>" . 
					"<button id='".$count2."' class='button'>Pay</button>" . "</td><td>" . 
					"</td></tr>";
				
			    }
			    
			    echo "</table>";
		    
echo "	    </table>
	    </div>
	</div>
    </div>";
    ?>
    </body>
</html>
