<script>
$(function(){
	try
	{
		/*click button đóng form biểu mẫu dạng file*/
		if($('#button__id__huyBieuMauDangFile').length)
			$('#button__id__huyBieuMauDangFile').on('click', function(){
	            try
	            {
		            $('#div__id__formBieuMauDangFile').slideUp(800);
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

		/*click button đóng form biểu mẫu dạng xml*/
		if($('#button__id__huyBieuMauDangXML').length)
			$('#button__id__huyBieuMauDangXML').on('click', function(){
	            try
	            {
		            $('#div__id__formBieuMauDangXML').slideUp(800);
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