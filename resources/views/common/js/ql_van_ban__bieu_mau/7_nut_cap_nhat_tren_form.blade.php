<script>
$(function(){
	try
	{
		/*click button cập nhật hoặc thêm biểu mẫu*/
		if($('#button__id__capNhatBieuMauDangXML').length)
			$('#button__id__capNhatBieuMauDangXML').on('click', function(){
				try
				{
					var _date = new Date();
					var fieldsDefine = '';
					var fieldsCheck = '';
					var formData = '\n\t\t\t\t\tformData.append("_token", CSRF_TOKEN);';
					var fieldsCheckArr = new Array();
					var _scriptForSubMitButton = '';
					var _scriptForOther = '';
					var groupCheck = '';
					var i = 0;
					var maxDate = '';
					var minDate = '';
					var message = '';
					var object = null;
					var formContent = '\n\t\t<form class="form-horizontal form-label-left" novalidate>';
					var countField = 0;
					if($('[data-div-luu="control"]').length)
					{
						$('[data-input-controlDeleted]').remove();
						$('[data-div-controlDeleted]').remove();

						/*check properties of fields to create check input*/
						$('[data-input-inputNo][data-input-name]').each(function(){
							switch($(this).attr('data-input-name'))
							{
								case 'textbox':
									fieldsDefine += '\n\t\t\t\t\tvar _' + (++countField) + ' = $("#textBox__id__toolBox_textBox_' + $(this).attr('data-input-inputNo') + '").val().trim();';
									formData += '\n\t\t\t\t\tformData.append("_' + countField + '", ["_' + countField + '", "|", $("#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo') + '").text(), "|", "textbox", "|", _' + countField + ', "|", "textBox__id__toolBox_textBox_' + $(this).attr('data-input-inputNo') + '"]);';
									fieldsCheck = '';
									if(typeof $(this).attr('required') !== typeof undefined)
									{
										if($('#div__id__truongLuu_' + $(this).attr('data-input-inputNo')).hasClass('bad'))
											validator.unmark($(this));
										fieldsCheck = '!_' + countField;
										message = 'Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" bắt buộc nhập.';
									}
									if(typeof $(this).attr('minlength') !== typeof undefined && $(this).attr('minlength'))
									{
										fieldsCheck = fieldsCheck ? (fieldsCheck + ' || _' + countField + '.length < ' + $(this).attr('minlength')) : ('_' + countField + '.length < ' + $(this).attr('minlength'));
										message = message ? (message + '<br>Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có độ dài ký tự lớn hơn ' + $(this).attr('minlength') + '.') : ('Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có độ dài ký tự lớn hơn ' + $(this).attr('minlength') + '.');
									}
									if(typeof $(this).attr('maxlength') !== typeof undefined && $(this).attr('maxlength'))
									{
										fieldsCheck = fieldsCheck ? (fieldsCheck + ' || _' + countField + '.length > ' + $(this).attr('maxlength')) : ('_' + countField + '.length > ' + $(this).attr('maxlength'));
										message = message ? (message + '<br>Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có độ dài ký tự không quá ' + $(this).attr('maxlength') + '.') : ('Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có độ dài ký tự không quá ' + $(this).attr('maxlength') + '.');
									}
									if(fieldsCheck)
									{
										fieldsCheck = '\n\t\t\t\t\tif(' + fieldsCheck + ')\n\t\t\t\t\t\tthrow new Error(\'' + '<br><label style="font-weight: bold; font-size: 14px">Thông tin nhập vào không đầy đủ hoặc sai. Vui lòng kiểm tra lại!<br><label style="color: red;">' + message + '</label></label><br>\');';
										fieldsCheckArr[i] = fieldsCheck;
										++i;
									}
									break;
								case 'number':
									fieldsDefine += '\n\t\t\t\t\tvar _' + (++countField) + ' = $("#number__id__toolBox_number_' + $(this).attr('data-input-inputNo') + '").val();';
									formData += '\n\t\t\t\t\tformData.append("_' + countField + '", ["_' + countField + '", "|", $("#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo') + '").text(), "|", "number", "|", _' + countField + ', "|", "number__id__toolBox_number_' + $(this).attr('data-input-inputNo') + '"]);';
									fieldsCheck = '';
									if(typeof $(this).attr('required') !== typeof undefined)
									{
										if($('#div__id__truongLuu_' + $(this).attr('data-input-inputNo')).hasClass('bad'))
											validator.unmark($(this));
										fieldsCheck = '!_' + countField;
										message = 'Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" bắt buộc nhập.';
									}
									if(typeof $(this).attr('min') !== typeof undefined && $(this).attr('min'))
										if(typeof $(this).attr('data-number-noRegex') === typeof undefined)
										{
											fieldsCheck = fieldsCheck ? (fieldsCheck + ' || !checkNumberIncludeRegex(_' + countField + ') || _' + countField + ' < ' + $(this).attr('min')) : ('!checkNumberIncludeRegex(_' + countField + ') || _' + countField + ' < ' + $(this).attr('min'));
											message = message ? (message + '<br>Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có giá trị lớn hơn ' + $(this).attr('min') + '.') : ('Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có giá trị lớn hơn ' + $(this).attr('min') + '.');
										}
										else
										{
											fieldsCheck = fieldsCheck ? (fieldsCheck + ' || !checkNumberExclusiveRegex(_' + countField + ') || _' + countField + ' < ' + $(this).attr('min')) : ('!checkNumberExclusiveRegex(_' + countField + ') || _' + countField + ' < ' + $(this).attr('min'));
											message = message ? (message + '<br>Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có giá trị lớn hơn ' + $(this).attr('min') + '.') : ('Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có giá trị lớn hơn ' + $(this).attr('min') + '.');
										}
									if(typeof $(this).attr('max') !== typeof undefined && $(this).attr('max'))
										if(typeof $(this).attr('data-number-noRegex') === typeof undefined)
										{
											fieldsCheck = fieldsCheck ? (fieldsCheck + ' || !checkNumberIncludeRegex(_' + countField + ') || _' + countField + ' > ' + $(this).attr('max')) : ('!checkNumberIncludeRegex(_' + countField + ') || _' + countField + ' > ' + $(this).attr('max'));
											message = message ? (message + '<br>Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có giá trị không quá ' + $(this).attr('max') + '.') : ('Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có giá trị không quá ' + $(this).attr('max') + '.');
										}	
										else
										{
											fieldsCheck = fieldsCheck ? (fieldsCheck + ' || !checkNumberExclusiveRegex(_' + countField + ') || _' + countField + ' > ' + $(this).attr('max')) : ('!checkNumberExclusiveRegex(_' + countField + ') || _' + countField + ' > ' + $(this).attr('max'));
											message = message ? (message + '<br>Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có giá trị không quá ' + $(this).attr('max') + '.') : ('Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có giá trị không quá ' + $(this).attr('max') + '.');
										}
									if(fieldsCheck)
									{
										fieldsCheck = '\n\t\t\t\t\tif(' + fieldsCheck + ')\n\t\t\t\t\t\tthrow new Error(\'' + '<br><label style="font-weight: bold; font-size: 14px">Thông tin nhập vào không đầy đủ hoặc sai. Vui lòng kiểm tra lại!<br><label style="color: red;">' + message + '</label></label><br>\');';
										fieldsCheckArr[i] = fieldsCheck;
										++i;
									}
									break;
								case 'textarea':
									fieldsDefine += '\n\t\t\t\t\tvar _' + (++countField) + ' = $("#textarea__id__toolBox_textarea_' + $(this).attr('data-input-inputNo') + '").val().trim();';
									formData += '\n\t\t\t\t\tformData.append("_' + countField + '", ["_' + countField + '", "|", $("#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo') + '").text(), "|", "textarea", "|", _' + countField + ', "|", "textarea__id__toolBox_textarea_' + $(this).attr('data-input-inputNo') + '"]);';
									fieldsCheck = '';
									if(typeof $(this).attr('required') !== typeof undefined)
									{
										if($('#div__id__truongLuu_' + $(this).attr('data-input-inputNo')).hasClass('bad'))
										validator.unmark($(this));
										fieldsCheck = '!_' + countField;
										message = 'Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" bắt buộc nhập.';
									}
									if(typeof $(this).attr('minlength') !== typeof undefined && $(this).attr('minlength'))
									{
										fieldsCheck = fieldsCheck ? (fieldsCheck + ' || _' + countField + '.length < ' + $(this).attr('minlength')) : ('_' + countField + '.length < ' + $(this).attr('minlength'));
										message = message ? (message + '<br>Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có độ dài ký tự lớn hơn ' + $(this).attr('minlength') + '.') : ('Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có độ dài ký tự lớn hơn ' + $(this).attr('minlength') + '.');
									}
									if(typeof $(this).attr('maxlength') !== typeof undefined && $(this).attr('maxlength'))
									{
										fieldsCheck = fieldsCheck ? (fieldsCheck + ' || _' + countField + '.length > ' + $(this).attr('maxlength')) : ('_' + countField + '.length > ' + $(this).attr('maxlength'));
										message = message ? (message + '<br>Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có độ dài ký tự không quá ' + $(this).attr('maxlength') + '.') : ('Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có độ dài ký tự không quá ' + $(this).attr('maxlength') + '.');
									}
									if(fieldsCheck)
									{
										fieldsCheck = '\n\t\t\t\t\tif(' + fieldsCheck + ')\n\t\t\t\t\t\tthrow new Error(\'' + '<br><label style="font-weight: bold; font-size: 14px">Thông tin nhập vào không đầy đủ hoặc sai. Vui lòng kiểm tra lại!<br><label style="color: red;">' + message + '</label></label><br>\');';
										fieldsCheckArr[i] = fieldsCheck;
										++i;
									}
									break;
								case 'datalist':
									fieldsDefine += '\n\t\t\t\t\tvar _' + (++countField) + ' = $("#textBox__id__toolBox_datalist_' + $(this).attr('data-input-inputNo') + '").val().trim();';
									formData += '\n\t\t\t\t\tformData.append("_' + countField + '", ["_' + countField + '", "|", $("#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo') + '").text(), "|", "datalist", "|", $("#hidden__id__toolBox_datalist_' + countField + '").val(), "|", "textBox__id__toolBox_datalist_' + $(this).attr('data-input-inputNo') + '"]);';
									_scriptForOther += '\n\t\tif($("#textBox__id__toolBox_datalist_' + $(this).attr('data-input-inputNo') + '").length)\n\t\t\t$("#textBox__id__toolBox_datalist_' + $(this).attr('data-input-inputNo') + '").on("input", function(){\n\t\t\t\tvar inputText = $(this).val().trim();\n\t\t\t\t$("#datalist__id__toolBox_datalist_' + $(this).attr('data-input-inputNo') + '").children().each(function(){\n\t\t\t\t\tif(inputText === $(this).val() || inputText === $(this).text())\n\t\t\t\t\t{\n\t\t\t\t\t\t$("#textBox__id__toolBox_datalist_' + $(this).attr('data-input-inputNo') + '").val($(this).val() + " - " + $(this).text());\n\t\t\t\t\t\t$("#hidden__id__toolBox_datalist_' + $(this).attr('data-input-inputNo') + '").attr("value", $(this).val());\n\t\t\t\t\t\treturn false;\n\t\t\t\t\t}\n\t\t\t\t\telse\n\t\t\t\t\t\t $("#hidden__id__toolBox_datalist_' + $(this).attr('data-input-inputNo') + '").attr("value", "");\n\t\t\t\t});\n\t\t\t});';
									fieldsCheck = '';
									if(typeof $(this).attr('required') !== typeof undefined)
									{
										if($('#div__id__truongLuu_' + $(this).attr('data-input-inputNo')).hasClass('bad'))
											validator.unmark($(this));
										fieldsCheck = '!_' + countField;
										message = 'Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" bắt buộc nhập.';
									}
									if(typeof $(this).attr('maxlength') !== typeof undefined && $(this).attr('maxlength'))
									{
										fieldsCheck = fieldsCheck ? (fieldsCheck + ' || _' + countField + '.length > ' + $(this).attr('maxlength')) : ('_' + countField + '.length > ' + $(this).attr('maxlength'));
										message = message ? (message + '<br>Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có độ dài ký tự không quá ' + $(this).attr('maxlength') + '.') : ('Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" phải có độ dài ký tự không quá ' + $(this).attr('maxlength') + '.');
									}
									if(fieldsCheck)
									{
										fieldsCheck = '\n\t\t\t\t\tif(' + fieldsCheck + ')\n\t\t\t\t\t\tthrow new Error(\'' + '<br><label style="font-weight: bold; font-size: 14px">Thông tin nhập vào không đầy đủ hoặc sai. Vui lòng kiểm tra lại!<br><label style="color: red;">' + message + '</label></label><br>\');\n\t\t\t\t\tif(!$("#datalist__id__toolBox_datalist_' + $(this).attr('data-input-inputNo') + '").children().length)\n\t\t\t\t\t\tthrow new Error(\'' + '<br><label style="font-weight: bold; font-size: 14px">Danh sách lựa chọn của trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" rỗng!</label><br>\');\n\t\t\t\t\tif(!$("#hidden__id__toolBox_datalist_' + $(this).attr('data-input-inputNo') + '").val())\n\t\t\t\t\t\tthrow new Error(\'' + '<br><label style="font-weight: bold; font-size: 14px">Thông tin nhận được không có trong danh sách của trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\"!</label><br>\');';
										fieldsCheckArr[i] = fieldsCheck;
										++i;
									}
									break;
								case 'checkbox':
									if(typeof $(this).attr('data-input-inputCommonNo') === typeof undefined)
									{
										fieldsDefine += '\n\t\t\t\t\tvar _' + (++countField) + ' = $("#checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '");';

										formData += '\n\t\t\t\t\tfieldsId = new Array();\n\t\t\t\t\tfieldsVal = new Array();\n\t\t\t\t\ti = 0;\n\t\t\t\t\tif(_' + countField + '.prop("checked"))\n\t\t\t\t\t{\n\t\t\t\t\t\tfieldsVal[i] = $("#label__id__checkBoxTiTle_' + $(this).attr("data-input-inputNo") + '").text();\n\t\t\t\t\t\tfieldsId[i] = _' + countField + '.attr("id");\n\t\t\t\t\t\t++i;\n\t\t\t\t\t}\n\t\t\t\t\tif($("[data-input-name=\'checkbox\'][data-input-inputCommonNo=\'' + $(this).attr('data-input-inputNo') + '\']").length)\n\t\t\t\t\t{\n\t\t\t\t\t\t$("[data-input-name=\'checkbox\'][data-input-inputCommonNo=\'' + $(this).attr('data-input-inputNo') + '\']").each(function(){\n\t\t\t\t\t\t\tif($(this).prop("checked"))\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\tif(!i)\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\tfieldsVal[i] = $("#label__id__checkBoxTiTle_" + $(this).attr("data-input-inputNo")).text();\n\t\t\t\t\t\t\t\t\tfieldsId[i] = $(this).attr("id");\n\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t\telse\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\tfieldsVal[i] = ";";\n\t\t\t\t\t\t\t\t\tfieldsId[i] = ";";\n\t\t\t\t\t\t\t\t\tfieldsVal[++i] = $("#label__id__checkBoxTiTle_" + $(this).attr("data-input-inputNo")).text();\n\t\t\t\t\t\t\t\t\tfieldsId[++i] = $(this).attr("id");\n\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t\t++i;\n\t\t\t\t\t\t\t}\n\t\t\t\t\t\t});\n\t\t\t\t\t}\n\t\t\t\t\tif(i)\n\t\t\t\t\t\tformData.append("_' + countField + '", ["_' + countField + '", "|", $("#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo') + '").text(), "|", "checkbox", "|", fieldsVal, "|", fieldsId]);\n\t\t\t\t\telse\n\t\t\t\t\t\tformData.append("_' + countField + '", ["_' + countField + '", "|", $("#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo') + '").text(), "|", "checkbox", "|", "", "|", "checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '"]);';
										fieldsCheck = '';
										if(typeof $(this).attr('required') !== typeof undefined)
										{
											if($('#div__id__truongLuu_' + $(this).attr('data-input-inputNo')).hasClass('bad'))
											validator.unmark($(this));
											fieldsCheck = '!_' + countField + '.prop("checked")';
											message = 'Mục \"' + $('#label__id__checkBoxTiTle_' + $(this).attr('data-input-inputNo')).text() + '\" bắt buộc chọn.';
										}
										if(fieldsCheck)
										{
											fieldsCheck = '\n\t\t\t\t\tif(' + fieldsCheck + ')\n\t\t\t\t\t\tthrow new Error(\'' + '<br><label style="font-weight: bold; font-size: 14px">Thông tin nhập vào không đầy đủ hoặc sai. Vui lòng kiểm tra lại!<br><label style="color: red;">' + message + '</label></label><br>\');';
											fieldsCheckArr[i] = fieldsCheck;
											++i;
										}
									}
									_scriptForOther += '\n\t\tif($("#div__id__truongLuu_' + $(this).attr('data-input-inputNo') + '").length)\n\t\t{\n\t\t\t$("#div__id__truongLuu_' + $(this).attr('data-input-inputNo') + '").addClass("bounded_event_click");\n\t\t\t$("#div__id__truongLuu_' + $(this).attr('data-input-inputNo') + '").on("click", function(){\n\t\t\t\ttry\n\t\t\t\t{\n\t\t\t\t\tif($("#checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '").prop("checked"))\n\t\t\t\t\t\t$("#checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '").prop("checked", false);\n\t\t\t\t\telse\n\t\t\t\t\t\t$("#checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '").prop("checked", true);' + ($(this).attr('required') ? '\n\t\t\t\t\tvalidator.checkFieldForCheckBox($("#checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '"));' : '') + '\n\t\t\t\t\treturn true;\n\t\t\t\t}\n\t\t\t\tcatch(err)\n\t\t\t\t{\n\t\t\t\t\talert("Lỗi: " + err.stack + "!");\n\t\t\t\t\treturn false;\n\t\t\t\t}\n\t\t\t});\n\t\t}\n\n\t\tif($("#checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '").length)\n\t\t{\n\t\t\t$("#checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '").on("mousedown", function(){\n\t\t\t\ttry\n\t\t\t\t{\n\t\t\t\t\tif($("#div__id__truongLuu_' + $(this).attr('data-input-inputNo') + '").hasClass("bounded_event_click"))\n\t\t\t\t\t{\n\t\t\t\t\t\t$("#div__id__truongLuu_' + $(this).attr('data-input-inputNo') + '").unbind("click");\n\t\t\t\t\t\t$("#div__id__truongLuu_' + $(this).attr('data-input-inputNo') + '").removeClass("bounded_event_click");\n\t\t\t\t\t}\n\t\t\t\t\treturn true;\n\t\t\t\t}\n\t\t\t\tcatch(err)\n\t\t\t\t{\n\t\t\t\t\talert("Lỗi: " + err.stack + "!");\n\t\t\t\t\treturn false;\n\t\t\t\t}\n\t\t\t});\n\t\t\t$("#checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '").on("mouseout", function(){\n\t\t\t\tif(!$("#div__id__truongLuu_' + $(this).attr('data-input-inputNo') + '").hasClass("bounded_event_click"))\n\t\t\t\t{\n\t\t\t\t\t$("#div__id__truongLuu_' + $(this).attr('data-input-inputNo') + '").bind("click", function(e){\n\t\t\t\t\t\ttry\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\tif($("#checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '").prop("checked"))\n\t\t\t\t\t\t\t\t$("#checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '").prop("checked", false);\n\t\t\t\t\t\t\telse\n\t\t\t\t\t\t\t\t$("#checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '").prop("checked", true);' + ($(this).attr('required') ? '\n\t\t\t\t\tvalidator.checkFieldForCheckBox($("#checkBox__id__toolBox_checkBox_' + $(this).attr('data-input-inputNo') + '"));' : '') + '\n\t\t\t\t\t\t\treturn true;\n\t\t\t\t\t\t}\n\t\t\t\t\t\tcatch(err)\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\talert("Lỗi: " + err.stack + "!");\n\t\t\t\t\t\t\treturn false;\n\t\t\t\t\t\t}\n\t\t\t\t\t});\n\t\t\t\t\t$("#div__id__truongLuu_' + $(this).attr('data-input-inputNo') + '").addClass("bounded_event_click");\n\t\t\t\t}\n\t\t\t\treturn true;\n\t\t\t});\n\t\t\}';
									break;
								case 'file':
									fieldsDefine += '\n\t\t\t\t\tvar _' + (++countField) + ' = $("#file__id__toolBox_file_' + $(this).attr('data-input-inputNo') + '");';
									formData += '\n\t\t\t\t\tif(_' + countField + '.prop("files").length >= 1)\n\t\t\t\t\t{\n\t\t\t\t\t\tformData.append("_' + countField + '", ["_' + countField + '", "|", $("#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo') + '").text(), "|", "file", "|", "file", "|", "file__id__toolBox_file_' + $(this).attr('data-input-inputNo') + '"]);\n\t\t\t\t\t\tif(_' + countField + '.prop("files").length > 1)\n\t\t\t\t\t\t\tfor(i = 0; i < _' + countField + '.prop("files").length; ++i)\n\t\t\t\t\t\t\t\tformData.append("_file_' + countField + '[]", _' + countField + '.prop("files")[i]);\n\t\t\t\t\t\telse\n\t\t\t\t\t\t\tformData.append("_file_' + countField + '", _' + countField + '.prop("files")[0]);\n\t\t\t\t\t}\n\t\t\t\t\telse\n\t\t\t\t\t\tformData.append("_' + countField + '", ["_' + countField + '", "|", $("#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo') + '").text(), "|", "file", "|", "", "|", "file__id__toolBox_file_' + $(this).attr('data-input-inputNo') + '"]);';
									fieldsCheck = '';
									if(typeof $(this).attr('required') !== typeof undefined)
										{
											if($('#div__id__truongLuu_' + $(this).attr('data-input-inputNo')).hasClass('bad'))
											validator.unmark($(this));
											fieldsCheck = '!_' + countField + '.prop("files").length';
											message = 'Trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" bắt buộc chọn file.';
										}
										if(fieldsCheck)
										{
											fieldsCheck = '\n\t\t\t\t\tif(' + fieldsCheck + ')\n\t\t\t\t\t\tthrow new Error(\'' + '<br><label style="font-weight: bold; font-size: 14px">Thông tin nhập vào không đầy đủ hoặc sai. Vui lòng kiểm tra lại!<br><label style="color: red;">' + message + '</label></label><br>\');';
											fieldsCheckArr[i] = fieldsCheck;
											++i;
										}
									break;
								case 'combobox': 
									fieldsDefine += '\n\t\t\t\t\tvar _' + (++countField) + ' = $("#comboBox__id__toolBox_comboBox_' + $(this).attr('data-input-inputNo') + '");';
									formData += '\n\t\t\t\t\tformData.append("_' + countField +'", ["_' + countField + '", "|", $("#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo') + '").text(), "|", "combobox", "|", $("#comboBox__id__toolBox_comboBox_' + $(this).attr('data-input-inputNo') + '").val(), "|", "comboBox__id__toolBox_comboBox_' + $(this).attr('data-input-inputNo') + '"]);';
									fieldsCheckArr[i] = '\n\t\t\t\t\tif(!_' + countField + '.children().length)\n\t\t\t\t\t\tthrow new Error(\'' + '<br><label style="font-weight: bold; font-size: 14px">Danh sách lựa chọn của trường \"' + $('#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo')).text() + '\" rỗng!</label><br>\');';
									++i;
									break;
								case 'datetimepicker': 
									fieldsDefine += '\n\t\t\t\t\tvar _' + (++countField) + ' = $("#datetimePicker__id__toolBox_datetimePicker_' + $(this).attr('data-input-inputNo') + '");';
									formData += '\n\t\t\t\t\tformData.append("_' + countField +'", ["_' + countField + '", "|", $("#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo') + '").text(), "|", "datetimepicker", "|", _' + countField + '.val(), "|", "datetimePicker__id__toolBox_datetimePicker_' + $(this).attr('data-input-inputNo') + '"]);';
									_scriptForOther += '\n\t\tif($("#div__id__datetimePicker_' + $(this).attr('data-input-inputNo') + '").length)\n\t\t\t$("#div__id__datetimePicker_' + $(this).attr('data-input-inputNo') + '").datetimepicker({\n\t\t\t\tformat: "' + $('#datetimePicker__id__toolBox_datetimePicker_' + $(this).attr('data-input-inputNo')).attr('data-textBox-formatDate') + '",\n\t\t\t\tallowInputToggle: true,\n\t\t\t\t';
									maxDate = '';
									minDate = '';
									object = $("#datetimePicker__id__toolBox_datetimePicker_" + $(this).attr('data-input-inputNo'));
									if(typeof object.attr('data-textBox-maxDate') !== typeof undefined && object.attr('data-textBox-maxDate'))
										maxDate = object.attr('data-textBox-maxDate');
									else if(typeof object.attr('data-textBox-maxDate_current') !== typeof undefined && object.attr('data-textBox-maxDate_current'))
										maxDate = object.attr('data-textBox-maxDate_current');
									if(typeof object.attr('data-textBox-minDate') !== typeof undefined && object.attr('data-textBox-minDate'))
										minDate = object.attr('data-textBox-minDate');
									else if(typeof object.attr('data-textBox-minDate_current') !== typeof undefined && object.attr('data-textBox-minDate_current'))
										minDate = object.attr('data-textBox-minDate_current');
									if(maxDate && minDate)
										_scriptForOther += 'date: "' + minDate + '",\n\t\t\t\tmaxDate: "' + maxDate + '",\n\t\t\t\tminDate: "' + minDate + '"\n\t\t\t});';
									else if(maxDate)
										_scriptForOther += 'date: "' + maxDate + '",\n\t\t\t\tmaxDate: "' + maxDate + '"\n\t\t\t});';
									else if(minDate)
										_scriptForOther += 'date: "' + minDate + '",\n\t\t\t\tminDate: "' + minDate + '"\n\t\t\t});';
									else
										_scriptForOther += 'date: new Date()\n\t\t\t});';
									break;
								case 'radio':
									if(typeof $(this).attr('data-input-inputCommonNo') === typeof undefined)
									{
										fieldsDefine += '\n\t\t\t\t\tvar _' + (++countField) + ' = $("#radio__id__toolBox_radio_' + $(this).attr('data-input-inputNo') + '");';

										formData += '\n\t\t\t\t\tfieldsId = "";\n\t\t\t\t\tfieldsVal = "";\n\t\t\t\t\tif(_' + countField + '.prop("checked"))\n\t\t\t\t\t{\n\t\t\t\t\t\tfieldsVal = $("#label__id__radioTiTle_" + $(this).attr("data-input-inputNo")).text();\n\t\t\t\t\t\tfieldsId = _' + countField + '.attr("id");\n\t\t\t\t\t}\n\t\t\t\t\tif($("[data-input-name=\'radio\'][data-input-inputCommonNo=\'' + $(this).attr('data-input-inputNo') + '\']").length)\n\t\t\t\t\t{\n\t\t\t\t\t\t$("[data-input-name=\'radio\'][data-input-inputCommonNo=\'' + $(this).attr('data-input-inputNo') + '\']").each(function(){\n\t\t\t\t\t\t\tif($(this).prop("checked"))\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\tfieldsVal = $("#label__id__radioTiTle_" + $(this).attr("data-input-inputNo")).text();\n\t\t\t\t\t\t\t\tfieldsId = $(this).attr("id");\n\t\t\t\t\t\t\t\treturn false;\n\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t});\n\t\t\t\t\t}\n\t\t\t\t\tformData.append("_' + countField + '", ["_' + countField + '", "|", $("#label__id__tenTruongBieuMau_' + $(this).attr('data-input-inputNo') + '").text(), "|", "radio", "|", fieldsVal, "|", fieldsId]);';
									}
									_scriptForOther += '\n\t\tif($("#div__id__truongLuu_' + $(this).attr('data-input-inputNo') + '").length)\n\t\t{\n\t\t\t$("#div__id__truongLuu_' + $(this).attr('data-input-inputNo') + '").addClass("bounded_event_click");\n\t\t\t$("#div__id__truongLuu_' + $(this).attr('data-input-inputNo') + '").on("click", function(){\n\t\t\t\ttry\n\t\t\t\t{\n\t\t\t\t\t$("#radio__id__toolBox_radio_' + $(this).attr('data-input-inputNo') + '").prop("checked", true);\n\t\t\t\t\treturn true;\n\t\t\t\t}\n\t\t\t\tcatch(err)\n\t\t\t\t{\n\t\t\t\t\talert("Lỗi: " + err.stack + "!");\n\t\t\t\t\treturn false;\n\t\t\t\t}\n\t\t\t});\n\t\t}';
									break;
								default:
									throw new Error('Input đã tạo không được hỗ trợ!');
							}
						});
						_date = _date.getTime().toString();
						$('#button__id__guiBieuMau').attr('id', 'button__id__guiBieuMau_' + _date);
						$('#button__id__huyGuiBieuMau').attr('id', 'button__id__huyGuiBieuMau_' + _date);
						fieldsCheck = '';
						for(i = 0; i < fieldsCheckArr.length; ++i)
							fieldsCheck += fieldsCheckArr[i];
						_scriptForSubMitButton = '\n\t\tif($("#button__id__guiBieuMau_' + _date + '").length)\n\t\t\t$("#button__id__guiBieuMau_' + _date + '").on("click", function(){\n\t\t\t\ttry\n\t\t\t\t{' + fieldsDefine + '\n\t\t\t\t\tvar formData = null;\n\t\t\t\t\tvar i = 0;\n\t\t\t\t\tvar fieldsId = new Array();\n\t\t\t\t\tvar fieldsVal = new Array();' + fieldsCheck  + '\n\t\t\t\t\tformData =  new FormData();' + formData + '\n\t\t\t\t\t$.ajax({\n\t\t\t\t\t\ttype: "POST",\n\t\t\t\t\t\tdataType: "JSON",\n\t\t\t\t\t\turl: "/QLHTSV/Common/bieu_mau/tao_bieu_mau_xml",\n\t\t\t\t\t\txhr: function(){\n\t\t\t\t\t\t\t\t\treturn $.ajaxSettings.xhr();\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\tcache: false,\n\t\t\t\t\t\tcontentType: false,\n\t\t\t\t\t\tprocessData: false,\n\t\t\t\t\t\tdata: formData,\n\t\t\t\t\t\tsuccess: function(data){\n\t\t\t\t\t\t\ttry\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\tif(!data.flag)\n\t\t\t\t\t\t\t\t\tthrow new Error(data.error);\n\t\t\t\t\t\t\t\telse\n\t\t\t\t\t\t\t\t\talert("Gửi yêu cầu thành công!");\n\t\t\t\t\t\t\t\treturn true;\n\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\tcatch(err)\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\talert("Gửi yêu cầu thất bại! Lỗi: " + err.stack + "!");\n\t\t\t\t\t\t\t\treturn false;\n\t\t\t\t\t\t\t}\n\t\t\t\t\t\t},\n\t\t\t\t\t\terror: function(jqXHR, textStatus, errorThrown){\n\t\t\t\t\t\t\ttry\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\tif(jqXHR.status == 419)\n\t\t\t\t\t\t\t\t\tthrow new Error("Người dùng không được xác thực (có thể đã đăng xuất hoặc có thể do cookie hoặc session đã bị xoá). Mô tả: " + jqXHR.responseText + " ; " + textStatus + " ; " + errorThrown);\n\t\t\t\t\t\t\t\telse if(jqXHR.status == 500)\n\t\t\t\t\t\t\t\t\tthrow new Error("Đã phát hiện lỗi trên máy chủ phục vụ. Mô tả: " + jqXHR.responseText + " ; " + textStatus + " ; " + errorThrown);\n\t\t\t\t\t\t\t\telse\n\t\t\t\t\t\t\t\t\tthrow new Error("Lỗi server: " + jqXHR.responseText + " ; " + textStatus + " ; " + errorThrown);\n\t\t\t\t\t\t\t\treturn true;\n\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\tcatch(err)\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\talert("Gửi yêu cầu thất bại! Lỗi: " + err.stack + "!");\n\t\t\t\t\t\t\t\treturn false;\n\t\t\t\t\t\t\t}\n\t\t\t\t\t\t}\n\t\t\t\t\t});\n\t\t\t\t}\n\t\t\t\tcatch(err)\n\t\t\t\t{\n\t\t\t\t\talert("Lỗi: " + err.stack + "!");\n\t\t\t\t\treturn false;\n\t\t\t\t}\n\t\t\t});';
						_scriptForSubMitButton += _scriptForOther;
						formContent += '\n\t\t' + $('#div__id__noiDungBMXML').html() + '\n\t\t</form>';
					}
					else
						throw new Error('Không tồn tại ít nhất một trường nào để tạo biểu mẫu!');
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