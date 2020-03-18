<script>
$(function(){
	try
	{
		/*checkbox cho thuộc tính minDate_current*/
		if($('#div__id__minDate_current').length)
		{
	        $('#div__id__minDate_current').addClass('bounded_event_click');
	        $('#div__id__minDate_current').on('click', function(){
	        	try
	        	{
		        	if($('#checkBox__id__minDate_current').prop('checked'))
	                    $('#checkBox__id__minDate_current').prop('checked', false);
	                else
	                    $('#checkBox__id__minDate_current').prop('checked', true);
                    $('#checkBox__id__minDate_current').trigger('change');
		            return true;
	        	}
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });
	    }

	    if($('#checkBox__id__minDate_current').length)
	    {
	        $('#checkBox__id__minDate_current').on('mousedown', function(){
	        	try
	        	{
		        	if($('#div__id__minDate_current').hasClass('bounded_event_click'))
		        	{
			            $('#div__id__minDate_current').unbind('click');
			            $('#div__id__minDate_current').removeClass('bounded_event_click');
		        	}
		        	return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });

	        $('#checkBox__id__minDate_current').on('mouseout', function(){
	        	try
	        	{
		        	if(!$('#div__id__minDate_current').hasClass('bounded_event_click'))
		        	{
		        		$('#div__id__minDate_current').bind('click', function(){
			                try
				        	{
					        	if($('#checkBox__id__minDate_current').prop('checked'))
				                    $('#checkBox__id__minDate_current').prop('checked', false);
				                else
				                    $('#checkBox__id__minDate_current').prop('checked', true);
			                    $('#checkBox__id__minDate_current').trigger('change');
					            return true;
				        	}
				            catch(err)
							{
								alert('Lỗi: ' + err.stack + '!');
								return false;
							}
			            });
		        		$('#div__id__minDate_current').addClass('bounded_event_click');
		        	}
	        		return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });

	        /*Sự kiện check box minDate_current change*/
			$('#checkBox__id__minDate_current').on('change', function(e, _ddate){
				try
				{
					var _date = new Date();
					if(typeof _ddate !== typeof undefined)
						_date = new Date(_ddate);
					if($(this).prop('checked'))
					{
						$('#div__id__datetimePicker_minDate_current').data('DateTimePicker').date(_date);
						$('#checkBox__id__minDate').prop('checked', false);
						$('#div__id__datetimePicker_maxDate').data('DateTimePicker').minDate(_date);
						$(this).attr('data-checkBox-minDate_current', _date.toString());
						if(_date > new Date($('#checkBox__id__maxDate_current').attr('data-checkBox-maxDate_current')))
						{
							$('#div__id__datetimePicker_maxDate_current').data('DateTimePicker').date(_date);
							$('#checkBox__id__maxDate_current').attr('data-checkBox-maxDate_current', _date.toString());
						}
						if(new Date($('#textBox__id__maxDate').attr('data-textBox-maxDate')) < _date)
						{
							$('#div__id__datetimePicker_maxDate').data('DateTimePicker').date(_date);
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