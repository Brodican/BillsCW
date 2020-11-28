
$(document).ready(function() {
    // process the form
    $('form').submit(function(event) {
        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'am'              : $('input[name=am]').val()
        };
	alert("I am an alert box!");
 	alert($('input[name=am]').val());
	alert("I am an alert box!");
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'payBill.php', // the url where we want to POST
            data        : formData, // our data object
//        dataType    : 'json', // what type of data do we expect back from the server
            encode          : true,
             success: function(data) {
                // log data to the console so we can see
                console.log(data); 
		$("#change3").html(data);
                // here we will handle errors and validation messages
            }       
	  
	})
            // using the done promise callback


        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});

