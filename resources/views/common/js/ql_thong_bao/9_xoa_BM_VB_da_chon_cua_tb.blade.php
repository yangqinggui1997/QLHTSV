<script>
$(function(){
	try
	{
		/*click button xoá biểu mẫu đã chọn của thông báo*/
		if($('#button__id__removeBieuMauDinhKemDaChon').length)
			$('#button__id__removeBieuMauDinhKemDaChon').on('click', function(){
	            try
	            {
	            	if($('#select__id__bieuMauDinhKemDaChon').children().length)
			            $('[data-option-id="' + $('#select__id__bieuMauDinhKemDaChon').val() + '"]').remove();
	            	return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click button xoá văn bản đã chọn của thông báo*/
		if($('#button__id__removeVanBanDinhKemDaChon').length)
			$('#button__id__removeVanBanDinhKemDaChon').on('click', function(){
	            try
	            {
	            	if($('#select__id__vanBanDinhKemDaChon').children().length)
			            $('[data-option-id="' + $('#select__id__vanBanDinhKemDaChon').val() + '"]').remove();
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