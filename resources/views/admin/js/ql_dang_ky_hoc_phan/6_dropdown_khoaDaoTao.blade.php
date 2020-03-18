<script>
$(function(){
	try
	{
		function setLabelKDT()
		{
			try
            {
            	var listContent = '';
            	$('[data-checkbox-kdt]:checked').each(function(){
            		if(listContent)
	            		listContent += ' - ' + $(this).attr('data-checkbox-content');
	            	else
	            		listContent += $(this).attr('data-checkbox-content');
            	});
            	if(listContent)
            		$('#label__id__khoaDaoTao').text(listContent);
            	else
            		$('#label__id__khoaDaoTao').text('');

	            return true;
            }
            catch(err)
			{
				alert("Lỗi: " + err.stack + "!");
				return false;
			}
		}
		/*click dropdown khoá đào tạo*/
		if($('#div__id__khoaDaoTao').length)
		{
			$('#div__id__khoaDaoTao').on('mousedown', function(){
	            try
	            {
	            	if($('#div__id__danhSachKDTArea').is(':hidden'))
	            		$('#div__id__danhSachKDTArea').css('display', 'block');
	            	$('#i__id__propdownSelect').removeClass('fa-sort-down');
					$('#i__id__propdownSelect').addClass('fa-sort-up');
					$('#i__id__propdownSelect').css('vertical-align', 'sub');
		            return true;
	            }
	            catch(err)
				{
					alert("Lỗi: " + err.stack + "!");
					return false;
				}
			});

			$('#div__id__khoaDaoTao').on('blur', function(){
				try
				{
					$('#div__id__danhSachKDTArea').css('display', 'none');
					$('#i__id__propdownSelect').removeClass('fa-sort-up');
					$('#i__id__propdownSelect').addClass('fa-sort-down');
					$('#i__id__propdownSelect').css('vertical-align', 'super');
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
		}

		/*Click lên vùng chứa checkbox sẽ check*/
		if($('.checkboxKDT').length)
		{
			$('.checkboxKDT').addClass('bounded_event_click');
	        $('.checkboxKDT').on('click', function(){
	        	try
	        	{
	        		var checkbox = $('[data-checkbox-id="kdt_' + $(this).attr('data-div-id') + '"]');
		        	if(checkbox.prop('checked'))
		               	checkbox.prop('checked', false);
		            else
		                checkbox.prop('checked', true);
		            setLabelKDT();
		            return true;
	        	}
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });
		}
		
		if($('[data-checkbox-kdt]').length)
		{
	        $('[data-checkbox-kdt]').on('mousedown', function(){
	        	try
	        	{
	        		var div = $('[data-div-id="' + $(this).attr('data-checkbox-content') + '"]');
		        	if(div.hasClass('bounded_event_click'))
		        	{
			            div.unbind('click');
			            div.removeClass('bounded_event_click');
		        	}
		        	setLabelKDT();
		        	return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
	        });

	        $('[data-checkbox-kdt]').on('mouseout', function(){
	        	try
	        	{
	        		var div = $('[data-div-id="' + $(this).attr('data-checkbox-content') + '"]');
		        	if(!div.hasClass('bounded_event_click'))
		        	{
		        		div.bind('click', function(){
			                try
				        	{
				        		var checkbox = $('[data-checkbox-id="kdt_' + $(this).attr('data-div-id') + '"]');
					        	if(checkbox.prop('checked'))
					               	checkbox.prop('checked', false);
					            else
					                checkbox.prop('checked', true);
					            setLabelKDT();
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

        /*click vùng chứa dropdown*/
		if($('#div__id__danhSachKDTArea').length)
		{
			$('#div__id__danhSachKDTArea').on('mousedown', function(){
	            try
	            {
	            	$('#div__id__khoaDaoTao').unbind('blur');
		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

			$('#div__id__danhSachKDTArea').on('mouseup', function(){
				try
				{
					$('#div__id__khoaDaoTao').bind('blur', function(){
						try
						{
							$('#div__id__danhSachKDTArea').css('display', 'none');
							$('#i__id__propdownSelect').removeClass('fa-sort-up');
							$('#i__id__propdownSelect').addClass('fa-sort-down');
							$('#i__id__propdownSelect').css('vertical-align', 'super');
							return true;
						}
						catch(err)
						{
							alert('Lỗi: ' + err.stack + '!');
							return false;
						}
					});
					$('#div__id__khoaDaoTao').focus();
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