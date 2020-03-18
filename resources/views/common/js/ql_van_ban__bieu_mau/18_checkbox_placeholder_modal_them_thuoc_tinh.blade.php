<script>
$(function(){
	try
	{
		/*checkbox cho thuộc tính placeholder*/
		if($('#textBox__id__placeholder').length)
		{
	        $('#textBox__id__placeholder').on('mousedown', function(){
	        	try
	        	{
		        	if($('#checkBox__id__placeholder').prop('checked'))
		        	{
		        		if($('#div__id__placeholder').hasClass('bounded_event_click'))
			        	{
				            $('#div__id__placeholder').unbind('click');
				            $('#div__id__placeholder').removeClass('bounded_event_click');
			        	}
		        	}
		        	return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });
	        
	        $('#textBox__id__placeholder').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__placeholder').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__placeholder').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__placeholder').prop('checked'))
					                $('#checkBox__id__placeholder').prop('checked', false);
					            else
					                $('#checkBox__id__placeholder').prop('checked', true);
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__placeholder').addClass('bounded_event_click');
		        	}
		        	return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });
	    }
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>