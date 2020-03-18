<script>
$(function(){
	try
	{
		/*checkbox cho thuộc tính minlength*/
        if($('#number__id__minLength').length)
        {
	        $('#number__id__minLength').on('mousedown', function(){
	        	try
	        	{
		        	if($('#checkBox__id__minLength').prop('checked'))
		        	{
		        		if($('#div__id__minLength').hasClass('bounded_event_click'))
			        	{
				            $('#div__id__minLength').unbind('click');
				            $('#div__id__minLength').removeClass('bounded_event_click');
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
	        
	        $('#number__id__minLength').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__minLength').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__minLength').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__minLength').prop('checked'))
					                $('#checkBox__id__minLength').prop('checked', false);
					            else
					                $('#checkBox__id__minLength').prop('checked', true);
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__minLength').addClass('bounded_event_click');
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