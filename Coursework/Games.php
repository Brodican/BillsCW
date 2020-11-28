<!DOCTYPE html>
<html>
    <head>
                <link rel="stylesheet" href="main.css" type="text/css" charset="utf-8">
                <meta charset="UTF-8">
                <title>Bills</title>
    </head>
    <body>
	<?php include 'security.php';?>
	<?php
			session_start();
			$db = new SQLITE3("bills.db");
			$uId = $_SESSION["ID"];
			$userQuery = $db->query("SELECT username FROM users WHERE ID = '$uId';");
			$user = "";
			while($row = $userQuery->fetchArray()) {
				$user = $row["username"];
			}
	?>
			<div class=logo>
					<img class=logo src="logo.png" alt="Logo">
			</div>
			<div class=centrebox>
					<br>
					<br>
					<div class=title>
							<h1 class=title> BillATron9000 - Games</h1>
					</div>
					<br>
					<br>
					<br>
					<div class=firstbox>
							<p class=bold>
							    <div class=writebox>
								<?php 
									echo "Welcome " . h($user) . "!" . 
									" Looking to blow off some steam? Steam not working for you? 
									Try our selection of other people's games!" ;
								?>
							    </div>
							</p>
					</div>

					<div class=gameDiv>
					<figure class=gameFig>
					    <img class=RRBlast src="RRBlast.jpg" alt="No Thumbnail">
					    <a href="RedBlast.php" class="gameLink">Red Remover Blast</a>
					</figure>
					<br>
					<figure class=gameFig>
					    <img class=RRBlast src="SS2.jpg" alt="No Thumbnail">
					    <a href="SuperStack2.php" class="gameLink">Super Stacker 2</a>
					</figure>
					<br>
					<figure class=gameFig>
					    <img class=RRBlast src="BloonsTD3.jpg" alt="No Thumbnail">
					    <a href="Bloons3.php" class="gameLink">Bloons TD 3</a>
					</figure>
					<a href="Bills.php" class="billButton">Back to Bills</a>
					<br>
					<br>
					<br>
					<br>
					</div>
					
			</div>
			
	<div class=bottom>
		<p class=bottom>
							Works of Utku
		</p>
	</div>
			
    </body>
</html>
