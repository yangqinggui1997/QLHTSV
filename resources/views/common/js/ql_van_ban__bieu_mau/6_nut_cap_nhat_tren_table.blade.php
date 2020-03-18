<script>
$(function(){
	try
	{
		/*click button cập nhật biểu mẫu dạng file*/
		if($('#table__id__bieuMauDangFile').length)
			$('#table__id__bieuMauDangFile').on('click', '[data-button="suaBieuMauDangFile"]', function(){
				try
	            {
	            	$('#button__id__capNhatBieuMauDangFile').attr('data-original-title', 'Cập nhật');
	            	if($(this).attr('data-button-loaibm') === 'vanBan')
	            	{
	            		$('#button__id__capNhatBieuMauDangFile').attr('data-button-loaiBM', 'vanBan');
	            		$('#h2__id__tieuDeFormBM').text('THÔNG TIN VĂN BẢN');
	            	}
	            	else
	            	{
	            		$('#button__id__capNhatBieuMauDangFile').attr('data-button-loaiBM', 'bieuMauDangFile');
	            		$('#h2__id__tieuDeFormBM').text('THÔNG TIN BIỂU MẪU DẠNG FILE');
	            	}
		            $('#div__id__formBieuMauDangFile').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__formBieuMauDangFile").offset().top
		            }, 800);
		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click button cập nhật biểu mẫu dạng xml*/
		if($('#table__id__bieuMauDangXML').length)
			$('#table__id__bieuMauDangXML').on('click', '[data-button="suaBieuMauDangXML"]', function(){
				try
	            {
	            	$('#button__id__capNhatBieuMauDangXML').attr('data-original-title', 'Cập nhật');
		            $('#div__id__formBieuMauDangXML').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__formBieuMauDangXML").offset().top
		            }, 800);
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