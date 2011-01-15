
$(document).ready(function(){
	$('#fsubmit').click(function(){
		
		$.get('process.php',{'feed':$('#fselector option:selected').text(),'genre':$('#gselector option:selected').text()},function(data){
			$('#ajax_return').html(data);			
			});
		});

	});
