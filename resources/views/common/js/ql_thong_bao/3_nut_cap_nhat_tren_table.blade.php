<script>
$(function(){
	try
	{
		/*click button cập nhật*/
		if($('#tbody__id__thongBao').length)
			$('#tbody__id__thongBao').on('click', '[data-button="sua"]', function(){
	            try
	            {
		            $('#button__id__capNhat').attr('data-original-title', 'Cập nhật');
		            $('#div__id__formThongBao').slideDown(800);
		            $('html, body').animate({
		                scrollTop: $("#div__id__formThongBao").offset().top
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