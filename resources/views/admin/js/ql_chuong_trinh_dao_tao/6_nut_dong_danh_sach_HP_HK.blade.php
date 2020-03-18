<script>
$(function(){
	try
	{
		/*click button đóng danh sách học phần học kỳ*/
		if($('#button__id__dongDanhSachHPHK').length)
			$('#button__id__dongDanhSachHPHK').on('click', function(){
				try
				{
					$('#div__id__formHPHK').slideUp(800);
					$('#div__id__danhSachHPHK').slideUp(800);
					$('html, body').animate({
		                scrollTop: $('html').offset().top
		            }, 800);
		            return true;
				}
	            catch(err)
				{
					alert("Lỗi: " + err.stack + "!");
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