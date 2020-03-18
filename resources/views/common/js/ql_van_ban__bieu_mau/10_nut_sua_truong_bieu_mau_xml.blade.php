<script>
$(function(){
	try
	{
		if($('#div__id__noiDungBMXML').length)
		{
			/*click nút sửa trường đã thêm vào biểu mẫu*/
			$('#div__id__noiDungBMXML').on('click', '[id*="button__id__suaTruong_"]', function(){
				try
				{
					var object = null;
					var options = '';
					var order = 0;
					var objectTextBoxTruong = $('#textBox__id__tenTruongBieuMau_' + $(this).attr('data-button-inputNo'));
					var objectLabelTruong = $('#label__id__tenTruongBieuMau_' + $(this).attr('data-button-inputNo'));
					if($(this).attr('data-button-command') === 'sua')
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
						if($('#button__id__doiTruong_' + $(this).attr('data-button-inputNo')).length)
							$('#button__id__doiTruong_' + $(this).attr('data-button-inputNo')).hide();
						$(this).attr('data-button-command', 'capnhat');
						$('#button__id__xoaTruong_' + $(this).attr('data-button-inputNo')).attr('data-button-commandDestroy', 'sua');
						$('#button__id__xoaTruong_' + $(this).attr('data-button-inputNo')).attr('data-button-command', 'huy');
						$('#button__id__xoaTruong_' + $(this).attr('data-button-inputNo')).attr('data-original-title', 'Huỷ');
					}
					/*click nút cập nhật sau khi chọn cập nhật hoặc đổi trường biểu mẫu*/
					else
					{
						$('#div__id__modalBodyThemThuocTinh').css('height', '');
		            	$('[data-input-clearCheck]').prop('checked', false);
						$('[data-input-clearText]').val('');
						if($('[data-div-fielddeleted]').length)
							$('[data-div-fielddeleted]').remove();
						$('#select__id__datetimePicker').val('DD/MM/YYYY hh:mm:ss A');
						$('#select__id__datetimePicker').trigger('change');
						if(typeof $('#button__id__ok').attr('data-dismiss') !== typeof undefined)
							$('#button__id__ok').removeAttr('data-dismiss');
						if(typeof $('#button__id__ok').attr('data-button-controlName') !== typeof undefined)
							$('#button__id__ok').removeAttr('data-button-controlName');
						if(typeof $('#button__id__ok').attr('data-button-changeControl') !== typeof undefined)
							$('#button__id__ok').removeAttr('data-button-changeControl');
						if(typeof $('#button__id__ok').attr('data-button-controlReplaced') !== typeof undefined)
							$('#button__id__ok').removeAttr('data-button-controlReplaced');
						if($('#textBox__id__tenTruongBieuMau_' + $(this).attr('data-button-inputNo')).length)
							if(!$('#textBox__id__tenTruongBieuMau_' + $(this).attr('data-button-inputNo')).val().trim())
							{
								throw new Error('Tên trường biểu mẫu không được rỗng!');
							}

						switch($(this).parent().attr('data-div-controlName'))
						{
							case 'textBox':
								object = $('#textBox__id__toolBox_textBox_' + $(this).attr('data-button-inputNo'));
								if(typeof object.attr('required') !== typeof undefined)
									$('#checkBox__id__required').prop('checked', true);
								if(typeof object.attr('placeholder') !== typeof undefined && object.attr('placeholder').trim())
								{
									$('#checkBox__id__placeholder').prop('checked', true);
									$('#textBox__id__placeholder').val(object.attr('placeholder').trim());
								}
								if(typeof object.attr('maxlength') !== typeof undefined && object.attr('maxlength'))
								{
									$('#checkBox__id__maxLength').prop('checked', true);
									$('#number__id__maxLength').val(object.attr('maxlength'));
								}
								if(typeof object.attr('minlength') !== typeof undefined && object.attr('minlength'))
								{
									$('#checkBox__id__minLength').prop('checked', true);
									$('#number__id__minLength').val(object.attr('minlength'));
								}
								if(!showHideInputModal('textBox'))
									return false;
								break;
							case 'number':
								object = $('#number__id__toolBox_number_' + $(this).attr('data-button-inputNo'));
								if(typeof object.attr('required') !== typeof undefined)
									$('#checkBox__id__required').prop('checked', true);
								if(typeof object.attr('data-number-noRegex') !== typeof undefined)
									$('#checkBox__id__numberNoRegex').prop('checked', true);
								if(typeof object.attr('placeholder') !== typeof undefined && object.attr('placeholder').trim())
								{
									$('#checkBox__id__placeholder').prop('checked', true);
									$('#textBox__id__placeholder').val(object.attr('placeholder').trim());
								}
								if(typeof object.attr('max') !== typeof undefined && object.attr('max'))
								{
									$('#checkBox__id__max').prop('checked', true);
									$('#number__id__max').val(object.attr('max'));
								}
								if(typeof object.attr('min') !== typeof undefined && object.attr('min'))
								{
									$('#checkBox__id__min').prop('checked', true);
									$('#number__id__min').val(object.attr('min'));
								}
								if(!showHideInputModal('number'))
									return false;
								break;
							case 'textarea':
								object = $('#textarea__id__toolBox_textarea_' + $(this).attr('data-button-inputNo'));
								if(typeof object.attr('required') !== typeof undefined)
									$('#checkBox__id__required').prop('checked', true);
								if(typeof object.attr('placeholder') !== typeof undefined && object.attr('placeholder').trim())
								{
									$('#checkBox__id__placeholder').prop('checked', true);
									$('#textBox__id__placeholder').val(object.attr('placeholder').trim());
								}
								if(typeof object.attr('maxlength') !== typeof undefined && object.attr('maxlength'))
								{
									$('#checkBox__id__maxLength').prop('checked', true);
									$('#number__id__maxLength').val(object.attr('maxlength'));
								}
								if(typeof object.attr('minlength') !== typeof undefined && object.attr('minlength'))
								{
									$('#checkBox__id__minLength').prop('checked', true);
									$('#number__id__minLength').val(object.attr('minlength'));
								}
								if(typeof object.attr('rows') !== typeof undefined && object.attr('rows'))
								{
									$('#checkBox__id__rows').prop('checked', true);
									$('#number__id__rows').val(object.attr('rows'));
								}
								if(!showHideInputModal('textarea'))
									return false;
								break;
							case 'comboBox':
								object = $('#comboBox__id__toolBox_comboBox_' + $(this).attr('data-button-inputNo'));
								object.children().each(function(){
									order = $(this).val();
									options += '<div class="row form-group" data-div-comboBox_datalist-no="' + order + '" data-div-fieldDeleted>\
			                			<div class="col-md-1 col-sm-1 col-xs-12">\
			                			</div>\
			                			<div class="col-md-5 col-sm-5 col-xs-12 text-right">\
				                			<label data-label-comboBox_datalist-no="' + order + '"> Lựa chọn ' + (order < 10 ? ('0' + order) : order) + '.</label>\
			                			</div>\
			                			<div class="col-md-5 col-sm-5 col-xs-12">\
			                				<input type="text" class="form-control" data-textBox-id="textBox__data-textBox-id__themLuaChon" value="' + $(this).text() + '" required>\
			                			</div>\
			                			<div class="col-md-1 col-sm-1 col-xs-12">\
			                				<button type="button" class="btn btn-sm btn-danger" data-button-id="button__data-button-id__xoaLuaChon" data-button-comboBox_datalist-no="' + order + '">\
			                					<i class="glyphicon glyphicon-remove"></i>\
			                				</button>\
			                			</div>\
			                		</div>';
								});
								$(options).insertAfter('#div__id__comboBox_datalist');
								if(!showHideInputModal('comboBox'))
									return false;
								break;
							case 'datetimePicker':
								$('#select__id__datetimePicker').val($('#datetimePicker__id__toolBox_datetimePicker_' + $(this).attr('data-button-inputNo')).attr('data-textBox-formatDate'));
								$('#select__id__datetimePicker').trigger('change', $(this).attr('data-button-inputNo'));

								if(typeof $('#datetimePicker__id__toolBox_datetimePicker_' + $(this).attr('data-button-inputNo')).attr('data-textBox-minDate_current') !== typeof undefined)
								{
									$('#checkBox__id__minDate_current').prop('checked', true);
									$('#checkBox__id__minDate_current').trigger('change', $('#datetimePicker__id__toolBox_datetimePicker_' + $(this).attr('data-button-inputNo')).attr('data-textBox-minDate_current'));
								}
								else if(typeof $('#datetimePicker__id__toolBox_datetimePicker_' + $(this).attr('data-button-inputNo')).attr('data-textBox-minDate') !== typeof undefined)
								{
									$('#checkBox__id__minDate').prop('checked', true);
								}

								if(typeof $('#datetimePicker__id__toolBox_datetimePicker_' + $(this).attr('data-button-inputNo')).attr('data-textBox-maxDate_current') !== typeof undefined)
								{
									$('#checkBox__id__maxDate_current').prop('checked', true);
									$('#checkBox__id__maxDate_current').trigger('change', $('#datetimePicker__id__toolBox_datetimePicker_' + $(this).attr('data-button-inputNo')).attr('data-textBox-maxDate_current'));
								}
								else if(typeof $('#datetimePicker__id__toolBox_datetimePicker_' + $(this).attr('data-button-inputNo')).attr('data-textBox-maxDate') !== typeof undefined)
								{
									$('#checkBox__id__maxDate').prop('checked', true);
								}

								if(!showHideInputModal('datetimePicker'))
									return false;
								break;
							case 'datalist':
								object = $('#textBox__id__toolBox_datalist_' + $(this).attr('data-button-inputNo'));
								if(typeof object.attr('required') !== typeof undefined)
									$('#checkBox__id__required').prop('checked', true);
								if(typeof object.attr('placeholder') !== typeof undefined && object.attr('placeholder').trim())
								{
									$('#checkBox__id__placeholder').prop('checked', true);
									$('#textBox__id__placeholder').val(object.attr('placeholder').trim());
								}
								if(typeof object.attr('maxlength') !== typeof undefined && object.attr('maxlength'))
								{
									$('#checkBox__id__maxLength').prop('checked', true);
									$('#number__id__maxLength').val(object.attr('maxlength'));
								}
								object = $('#datalist__id__toolBox_datalist_' + $(this).attr('data-button-inputNo'));
								object.children().each(function(){
									order = $(this).val();
									options += '<div class="row form-group" data-div-comboBox_datalist-no="' + order + '" data-div-fieldDeleted>\
			                			<div class="col-md-1 col-sm-1 col-xs-12">\
			                			</div>\
			                			<div class="col-md-5 col-sm-5 col-xs-12 text-right">\
				                			<label data-label-comboBox_datalist-no="' + order + '"> Lựa chọn ' + (order < 10 ? ('0' + order) : order) + '.</label>\
			                			</div>\
			                			<div class="col-md-5 col-sm-5 col-xs-12">\
			                				<input type="text" class="form-control" data-textBox-id="textBox__data-textBox-id__themLuaChon" value="' + $(this).text() + '" required>\
			                			</div>\
			                			<div class="col-md-1 col-sm-1 col-xs-12">\
			                				<button type="button" class="btn btn-sm btn-danger" data-button-id="button__data-button-id__xoaLuaChon" data-button-comboBox_datalist-no="' + order + '">\
			                					<i class="glyphicon glyphicon-remove"></i>\
			                				</button>\
			                			</div>\
			                		</div>';
								});
								$(options).insertAfter('#div__id__comboBox_datalist');
								if(!showHideInputModal('datalist'))
									return false;
								break;
							case 'checkBox':
								object = $('#checkBox__id__toolBox_checkBox_' + $(this).attr('data-button-inputNo'));
								if(typeof object.attr('required') !== typeof undefined)
									$('#checkBox__id__required').prop('checked', true);
								$('#textBox__id__radio_checkBox').val($('#label__id__checkBoxTiTle_' + $(this).attr('data-button-inputNo')).text());
								if(!showHideInputModal('checkBox'))
									return false;
								break;
							case 'radio':
								$('#textBox__id__radio_checkBox').val($('#label__id__radioTiTle_' + $(this).attr('data-button-inputNo')).text());
								if(!showHideInputModal('radio'))
									return false;
								break;
							case 'file':
								object = $('#file__id__toolBox_file_' + $(this).attr('data-button-inputNo'));
								if(typeof object.attr('required') !== typeof undefined)
									$('#checkBox__id__required').prop('checked', true);
								if(typeof object.attr('multiple') !== typeof undefined)
									$('#checkBox__id__multiple').prop('checked', true);
								if(!showHideInputModal('file'))
									return false;
								break;
							default:
								throw new Error('Input đã chọn không được hỗ trợ!');
						}
						$('#button__id__ok').attr('data-button-updateData', $(this).attr('data-button-inputNo'));
						$(this).attr('data-target','#div__id__modalPropertyInput');
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