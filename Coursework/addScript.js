$(document).ready(function() {
    $(document).on('submit','#newbill', function(event) {
        var formData = {
            'bill'              : $('input[name=bill]').val(),
            'price'             : $('input[name=price]').val(),
            'shares'            : $('input[name=shares]').val(),
	    'housey'		: $('select[name=housey]').val()
        };
	
        $.ajax({
            type        : 'POST', 
            url         : 'newbill.php', 
            data        : formData, 
            encode          : true,
             success: function(data) {
                console.log(data); 
		$("#change").html(data);
            }       
	  
	})

	event.preventDefault();
    });

});