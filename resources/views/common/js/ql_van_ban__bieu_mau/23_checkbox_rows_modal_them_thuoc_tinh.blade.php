<script>
$(function(){
	try
	{
		/*checkbox cho thuộc tính rows*/        
        if($('#number__id__rows').length)
        {
	        $('#number__id__rows').on('mousedown', function(){
	        	try
	        	{
		        	if($('#checkBox__id__rows').prop('checked'))
		        	{
		        		if($('#div__id__rows').hasClass('bounded_event_click'))
			        	{
				            $('#div__id__rows').unbind('click');
				            $('#div__id__rows').removeClass('bounded_event_click');
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
	        
	        $('#number__id__rows').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__rows').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__rows').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__rows').prop('checked'))
					                $('#checkBox__id__rows').prop('checked', false);
					            else
					                $('#checkBox__id__rows').prop('checked', true);
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__rows').addClass('bounded_event_click');
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