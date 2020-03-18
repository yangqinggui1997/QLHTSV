<script>
$(function(){
	try
	{
		/*click button mở danh sách xem chương trình đào tạo của học phần*/
		if($('#tbody__id__hocPhan').length)
			$('#tbody__id__hocPhan').on('click', '[data-button-id="xemNganhDaoTao"]', function(){
				try
	            {
		            $('#div__id__danhSachCTDT').slideDown(800);
		            $('html, body').animate({
		                scrollTop: $("#div__id__danhSachCTDT").offset().top
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