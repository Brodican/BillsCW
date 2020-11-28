
function validateForm() {
    var a = document.forms["billy"]["bill"].value;
    if (a == "") {
        alert("You must name the bill");
        return false;
    }
    var b = document.forms["billy"]["price"].value;
    if (b == "") {
        alert("You must specify a price");
        return false;
    }
    var d = document.forms["billy"]["housey"].value;
    if (d == "Some") {
	var e = document.forms["billy"]["shares"].value;
	if (e == "") {
	    alert("You need to share the bill with some housemates!");
	    return false;
	}
    }
}