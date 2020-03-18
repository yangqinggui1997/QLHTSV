<script>
$(function(){
	try
	{
		/*click button thêm biểu mẫu dạng file*/
		if($('#button__id__themBieuMauDangFile').length)
			$('#button__id__themBieuMauDangFile').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhatBieuMauDangFile').attr('data-original-title', 'Thêm mới');
	            	$('#button__id__capNhatBieuMauDangFile').attr('data-button-loaiBM', 'bieuMauDangFile');
	            	$('#h2__id__tieuDeFormBM').text('THÔNG TIN BIỂU MẪU DẠNG FILE');
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

		/*click button thêm văn bản*/
		if($('#button__id__themVanBan').length)
			$('#button__id__themVanBan').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhatBieuMauDangFile').attr('data-original-title', 'Thêm mới');
	            	$('#button__id__capNhatBieuMauDangFile').attr('data-button-loaiBM', 'vanBan');
	            	$('#h2__id__tieuDeFormBM').text('THÔNG TIN VĂN BẢN');
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

		/*click button thêm biểu mẫu dạng xml*/
		if($('#button__id__themBieuMauDangXML').length)
			$('#button__id__themBieuMauDangXML').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhatBieuMauDangXML').attr('data-original-title', 'Thêm mới');
	            	$('#button__id__capNhatBieuMauDangFile').attr('data-button-loaiBM', 'bieuMauDangXML');
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