 $(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow" type="checkbox"></td>';          
		htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>';		          
		htmlRows += '<td><select type="text" name="productName[]" id="productName_'+count+'" class="form-control" autocomplete="off"></select></td>';	
		htmlRows += '<td><input type="number" name="duration[]" id="duration_'+count+'" class="form-control duration" autocomplete="off"></td>';   		
		htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';		 
		htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" autocomplete="off"></td>';		
		htmlRows += '</tr>';
		$('#invoiceItem').append(htmlRows);
	}); 
	
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});
	
	//On Blur procedures		
	$(document).on('blur', "[id^=quantity_]", function(){
		calculateTotal();
	});	
	
	$(document).on('blur', "[id^=price_]", function(){
		calculateTotal();
	});

	$(document).on('blur', "[id^=duration_]", function(){
		calculateTotal();
	});

	$(document).on('blur', "#taxRate", function(){				
		calculateTotal();		
	});

	$(document).on('blur', "#vatRate", function(){		
		calculateTotal();
	});	
	$(document).on('blur', "#gtlRate", function(){		
		calculateTotal();
	});	
	$(document).on('blur', "#driverAllowance", function(){		
		calculateTotal();
	});	

	$(document).on('blur', "#amountPaid", function(){
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}	
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
	var totalAmount = 0; 
	$("[id^='price_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("price_",'');
		var price = $('#price_'+id).val();
		var quantity  = $('#quantity_'+id).val();		
		if(!quantity) {
			quantity = 1;
		}
		var duration = $('#duration_'+id).val();
		if(!duration) {
			duration = 1;
		}
		var total = price * quantity * duration;
		$('#total_'+id).val(parseFloat(total));
		totalAmount += total;			
	});

	$('#subTotal').val(parseFloat(totalAmount));	
	var taxRate = $("#taxRate").val();	
	var subTotal = $('#subTotal').val();	
	if(subTotal) 
	{
		var taxAmount = subTotal*taxRate/100;
		$('#taxAmount').val(taxAmount);
		subTotalAfterLevy = parseFloat(subTotal)+parseFloat(taxAmount);
		$('#totalAftertax').val(subTotalAfterLevy);

		var vatRate = $("#vatRate").val();
		var vatAmount = subTotalAfterLevy*vatRate/100;
		$('#vatAmount').val(vatAmount);
        totalAftertaxes = parseFloat(subTotalAfterLevy)+parseFloat(vatAmount);
        $('#totalAftertaxes').val(totalAftertaxes);
		
		var gtlRate = $("#gtlRate").val();
		var gtlAmount = subTotal*gtlRate/100;
		$('#gtlAmount').val(gtlAmount);
		
		var totalAfterGTL = parseFloat(totalAfterTaxes)+parseFloat(gtlAmount);		
		$('#totalAfterGTL').val(totalAfterGTL);
		var driverAllowance = parseFloat($("#driverAllowance").val());
		var amountAfterDriAll = parseFloat(amountAfterGTL)+parseFloat(driverAllowance); 
		
		$('#totalWOF').val(amountAfterDriAll);

		var amountPaid = $('#amountPaid').val();
		var totalAftertax = $('#totalAftertax').val();					
		if(amountPaid && totalAftertax) 
		{
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(subTotal);
		} else 
		{		
			$('#amountDue').val(subTotal);
		}
	}
} 