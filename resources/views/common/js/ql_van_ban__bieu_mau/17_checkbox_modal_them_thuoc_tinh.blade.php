<script>
$(function(){
	try
	{
		/*Click lên vùng chứa checkbox sẽ check, các checkbox trên modal thêm thuộc tính cho các input được tạo*/
		if($('[data-div-check]').length)
		{
			$('[data-div-check]').addClass('bounded_event_click');
	        $('[data-div-check]').on('click', function(){
	        	try
	        	{
	        		var checkbox = $($($(this).children()[0]).children()[0]);
		        	if(checkbox.prop('checked'))
		               	checkbox.prop('checked', false);
		            else
		                checkbox.prop('checked', true);
		            return true;
	        	}
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });
		}
		
		if($('[data-input-clearCheck]').length)
		{
	        $('[data-input-clearCheck]').on('mousedown', function(){
	        	try
	        	{
	        		var div = $(this).parent().parent();
		        	if(div.hasClass('bounded_event_click'))
		        	{
			            div.unbind('click');
			            div.removeClass('bounded_event_click');
		        	}
		        	return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });

	        $('[data-input-clearCheck]').on('mouseout', function(){
	        	try
	        	{
	        		var div = $(this).parent().parent();
		        	if(!div.hasClass('bounded_event_click'))
		        	{
		        		div.bind('click', function(){
			                try
				        	{
				        		var checkbox = $($($(this).children()[0]).children()[0]);
					        	if(checkbox.prop('checked'))
					                checkbox.prop('checked', false);
					            else
					                checkbox.prop('checked', true);
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		div.addClass('bounded_event_click');
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