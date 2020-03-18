<script>
$(function(){
	try
	{
		/*click button mở danh sách học phần của học kỳ*/
		if($('#tbody__id__ctdt').length)
			$('#tbody__id__ctdt').on('click', '[data-button="xemHPHK"]', function(){
				try
	            {
		            $('#div__id__danhSachHPHK').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__danhSachHPHK").offset().top
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