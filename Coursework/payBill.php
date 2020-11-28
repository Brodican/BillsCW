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
//     echo "mainnewprice: " . $mainnewprice . "<br>";
    
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
//       $db->exec("UPDATE mainbills SET price = '$mainnewprice' WHERE bill = '$name';");
      $pupdatemain = $db->prepare("UPDATE mainbills SET price=:newprice WHERE bill=:name");
      $pupdatemain->bindParam(':newprice', $mainnewprice);
      $pupdatemain->bindParam(':name', $name);
      $pupdatemain->execute(); 
//       $db->exec("UPDATE mainbills SET confirmed = '$done' WHERE bill = '$name';");
      $pupdatemaint = $db->prepare("UPDATE mainbills SET confirmed=:conf WHERE bill=:name");
      $pupdatemaint->bindParam(':conf', $done);
      $pupdatemaint->bindParam(':name', $name);
      $pupdatemaint->execute(); 
    }
    
    elseif ($newprice == 0) {
      echo "<script>";
      echo "alert('You have finished a share payment!');";
      echo "</script>";	
      
      $db->exec("DELETE FROM bills WHERE ID = '$billID';");
      
      $pupdate = $db->prepare("UPDATE mainbills SET price=:newprice WHERE bill=:name");
      $pupdate->bindParam(':newprice', $mainnewprice);
      $pupdate->bindParam(':name', $name);
      $pupdate->execute();     
      
    }
    
    else {
// 	$db->exec("UPDATE bills SET price = '$newprice' WHERE ID = $billID;");
	$pupdateshare = $db->prepare("UPDATE bills SET price=:newpriceshare WHERE ID=:billID");
	$pupdateshare->bindParam(':newpriceshare', $newprice);
	$pupdateshare->bindParam(':billID', $billID);
	$pupdateshare->execute(); 
// 	$db->exec("UPDATE mainbills SET price = '$mainnewprice' WHERE bill = '$name';");
	$pupdatemain = $db->prepare("UPDATE mainbills SET price=:newprice WHERE bill=:name");
	$pupdatemain->bindParam(':newprice', $mainnewprice);
	$pupdatemain->bindParam(':name', $name);
	$pupdatemain->execute(); 
    }
	    
echo "</table>
</div>
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
	    
echo "    </table>
    </div>
    </div>";

?>
