<script>
$(function(){
	try
	{
		/*click button đóng TCDGGD*/
		if($('#button__id__huy').length)
			$('#button__id__huy').on('click', function(){
	            try
	            {
	            	$('#div__id__formTCDGGD').slideUp(800);
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