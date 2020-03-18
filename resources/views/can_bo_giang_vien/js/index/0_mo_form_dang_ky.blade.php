<script>
$(function(){
	try
	{
		/*click button mở form đăng ký trên thông báo cấp trường*/
		if($('#div__id__thongBaoTruong').length)
			$('#div__id__thongBaoTruong').on('click', '[data-button-id="button__data-button-id__dangKy"]', function(){
	            try
	            {
		            $('#div__id__bieuMauDangXML').slideDown(800);
		            $('html, body').animate({
		                scrollTop: $("#div__id__bieuMauDangXML").offset().top
		            }, 800);
		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click button mở form đăng ký trên thông báo cấp khoa*/
		if($('#div__id__thongBaoKhoa').length)
			$('#div__id__thongBaoKhoa').on('click', '[data-button-id="button__data-button-id__dangKy"]', function(){
	            try
	            {
		            $('#div__id__bieuMauDangXML').slideDown(800);
		            $('html, body').animate({
		                scrollTop: $("#div__id__bieuMauDangXML").offset().top
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