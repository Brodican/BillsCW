<?php include 'security.php';?>
<?php
    session_start();
    $am = $_POST["am"];
    $billID = $_POST["inBillID"];
    $db = new SQLite3('bills.db');
    $results = $db->query("SELECT * FROM bills WHERE ID = '$billID';");
    $price = 0;
    $name = "";
    while ($row = $results->fetchArray()) {
      $price = $row["price"];
      $name = $row["bill"];
    }
    
    $newprice = $price - $am;
    $mainprice = 0;
    $mainresults = $db->query("SELECT * FROM mainbills WHERE bill = '$name';");
    while ($row = $mainresults->fetchArray()) {
      $mainprice = $row["price"];
    }
    
    $mainnewprice = $mainprice - $am;
    
    if($am > $price) {
      echo "<script>";
      echo "alert('You attempted to overpay!');";
      echo "</script>";
    }
    
    elseif ($mainnewprice == 0) {
      echo "<script>";
      echo "alert('You have finished a house bill!');";
      echo "</script>";	
      $done = "Unconfirmed";
      $db->exec("DELETE FROM bills WHERE ID = '$billID';");
      $db->exec("UPDATE mainbills SET confirmed = '$done' WHERE bill = '$name';");
    }
    
    elseif ($newprice == 0) {
      echo "<script>";
      echo "alert('You have finished a share payment!');";
      echo "</script>";	
      $db->exec("DELETE FROM bills WHERE ID = '$billID';");
      
    }
    
    else {
// 	$queryBillID = $db->prepare("SELECT ID FROM bills WHERE bill=:bill AND user_ID=:uId AND household=:house;");
// 	$queryBillID->bindParam(':bill', $content);
// 	$queryBillID->bindParam(':uId', $uId);
// 	$queryBillID->bindParam(':house', $household);
	$db->exec("UPDATE bills SET checkoffs = '1' WHERE ID = $billID;");
	$db->exec("UPDATE bills SET price = '$newprice' WHERE ID = $billID;");
	$db->exec("UPDATE mainbills SET price = '$mainnewprice' WHERE bill = '$name';");
// 	$pupdate = $db->prepare("UPDATE bills SET checkoffs=:check WHERE ID=:billID;");
// 	$checky = 1;
// 	$pupdate->bindParam(':check', $checky);
// 	$pupdate->bindParam(':newprice', $newprice);
// 	$pupdate->bindParam(':billID', $billID);
// 	$pupdate->execute();
    }

echo "<div id='change'>
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
	    
echo "</table>
</div>
<br><br>
<div id='changejoin'>
    <div id='change2'>
    <table>
      <caption class=captiony>- Bills of your household: -</caption>";
		
/*			session_start();
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
			echo "</table>";*/	
							    session_start();
							    $household = $_SESSION["household"];
							    $db = new SQLite3('bills.db');
							    $results = $db->query("SELECT * FROM mainbills WHERE household = '$household';");
							    echo "<table>";
							    echo "  
								<th class=titley>Issuer</th>
								<th class=titley>Name of Bill</th>
								<th class=titley>Price of Bill</th>
								<th class=titley>Status</th>
								";
							    while ($row = $results->fetchArray()) {
								echo "<tr class=hovvy><td>". h($row['issuer_name']) . "</td><td>". h($row['bill']) ."</td><td>". h($row['price']) ."</td><td>". h($row['confirmed']) . "</td></tr>";
							    }
							    echo "</table>";
		
echo    "</table>
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
			    <th class=titley>Price of Bill</th>
			    <th class=titley>Pay the Bill</th>
			    ";
		    while ($row = $presults->fetchArray()) {
		    
			$count2++;
			  
			    $inID = h($row['ID']);

			    echo "<tr class=hovvy><td value='$inID'>" . h($row['bill']) . "</td><td>" . h($row['price']) . "</td><td>" . 
				"<input type='text' id='amount".$count2."' name='amount' value='$count2'><br/>" . 
				"<input hidden id='billID".$count2."' value='$inID'>" . 
				"<button id='".$count2."' class='button'>Pay</button>" . "</td><td>" . 
				"</td></tr>";
			
		    }
		    
		    echo "</table>";
	    
echo "    </table>
    </div>
    </div>";

?>