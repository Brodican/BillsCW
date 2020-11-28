$(document).ready(function() {
    
      $(document).on('click','.confbutton', function(event) { // Use on so page is changed even after ajax call
	
	var id = $(this).attr('id'); // Get id of button clicked
	var inmainbillID = "#".concat("billID".concat(id));
	var billID = $(inmainbillID).val();
	  
        var formData = {
	    'inmainBillID'              : $(inmainbillID).val()
        };
	
        $.ajax({
            type        : 'POST', 
            url         : 'delmain.php', 
            data        : formData, 
            encode          : true,
             success: function(data) {
	       
                console.log(data); 
		$("#change2").html(data);
		
            }       
	  
	})

        event.preventDefault();
    });

});