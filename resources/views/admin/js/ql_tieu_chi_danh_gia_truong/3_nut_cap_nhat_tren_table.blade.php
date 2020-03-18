<script>
$(function(){
	try
	{
		/*click button cập nhật TCDGT*/
		if($('#tbody__id__tcdgt').length)
			$('#tbody__id__tcdgt').on('click', '[data-button="sua"]', function(){
	            try
	            {
					$('#button__id__capNhat').attr('data-original-title', 'Cập nhật');
		            $('#div__id__formTCDGT').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__formTCDGT").offset().top
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