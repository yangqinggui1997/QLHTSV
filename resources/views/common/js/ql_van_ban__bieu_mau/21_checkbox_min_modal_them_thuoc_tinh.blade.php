<script>
$(function(){
	try
	{
		/*checkbox cho thuộc tính min*/        
        if($('#number__id__min').length)
        {
	        $('#number__id__min').on('mousedown', function(){
	        	try
	        	{
		        	if($('#checkBox__id__min').prop('checked'))
		        	{
		        		if($('#div__id__min').hasClass('bounded_event_click'))
			        	{
				            $('#div__id__min').unbind('click');
				            $('#div__id__min').removeClass('bounded_event_click');
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
	        
	        $('#number__id__min').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__min').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__min').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__min').prop('checked'))
					                $('#checkBox__id__min').prop('checked', false);
					            else
					                $('#checkBox__id__min').prop('checked', true);
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__min').addClass('bounded_event_click');
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