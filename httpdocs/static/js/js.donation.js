


$( document ).ready(function() { 

$('.amountinput').each(function(){
	
				
		$(this).keyup(function(){
				  $("#cttotal").html(  Math.ceil( Math.ceil(spm) +   Math.ceil($(this).val()))  );
		})

}) 


$('.donation_amount').each(function(){

	$(this).click(function(){
		$('.donation_amount').removeClass('active');
		$('.donation_amount').find('input').attr('disabled','disabled');
		
		$(this).addClass('active');
		$(this).find('input').removeAttr('disabled');
		
 		 $("#cttotal").html(  Math.ceil(  Math.ceil(spm)+   Math.ceil(  $(this).find('input').val())  )  );
	})

}) 

})