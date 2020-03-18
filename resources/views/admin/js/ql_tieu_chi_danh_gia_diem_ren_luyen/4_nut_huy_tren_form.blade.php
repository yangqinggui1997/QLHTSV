<script>
$(function(){
	try
	{
		/*click button đóng TCDG*/
		if($('#button__id__huy').length)
			$('#button__id__huy').on('click', function(){
	            try
	            {
	            	$('#div__id__formTCDG').slideUp(800);
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
		
		/*click button đóng TCDGCT*/
		if($('#button__id__huyTCDGCT').length)
			$('#button__id__huyTCDGCT').on('click', function(){
				try
				{
					$('#div__id__formTCDGCT').slideUp(800);
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

		/*click button đóng CTCTCDGCT*/
		if($('#button__id__huyCTCTCDGCT').length)
			$('#button__id__huyCTCTCDGCT').on('click', function(){
				try
				{
					$('#div__id__formCTCTCDGCT').slideUp(800);
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