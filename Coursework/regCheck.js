function checkPasswordMatch() {
    var password = $("#Password1").val();
    var confirmPassword = $("#Password2").val();

    if (password != confirmPassword) {
        $("#printCheck").html("Passwords do not match!");
        $("#printCheck").css("color","red");
	
    }
    else {
        $("#printCheck").html("Passwords match.");
        $("#printCheck").css("color","blue");
    }
}

$(document).ready(function () {
   $("#Password1, #Password2").keyup(checkPasswordMatch);
});

function validateForm() {
    var a = document.forms["reggy"]["username"].value;
    if (a == "") {
        alert("Name must be filled out");
        return false;
    }
    var d = document.forms["reggy"]["email"].value;
    if (d == "") {
        alert("Email must be filled out");
        return false;
    }
    var b = document.forms["reggy"]["password1"].value;
    if (b == "") {
        alert("Password must be filled out");
        return false;
    }
    var c = document.forms["reggy"]["password2"].value;
    if (c == "") {
        alert("Password repeat must be filled out");
        return false;
    }
    var e = document.forms["reggy"]["household"].value;
    if (e == "") {
        alert("Household must be filled out");
        return false;
    }
    var f = document.forms["reggy"]["cpassword"].value;
    if (f == "") {
        alert("Password must be filled out");
        return false;
    }
}
