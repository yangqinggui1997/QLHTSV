<script>
$(function(){
	try
	{
		/*Click nút thêm trường mới vào form*/
		if($('#button__id__themTruong').length)
			$('#button__id__themTruong').on('click', function(e, _trigger, controlName, controlReplaced){
				try
	            {
	            	var control = null;
	            	if(typeof _trigger === typeof undefined)
	            	{
	            		$('[data-radio-controlKhoiTao]').each(function(){
							if($(this).prop('checked'))
							{
								control = $(this);
								return false; //stop , true if countinue
							}
						});
		            	if(!control)
		            	{
	            			throw new Error('Nhập tên trường và chọn input!');
		            	}
		            	else if(!$('#textBox__id__tenTruongBieuMau').val().trim())
		            	{
	            			if((control.attr('data-radio-controlKhoiTao') !== 'radio__data-radio-controlKhoiTao__toolBox_checkBox' && control.attr('data-radio-controlKhoiTao') !== 'radio__data-radio-controlKhoiTao__toolBox_radio'))
		            		{
		            			throw new Error('Nhập tên trường và chọn input!');
		            		}
		            		else if(typeof $('[data-input-inputNo][data-input-name]') !== typeof undefined)
		            			if((control.attr('data-radio-controlKhoiTao') === 'radio__data-radio-controlKhoiTao__toolBox_checkBox' && $('[data-input-inputNo][data-input-name]').last().attr('data-input-name') !== 'checkbox') || control.attr('data-radio-controlKhoiTao') === 'radio__data-radio-controlKhoiTao__toolBox_radio' && $('[data-input-inputNo][data-input-name]').last().attr('data-input-name') !== 'radio')
		            			{
		            				throw new Error('Nhập tên trường và chọn input!');
		            			}
		            	}
		            	$('#div__id__modalBodyThemThuocTinh').css('height', '');
		            	$('[data-input-clearCheck]').prop('checked', false);
						$('[data-input-clearText]').val('');
						if($('[data-div-fielddeleted]').length)
							$('[data-div-fielddeleted]').remove();
						$('#select__id__datetimePicker').val('DD/MM/YYYY hh:mm:ss A');
						$('#select__id__datetimePicker').trigger('change');
						if(typeof $('#button__id__ok').attr('data-button-updateData') !== typeof undefined)
							$('#button__id__ok').removeAttr('data-button-updateData');
						if(typeof $('#button__id__ok').attr('data-dismiss') !== typeof undefined)
							$('#button__id__ok').removeAttr('data-dismiss');
						if(typeof $('#button__id__ok').attr('data-button-controlName') !== typeof undefined)
							$('#button__id__ok').removeAttr('data-button-controlName');
						if(typeof $('#button__id__ok').attr('data-button-changeControl') !== typeof undefined)
							$('#button__id__ok').removeAttr('data-button-changeControl');
						if(typeof $('#button__id__ok').attr('data-button-controlReplaced') !== typeof undefined)
							$('#button__id__ok').removeAttr('data-button-controlReplaced');
						$('[data-radio-controlKhoiTao]').each(function(){
							if($(this).prop('checked'))
							{
								switch($(this).attr('data-radio-controlKhoiTao'))
								{
									case 'radio__data-radio-controlKhoiTao__toolBox_textBox':
										if(!showHideInputModal('textBox'))
											return false;
										break;
									case 'radio__data-radio-controlKhoiTao__toolBox_number':
										if(!showHideInputModal('number'))
											return false;
										break;
									case 'radio__data-radio-controlKhoiTao__toolBox_textarea':
										if(!showHideInputModal('textarea'))
											return false;
										break;
									case 'radio__data-radio-controlKhoiTao__toolBox_comboBox':
										if(!showHideInputModal('comboBox'))
											return false;
										break;
									case 'radio__data-radio-controlKhoiTao__toolBox_datetimePicker':
										if(!showHideInputModal('datetimePicker'))
											return false;
										break;
									case 'radio__data-radio-controlKhoiTao__toolBox_datalist':
										if(!showHideInputModal('datalist'))
											return false;
										break;
									case 'radio__data-radio-controlKhoiTao__toolBox_checkBox':
										if(!showHideInputModal('checkBox'))
											return false;
										break;
									case 'radio__data-radio-controlKhoiTao__toolBox_radio':
										if(!showHideInputModal('radio'))
											return false;
										break;
									case 'radio__data-radio-controlKhoiTao__toolBox_file':
										if(!showHideInputModal('file'))
											return false;
										break;
									default:
										throw new Error('Input đã chọn không được hỗ trợ!');
								}
								
								$('#button__id__ok').attr('data-button-tenTruongBieuMau', $('#textBox__id__tenTruongBieuMau').val().trim());
								return false;
							}
						});
	            	}
	            	else
	            	{
	            		$('[name*=radio__name__toolBoxBM]').each(function(){
							if($(this).prop('checked'))
							{
								control = $(this);
								return false; //stop , true if countinue
							}
						});
		            	if(!control || !$('#textBox__id__tenTruongBieuMau_' + _trigger).val().trim())
		            	{
	            			throw new Error('Nhập tên trường và chọn input!');
		            	}
		            	$('#div__id__modalBodyThemThuocTinh').css('height', '');
		            	$('[data-input-clearCheck]').prop('checked', false);
						$('[data-input-clearText]').val('');
						if($('[data-div-fielddeleted]').length)
							$('[data-div-fielddeleted]').remove();
						$('#select__id__datetimePicker').val('DD/MM/YYYY hh:mm:ss A');
						$('#select__id__datetimePicker').trigger('change');
						if(typeof $('#button__id__ok').attr('data-button-updateData') !== typeof undefined)
							$('#button__id__ok').removeAttr('data-button-updateData');
						if(typeof $('#button__id__ok').attr('data-dismiss') !== typeof undefined)
							$('#button__id__ok').removeAttr('data-dismiss');
						$('#button__id__ok').attr('data-button-changeControl', _trigger);
						$('#button__id__ok').attr('data-button-controlName', controlName);
						$('#button__id__ok').attr('data-button-controlReplaced', controlReplaced);
						$('[name="radio__name__toolBoxBM_' + _trigger + '"]').each(function(){
							if($(this).prop('checked'))
							{
								switch($(this).attr('id'))
								{
									case 'radio__id__toolBox_textBox_' + _trigger:
										if(!showHideInputModal('textBox'))
											return false;
										break;
									case 'radio__id__toolBox_number_' + _trigger:
										if(!showHideInputModal('number'))
											return false;
										break;
									case 'radio__id__toolBox_textarea_' + _trigger:
										if(!showHideInputModal('textarea'))
											return false;
										break;
									case 'radio__id__toolBox_comboBox_' + _trigger:
										if(!showHideInputModal('comboBox'))
											return false;
										break;
									case 'radio__id__toolBox_datetimePicker_' + _trigger:
										if(!showHideInputModal('datetimePicker'))
											return false;
										break;
									case 'radio__id__toolBox_datalist_' + _trigger:
										if(!showHideInputModal('datalist'))
											return false;
										break;
									case 'radio__id__toolBox_checkBox_' + _trigger:
										if(!showHideInputModal('checkBox'))
											return false;
										break;
									case 'radio__id__toolBox_controlRadio_' + _trigger:
										if(!showHideInputModal('radio'))
											return false;
										break;
									case 'radio__id__toolBox_file_' + _trigger:
										if(!showHideInputModal('file'))
											return false;
										break;
									default:
										throw new Error('Input đã chọn không được hỗ trợ!');
								}
								
								$('#button__id__ok').attr('data-button-tenTruongBieuMau', $('#textBox__id__tenTruongBieuMau_' + _trigger).val().trim());
								return false;
							}
						});
	            	}
	            	
					$(this).attr('data-target','#div__id__modalPropertyInput');
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