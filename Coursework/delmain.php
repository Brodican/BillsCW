<?php include 'security.php';?>
<?php
    $billID = $_POST["inmainBillID"];
    $db = new SQLite3('bills.db');
    $db->exec("DELETE FROM mainbills WHERE ID = '$billID';");
	    
echo "<table>
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
	    
echo "</table>";
	
?>