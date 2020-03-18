<script>
$(function(){
	try
	{
		/*click button đóng danh sách chương trình đào tạo*/
		if($('#button__id__huy').length)
			$('#button__id__huy').on('click', function(){
	            try
	            {
		            $('#div__id__formCTDT').slideUp(800);
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

		/*click button đóng danh sách học phần học kỳ*/
		if($('#button__id__huyHPHK').length)
			$('#button__id__huyHPHK').on('click', function(){
	            try
	            {
		            $('#div__id__formHPHK').slideUp(800);
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