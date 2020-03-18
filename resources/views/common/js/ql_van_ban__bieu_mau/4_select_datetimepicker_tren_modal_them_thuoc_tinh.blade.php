<script>
$(function(){
	try
	{
		/*Sự kiện thay đổi lựa chọn định dạng ngày giờ trên modal thêm thuộc tính sẽ quy định format date trên input ngày giờ nhỏ nhất và ngày giờ lớn nhất*/
		if($('#select__id__datetimePicker').length)
			$('#select__id__datetimePicker').on('change', function(e, flagCallBack){
				try
				{
					var _ddate = [new Date(), new Date()];

					if(typeof $('#div__id__datetimePicker_maxDate').data("DateTimePicker") === typeof undefined && typeof $('#div__id__datetimePicker_minDate').data("DateTimePicker") === typeof undefined)
					{
						/*Mở modal để sửa trường*/
						if(typeof flagCallBack !== typeof undefined && flagCallBack)
						{
							if($('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-minDate') !== typeof undefined && $('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-minDate'))
							{
								_ddate[1] = $('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-minDate');
							}
							if($('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-maxDate') !== typeof undefined && $('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-maxDate'))
							{
								_ddate[0] =  $('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-maxDate');
							}
						}
						if(!initialDateTimPicker($(this).val(), _ddate, false))
							return false;
					}
					else
					{
						if(typeof flagCallBack !== typeof undefined && flagCallBack)
						{
							if($('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-minDate') !== typeof undefined && $('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-minDate'))
							{
								$('#textBox__id__minDate').attr('data-textBox-date', $('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-minDate'));
								$('#textBox__id__minDate').attr('data-textBox-minDate', $('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-minDate'));
							}
							if($('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-maxDate') !== typeof undefined && $('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-maxDate'))
							{
								$('#textBox__id__maxDate').attr('data-textBox-date', $('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-maxDate'));
								$('#textBox__id__maxDate').attr('data-textBox-maxDate', $('#datetimePicker__id__toolBox_datetimePicker_' + flagCallBack).attr('data-textBox-maxDate'));
							}
						}
						if(typeof $('#textBox__id__maxDate').attr('data-textBox-date') !== typeof undefined && $('#textBox__id__maxDate').attr('data-textBox-date'))
							_ddate[0] = $('#textBox__id__maxDate').attr('data-textBox-date');
						else
							_ddate[0] = $('#textBox__id__maxDate').attr('data-textBox-maxDate');

						if(typeof $('#textBox__id__minDate').attr('data-textBox-date') !== typeof undefined && $('#textBox__id__minDate').attr('data-textBox-date'))
							_ddate[1] = $('#textBox__id__minDate').attr('data-textBox-date');
						else
							_ddate[1] = $('#textBox__id__minDate').attr('data-textBox-minDate');

						if(!initialDateTimPicker($(this).val(), _ddate, true))
							return false;	
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>