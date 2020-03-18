<script>
$(function(){
	try
	{
		/*Click nút ok trên modal thêm thuộc tính cho input*/
		if($('#button__id__ok').length)
			$('#button__id__ok').on('click', function(){
				try
	            {
					var properties = '';
					var inputHtmlContent = '';
					var comboBoxDatalistContent = '';
					var radioCheckBoxTextTitle = '';
					var htmlControlString1 = '';
            		var htmlControlString2 = '';
            		var htmlControlString3 = '';
            		var htmlControlString4 = '';
            		var min = false;
            		var max = false;
            		var i = 0;
            		var object = null;

            		if(typeof this._countInput === typeof undefined || !$('[id*="div__id__truongLuu_"]').length)
            			this._countInput = 0;
					if($('#checkBox__id__required').prop('checked'))
						properties += 'required ';
					if($('#checkBox__id__placeholder').prop('checked'))
						properties += 'placeholder="' + $('#textBox__id__placeholder').val().trim() + '" ';
					if($('#checkBox__id__maxLength').prop('checked'))
					{
						if(!checkStringIsNumber($('#number__id__maxLength').val()))
						{
							throw new Error('Trường nhập số nhận dữ liệu không phải số!');
						}
						properties += 'maxlength="' + $('#number__id__maxLength').val() + '" ';
						maxlength = true;
					}
					if($('#checkBox__id__minLength').prop('checked'))
					{
						if(!checkStringIsNumber($('#number__id__minLength').val()))
						{
							throw new Error('Trường nhập số nhận dữ liệu không phải số!');
						}
						properties += 'minlength="' + $('#number__id__minLength').val() + '" ';
						minlength = true;
					}
					if($('#checkBox__id__min').prop('checked'))
					{
						if(!checkStringIsNumber($('#number__id__min').val()))
						{
							throw new Error('Trường nhập số nhận dữ liệu không phải số!');
						}
						properties += 'min="' + $('#number__id__min').val() + '" ';
						min = true;
					}
					if($('#checkBox__id__max').prop('checked'))
					{
						if(!checkStringIsNumber($('#number__id__max').val()))
						{
							throw new Error('Trường nhập số nhận dữ liệu không phải số!');
						}
						properties += 'max="' + $('#number__id__max').val() + '" ';
						max = true;
					}
					if($('#checkBox__id__multiple').prop('checked'))
					{
						properties += 'multiple ';
					}
					if($('#checkBox__id__rows').prop('checked'))
					{
						if($('#number__id__rows').val().trim() && !checkStringIsNumber($('#number__id__rows').val()))
						{
							throw new Error('Trường nhập số nhận dữ liệu không phải số!');
						}
						properties += 'rows="' + $('#number__id__rows').val() + '" ';
					}

					if($('#checkBox__id__minDate').prop('checked'))
					{
						if(!$('#textBox__id__minDate').val().trim())
						{
							throw new Error('Trường ngày giờ nhỏ nhất rỗng! Có thể bỏ chọn trường này.');
						}
					}
					if($('#checkBox__id__maxDate').prop('checked'))
					{
						if(!$('#textBox__id__maxDate').val().trim())
						{
							throw new Error('Trường ngày giờ lớn nhất rỗng! Có thể bỏ chọn trường này.');
						}
					}

					if(min && max)
						properties += 'data-validate-minmax="' + $('#number__id__min').val() + ',' + $('#number__id__max').val() + '"';
					else if(min)
						properties += 'data-validate-minmax="' + $('#number__id__min').val() + '"';
					else if(max)
						properties += 'data-validate-minmax="' + $('#number__id__max').val() + ',' + $('#number__id__max').val() + '"';

					if(typeof $(this).attr('data-button-updateData') === typeof undefined)
					{
						htmlControlString1 = '\n\t\t<div class="item form-group" id="div__id__truongLuu_' + this._countInput + '" data-div-inputNo="' + this._countInput + '" data-div-hoverShowButton data-div-luu="control">\n\t\t<div class="col-md-3 col-sm-3 col-xs-12 text-right">\n\t\t<input type="text" class="form-control" data-input-controlDeleted id="textBox__id__tenTruongBieuMau_' + this._countInput + '" data-input-inputNo="' + this._countInput + '" placeholder="Tiêu đề trường nhập" style="display: none;" required>\n\t\t<label class="control-label" id="label__id__tenTruongBieuMau_' + this._countInput + '" data-label-inputNo="' + this._countInput + '">' + $(this).attr('data-button-tenTruongBieuMau') + '</label>\n\t\t</div>\n\t\t<div class="col-md-6 col-sm-6 col-xs-12" id="div__id__controlArea_' + this._countInput + '" data-div-inputNo="' + this._countInput + '">';

						htmlControlString2 = '\n\t\t<div class="btn-group" data-toggle="buttons" id="div__id__toolBox_' + this._countInput + '" data-div-controlDeleted style="display: none;">\n\t\t<label class="btn btn-default" data-toggle="tooltip" data-original-title="Text box" data-label-id="label__data-label-id__toolBoxBM_' + this._countInput + '">\n\t\t<input type="radio" name="radio__name__toolBoxBM_' + this._countInput + '" id="radio__id__toolBox_textBox_' + this._countInput + '" data-input-inputNo="' + this._countInput + '">\n\t\t<i class="fa fa-edit"></i>\n\t\t</label>\n\t\t<label class="btn btn-default" data-toggle="tooltip" data-original-title="Number" data-label-id="label__data-label-id__toolBoxBM_' + this._countInput + '"">\n\t\t<input type="radio" name="radio__name__toolBoxBM_' + this._countInput + '" id="radio__id__toolBox_number_' + this._countInput + '" data-input-inputNo="' + this._countInput + '">\n\t\t<i class="glyphicon glyphicon-sound-7-1"></i>\n\t\t</label>\n\t\t<label class="btn btn-default" data-toggle="tooltip" data-original-title="Text box multiline" data-label-id="label__data-label-id__toolBoxBM_' + this._countInput + '">\n\t\t<input type="radio" name="radio__name__toolBoxBM_' + this._countInput + '" id="radio__id__toolBox_textarea_' + this._countInput + '" data-input-inputNo="' + this._countInput + '">\n\t\t<i class="fa  fa-align-justify"></i>\n\t\t</label>\n\t\t<label class="btn btn-default" data-toggle="tooltip" data-original-title="Combo box" data-label-id="label__data-label-id__toolBoxBM_' + this._countInput + '">\n\t\t<input type="radio" name="radio__name__toolBoxBM_' + this._countInput + '" id="radio__id__toolBox_comboBox_' + this._countInput + '" data-input-inputNo="' + this._countInput + '">\n\t\t<i class="fa fa-toggle-down"></i>\n\t\t</label>\n\t\t<label class="btn btn-default" data-toggle="tooltip" data-original-title="Datetime picker" data-label-id="label__data-label-id__toolBoxBM_' + this._countInput + '">\n\t\t<input type="radio" name="radio__name__toolBoxBM_' + this._countInput + '" id="radio__id__toolBox_datetimePicker_' + this._countInput + '" data-input-inputNo="' + this._countInput + '">\n\t\t<i class="glyphicon glyphicon-calendar"></i>\n\t\t</label>\n\t\t<label class="btn btn-default" data-toggle="tooltip" data-original-title="Datalist" data-label-id="label__data-label-id__toolBoxBM_' + this._countInput + '">\n\t\t<input type="radio" name="radio__name__toolBoxBM_' + this._countInput + '" id="radio__id__toolBox_datalist_' + this._countInput + '" data-input-inputNo="' + this._countInput + '">\n\t\t<i class="fa fa-list-ul"></i>\n\t\t</label>\n\t\t<label class="btn btn-default" data-toggle="tooltip" data-original-title="Check box" data-label-id="label__data-label-id__toolBoxBM_' + this._countInput + '">\n\t\t<input type="radio" name="radio__name__toolBoxBM_' + this._countInput + '" id="radio__id__toolBox_checkBox_' + this._countInput + '" data-input-inputNo="' + this._countInput + '">\n\t\t<i class="fa fa-check-square-o"></i>\n\t\t</label>\n\t\t<label class="btn btn-default" data-toggle="tooltip" data-original-title="Radio button" data-label-id="label__data-label-id__toolBoxBM_' + this._countInput + '">\n\t\t<input type="radio" name="radio__name__toolBoxBM_' + this._countInput + '" id="radio__id__toolBox_controlRadio_' + this._countInput + '" data-input-inputNo="' + this._countInput + '">\n\t\t<i class="fa fa-dot-circle-o"></i>\n\t\t</label>\n\t\t<label class="btn btn-default" data-toggle="tooltip" data-original-title="Up files" data-label-id="label__data-label-id__toolBoxBM_' + this._countInput + '">\n\t\t<input type="radio" name="radio__name__toolBoxBM_' + this._countInput + '" id="radio__id__toolBox_file_' + this._countInput + '" data-input-inputNo="' + this._countInput + '">\n\t\t<i class="fa fa-cloud-upload"></i>\n\t\t</label>\n\t\t</div>\n\t\t</div><div class="col-md-3 col-sm-3 col-xs-12">\n\t\t<div class="btn-group" id="div__id__controlButtonArea_' + this._countInput + '" data-div-inputNo="' + this._countInput + '" data-div-controlDeleted data-div-controlName="';
						            		/*insert control name*/
	            		htmlControlString3 = '">\n\t\t<button type="button" class="btn btn-sm btn-success" data-toggle="modal" rel="tooltip" data-original-title="Sửa trường này" id="button__id__suaTruong_' + this._countInput + '" data-button-command="sua" data-button-inputNo="' + this._countInput + '">\n\t\t<i class="fa fa-edit"></i>\n\t\t</button>\n\t\t<button type="button" class="btn btn-sm btn-info" data-toggle="modal" rel="tooltip" data-original-title="Đổi trường khác" id="button__id__doiTruong_' + this._countInput + '" data-button-command="doi" data-button-inputNo="' + this._countInput + '" data-button-controlId="';
								              	/*Insert control id*/
		              	htmlControlString4='>\n\t\t<i class="fa fa-exchange"></i>\n\t\t</button>\n\t\t<button type="button" class="btn btn-sm btn-danger" rel="tooltip" data-original-title="Xoá trường này"  id="button__id__xoaTruong_' + this._countInput + '" data-button-command="xoa" data-button-inputNo="' + this._countInput + '">\n\t\t<i class="glyphicon glyphicon-remove"></i>\n\t\t</button>\n\t\t</div>\n\t\t</div>\n\t\t</div>';
						switch($(this).attr('data-button-controlCategory'))
						{
							case 'textBox':
								if(typeof $(this).attr('data-button-changeControl') === typeof undefined)
									inputHtmlContent = htmlControlString1 + '\n\t\t<input type="text" class="form-control col-md-7 col-xs-12" id="textBox__id__toolBox_textBox_' + this._countInput + '" data-input-name="textbox" data-input-inputNo="' + this._countInput + '" ' + properties + '>' + htmlControlString2 + 'textBox' + htmlControlString3 + 'textBox__id__toolBox_textBox_"' + htmlControlString4;
								else
								{
									i = $(this).attr('data-button-changeControl');
									inputHtmlContent = '<input type="text" class="form-control col-md-7 col-xs-12" id="textBox__id__toolBox_textBox_' + i + '" data-input-name="textbox" data-input-inputNo="' + i + '" ' + properties + '>';
									$('#div__id__controlButtonArea_' + $(this).attr('data-button-changeControl')).attr('data-div-controlName', 'textBox');
									$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlId', 'textBox__id__toolBox_textBox_');
									if(typeof $('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlLabelId') !== typeof undefined)
										$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).removeAttr('data-button-controlLabelId');
								}
								break;
							case 'number':
								if(typeof $(this).attr('data-button-changeControl') === typeof undefined)
								{
									if($('#checkBox__id__numberNoRegex').prop('checked'))
										inputHtmlContent = htmlControlString1 + '\n\t\t<input type="number" class="form-control col-md-7 col-xs-12" id="number__id__toolBox_number_' + this._countInput + '" data-input-name="number" data-number-noRegex data-input-inputNo="' + this._countInput + '" ' + properties + '>' + htmlControlString2 + 'number' + htmlControlString3 + 'number__id__toolBox_number_"' + htmlControlString4;
									else
										inputHtmlContent = htmlControlString1 + '\n\t\t<input type="number" class="form-control col-md-7 col-xs-12" id="number__id__toolBox_number_' + this._countInput + '" data-input-name="number" data-input-inputNo="' + this._countInput + '" ' + properties + '>' + htmlControlString2 + 'number' + htmlControlString3 + 'number__id__toolBox_number_"' + htmlControlString4;
								}
								else
								{
									i = $(this).attr('data-button-changeControl');
									if($('#checkBox__id__numberNoRegex').prop('checked'))
										inputHtmlContent = '<input type="number" class="form-control col-md-7 col-xs-12" id="number__id__toolBox_number_' + i + '" data-number-noRegex data-input-name="number" data-input-inputNo="' + i + '" ' + properties + '>';
									else
										inputHtmlContent = '<input type="number" class="form-control col-md-7 col-xs-12" id="number__id__toolBox_number_' + i + '" data-input-name="number" data-input-inputNo="' + i + '" ' + properties + '>';
									$('#div__id__controlButtonArea_' + $(this).attr('data-button-changeControl')).attr('data-div-controlName', 'number');
									$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlId', 'number__id__toolBox_number_');
									if(typeof $('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlLabelId') !== typeof undefined)
										$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).removeAttr('data-button-controlLabelId');
								}
								break;
							case 'textarea':
								if(typeof $(this).attr('data-button-changeControl') === typeof undefined)
									inputHtmlContent = htmlControlString1 + '\n\t\t<textarea class="form-control col-md-7 col-xs-12" id="textarea__id__toolBox_textarea_' + this._countInput + '" data-input-name="textarea" data-input-inputNo="' + this._countInput + '" ' + properties + '>\n\t\t' + '</textarea>' + htmlControlString2 + 'textarea' + htmlControlString3 + 'textarea__id__toolBox_textarea_"' + htmlControlString4;
								else
								{
									i = $(this).attr('data-button-changeControl');
									inputHtmlContent = '<textarea class="form-control col-md-7 col-xs-12" id="textarea__id__toolBox_textarea_' + i + '" data-input-name="textarea" data-input-inputNo="' + i + '" ' + properties + '>\n\t\t' + '</textarea>';

									$('#div__id__controlButtonArea_' + $(this).attr('data-button-changeControl')).attr('data-div-controlName', 'textarea');
									$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlId', 'textarea__id__toolBox_textarea_');
									if(typeof $('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlLabelId') !== typeof undefined)
										$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).removeAttr('data-button-controlLabelId');
								}
								break;
							case 'comboBox':
								if(!$('[data-div-combobox_datalist-no]').length)
								{		
									throw new Error('Hãy nhập ít nhất 1 lựa chọn vào!');
								}

								/*Kiểm tra và sắp xếp lại thứ tự các option khi xoá options bằng dev tool (google chrome)*/
								if(!sortOption($('[data-label-comboBox_datalist-no]'), {'val': 0}))
									return false;	
								for(; i < $('[data-textBox-id="textBox__data-textBox-id__themLuaChon"]').length; ++i)
					          	{
					          		object = $($('[data-label-comboBox_datalist-no]')[i]);
					          		comboBoxDatalistContent += '\n\t\t<option value="' + object.attr('data-label-comboBox_datalist-no') + '">' + $('[data-textBox-id="textBox__data-textBox-id__themLuaChon"]')[i].value + '</option>'; 
					          	}
					          	if(typeof $(this).attr('data-button-changeControl') === typeof undefined)
									inputHtmlContent = htmlControlString1 + '\n\t\t<select class="form-control col-md-7 col-xs-12" id="comboBox__id__toolBox_comboBox_' + this._countInput + '" data-input-name="combobox" data-input-inputNo="' + this._countInput + '">' + comboBoxDatalistContent + '\n\t\t</select>' + htmlControlString2 + 'comboBox' + htmlControlString3 + 'comboBox__id__toolBox_comboBox_"' + htmlControlString4;
				              	else
				              	{
				              		i = $(this).attr('data-button-changeControl');
				              		inputHtmlContent = '<select class="form-control col-md-7 col-xs-12" id="comboBox__id__toolBox_comboBox_' + i + '" data-input-name="combobox" data-input-inputNo="' + i + '">' + comboBoxDatalistContent + '\n\t\t</select>';
					              	$('#div__id__controlButtonArea_' + $(this).attr('data-button-changeControl')).attr('data-div-controlName', 'comboBox');
									$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlId', 'comboBox__id__toolBox_comboBox_');
									if(typeof $('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlLabelId') !== typeof undefined)
										$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).removeAttr('data-button-controlLabelId');
				              	}
								break;
							case 'datetimePicker':
								if(typeof $(this).attr('data-button-changeControl') === typeof undefined)
									inputHtmlContent = htmlControlString1 + '\n\t\t<div class="form-group" id="div__id__toolBox_datetimePickerArea_' + this._countInput + '" data-input-name="datetimepicker" style="margin-bottom: 0">\n\t\t<div class="input-group date" id="div__id__datetimePicker_' + this._countInput + '" style="margin-bottom: 0">\n\t\t<input type="text" class="form-control" id="datetimePicker__id__toolBox_datetimePicker_' + this._countInput + '" data-input-name="datetimepicker" data-input-inputNo="' + this._countInput + '" onkeydown="return false" data-textBox-formatDate="' + $('#select__id__datetimePicker').val() +'">\n\t\t<span class="input-group-addon">\n\t\t<span class="glyphicon glyphicon-calendar"></span>\n\t\t</span>\n\t\t</div>\n\t\t</div>' + htmlControlString2 + 'datetimePicker' + htmlControlString3 + 'div__id__toolBox_datetimePickerArea_"' + htmlControlString4;
			                    else
			                    {
			                    	i = $(this).attr('data-button-changeControl');
				              		inputHtmlContent = '<div class="form-group" id="div__id__toolBox_datetimePickerArea_' + i + '" data-input-name="datetimepicker" style="margin-bottom: 0">\n\t\t<div class="input-group date" id="div__id__datetimePicker_' + i + '" style="margin-bottom: 0">\n\t\t<input type="text" class="form-control" id="datetimePicker__id__toolBox_datetimePicker_' + i + '" data-input-name="datetimepicker" data-input-inputNo="' + i + '" onkeydown="return false" data-textBox-formatDate="' + $('#select__id__datetimePicker').val() +'">\n\t\t<span class="input-group-addon">\n\t\t<span class="glyphicon glyphicon-calendar"></span>\n\t\t</span>\n\t\t</div>\n\t\t</div>';
					              	$('#div__id__controlButtonArea_' + $(this).attr('data-button-changeControl')).attr('data-div-controlName', 'datetimePicker');
									$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlId', 'div__id__toolBox_datetimePickerArea_');
									if(typeof $('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlLabelId') !== typeof undefined)
										$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).removeAttr('data-button-controlLabelId');
			                    }
								break;
							case 'datalist':
								if(!$('[data-div-combobox_datalist-no]').length)
								{		
									throw new Error('Hãy nhập ít nhất 1 lựa chọn vào!');
								}
								/*Kiểm tra và sắp xếp lại thứ tự các option khi xoá options bằng dev tool (google chrome)*/
								if(!sortOption($('[data-label-comboBox_datalist-no]'), {'val': 0}))
									return false;
								for(; i < $('[data-textBox-id="textBox__data-textBox-id__themLuaChon"]').length; ++i)
					          	{
					          		object = $($('[data-label-comboBox_datalist-no]')[i]);
					          		comboBoxDatalistContent += '\n\t\t<option value="' + object.attr('data-label-comboBox_datalist-no') + '">' + $('[data-textBox-id="textBox__data-textBox-id__themLuaChon"]')[i].value + '</option>'; 
					          	}
					          	if(typeof $(this).attr('data-button-changeControl') === typeof undefined)
									inputHtmlContent = htmlControlString1 + '\n\t\t<div class="col-sm-12 col-md-12 col-xs-12" style="padding: 0" id="div__id__toolBox_datalistArea_' + this._countInput + '" data-input-name="datalist">\n\t\t<input type="text" class="form-control" list="datalist__id__toolBox_datalist_' + this._countInput + '" id="textBox__id__toolBox_datalist_' + this._countInput + '" data-input-name="datalist" data-input-inputNo="' + this._countInput + '" ' + properties + '>\n\t\t<datalist id="datalist__id__toolBox_datalist_' + this._countInput + '" data-input-inputNo="' + this._countInput + '">' + comboBoxDatalistContent + '\n\t\t</datalist>\n\t\t<input type="hidden" id="hidden__id__toolBox_datalist_' + this._countInput + '" data-input-inputNo="' + this._countInput + '"></div>' + htmlControlString2 + 'datalist' + htmlControlString3 + 'div__id__toolBox_datalistArea_"' + htmlControlString4;
				              	else
				              	{
				              		i = $(this).attr('data-button-changeControl');
				              		inputHtmlContent = '<div class="col-sm-12 col-md-12 col-xs-12" style="padding: 0" id="div__id__toolBox_datalistArea_' + i + '" data-input-name="datalist">\n\t\t<input type="text" class="form-control" list="datalist__id__toolBox_datalist_' + i + '" id="textBox__id__toolBox_datalist_' + i + '" data-input-name="datalist" data-input-inputNo="' + i + '" ' + properties + '>\n\t\t<datalist id="datalist__id__toolBox_datalist_' + i + '" data-input-inputNo="' + i + '">' + comboBoxDatalistContent + '\n\t\t</datalist>\n\t\t<input type="hidden" id="hidden__id__toolBox_datalist_' + i + '" data-input-inputNo="' + i + '">';
					              	$('#div__id__controlButtonArea_' + $(this).attr('data-button-changeControl')).attr('data-div-controlName', 'datalist');
									$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlId', 'div__id__toolBox_datalistArea_');
									if(typeof $('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlLabelId') !== typeof undefined)
										$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).removeAttr('data-button-controlLabelId');
				              	}	
								break;
							case 'checkBox':
								if(!$('#textBox__id__radio_checkBox').val().trim())
								{
									throw new Error('Hãy nhập tiêu đề check box vào!');
								}
	                			if(typeof $(this).attr('data-button-changeControl') === typeof undefined)
	                			{
	                				object = $('[data-input-inputNo][data-input-name]').last();
			                		if(object.attr('data-input-name') === 'checkbox')
			                		{
			                			object = $('[data-div-luu="control"][data-div-inputNo="' + object.attr('data-input-inputNo') + '"]');
			                			inputHtmlContent = '\n\t\t<div class="item form-group" id="div__id__truongLuu_' + this._countInput + '" data-div-inputNo="' + this._countInput + '"  data-div-inputCommonNo="' + ((typeof object.attr('data-div-inputCommonNo') !== typeof undefined && object.attr('data-div-inputCommonNo')) ? object.attr('data-div-inputCommonNo').trim() : object.attr('data-div-inputNo').trim()) + '" data-div-hoverShowButton  data-div-luu="control">\n\t\t<div class="col-md-3 col-sm-3 col-xs-12"></div>\n\t\t<div class="col-md-6 col-sm-6 col-xs-12" id="div__id__controlArea_' + this._countInput + '" data-div-inputNo="' + this._countInput + '">\n\t\t<div class="row" id="div__id__toolBox_checkBox_' + this._countInput + '" data-div-inputNo="' + this._countInput + '">\n\t\t<div class="col-md-1 col-sm-1 col-xs-12">\n\t\t<input type="checkbox" style="margin-top: 10px;" id="checkBox__id__toolBox_checkBox_' + this._countInput + '" data-input-name="checkbox" data-input-inputNo="' + this._countInput + '" data-input-inputCommonNo="' + ((typeof object.attr('data-div-inputCommonNo') !== typeof undefined && object.attr('data-div-inputCommonNo')) ? object.attr('data-div-inputCommonNo').trim() : object.attr('data-div-inputNo').trim()) + '" ' + properties + '>\n\t\t</div><div class="col-md-11 col-sm-11 col-xs-12" style="padding-left: 0"><label style="padding-top: 8px; font-weight: normal" id="label__id__checkBoxTiTle_' + this._countInput + '" data-label-inputNo="' + this._countInput + '">' + $('#textBox__id__radio_checkBox').val() + '</label></div></div>' + htmlControlString2 + 'checkBox' + '"><button type="button" class="btn btn-sm btn-success" data-toggle="modal" rel="tooltip" data-original-title="Sửa trường này" id="button__id__suaTruong_' + this._countInput + '" data-button-command="sua" data-button-inputNo="' + this._countInput + '"><i class="fa fa-edit"></i></button><button type="button" class="btn btn-sm btn-danger" rel="tooltip" data-original-title="Xoá trường này"  id="button__id__xoaTruong_' + this._countInput + '" data-button-command="xoa" data-button-inputNo="' + this._countInput + '">\n\t\t<i class="glyphicon glyphicon-remove"></i>\n\t\t</button>\n\t\t</div>\n\t\t</div></div>';
							        }
							        else
										inputHtmlContent = htmlControlString1 + '\n\t\t<div class="row" id="div__id__toolBox_checkBox_' + this._countInput + '" data-input-name="checkbox">\n\t\t<div class="col-md-1 col-sm-1 col-xs-12">\n\t\t<input type="checkbox" style="margin-top: 10px;" id="checkBox__id__toolBox_checkBox_' + this._countInput + '" data-input-name="checkbox" data-input-inputNo="' + this._countInput + '" ' + properties + '>\n\t\t</div>\n\t\t<div class="col-md-11 col-sm-11 col-xs-12" style="padding-left: 0">\n\t\t<label style="padding-top: 8px; font-weight: normal" id="label__id__checkBoxTiTle_' + this._countInput + '" data-label-inputNo="' + this._countInput + '">' + $('#textBox__id__radio_checkBox').val() + '</label>\n\t\t</div>\n\t\t</div>' + htmlControlString2 + 'checkBox' + htmlControlString3 + 'div__id__toolBox_checkBox_" data-button-controlLabelId="label__id__checkBoxTiTle_"' + htmlControlString4;
	                			}
		                		else
		                		{
		                			i = $(this).attr('data-button-changeControl');
				              		inputHtmlContent = '<div class="row" id="div__id__toolBox_checkBox_' + i + '" data-input-name="checkbox">\n\t\t<div class="col-md-1 col-sm-1 col-xs-12">\n\t\t<input type="checkbox" style="margin-top: 10px;" id="checkBox__id__toolBox_checkBox_' + i + '" data-input-name="checkbox" ' + ((typeof $('#checkBox__id__toolBox_checkBox_' + i).attr('data-input-inputCommonNo') !== typeof undefined && $('#checkBox__id__toolBox_checkBox_' + i).attr('data-input-inputCommonNo')) ? 'data-input-inputCommonNo="' + $('#checkBox__id__toolBox_checkBox_' + i).attr('data-input-inputCommonNo').trim() + '"' : '') + ' data-input-inputNo="' + i + '" ' + properties + '>\n\t\t</div>\n\t\t<div class="col-md-11 col-sm-11 col-xs-12" style="padding-left: 0">\n\t\t<label style="padding-top: 8px; font-weight: normal" id="label__id__checkBoxTiTle_' + i + '" data-label-inputNo="' + i + '">' + $('#textBox__id__radio_checkBox').val() + '</label>\n\t\t</div>\n\t\t</div>';
					              	$('#div__id__controlButtonArea_' + $(this).attr('data-button-changeControl')).attr('data-div-controlName', 'checkBox');
									$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlId', 'div__id__toolBox_checkBox_');
									$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlLabelId', 'label__id__checkBoxTiTle_');
		                		}
								break;
							case 'radio':
								if(!$('#textBox__id__radio_checkBox').val().trim())
								{
									throw new Error('Hãy nhập tiêu đề check box vào!');
								}
		            			if(typeof $(this).attr('data-button-changeControl') === typeof undefined)
		            			{
		            				object = $('[data-input-inputNo][data-input-name]').last();
		            				if(object.attr('data-input-name') === 'radio')
			                		{
			                			object = $('[data-div-luu="control"][data-div-inputNo="' + object.attr('data-input-inputNo') + '"]');
				            			inputHtmlContent = '\n\t\t<div class="item form-group" id="div__id__truongLuu_' + this._countInput + '" data-div-inputNo="' + this._countInput + '" data-div-inputCommonNo="' + ((typeof object.attr('data-div-inputCommonNo') !== typeof undefined && object.attr('data-div-inputCommonNo')) ? object.attr('data-div-inputCommonNo').trim() : object.attr('data-div-inputNo').trim()) + '" data-div-hoverShowButton  data-div-luu="control">\n\t\t<div class="col-md-3 col-sm-3 col-xs-12"></div>\n\t\t<div class="col-md-6 col-sm-6 col-xs-12" id="div__id__controlArea_' + this._countInput + '" data-div-inputNo="' + this._countInput + '">\n\t\t<div class="row" id="div__id__toolBox_radio_' + this._countInput + '">\n\t\t<div class="col-sm-1">\n\t\t<input type="radio" style="margin-top: 10px;" data-input-inputNo="' + this._countInput + '" data-input-name="radio" name="' + $('[data-input-name="radio"][data-input-inputNo="' + (this._countInput ? (this._countInput - 1) : this._countInput) + '"]').attr('name') + '" data-input-inputCommonNo="' + ((typeof object.attr('data-div-inputCommonNo') !== typeof undefined && object.attr('data-div-inputCommonNo')) ? object.attr('data-div-inputCommonNo').trim() : object.attr('data-div-inputNo').trim()) + '" id="radio__id__toolBox_radio_' + this._countInput + '">\n\t\t</div>\n\t\t<div class="col-sm-11" style="padding-left: 0">\n\t\t<label id="label__id__radioTiTle_' + this._countInput + '" data-label-inputNo="' + this._countInput + '" style="padding-top: 8px; font-weight: normal">' + $('#textBox__id__radio_checkBox').val() + '</label>\n\t\t</div>\n\t\t</div>' + htmlControlString2 + 'radio' + '">\n\t\t<button type="button" class="btn btn-sm btn-success" data-toggle="modal" rel="tooltip" data-original-title="Sửa trường này" id="button__id__suaTruong_' + this._countInput + '" data-button-command="sua" data-button-inputNo="' + this._countInput + '">\n\t\t<i class="fa fa-edit"></i>\n\t\t</button>\n\t\t<button type="button" class="btn btn-sm btn-danger" rel="tooltip" data-original-title="Xoá trường này"  id="button__id__xoaTruong_' + this._countInput + '" data-button-command="xoa" data-button-inputNo="' + this._countInput + '">\n\t\t<i class="glyphicon glyphicon-remove"></i>\n\t\t</button>\n\t\t</div>\n\t\t</div>\n\t\t</div>';
				            		}	
				            		else
				            			inputHtmlContent = htmlControlString1 + '<div class="row" id="div__id__toolBox_radio_' + this._countInput + '" data-input-name="radio">\n\t\t<div class="col-sm-1">\n\t\t<input type="radio" style="margin-top: 10px;" data-input-inputNo="' + this._countInput + '" data-input-name="radio" name="radio__name__' + this._countInput + '" id="radio__id__toolBox_radio_' + this._countInput + '" checked>\n\t\t</div>\n\t\t<div class="col-sm-11" style="padding-left: 0">\n\t\t<label id="label__id__radioTiTle_' + this._countInput + '" data-label-inputNo="' + this._countInput + '" style="padding-top: 8px; font-weight: normal">' + $('#textBox__id__radio_checkBox').val() + '</label>\n\t\t</div>\n\t\t</div>' + htmlControlString2 + 'radio' + htmlControlString3 + 'div__id__toolBox_radio_" data-button-controlLabelId="label__id__radioTiTle_"' + htmlControlString4;
				            	}
			            		else
			            		{
			            			i = $(this).attr('data-button-changeControl');
				              		inputHtmlContent = '<div class="row" id="div__id__toolBox_radio_' + i + '" data-input-name="radio">\n\t\t<div class="col-sm-1">\n\t\t<input type="radio" style="margin-top: 10px;" data-input-inputNo="' + i + '" ' + ((typeof $('#radio__id__toolBox_radio_' + i).attr('data-input-inputCommonNo') !== typeof undefined && $('#radio__id__toolBox_radio_' + i).attr('data-input-inputCommonNo')) ? 'data-input-inputCommonNo="' + $('#radio__id__toolBox_radio_' + i).attr('data-input-inputCommonNo').trim() + '"' : '') + ' data-input-name="radio" name="radio__name__' + i + '" id="radio__id__toolBox_radio_' + i + '" checked>\n\t\t</div>\n\t\t<div class="col-sm-11" style="padding-left: 0">\n\t\t<label id="label__id__radioTiTle_' + i + '" data-label-inputNo="' + i + '" style="padding-top: 8px; font-weight: normal">' + $('#textBox__id__radio_checkBox').val() + '</label>\n\t\t</div>\n\t\t</div>';
					              	$('#div__id__controlButtonArea_' + $(this).attr('data-button-changeControl')).attr('data-div-controlName', 'radio');
									$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlId', 'div__id__toolBox_radio_');
									$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlLabelId', 'label__id__radioTiTle_');
			            		}	
								break;
							case 'file':
								if(typeof $(this).attr('data-button-changeControl') === typeof undefined)
									inputHtmlContent = htmlControlString1 + '<input type="file" class="form-control col-md-7 col-xs-12" id="file__id__toolBox_file_' + this._countInput + '" data-input-name="file" data-input-inputNo="' + this._countInput + '" ' + properties + '>' + htmlControlString2 + 'file' + htmlControlString3 + 'file__id__toolBox_file_"' + htmlControlString4;
								else
								{
			            			i = $(this).attr('data-button-changeControl');
				              		inputHtmlContent = '<input type="file" class="form-control col-md-7 col-xs-12" id="file__id__toolBox_file_' + i + '" data-input-name="file" data-input-inputNo="' + i + '" ' + properties + '>';
					              	$('#div__id__controlButtonArea_' + $(this).attr('data-button-changeControl')).attr('data-div-controlName', 'file');
									$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlId', 'file__id__toolBox_file_');
									if(typeof $('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-controlLabelId') !== typeof undefined)
										$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).removeAttr('data-button-controlLabelId');
			            		}
								break;
							default:
								throw new Error('Input đã chọn không được hỗ trợ!');
						}
						
						if(!this._countInput)
						{
							$('#div__id__noiDungBMXML').append('\n\t\t<div class="form-group text-center" id="div__id__truongLuu_' + this._countInput + '" data-div-luu="command">\n\t\t<div class="col-md-6 col-md-offset-3">\n\t\t<button type="button" class="btn btn-success" rel="tooltip" data-original-title="Gửi" id="button__id__guiBieuMau">\n\t\t<i class="glyphicon glyphicon-ok"></i>\n\t\t</button>\n\t\t<button type="button" class="btn btn-danger" rel="tooltip" data-original-title="Huỷ" id="button__id__huyGuiBieuMau">\n\t\t<i class="glyphicon glyphicon-remove">\n\t\t</i>\n\t\t</button>\n\t\t</div>\n\t\t</div>');
				          	$('#div__id__noiDungBMXML').prepend('<div class="ln_solid" data-div-luu="line"></div>');
							$('#div__id__noiDungBMXML').prepend(inputHtmlContent);
							$('[data-label-id="label__data-label-id__toolBoxBM_' + this._countInput + '"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							$('#button__id__guiBieuMau').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							$('#button__id__huyBieuMau').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							$('#button__id__suaTruong_' + this._countInput).tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							$('#button__id__doiTruong_' + this._countInput).tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							$('#button__id__xoaTruong_' + this._countInput).tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							++this._countInput;
						}
						else
						{
							if(typeof $(this).attr('data-button-changeControl') === typeof undefined)
							{
								$(inputHtmlContent).insertAfter($('[data-div-luu="control"]').last());
								if($(this).attr('data-button-controlCategory') == 'datetimePicker')
									if(!formatFieldDate(this._countInput))
										return false;
								
								$('[data-label-id="label__data-label-id__toolBoxBM_' + this._countInput + '"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
								$('#button__id__suaTruong_' + this._countInput).tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
								$('#button__id__doiTruong_' + this._countInput).tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
								$('#button__id__xoaTruong_' + this._countInput).tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
								$('#button__id__themTruong').removeAttr('data-target');
								++this._countInput;
							}
							else
							{
								$('#div__id__toolBox_' + $(this).attr('data-button-changeControl')).hide();
								$('#' + $(this).attr('data-button-controlName')).parent().removeClass('active');

								$($('#'+ $(this).attr('data-button-controlReplaced'))).replaceWith(inputHtmlContent);

								$('#label__id__tenTruongBieuMau_' + $(this).attr('data-button-changeControl')).text($('#textBox__id__tenTruongBieuMau_' + $(this).attr('data-button-changeControl')).val().trim());
	                			$('#textBox__id__tenTruongBieuMau_' + $(this).attr('data-button-changeControl')).hide();
								$('#label__id__tenTruongBieuMau_' + $(this).attr('data-button-changeControl')).show();

								if($(this).attr('data-button-controlCategory') == 'datetimePicker')
									if(!formatFieldDate($(this).attr('data-button-changeControl')))
										return false;
									
								$('[name="radio__name__toolBoxBM_' + $(this).attr('data-button-changeControl') + '"]').prop('checked', false);
								$('#div__id__controlArea_' + $(this).attr('data-button-changeControl')).removeClass('text-center');
								$($('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).children()[0]).attr('class', 'fa fa-exchange');
								$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-original-title', 'Đổi trường khác');
								$('#button__id__suaTruong_' + $(this).attr('data-button-changeControl')).show();
								$('#button__id__doiTruong_' + $(this).attr('data-button-changeControl')).attr('data-button-command', 'doi');
								$('#button__id__themTruong').removeAttr('data-target');

								if(typeof $(this).attr('data-button-controlName') !== typeof undefined)
									$(this).removeAttr('data-button-controlName');
								if(typeof $(this).attr('data-button-changeControl') !== typeof undefined)
									$(this).removeAttr('data-button-changeControl');
								if(typeof $(this).attr('data-button-controlReplaced') !== typeof undefined)
									$(this).removeAttr('data-button-controlReplaced');
							}
						}
					}
					else
					{
						switch($(this).attr('data-button-controlCategory'))
						{
							case 'textBox':
								object = $('#textBox__id__toolBox_textBox_' + $(this).attr('data-button-updateData'));
								validator.unmark(object);
								if(typeof object.attr('required') !== typeof undefined && !$('#checkBox__id__required').prop('checked'))
									object.removeAttr('required');
								else if($('#checkBox__id__required').prop('checked'))
									object.attr('required','');

								if(typeof object.attr('placeholder') !== typeof undefined  && !$('#checkBox__id__placeholder').prop('checked'))
									object.removeAttr('placeholder');
								else if($('#checkBox__id__placeholder').prop('checked'))
									object.attr('placeholder',$('#textBox__id__placeholder').val().trim());

								if(typeof object.attr('maxlength') !== typeof undefined && !$('#checkBox__id__maxLength').prop('checked'))
									object.removeAttr('maxlength');
								else if($('#checkBox__id__maxLength').prop('checked'))
									object.attr('maxlength',$('#number__id__maxLength').val());

								if(typeof object.attr('minlength') !== typeof undefined && !$('#checkBox__id__minLength').prop('checked'))
									object.removeAttr('minlength');
								else if($('#checkBox__id__minLength').prop('checked'))
									object.attr('minlength',$('#number__id__minLength').val());
								break;
							case 'number':
								object = $('#number__id__toolBox_number_' + $(this).attr('data-button-updateData'));
								validator.unmark(object);
								if(typeof object.attr('required') !== typeof undefined && !$('#checkBox__id__required').prop('checked'))
									object.removeAttr('required');
								else if($('#checkBox__id__required').prop('checked'))
									object.attr('required','');
								if(typeof object.attr('data-number-noRegex') !== typeof undefined && !$('#checkBox__id__numberNoRegex').prop('checked'))
									object.removeAttr('data-number-noRegex');
								else if($('#checkBox__id__numberNoRegex').prop('checked'))
									object.attr('data-number-noRegex','');
								if(typeof object.attr('placeholder') !== typeof undefined && !$('#checkBox__id__placeholder').prop('checked'))
									object.removeAttr('placeholder');
								else if($('#checkBox__id__placeholder').prop('checked'))
									object.attr('placeholder',$('#textBox__id__placeholder').val().trim());

								if(typeof object.attr('max') !== typeof undefined && !$('#checkBox__id__max').prop('checked'))
								{
									if(typeof object.attr('min') !== typeof undefined && !$('#checkBox__id__min').prop('checked'))
									{
										object.removeAttr('data-validate-minmax');
										object.removeAttr('min');
									}
									else if($('#checkBox__id__min').prop('checked'))
									{
										object.attr('data-validate-minmax', $('#number__id__min').val());
										object.attr('min',$('#number__id__min').val());
									}
									object.removeAttr('max');
								}
								else if($('#checkBox__id__max').prop('checked'))
								{
									if(typeof object.attr('min') !== typeof undefined && !$('#checkBox__id__min').prop('checked'))
									{
										object.attr('data-validate-minmax', $('#number__id__max').val() + ',' + $('#number__id__max').val());
										object.removeAttr('min');
									}
									else if($('#checkBox__id__min').prop('checked'))
									{
										object.attr('data-validate-minmax', $('#number__id__min').val() + ',' + $('#number__id__max').val());
										object.attr('min',$('#number__id__min').val());
									}
									object.attr('max',$('#number__id__max').val());
								}
								break;
							case 'textarea':
								object = $('#textarea__id__toolBox_textarea_' + $(this).attr('data-button-updateData'));
								validator.unmark(object);
								if(typeof object.attr('required') !== typeof undefined && !$('#checkBox__id__required').prop('checked'))
									object.removeAttr('required');
								else if($('#checkBox__id__required').prop('checked'))
									object.attr('required','');

								if(typeof object.attr('placeholder') !== typeof undefined && !$('#checkBox__id__placeholder').prop('checked'))
									object.removeAttr('placeholder');
								else if($('#checkBox__id__placeholder').prop('checked'))
									object.attr('placeholder',$('#textBox__id__placeholder').val().trim());

								if(typeof object.attr('maxlength') !== typeof undefined && !$('#checkBox__id__maxLength').prop('checked'))
									object.removeAttr('maxlength');
								else if($('#checkBox__id__maxLength').prop('checked'))
									object.attr('maxlength',$('#number__id__maxLength').val());

								if(typeof object.attr('minlength') !== typeof undefined && !$('#checkBox__id__minLength').prop('checked'))
									object.removeAttr('minlength');
								else if($('#checkBox__id__minLength').prop('checked'))
									object.attr('minlength',$('#number__id__minLength').val());

								if(typeof object.attr('rows') !== typeof undefined && !$('#checkBox__id__rows').prop('checked'))
									object.removeAttr('rows');
								else if($('#checkBox__id__rows').prop('checked'))
									object.attr('rows',$('#number__id__rows').val());
								break;
							case 'comboBox':
								if(!$('[data-div-combobox_datalist-no]').length)
								{		
									throw new Error('Hãy nhập ít nhất 1 lựa chọn vào!');
								}	
								for(; i < $('[data-textBox-id="textBox__data-textBox-id__themLuaChon"]').length; ++i)
					          	{
					          		object = $($('[data-label-comboBox_datalist-no]')[i]);
					          		comboBoxDatalistContent += '<option value="' + object.attr('data-label-comboBox_datalist-no') + '">' + $('[data-textBox-id="textBox__data-textBox-id__themLuaChon"]')[i].value + '</option>'; 
					          	}
								$('#comboBox__id__toolBox_comboBox_' + $(this).attr('data-button-updateData')).html(comboBoxDatalistContent);
								break;
							case 'datetimePicker':
								if(!formatFieldDate($(this).attr('data-button-updateData')))
									return false;
								$('#datetimePicker__id__toolBox_datetimePicker_' + $(this).attr('data-button-updateData')).attr('data-textBox-formatDate', $('#select__id__datetimePicker').val());
								break;
							case 'datalist':
								if(!$('[data-div-combobox_datalist-no]').length)
								{		
									throw new Error('Hãy nhập ít nhất 1 lựa chọn vào!');
								}	
								object = $('#textBox__id__toolBox_datalist_' + $(this).attr('data-button-updateData'));
								validator.unmark(object);
								if(typeof object.attr('required') !== typeof undefined && !$('#checkBox__id__required').prop('checked'))
								{
									object.removeAttr('required');
								}
								else if($('#checkBox__id__required').prop('checked'))
									object.attr('required','');

								if(typeof object.attr('placeholder') !== typeof undefined && !$('#checkBox__id__placeholder').prop('checked'))
									object.removeAttr('placeholder');
								else if($('#checkBox__id__placeholder').prop('checked'))
									object.attr('placeholder',$('#textBox__id__placeholder').val().trim());

								if(typeof object.attr('maxlength') !== typeof undefined && !$('#checkBox__id__maxLength').prop('checked'))
									object.removeAttr('maxlength');
								else if($('#checkBox__id__maxLength').prop('checked'))
									object.attr('maxlength',$('#number__id__maxLength').val());

								for(; i < $('[data-textBox-id="textBox__data-textBox-id__themLuaChon"]').length; ++i)
					          	{
					          		object = $($('[data-label-comboBox_datalist-no]')[i]);
					          		comboBoxDatalistContent += '<option value="' + object.attr('data-label-comboBox_datalist-no') + '">' + $('[data-textBox-id="textBox__data-textBox-id__themLuaChon"]')[i].value + '</option>'; 
					          	}
								$('#datalist__id__toolBox_datalist_' + $(this).attr('data-button-updateData')).html(comboBoxDatalistContent);
								break;
							case 'checkBox':
								object = $('#checkBox__id__toolBox_checkBox_' + $(this).attr('data-button-updateData'));
								validator.unmark(object);
								if(typeof object.attr('required') !== typeof undefined && !$('#checkBox__id__required').prop('checked'))
									object.removeAttr('required');
								else if($('#checkBox__id__required').prop('checked'))
									object.attr('required','');
								$('#label__id__checkBoxTiTle_' + $(this).attr('data-button-updateData')).text($('#textBox__id__radio_checkBox').val());
								break;
							case 'radio':
				            	$('#label__id__radioTiTle_' + $(this).attr('data-button-updateData')).text($('#textBox__id__radio_checkBox').val());
								break;
							case 'file':
								object = $('#file__id__toolBox_file_' + $(this).attr('data-button-updateData'));
								if(typeof object.attr('required') !== typeof undefined && !$('#checkBox__id__required').prop('checked'))
								{
									object.removeAttr('required');
									validator.unmark(object);
								}
								else if($('#checkBox__id__required').prop('checked'))
									object.attr('required','');

								if(typeof object.attr('multiple') !== typeof undefined && !$('#checkBox__id__multiple').prop('checked'))
									object.removeAttr('multiple');
								else if($('#checkBox__id__multiple').prop('checked'))
									object.attr('multiple','');
								break;
							default:
								throw new Error('Input đã chọn không được hỗ trợ!');
						}
						if($('#label__id__tenTruongBieuMau_' + $(this).attr('data-button-updateData')).length && $('#textBox__id__tenTruongBieuMau_' + $(this).attr('data-button-updateData')).length)
						{
                			$('#label__id__tenTruongBieuMau_' + $(this).attr('data-button-updateData')).text($('#textBox__id__tenTruongBieuMau_' + $(this).attr('data-button-updateData')).val().trim());
                			$('#textBox__id__tenTruongBieuMau_' + $(this).attr('data-button-updateData')).hide();
							$('#label__id__tenTruongBieuMau_' + $(this).attr('data-button-updateData')).show();
						}
						if($('#button__id__doiTruong_' + $(this).attr('data-button-updateData')).length)
							$('#button__id__doiTruong_' + $(this).attr('data-button-updateData')).show();

						$($('#button__id__suaTruong_' + $(this).attr('data-button-updateData')).children()[0]).attr('class', 'fa fa-edit');
						$('#button__id__suaTruong_' + $(this).attr('data-button-updateData')).removeAttr('data-target');
						$('#button__id__suaTruong_' + $(this).attr('data-button-updateData')).attr('data-button-command', 'sua');
						$('#button__id__suaTruong_' + $(this).attr('data-button-updateData')).attr('data-original-title', 'Sửa trường này');
						$('#button__id__suaTruong_' + $(this).attr('data-button-updateData')).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					}
					$(this).attr('data-dismiss', 'modal');
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