<script>
$(function(){
	try
	{
		if($('#div__id__noiDungBMXML').length)
		{
			/*click nút đổi trường đã thêm trên biểu mẫu*/
			$('#div__id__noiDungBMXML').on('click', '[id*="button__id__doiTruong_"]', function(){
				try
				{
					var objectTextBoxTruong = $('#textBox__id__tenTruongBieuMau_' + $(this).attr('data-button-inputNo'));
					var objectLabelTruong = $('#label__id__tenTruongBieuMau_' + $(this).attr('data-button-inputNo'));
					var objectControl = $('#' + $(this).attr('data-button-controlId') + $(this).attr('data-button-inputNo'));

					if($(this).attr('data-button-command') === 'doi')
					{
						if(objectTextBoxTruong.length && objectLabelTruong.length)
						{
							objectTextBoxTruong.val(objectLabelTruong.text());
							objectTextBoxTruong.show();
							objectLabelTruong.hide();
						}
						
						$($(this).children()[0]).attr('class', 'glyphicon glyphicon-ok');
						$(this).attr('data-original-title', 'Cập nhật');
						$(this).tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						$('#button__id__suaTruong_' + $(this).attr('data-button-inputNo')).hide();
						$(this).attr('data-button-command', "capnhat");
						$('#button__id__xoaTruong_' + $(this).attr('data-button-inputNo')).attr('data-button-commandDestroy', 'doi');
						$('#button__id__xoaTruong_' + $(this).attr('data-button-inputNo')).attr('data-button-command', 'huy');
						$('#button__id__xoaTruong_' + $(this).attr('data-button-inputNo')).attr('data-original-title', 'Huỷ');
						$('#div__id__controlArea_' + $(this).attr('data-button-inputNo')).addClass('text-center');
						$('#div__id__toolBox_' + $(this).attr('data-button-inputNo')).show();
						objectControl.hide();
						if($('#' + $(this).attr('data-button-controlLabelId') + $(this).attr('data-button-inputNo')).length)
							$('#' + $(this).attr('data-button-controlLabelId') + $(this).attr('data-button-inputNo')).hide();
						switch(objectControl.attr('data-input-name'))
						{
							case 'textbox':
								validator.unmark(objectControl);
								objectControl = $('#radio__id__toolBox_textBox_' + $(this).attr('data-button-inputNo'));
								objectControl.prop('checked', true);
								objectControl.parent().addClass('active');
								$(this).attr('data-button-controlName', 'radio__id__toolBox_textBox_' + $(this).attr('data-button-inputNo'));
								break;
							case 'number':
								validator.unmark(objectControl);
								objectControl = $('#radio__id__toolBox_number_' + $(this).attr('data-button-inputNo'));
								objectControl.prop('checked', true);
								objectControl.parent().addClass('active');
								$(this).attr('data-button-controlName', 'radio__id__toolBox_number_' + $(this).attr('data-button-inputNo'));
								break;
							case 'textarea':
								validator.unmark(objectControl);
								objectControl = $('#radio__id__toolBox_textarea_' + $(this).attr('data-button-inputNo'));
								objectControl.prop('checked', true);
								objectControl.parent().addClass('active');
								$(this).attr('data-button-controlName', 'radio__id__toolBox_textarea_' + $(this).attr('data-button-inputNo'));
								break;
							case 'combobox':
								objectControl = $('#radio__id__toolBox_comboBox_' + $(this).attr('data-button-inputNo'));
								objectControl.prop('checked', true);
								objectControl.parent().addClass('active');
								$(this).attr('data-button-controlName', 'radio__id__toolBox_comboBox_' + $(this).attr('data-button-inputNo'));
								break;
							case 'datetimepicker':
								objectControl = $('#radio__id__toolBox_datetimePicker_' + $(this).attr('data-button-inputNo'));
								objectControl.prop('checked', true);
								objectControl.parent().addClass('active');
								$(this).attr('data-button-controlName', 'radio__id__toolBox_datetimePicker_' + $(this).attr('data-button-inputNo'));
								break;
							case 'datalist':
								validator.unmark(objectControl);
								objectControl = $('#radio__id__toolBox_datalist_' + $(this).attr('data-button-inputNo'));
								objectControl.prop('checked', true);
								objectControl.parent().addClass('active');
								$(this).attr('data-button-controlName', 'radio__id__toolBox_datalist_' + $(this).attr('data-button-inputNo'));
								break;
							case 'checkbox':
								validator.unmark(objectControl);
								objectControl = $('#radio__id__toolBox_checkBox_' + $(this).attr('data-button-inputNo'));
								objectControl.prop('checked', true);
								objectControl.parent().addClass('active');
								$(this).attr('data-button-controlName', 'radio__id__toolBox_checkBox_' + $(this).attr('data-button-inputNo'));
								break;
							case 'radio':
								objectControl = $('#radio__id__toolBox_controlRadio_' + $(this).attr('data-button-inputNo'));
								objectControl.prop('checked', true);
								objectControl.parent().addClass('active');
								$(this).attr('data-button-controlName', 'radio__id__toolBox_controlRadio_' + $(this).attr('data-button-inputNo'));
								break;
							case 'file':
								validator.unmark(objectControl);
								objectControl = $('#radio__id__toolBox_file_' + $(this).attr('data-button-inputNo'));
								objectControl.prop('checked', true);
								objectControl.parent().addClass('active');
								$(this).attr('data-button-controlName', 'radio__id__toolBox_file_' + $(this).attr('data-button-inputNo'));
								break;
							default:
								throw new Error('Input đã chọn không được hỗ trợ!');
						}
					}
					/*click nút cập nhật sau khi chọn cập nhật hoặc đổi trường biểu mẫu*/
					else
					{
						$('#button__id__themTruong').removeAttr('data-target');
						$('#button__id__themTruong').trigger('click', [$(this).attr('data-button-inputNo'), $(this).attr('data-button-controlName'), $(this).attr('data-button-controlId') + $(this).attr('data-button-inputNo')]);
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