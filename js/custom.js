
$(document).ready(function(){
	
	$('.pagination').hide();
	$('#fsubmit').click(function(){
		$('.pagination').hide();
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
		$('.pagination').hide();		
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
	
	
	

$('#ajax_return').ajaxStop(function(){
$('.read-more').hide();

$('.more').click(function(){	
$(this).prev().append($(this).next('.read-more').text());
$(this).hide();
});

var counter=$('#ajax-content').attr('class');
var page =counter/20;

	$('.paginator').each(function(){
		if($(this).attr('id')<page)$(this).hide();		
		});
	
});







	});
