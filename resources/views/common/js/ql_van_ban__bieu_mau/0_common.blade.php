<script>
/*Kiểm tra thứ tự các lựa chọn được thêm vào, sắp xếp lại chúng nếp không hợp lý*/
function sortOption(options, orderRetrieve)
{
	try
	{
		var i = 1;
		var order = 0;
		var badOrder = false;
		var object = $(options[0]);
		if(typeof options === typeof undefined || !object.attr('data-label-comboBox_datalist-no') || isNaN(object.attr('data-label-comboBox_datalist-no')))
			throw new Error('Đối tượng sắp xếp không tồn tại hoặc chứa giá trị không hợp lệ!');
		order = parseInt(object.attr('data-label-comboBox_datalist-no'));
		if(order !== 1)
		{
			badOrder = true;
			i = 0;
			order = 0;
		}
		else
			for(; i < options.length; ++i)
			{
				object = $(options[i]);
				if(!object.attr('data-label-comboBox_datalist-no') || isNaN(object.attr('data-label-comboBox_datalist-no')))
					throw new Error('Đối tượng sắp xếp chứa giá trị không hợp lệ!');
				if(parseInt(object.attr('data-label-comboBox_datalist-no')) - order !== 1)
				{
					badOrder = true;
					break;
				}
				order = parseInt(object.attr('data-label-comboBox_datalist-no'));
			}
		if(badOrder)
			for(; i < options.length; ++i)
			{
				object = $(options[i]);
				if(!object.attr('data-label-comboBox_datalist-no') || isNaN(object.attr('data-label-comboBox_datalist-no')))
					throw new Error('Đối tượng sắp xếp chứa giá trị không hợp lệ!');
				$('[data-div-comboBox_datalist-no="' + object.attr('data-label-comboBox_datalist-no') + '"]').attr('data-div-comboBox_datalist-no', ++order);
				$('[data-button-comboBox_datalist-no="' + object.attr('data-label-comboBox_datalist-no') + '"]').attr('data-button-comboBox_datalist-no', order);
				object.text('Lựa chọn ' + (order < 10 ? ('0' + order) : order) + '.');
				object.attr('data-label-comboBox_datalist-no', order);
			}
		orderRetrieve.val = ++order;
		return true
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
}

/*Show/Hide một số input trên modal thêm thuộc tính*/
function showHideInputModal(inputName)
{
	try
	{
		switch(inputName)
		{
			case 'textBox':
				$('#div__id__required').show();
				$('#div__id__placeholder').show();
				$('#div__id__maxLength').show();
				$('#div__id__minLength').show();

				$('#div__id__max').hide();
				$('#div__id__min').hide();
				$('#div__id__rows').hide();
				$('#div__id__multiple').hide();
				$('#div__id__datetimePicker').hide();
				$('#div__id__radio_checkBox').hide();
				$('#div__id__comboBox_datalist').hide();
				$('#div__id__maxDate').hide();
				$('#div__id__minDate').hide();
				$('#div__id__maxDate_current').hide();
				$('#div__id__minDate_current').hide();
				$('#div__id__numberNoRegex').hide();
				$('#button__id__ok').attr('data-button-controlCategory', 'textBox');
				$('#h5__id__modalTitleThemThuocTinh').text('Thêm các thuộc tính cho Text box');
				break;
			case 'number':
				$('#div__id__required').show();
				$('#div__id__placeholder').show();
				$('#div__id__max').show();
				$('#div__id__min').show();
				$('#div__id__numberNoRegex').show();

				$('#div__id__rows').hide();
				$('#div__id__maxLength').hide();
				$('#div__id__minLength').hide();
				$('#div__id__multiple').hide();
				$('#div__id__datetimePicker').hide();
				$('#div__id__radio_checkBox').hide();
				$('#div__id__comboBox_datalist').hide();
				$('#div__id__maxDate').hide();
				$('#div__id__minDate').hide();
				$('#div__id__maxDate_current').hide();
				$('#div__id__minDate_current').hide();
				$('#button__id__ok').attr('data-button-controlCategory', 'number');
				$('#h5__id__modalTitleThemThuocTinh').text('Thêm các thuộc tính cho Number');
				break;
			case 'textarea':
				$('#div__id__required').show();
				$('#div__id__placeholder').show();
				$('#div__id__maxLength').show();
				$('#div__id__minLength').show();
				$('#div__id__rows').show();

				$('#div__id__max').hide();
				$('#div__id__min').hide();
				$('#div__id__multiple').hide();
				$('#div__id__datetimePicker').hide();
				$('#div__id__radio_checkBox').hide();
				$('#div__id__comboBox_datalist').hide();
				$('#div__id__maxDate').hide();
				$('#div__id__minDate').hide();
				$('#div__id__maxDate_current').hide();
				$('#div__id__minDate_current').hide();
				$('#div__id__numberNoRegex').hide();
				$('#button__id__ok').attr('data-button-controlCategory', 'textarea');
				$('#h5__id__modalTitleThemThuocTinh').text('Thêm các thuộc tính cho Textarea');
				break;
			case 'comboBox':
				$('#div__id__comboBox_datalist').show();

				$('#div__id__placeholder').hide();
				$('#div__id__maxLength').hide();
				$('#div__id__minLength').hide();
				$('#div__id__rows').hide();
				$('#div__id__required').hide();
				$('#div__id__max').hide();
				$('#div__id__min').hide();
				$('#div__id__multiple').hide();
				$('#div__id__datetimePicker').hide();
				$('#div__id__radio_checkBox').hide();
				$('#div__id__maxDate').hide();
				$('#div__id__minDate').hide();
				$('#div__id__maxDate_current').hide();
				$('#div__id__minDate_current').hide();
				$('#div__id__numberNoRegex').hide();
				$('#button__id__ok').attr('data-button-controlCategory', 'comboBox');
				$('#h5__id__modalTitleThemThuocTinh').text('Thêm các thuộc tính cho Combo box');
				break;
			case 'datetimePicker':
				$('#div__id__required').hide();
				$('#div__id__placeholder').hide();
				$('#div__id__maxLength').hide();
				$('#div__id__minLength').hide();
				$('#div__id__rows').hide();
				$('#div__id__max').hide();
				$('#div__id__min').hide();
				$('#div__id__multiple').hide();
				$('#div__id__comboBox_datalist').hide();
				$('#div__id__radio_checkBox').hide();
				$('#div__id__numberNoRegex').hide();

				$('#div__id__maxDate').show();
				$('#div__id__minDate').show();
				$('#div__id__maxDate_current').show();
				$('#div__id__minDate_current').show();
				$('#div__id__datetimePicker').show();
				$('#div__id__modalBodyThemThuocTinh').css('height', '550px');
				$('#button__id__ok').attr('data-button-controlCategory', 'datetimePicker');
				$('#h5__id__modalTitleThemThuocTinh').text('Thêm các thuộc tính cho Datetime picker');
				break;
			case 'datalist':
				$('#div__id__required').show();
				$('#div__id__placeholder').show();
				$('#div__id__maxLength').show();
				$('#div__id__comboBox_datalist').show();

				$('#div__id__rows').hide();
				$('#div__id__minLength').hide();
				$('#div__id__max').hide();
				$('#div__id__min').hide();
				$('#div__id__multiple').hide();
				$('#div__id__datetimePicker').hide();
				$('#div__id__radio_checkBox').hide();
				$('#div__id__maxDate').hide();
				$('#div__id__minDate').hide();
				$('#div__id__maxDate_current').hide();
				$('#div__id__minDate_current').hide();
				$('#div__id__numberNoRegex').hide();

				$('#button__id__ok').attr('data-button-controlCategory', 'datalist');
				$('#h5__id__modalTitleThemThuocTinh').text('Thêm các thuộc tính cho Datalist');
				break;
			case 'checkBox':
				$('#div__id__required').show();
				$('#div__id__radio_checkBox').show();

				$('#div__id__placeholder').hide();
				$('#div__id__maxLength').hide();
				$('#div__id__minLength').hide();
				$('#div__id__rows').hide();
				$('#div__id__max').hide();
				$('#div__id__min').hide();
				$('#div__id__multiple').hide();
				$('#div__id__datetimePicker').hide();
				$('#div__id__comboBox_datalist').hide();
				$('#div__id__maxDate').hide();
				$('#div__id__minDate').hide();
				$('#div__id__maxDate_current').hide();
				$('#div__id__minDate_current').hide();
				$('#div__id__numberNoRegex').hide();

				$('#button__id__ok').attr('data-button-controlCategory', 'checkBox');
				$('#h5__id__modalTitleThemThuocTinh').text('Thêm các thuộc tính cho Check box');
				break;
			case 'radio':
				$('#div__id__radio_checkBox').show();

				$('#div__id__required').hide();
				$('#div__id__comboBox_datalist').hide();
				$('#div__id__placeholder').hide();
				$('#div__id__maxLength').hide();
				$('#div__id__minLength').hide();
				$('#div__id__rows').hide();
				$('#div__id__max').hide();
				$('#div__id__min').hide();
				$('#div__id__multiple').hide();
				$('#div__id__datetimePicker').hide();
				$('#div__id__maxDate').hide();
				$('#div__id__minDate').hide();
				$('#div__id__maxDate_current').hide();
				$('#div__id__minDate_current').hide();
				$('#div__id__numberNoRegex').hide();

				$('#button__id__ok').attr('data-button-controlCategory', 'radio');
				$('#h5__id__modalTitleThemThuocTinh').text('Thêm các thuộc tính cho Radio button');
				break;
			case 'file':
				$('#div__id__required').show();
				$('#div__id__multiple').show();

				$('#div__id__placeholder').hide();
				$('#div__id__maxLength').hide();
				$('#div__id__minLength').hide();
				$('#div__id__rows').hide();
				$('#div__id__max').hide();
				$('#div__id__min').hide();
				$('#div__id__datetimePicker').hide();
				$('#div__id__radio_checkBox').hide();
				$('#div__id__comboBox_datalist').hide();
				$('#div__id__maxDate').hide();
				$('#div__id__minDate').hide();
				$('#div__id__maxDate_current').hide();
				$('#div__id__minDate_current').hide();
				$('#div__id__numberNoRegex').hide();

				$('#button__id__ok').attr('data-button-controlCategory', 'file');
				$('#h5__id__modalTitleThemThuocTinh').text('Thêm các thuộc tính cho control file');
				break;
			default:
				throw new Error('Input đã chọn không được hỗ trợ!');
		}
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
}

/*Format date cho trường ngày giờ trên biểu mẫu*/
function formatFieldDate(order)
{
	try
	{
		var object = $('#datetimePicker__id__toolBox_datetimePicker_' + order);
		if(typeof $('#div__id__datetimePicker_' + order).data('DateTimePicker') !== typeof undefined)
		{
			object.off();
			$('#div__id__datetimePicker_' + order).data('DateTimePicker').destroy();
		}
		if($('#checkBox__id__minDate').prop('checked') && $('#checkBox__id__maxDate').prop('checked'))
		{
			$('#div__id__datetimePicker_' + order).datetimepicker({
				format: $('#select__id__datetimePicker').val(),
    			date: $('#textBox__id__minDate').attr('data-textBox-minDate'),
    			allowInputToggle: true,
    			maxDate: $('#textBox__id__maxDate').attr('data-textBox-maxDate'),
    			minDate: $('#textBox__id__minDate').attr('data-textBox-minDate')
			});
			object.attr('data-textBox-maxDate', $('#textBox__id__maxDate').attr('data-textBox-maxDate'));
			object.attr('data-textBox-minDate', $('#textBox__id__minDate').attr('data-textBox-minDate'));
			if(typeof object.attr('data-textBox-maxDate_current') !== typeof undefined)
				object.removeAttr('data-textBox-maxDate_current');
			if(typeof object.attr('data-textBox-minDate_current') !== typeof undefined)
				object.removeAttr('data-textBox-minDate_current');
		}
		else if($('#checkBox__id__minDate_current').prop('checked') && $('#checkBox__id__maxDate_current').prop('checked'))
		{
			$('#div__id__datetimePicker_' + order).datetimepicker({
				format: $('#select__id__datetimePicker').val(),
    			date: $('#checkBox__id__minDate_current').attr('data-checkBox-minDate_current'),
    			allowInputToggle: true,
    			maxDate: $('#checkBox__id__maxDate_current').attr('data-checkBox-maxDate_current'),
    			minDate: $('#checkBox__id__minDate_current').attr('data-checkBox-minDate_current')
			});
			object.attr('data-textBox-maxDate_current', $('#checkBox__id__maxDate_current').attr('data-checkBox-maxDate_current'));
			object.attr('data-textBox-minDate_current', $('#checkBox__id__minDate_current').attr('data-checkBox-minDate_current'));

			if(typeof object.attr('data-textBox-maxDate') !== typeof undefined)
				object.removeAttr('data-textBox-maxDate');
			if(typeof object.attr('data-textBox-minDate') !== typeof undefined)
				object.removeAttr('data-textBox-minDate');
		}
		else if($('#checkBox__id__minDate').prop('checked') && $('#checkBox__id__maxDate_current').prop('checked'))
		{
			$('#div__id__datetimePicker_' + order).datetimepicker({
				format: $('#select__id__datetimePicker').val(),
    			date: $('#textBox__id__minDate').attr('data-textBox-minDate'),
    			allowInputToggle: true,
    			maxDate: $('#checkBox__id__maxDate_current').attr('data-checkBox-maxDate_current'),
    			minDate: $('#textBox__id__minDate').attr('data-textBox-minDate')
			});
			object.attr('data-textBox-maxDate_current', $('#checkBox__id__maxDate_current').attr('data-checkBox-maxDate_current'));
			object.attr('data-textBox-minDate', $('#textBox__id__minDate').attr('data-textBox-minDate'));
			if(typeof object.attr('data-textBox-maxDate') !== typeof undefined)
				object.removeAttr('data-textBox-maxDate');
			if(typeof object.attr('data-textBox-minDate_current') !== typeof undefined)
				object.removeAttr('data-textBox-minDate_current');
		}
		else if($('#checkBox__id__minDate_current').prop('checked') && $('#checkBox__id__maxDate').prop('checked'))
		{
			$('#div__id__datetimePicker_' + order).datetimepicker({
				format: $('#select__id__datetimePicker').val(),
    			date: $('#checkBox__id__minDate_current').attr('data-checkBox-minDate_current'),
    			allowInputToggle: true,
    			maxDate: $('#textBox__id__maxDate').attr('data-textBox-maxDate'),
    			minDate: $('#checkBox__id__minDate_current').attr('data-checkBox-minDate_current')
			});
			object.attr('data-textBox-maxDate', $('#textBox__id__maxDate').attr('data-textBox-maxDate'));
			object.attr('data-textBox-minDate_current', $('#checkBox__id__minDate_current').attr('data-checkBox-minDate_current'));
			if(typeof object.attr('data-textBox-maxDate_current') !== typeof undefined)
				object.removeAttr('data-textBox-maxDate_current');
			if(typeof object.attr('data-textBox-minDate') !== typeof undefined)
				object.removeAttr('data-textBox-minDate');
		}
		else if($('#checkBox__id__minDate').prop('checked'))
		{
			$('#div__id__datetimePicker_' + order).datetimepicker({
				format: $('#select__id__datetimePicker').val(),
    			date: $('#textBox__id__minDate').attr('data-textBox-minDate'),
    			allowInputToggle: true,
    			minDate: $('#textBox__id__minDate').attr('data-textBox-minDate')
			});
			object.attr('data-textBox-minDate', $('#textBox__id__minDate').attr('data-textBox-minDate'));
			if(typeof object.attr('data-textBox-minDate_current') !== typeof undefined)
				object.removeAttr('data-textBox-minDate_current');
			if(typeof object.attr('data-textBox-maxDate_current') !== typeof undefined)
				object.removeAttr('data-textBox-maxDate_current');
			if(typeof object.attr('data-textBox-maxDate') !== typeof undefined)
				object.removeAttr('data-textBox-maxDate');
		}
		else if($('#checkBox__id__maxDate').prop('checked'))
		{
			$('#div__id__datetimePicker_' + order).datetimepicker({
				format: $('#select__id__datetimePicker').val(),
    			date: $('#textBox__id__maxDate').attr('data-textBox-maxDate'),
    			allowInputToggle: true,
    			maxDate: $('#textBox__id__maxDate').attr('data-textBox-maxDate')
			});
			object.attr('data-textBox-maxDate', $('#textBox__id__maxDate').attr('data-textBox-maxDate'));
			if(typeof object.attr('data-textBox-maxDate_current') !== typeof undefined)
				object.removeAttr('data-textBox-maxDate_current');
			if(typeof object.attr('data-textBox-minDate_current') !== typeof undefined)
				object.removeAttr('data-textBox-minDate_current');
			if(typeof object.attr('data-textBox-minDate') !== typeof undefined)
				object.removeAttr('data-textBox-minDate');
		}
		else if($('#checkBox__id__minDate_current').prop('checked'))
		{
			$('#div__id__datetimePicker_' + order).datetimepicker({
				format: $('#select__id__datetimePicker').val(),
    			date: $('#checkBox__id__minDate_current').attr('data-checkBox-minDate_current'),
    			allowInputToggle: true,
    			minDate: $('#checkBox__id__minDate_current').attr('data-checkBox-minDate_current')
			});
			object.attr('data-textBox-minDate_current', new Date());
			if(typeof object.attr('data-textBox-minDate') !== typeof undefined)
				object.removeAttr('data-textBox-minDate');
			if(typeof object.attr('data-textBox-maxDate_current') !== typeof undefined)
				object.removeAttr('data-textBox-maxDate_current');
			if(typeof object.attr('data-textBox-maxDate') !== typeof undefined)
				object.removeAttr('data-textBox-maxDate');
		}
		else if($('#checkBox__id__maxDate_current').prop('checked'))
		{
			$('#div__id__datetimePicker_' + order).datetimepicker({
				format: $('#select__id__datetimePicker').val(),
    			date: $('#checkBox__id__maxDate_current').attr('data-checkBox-maxDate_current'),
    			allowInputToggle: true,
    			maxDate: $('#checkBox__id__maxDate_current').attr('data-checkBox-maxDate_current')
			});
			object.attr('data-textBox-maxDate_current', new Date());
			if(typeof object.attr('data-textBox-maxDate') !== typeof undefined)
				object.removeAttr('data-textBox-maxDate');
			if(typeof object.attr('data-textBox-minDate_current') !== typeof undefined)
				object.removeAttr('data-textBox-minDate_current');
			if(typeof object.attr('data-textBox-minDate') !== typeof undefined)
				object.removeAttr('data-textBox-minDate');
		}
		else
		{
			$('#div__id__datetimePicker_' + order).datetimepicker({
				format: $('#select__id__datetimePicker').val(),
    			date: new Date(),
    			allowInputToggle: true
			});

			if(typeof object.attr('data-textBox-maxDate_current') !== typeof undefined)
				object.removeAttr('data-textBox-maxDate_current');
			if(typeof object.attr('data-textBox-minDate_current') !== typeof undefined)
				object.removeAttr('data-textBox-minDate_current');
			if(typeof object.attr('data-textBox-maxDate') !== typeof undefined)
				object.removeAttr('data-textBox-maxDate');
			if(typeof object.attr('data-textBox-minDate') !== typeof undefined)
				object.removeAttr('data-textBox-minDate');
		}
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
}

/*Khởi tạo datetimepicker trên modal thêm thuộc tính input*/
function initialDateTimPicker(_format, __date, flagOrder)
{
	try
	{
		var _ddate = __date;
		if(!flagOrder)
		{
			$('#div__id__datetimePicker_maxDate').datetimepicker({
				format: _format,
				date: _ddate[0],
				allowInputToggle: true,
				widgetPositioning: {horizontal:'auto',vertical:'bottom'}
			});

			$('#div__id__datetimePicker_minDate').datetimepicker({
				format: _format,
				date: _ddate[1],
				allowInputToggle: true,
				widgetPositioning: {horizontal:'auto',vertical:'bottom'}
			});
			$('#textBox__id__maxDate').attr('data-textBox-maxDate', _ddate[0].toString());
			$('#textBox__id__minDate').attr('data-textBox-minDate', _ddate[1].toString());
		}
		else
		{
			$('#textBox__id__minDate').off();
			$('#textBox__id__maxDate').off();
			$('#div__id__datetimePicker_minDate').off('dp.change');
			$('#div__id__datetimePicker_maxDate').off('dp.change');
			$('#div__id__datetimePicker_maxDate').data("DateTimePicker").destroy();
			$('#div__id__datetimePicker_minDate').data("DateTimePicker").destroy();
			$('#div__id__datetimePicker_maxDate_current').data("DateTimePicker").destroy();
			$('#div__id__datetimePicker_minDate_current').data("DateTimePicker").destroy();

			$('#div__id__datetimePicker_maxDate').datetimepicker({
				format: _format,
				date: _ddate[0],
				allowInputToggle: true,
				widgetPositioning: {horizontal:'auto',vertical:'bottom'}
			});

			$('#div__id__datetimePicker_minDate').datetimepicker({
				format: _format,
				date: _ddate[1],
				allowInputToggle: true,
				widgetPositioning: {horizontal:'auto',vertical:'bottom'}
			});

			/*Rebind events of textBox__id__maxDate*/
			$('#textBox__id__maxDate').bind('mousedown', function(){
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
	        
	        $('#textBox__id__maxDate').bind('mouseout', function(){
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

	        /*Rebind events of textBox__id__minDate*/
	        $('#textBox__id__minDate').bind('mousedown', function(){
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
	        
	        $('#textBox__id__minDate').bind('mouseout', function(){
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
		_ddate = new Date();
		$('#div__id__datetimePicker_maxDate_current').datetimepicker({
			format: _format,
			date: _ddate
		});

		$('#div__id__datetimePicker_minDate_current').datetimepicker({
			format: _format,
			date: _ddate
		});

		$('#checkBox__id__minDate_current').attr('data-checkBox-minDate_current', _ddate);
		$('#checkBox__id__maxDate_current').attr('data-checkBox-maxDate_current', _ddate);

		/*Sự kiện thay đổi ngày giờ trên trường ngày giờ nhỏ nhất - modal thêm thuộc tính trường biểu mẫu*/
		$('#div__id__datetimePicker_minDate').on('dp.change', function(e, _date){
			try
			{
				minDateChange(e, _date);
				return true;
			}
			catch(err)
			{
				alert('Lỗi: ' + err.stack + '!');
				return false;
			}
		});

		/*Sự kiện thay đổi ngày giờ trên trường ngày giờ lớn nhất - modal thêm thuộc tính trường biểu mẫu*/
		$('#div__id__datetimePicker_maxDate').on('dp.change', function(e, _date){
			try
			{
				maxDateChange(e, _date);
				return true;
			}
			catch(err)
			{
				alert('Lỗi: ' + err.stack + '!');
				return false;
			}
		});

		$('#div__id__datetimePicker_minDate').trigger('dp.change', $('#textBox__id__minDate').attr('data-textBox-minDate'));
		$('#div__id__datetimePicker_maxDate').trigger('dp.change', $('#textBox__id__maxDate').attr('data-textBox-maxDate'));
		$('#checkBox__id__minDate_current').trigger('change', _ddate);
		$('#checkBox__id__maxDate_current').trigger('change', _ddate);
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
	
}

/*Khởi tạo sự kiện dp.change trên đối tượng chọn ngày giờ nhỏ nhất*/
function minDateChange(e, _date)
{
	try
	{
		var __date = e.date;
		if(typeof _date !== typeof undefined && _date)
			__date = new Date(_date);
		$('#textBox__id__minDate').attr('data-textBox-minDate', __date.toString());
		$('#textBox__id__minDate').attr('data-textBox-date', __date.toString());
		$('#div__id__datetimePicker_maxDate').data('DateTimePicker').minDate(__date);
		if($('#checkBox__id__maxDate').prop('checked'))
			if(new Date($('#textBox__id__maxDate').attr('data-textBox-maxDate')) < new Date($('#textBox__id__minDate').attr('data-textBox-minDate')))
				$('#div__id__datetimePicker_maxDate').data('DateTimePicker').date(__date);

		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
}

/*Khởi tạo sự kiện dp.change trên đối tượng chọn ngày giờ lớn nhất*/
function maxDateChange(e, _date)
{
	try
	{
		var __date = e.date;
		if(typeof _date !== typeof undefined && _date)
			__date = new Date(_date);
		$('#textBox__id__maxDate').attr('data-textBox-maxDate', __date.toString());
		$('#textBox__id__maxDate').attr('data-textBox-date', __date.toString());
		$('#div__id__datetimePicker_minDate').data('DateTimePicker').maxDate(__date);
		if($('#checkBox__id__minDate').prop('checked'))
			if(new Date($('#textBox__id__maxDate').attr('data-textBox-maxDate')) < new Date($('#textBox__id__minDate').attr('data-textBox-minDate')))
				$('#div__id__datetimePicker_minDate').data('DateTimePicker').date(__date);
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
}
</script>