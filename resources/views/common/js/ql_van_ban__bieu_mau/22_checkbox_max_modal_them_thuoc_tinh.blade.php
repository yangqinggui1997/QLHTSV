<script>
$(function(){
	try
	{
		/*checkbox cho thuộc tính max*/
        if($('#number__id__max').length)
        {
	        $('#number__id__max').on('mousedown', function(){
	        	try
	        	{
		        	if($('#checkBox__id__max').prop('checked'))
		        	{
		        		if($('#div__id__max').hasClass('bounded_event_click'))
			        	{
				            $('#div__id__max').unbind('click');
				            $('#div__id__max').removeClass('bounded_event_click');
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
	        
	        $('#number__id__max').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__max').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__max').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__max').prop('checked'))
					                $('#checkBox__id__max').prop('checked', false);
					            else
					                $('#checkBox__id__max').prop('checked', true);
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__max').addClass('bounded_event_click');
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