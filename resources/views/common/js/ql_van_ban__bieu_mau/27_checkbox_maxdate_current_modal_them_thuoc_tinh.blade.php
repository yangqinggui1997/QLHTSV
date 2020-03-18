<script>
$(function(){
	try
	{
		/*checkbox cho thuộc tính maxDate_current*/
		if($('#div__id__maxDate_current').length)
		{
	        $('#div__id__maxDate_current').addClass('bounded_event_click');
	        $('#div__id__maxDate_current').on('click', function(){
	        	try
	        	{
		        	if($('#checkBox__id__maxDate_current').prop('checked'))
	                    $('#checkBox__id__maxDate_current').prop('checked', false);
	                else
	                    $('#checkBox__id__maxDate_current').prop('checked', true);
	                $('#checkBox__id__maxDate_current').trigger('change');
		            return true;
	        	}
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });
	    }

	    if($('#checkBox__id__maxDate_current').length)
	    {
	        $('#checkBox__id__maxDate_current').on('mousedown', function(){
	        	try
	        	{
		        	if($('#div__id__maxDate_current').hasClass('bounded_event_click'))
		        	{
			            $('#div__id__maxDate_current').unbind('click');
			            $('#div__id__maxDate_current').removeClass('bounded_event_click');
		        	}
		        	return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });

	        $('#checkBox__id__maxDate_current').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__maxDate_current').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__maxDate_current').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__maxDate_current').prop('checked'))
				                    $('#checkBox__id__maxDate_current').prop('checked', false);
				                else
				                    $('#checkBox__id__maxDate_current').prop('checked', true);
				                $('#checkBox__id__maxDate_current').trigger('change');
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__maxDate_current').addClass('bounded_event_click');
		        	}
	        		return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });

	        /*Sự kiện check box maxDate_current change*/
			$('#checkBox__id__maxDate_current').on('change', function(e, _ddate){
				try
				{
					var _date = new Date();
					if(typeof _ddate !== typeof undefined)
						_date = new Date(_ddate);
					if($(this).prop('checked'))
					{
						$('#div__id__datetimePicker_maxDate_current').data('DateTimePicker').date(_date);
						$('#checkBox__id__maxDate').prop('checked', false);
						$('#div__id__datetimePicker_minDate').data('DateTimePicker').maxDate(_date);
						$(this).attr('data-checkBox-maxDate_current', _date.toString());
						if(new Date($('#textBox__id__minDate').attr('data-textBox-minDate')) > _date)
						{
							$('#div__id__datetimePicker_minDate').data('DateTimePicker').date(_date);
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