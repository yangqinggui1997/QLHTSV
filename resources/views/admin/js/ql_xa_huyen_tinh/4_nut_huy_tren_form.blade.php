<script>
$(function(){
	try
	{
		/*click button đóng tỉnh*/
		if($('#button__id__huy').length)
			$('#button__id__huy').on('click', function(){
	            try
	            {
	            	$('#div__id__formTinh').slideUp(800);
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
		
		/*click button đóng huyện*/
		if($('#button__id__huyHuyen').length)
			$('#button__id__huyHuyen').on('click', function(){
				try
				{
					$('#div__id__formHuyen').slideUp(800);
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

		/*click button đóng xã*/
		if($('#button__id__huyXa').length)
			$('#button__id__huyXa').on('click', function(){
				try
				{
					$('#div__id__formXa').slideUp(800);
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