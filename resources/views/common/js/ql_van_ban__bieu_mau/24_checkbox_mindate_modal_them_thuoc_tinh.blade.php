<script>
$(function(){
	try
	{
		/*checkbox cho thuộc tính minDate*/
		if($('#div__id__minDate').length)
		{
	        $('#div__id__minDate').addClass('bounded_event_click');
	        $('#div__id__minDate').on('click', function(){
	        	try
	        	{
		        	if($('#checkBox__id__minDate').prop('checked'))
	                    $('#checkBox__id__minDate').prop('checked', false);
	                else
	                    $('#checkBox__id__minDate').prop('checked', true);
	                $('#checkBox__id__minDate').trigger('change');
		            return true;
	        	}
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });
	    }

	    if($('#checkBox__id__minDate').length)
	    {
	        $('#checkBox__id__minDate').on('mousedown', function(){
	        	try
	        	{
		        	if($('#div__id__minDate').hasClass('bounded_event_click'))
		        	{
			            $('#div__id__minDate').unbind('click');
			            $('#div__id__minDate').removeClass('bounded_event_click');
		        	}
		        	return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });

	        $('#checkBox__id__minDate').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__minDate').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__minDate').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__minDate').prop('checked'))
				                    $('#checkBox__id__minDate').prop('checked', false);
				                else
				                    $('#checkBox__id__minDate').prop('checked', true);
				                $('#checkBox__id__minDate').trigger('change');
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__minDate').addClass('bounded_event_click');
		        	}
	        		return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });

	        /*Sự kiện check box minDate change*/
			$('#checkBox__id__minDate').on('change', function(e, _date){
				try
				{
					if($(this).prop('checked'))
					{
						$('#checkBox__id__minDate_current').prop('checked', false);
						if(typeof _date === typeof undefined)
							$('#div__id__datetimePicker_minDate').trigger('dp.change', $('#textBox__id__minDate').attr('data-textBox-minDate'));
						else
							$('#div__id__datetimePicker_minDate').trigger('dp.change', _date);
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

		if($('#textBox__id__minDate').length)
		{
	        $('#textBox__id__minDate').on('mousedown', function(){
	        	try
	        	{
		        	if($('#checkBox__id__minDate').prop('checked'))
		        	{
		        		if($('#div__id__minDate').hasClass('bounded_event_click'))
			        	{
				            $('#div__id__minDate').unbind('click');
				            $('#div__id__minDate').removeClass('bounded_event_click');
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
	        
	        $('#textBox__id__minDate').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__minDate').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__minDate').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__minDate').prop('checked'))
				                    $('#checkBox__id__minDate').prop('checked', false);
				                else
				                    $('#checkBox__id__minDate').prop('checked', true);
				                $('#checkBox__id__minDate').trigger('change');
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__minDate').addClass('bounded_event_click');
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

	    if($('#span__id__minDate').length)
		{
	        $('#span__id__minDate').on('mousedown', function(){
	        	try
	        	{
		        	if($('#checkBox__id__minDate').prop('checked'))
		        	{
		        		if($('#div__id__minDate').hasClass('bounded_event_click'))
			        	{
				            $('#div__id__minDate').unbind('click');
				            $('#div__id__minDate').removeClass('bounded_event_click');
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
	        
	        $('#span__id__minDate').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__minDate').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__minDate').bind('click', function(e){
			                try
				        	{
					        	if($('#checkBox__id__minDate').prop('checked'))
				                    $('#checkBox__id__minDate').prop('checked', false);
				                else
				                    $('#checkBox__id__minDate').prop('checked', true);
				                $('#checkBox__id__minDate').trigger('change');
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__minDate').addClass('bounded_event_click');
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