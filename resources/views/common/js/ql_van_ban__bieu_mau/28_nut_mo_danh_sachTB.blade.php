<script>
$(function(){
	try
	{
		/*click button mở danh sách thông báo của biểu mẫu*/
		function moDanhSachTB()
		{
			try
            {
	            $('#div__id__danhSachTBCBM').slideDown(800);
				$('html, body').animate({
	                scrollTop: $("#div__id__danhSachTBCBM").offset().top
	            }, 800);
	            return true;
            }
            catch(err)
			{
				alert('Lỗi: ' + err.stack + '!');
				return false;
			}
		}

		if($('#tbody__id__bieuMauDangFile').length)
			$('#tbody__id__bieuMauDangFile').on('click', '[data-button="xemTBCBieuMauDangFile"]', moDanhSachTB);

		if($('#tbody__id__bieuMauDangXML').length)
			$('#tbody__id__bieuMauDangXML').on('click', '[data-button="xemTBCBieuMauDangXML"]', moDanhSachTB);
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>