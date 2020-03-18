<script>
$(function(){
	try
	{
		/*checkbox cho thuộc tính maxlength*/
	    if($('#number__id__maxLength').length)
	    {
		    $('#number__id__maxLength').on('mousedown', function(){
		    	try
		    	{
			    	if($('#checkBox__id__maxLength').prop('checked'))
		        	{
		        		if($('#div__id__maxLength').hasClass('bounded_event_click'))
			        	{
				            $('#div__id__maxLength').unbind('click');
				            $('#div__id__maxLength').removeClass('bounded_event_click');
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
	        
	        $('#number__id__maxLength').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__maxLength').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__maxLength').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__maxLength').prop('checked'))
					                $('#checkBox__id__maxLength').prop('checked', false);
					            else
					                $('#checkBox__id__maxLength').prop('checked', true);
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__maxLength').addClass('bounded_event_click');
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