<script>
$(function(){
	try
	{
		/*click button mở danh sách xem chương trình đào tạo của học phần*/
		if($('#tbody__id__TCDGCT').length)
		{
			$('#tbody__id__TCDGCT').on('click', '[data-button-id="xemCTCTCDGCT"]', function()
			{
				try
	            {
		            $('#div__id__danhSachCTCTCDGCT').slideDown(800);
		            $('html, body').animate({
		                scrollTop: $("#div__id__danhSachCTCTCDGCT").offset().top
		            }, 800);
	            	return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
		}
		
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>