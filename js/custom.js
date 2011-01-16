
$(document).ready(function(){
	$('.pagination').hide();
	$('#fsubmit').click(function(){
			$('.paginator').each(function(){
				if($(this).attr('value')==1){
					$(this).css('background-color','green');
					
					}
				else
				$(this).css('background-color','');
				
				});
		
		$.get('process.php',{'feed':$('#fselector option:selected').text(),'genre':$('#gselector option:selected').text(),'number':$('#pselector option:selected').text()},function(data){
			$('#ajax_return').html(data);			
			});
			$('#ajax_return').hide();
			$('#ajax_return').fadeIn('slow');
			$('.pagination').fadeIn('slow');
		});
		$('#ajax-content').hide();
		
	$('#loadingDiv').hide();
	
	
	$('.paginator').click(function(){
		var counter=$(this).attr('value');
			$.get('process.php',{'feed':$('#fselector option:selected').text(),'genre':$('#gselector option:selected').text(),'page':counter},function(data){
			$('#ajax_return').html(data);			
			});
			$('#ajax_return').hide();
			$('#ajax_return').fadeIn('slow');
			$('.pagination').fadeIn('slow');
			$('.paginator').each(function(){
				if($(this).attr('value')==counter){
					$(this).css('background-color','green');
					
					}
				else
				$(this).css('background-color','');
				
				});
			
		
		});
	
	
	
	/*
	ajaxStart(function() {
        $(this).show();
    }).ajaxStop(function() {
        $(this).hide();
    });
*/

	});
