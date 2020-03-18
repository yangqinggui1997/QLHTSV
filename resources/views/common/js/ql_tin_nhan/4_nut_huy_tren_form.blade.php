<script>
$(function(){
	try
	{
		/*click button đóng*/
		if($('#button__id__huy').length)
			$('#button__id__huy').on('click', function(){
	            try
	            {
		            $('#div__id__formTinNhan').slideUp(800);
		            $('html, body').animate({
		                scrollTop: $('html').offset().top
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