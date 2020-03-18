<script>
$(function(){
	try
	{
		/*Click nút thêm lựa chọn khi tạo trường là Combo box hoặc Datalist*/
		if($('#button__id__themLuaChon').length)
			$('#button__id__themLuaChon').on('click', function(){
				try
				{
					var addAfterElement = '';
					var orderRetrieve = {'val' : 0};
					var order = 0; 
					if(!$('#textBox__id__themLuaChon').val().trim())
					{
						throw new Error('Hãy nhập tên lựa chọn vào!');
					}
					if(!$('[data-div-comboBox_datalist-no]').length)
					{
						++order;
						addAfterElement = '#div__id__comboBox_datalist';
					}
					else
					{
						if(!sortOption($('[data-label-comboBox_datalist-no]'), orderRetrieve))
							return false;
						order = orderRetrieve.val;
						addAfterElement = $('[data-div-comboBox_datalist-no]')[$('[data-div-comboBox_datalist-no]').length - 1];
					}
					$('<div class="row form-group" data-div-comboBox_datalist-no="' + order + '" data-div-fieldDeleted>\n\t\t<div class="col-md-1 col-sm-1 col-xs-12">\n\t\t</div>\n\t\t<div class="col-md-5 col-sm-5 col-xs-12 text-right">\n\t\t<label data-label-comboBox_datalist-no="' + order + '"> Lựa chọn ' + (order < 10 ? ('0' + order) : order) + '.</label>\n\t\t</div>\n\t\t<div class="col-md-5 col-sm-5 col-xs-12">\n\t\t<input type="text" class="form-control" data-textBox-id="textBox__data-textBox-id__themLuaChon" value="' + $('#textBox__id__themLuaChon').val() + '" required>\n\t\t</div>\n\t\t<div class="col-md-1 col-sm-1 col-xs-12">\n\t\t<button type="button" class="btn btn-sm btn-danger" data-button-id="button__data-button-id__xoaLuaChon" data-button-comboBox_datalist-no="' + order + '">\n\t\t<i class="glyphicon glyphicon-remove"></i>\n\t\t</button>\n\t\t</div>\n\t\t</div>').insertAfter(addAfterElement);
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