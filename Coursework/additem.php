<?php include 'security.php';?>
<?php
session_start();
$db = new SQLite3('todo.db');
$stmt = $db->prepare("INSERT INTO litems (user_ID, content, category, created, checkoffs) VALUES (:user_ID, :content, :category, :created, :checkoffs)");
$uID = $_SESSION["ID"];
$content = $_POST["item"];
$category = $_POST["category"];
$created = date("Y/m/d");
$checkoffs = 0;
$db = new SQLite3('todo.db');
$stmt->bindParam(':user_ID', $uID);
$stmt->bindParam(':content', $content);
$stmt->bindParam(':category', $category);
$stmt->bindParam(':created', $created);
$stmt->bindParam(':checkoffs', $checkoffs);
$stmt->execute();
$db = new SQLite3('todo.db');
$results = $db->query("SELECT * FROM litems WHERE user_ID = '$uID';");
echo $content . "<br>";
echo "<table>
       <caption class=captiony>- Change dates and add items using the corresponding buttons -</caption>";
  	    echo "<table>";
 	    while ($row = $results->fetchArray()) {
   	    $var = h($row['ID']);
   	    echo "hihi";
  	    echo "<tr class=hovvy><td>". h($row['user_ID']) . "</td><td>". h($row['content']) ."</td><td>". h($row['category']) ."</td><td>". h($row['created']) ."</td><td>". h($row['checkoffs']) . "</td><td>" . "<input type='submit' id='x' class='button' name='check' value='Check Off' onclick='delItem($var)'/>" . "</td></tr>";
 	    }
  	    echo "</table>";				
echo "</table>";
?>