<!DOCTYPE html>
<html>
    <body>
	<?php
	    echo "logging out";
	    session_start();
	    $_SESSION = array();
	    session_destroy();
	    $url='Main.php';
	    echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
	?>
    </body>
</html>