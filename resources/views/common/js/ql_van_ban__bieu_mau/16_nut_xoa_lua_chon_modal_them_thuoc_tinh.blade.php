<script>
$(function(){
	try
	{
		if($('#div__id__modalBodyThemThuocTinh').length)
			/*Click nút xoá lựa chọn khi tạo trường là Combo box hoặc Datalist*/
			$('#div__id__modalBodyThemThuocTinh').on('click', '[data-button-id="button__data-button-id__xoaLuaChon"]', function(){
				try
				{
					$('[data-div-comboBox_datalist-no="' + $(this).attr('data-button-comboBox_datalist-no') + '"]').remove();
					if(!sortOption($('[data-label-comboBox_datalist-no]'), {'val': 0}))
						return false;
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