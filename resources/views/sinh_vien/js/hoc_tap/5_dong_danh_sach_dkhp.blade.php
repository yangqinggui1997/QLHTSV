<script>
$(function(){
	try
	{
		/*click button đóng danh sách đăng ký học phần*/
		if($('#button__id__dongDanhSachDKHP').length)
			$('#button__id__dongDanhSachDKHP').on('click', function(){
				try
				{
					$('#div__id__dangKyHP').slideUp(800);
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