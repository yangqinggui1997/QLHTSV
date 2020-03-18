<script>
$(function(){
	try
	{
		/*Click nút huỷ thêm trường mới vào form*/
		if($('#button__id__huyTruong').length)
			$('#button__id__huyTruong').on('click', function(){
				try
	            {
	            	$('#textBox__id__tenTruongBieuMau').val('');
	            	$('[data-radio-controlKhoiTao]').each(function(){
						if($(this).prop('checked'))
						{
							$(this).parent().removeClass('active');
							$(this).prop('checked', false);
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
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>