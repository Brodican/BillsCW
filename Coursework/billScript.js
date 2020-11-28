
$(document).ready(function() {
    
      $(document).on('click','.button', function(event) {
	
	  var id = $(this).attr('id'); // Get id of button clicked
	  var inamount = "#".concat("amount".concat(id));
	  var inbillID = "#".concat("billID".concat(id));
	  var amount = $(inamount).val();
	  var billID = $(inbillID).val();
        var formData = {
            'am'              : $(inamount).val(),
	    'inBillID'              : $(inbillID).val()
        };
	
        $.ajax({
            type        : 'POST', 
            url         : 'payBill.php', 
            data        : formData, 
            encode          : true,
             success: function(data) {
	       
                console.log(data); 
		$("#changejoin").html(data);
		
            }       
	  
	})

        event.preventDefault();
    });

});

