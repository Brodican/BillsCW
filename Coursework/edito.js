function delItem(str) {
	var xmlhttp;
  	if (str=="") {
    		document.getElementById("change").innerHTML="";
    		return;
  	}
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("change").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","deleteItem.php?return="+str,true);
        xmlhttp.send();
}

