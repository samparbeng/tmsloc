 $(document).ready(function(){
	//On Blur procedures		

	$(document).on('blur', "#orderquantity", function(){
		calculateTotal();
	});

	$(document).on('blur', "#orderunitpx", function(){				
		calculateTotal();		
	});

	$(document).on('blur', "#ordertotalpx", function(){		
		calculateTotal();
	});	

	
	
	$(document).on('click', '.deleteInvoice', function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_invoice'},				
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
});	

function calculateTotal(){
	$(document).on('blur', "#orderquantity", function(){
		var orderquantity = $('#orderquantity').val();
		if(!orderquantiti){
			orderquantity = 1
		}
		var orderunitpx = $('#orderunitpx').val();			
		if(orderquantity && orderunitpx) {
			ordertotalpx = orderquantity*orderunitpx;			
			$('#ordertotalpx').val(ordertotalpx);
			} 
		});
}
 