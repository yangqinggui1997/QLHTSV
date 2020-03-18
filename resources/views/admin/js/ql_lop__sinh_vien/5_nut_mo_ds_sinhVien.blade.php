<script>
$(function(){
	try
	{
		/*click button mở danh sách xem chương trình đào tạo của học phần*/
		if($('#tbody__id__lop').length)
			$('#tbody__id__lop').on('click', '[data-button-id="xemDanhSachSV"]', function(){
				try
	            {
		            $('#div__id__danhSachSV').slideDown(800);
		            $('html, body').animate({
		                scrollTop: $("#div__id__danhSachSV").offset().top
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