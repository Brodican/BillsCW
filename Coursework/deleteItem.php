<?php include 'security.php';?>
<?php

$litem_ID = $_GET["return"];
$db = new SQLite3('todo.db');
$db->exec("UPDATE litems SET checkoffs = '1' WHERE ID = $litem_ID;");
session_start();
$uID = $_SESSION["ID"];
$db = new SQLite3('todo.db');
$results = $db->query("SELECT * FROM litems WHERE user_ID = '$uID';");
echo "<table>
       <caption class=captiony>- Change dates and add items using the corresponding buttons -</caption>";
  	    echo "<table>";
 	    while ($row = $results->fetchArray()) {
   	    $var = h($row['ID']);
  	    echo "<tr class=hovvy><td>". h($row['user_ID']) . "</td><td>". h($row['content']) ."</td><td>". h($row['category']) ."</td><td>". h($row['created']) ."</td><td>". h($row['checkoffs']) . "</td><td>" . "<input type='submit' id='x' class='button' name='check' value='Check Off' onclick='delItem($var)'/>" . "</td></tr>";
 	    }
  	    echo "</table>";				
echo "</table>";
?>
