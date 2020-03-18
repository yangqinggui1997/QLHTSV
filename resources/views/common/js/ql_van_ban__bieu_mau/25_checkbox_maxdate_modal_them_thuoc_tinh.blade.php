<script>
$(function(){
	try
	{
		/*checkbox cho thuộc tính maxDate*/
		if($('#div__id__maxDate').length)
		{
	        $('#div__id__maxDate').addClass('bounded_event_click');
	        $('#div__id__maxDate').on('click', function(){
	        	try
	        	{
		        	if($('#checkBox__id__maxDate').prop('checked'))
	                    $('#checkBox__id__maxDate').prop('checked', false);
	                else
	                    $('#checkBox__id__maxDate').prop('checked', true);
                    $('#checkBox__id__maxDate').trigger('change');
		            return true;
	        	}
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });
	    }

	    if($('#checkBox__id__maxDate').length)
	    {
	        $('#checkBox__id__maxDate').on('mousedown', function(){
	        	try
	        	{
		        	if($('#div__id__maxDate').hasClass('bounded_event_click'))
		        	{
			            $('#div__id__maxDate').unbind('click');
			            $('#div__id__maxDate').removeClass('bounded_event_click');
		        	}
		        	return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });

	        $('#checkBox__id__maxDate').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__maxDate').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__maxDate').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__maxDate').prop('checked'))
				                    $('#checkBox__id__maxDate').prop('checked', false);
				                else
				                    $('#checkBox__id__maxDate').prop('checked', true);
			                    $('#checkBox__id__maxDate').trigger('change');
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__maxDate').addClass('bounded_event_click');
		        	}
	        		return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });

	        /*Sự kiện check box maxDate change*/
			$('#checkBox__id__maxDate').on('change', function(e, _date){
				try
				{
					if($(this).prop('checked'))
					{
						$('#checkBox__id__maxDate_current').prop('checked', false);
						if(typeof _date === typeof undefined)
							$('#div__id__datetimePicker_maxDate').trigger('dp.change', $('#textBox__id__maxDate').attr('data-textBox-maxDate'));
						else
							$('#div__id__datetimePicker_maxDate').trigger('dp.change', _date);
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

		if($('#textBox__id__maxDate').length)
		{
	        $('#textBox__id__maxDate').on('mousedown', function(){
	        	try
	        	{
		        	if($('#checkBox__id__maxDate').prop('checked'))
		        	{
		        		if($('#div__id__maxDate').hasClass('bounded_event_click'))
			        	{
				            $('#div__id__maxDate').unbind('click');
				            $('#div__id__maxDate').removeClass('bounded_event_click');
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
	        
	        $('#textBox__id__maxDate').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__maxDate').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__maxDate').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__maxDate').prop('checked'))
				                    $('#checkBox__id__maxDate').prop('checked', false);
				                else
				                    $('#checkBox__id__maxDate').prop('checked', true);
			                    $('#checkBox__id__maxDate').trigger('change');
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__maxDate').addClass('bounded_event_click');
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

	    if($('#span__id__maxDate').length)
		{
	        $('#span__id__maxDate').on('mousedown', function(){
	        	try
	        	{
		        	if($('#checkBox__id__maxDate').prop('checked'))
		        	{
		        		if($('#div__id__maxDate').hasClass('bounded_event_click'))
			        	{
				            $('#div__id__maxDate').unbind('click');
				            $('#div__id__maxDate').removeClass('bounded_event_click');
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
	        
	        $('#span__id__maxDate').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__maxDate').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__maxDate').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__maxDate').prop('checked'))
				                    $('#checkBox__id__maxDate').prop('checked', false);
				                else
				                    $('#checkBox__id__maxDate').prop('checked', true);
			                    $('#checkBox__id__maxDate').trigger('change');
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__maxDate').addClass('bounded_event_click');
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