<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" href="editor.css" type="text/css" charset="utf-8">
		<meta charset="UTF-8">
		<script src="jquery-3.1.1.min.js"></script>
		<script src="billScript.js"></script>
 		<script src="addScript.js"></script>
 		<script src="delMainBill.js"></script>
		<title>Bills</title>
    </head>
    <body>
		<?php include 'security.php';?>
		<div class=logo>
			<img class=logo src="logo.png" alt="Logo">
		</div>
		<div class=centrebox>
			<br>
			<br>
			<div class=title>
				<h1 class=title> Bills </h1>
			</div>
			<br>
			<br>
			<br>
			<br>
			<div class=secondbox>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<a class=button1 href="Account.php">Manage Your Account</a><br>
				<a class=button1 href="Main.php">Main Page</a><br>
				<a class=button1 href="Games.php">Games</a><br>
				<a class=button1 href="logout.php">Logout</a><br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
			</div>
			<div class=firstbox>
				<div id="change">
				    <h1></h1>
				    <div id="change1">
				    <table>
				      <caption class=captiony>- Users in your household: -</caption>
						<?php
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
						?>
				    </table>
				    </div>
				    <br><br>
				    <div id="changejoin">
					<div id="change2">
					<table>
					  <caption class=captiony>- Bills of your household: -</caption>
						    <?php
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
						    ?>
					</table>
					</div>
					<br><br>
					<div id="change3">
					<table>
						<?php
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
						?>
					</table>
					</div>
				    </div>
				</div>
				    <br>
				    <br>
				    <br>
				    <form name="billy" class="inputty" id="newbill" action="" method="post">
				    <caption class=captiony>- Add a new Bill: -</caption><br>
					      <select class=selecty name="housey"><br>
						    <option value='All'>All HouseMates</option>
						    <option value='Some'>Some HouseMates</option>
					      </select><br>
					  <input type="bill" name="bill" placeholder="Name of bill"></textarea><br/>
					  <input type="price" name="price" placeholder="Bill Amount"></textarea><br/>
					  <input type="shares" name="shares" placeholder="Users (split with commas)"></textarea><br/>
					  <input class=tinybutton type="submit" value="&#10004;">
				    </form>
				    <br>
				    <br>
				    <br>
				</div>
			</div>
		</div>
        <div class=bottom>
            <p class=bottom> 
				Works of Utku
            </p>
        </div>
    </body>
</html>
