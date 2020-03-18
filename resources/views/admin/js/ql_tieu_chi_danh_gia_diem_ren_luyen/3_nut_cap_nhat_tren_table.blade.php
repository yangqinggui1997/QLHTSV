<script>
$(function(){
	try
	{
		/*click button cập nhật TCDG*/
		if($('#tbody__id__TCDG').length)
			$('#tbody__id__TCDG').on('click', '[data-button="sua"]', function(){
	            try
	            {
					$('#button__id__capNhat').attr('data-original-title', 'Cập nhật');
		            $('#div__id__formTCDG').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__formTCDG").offset().top
		            }, 800);
	            	return true;
	            }
	            catch(err)
				{
					alert("Lỗi: " + err.stack + "!");
					return false;
				}
			});

		/*click button cập nhật TCDGCT*/
		if($('#tbody__id__TCDGCT').length)
			$('#tbody__id__TCDGCT').on('click', '[data-button="suaTCDGCT"]', function(){
	            try
	            {
					$('#button__id__capNhatTCDGCT').attr('data-original-title', 'Cập nhật');
		            $('#div__id__formTCDGCT').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__formTCDGCT").offset().top
		            }, 800);
		            return true;
	            }
	            catch(err)
				{
					alert("Lỗi: " + err.stack + "!");
					return false;
				}
			});

		/*click button cập nhật CTCTCDGCT*/
		if($('#tbody__id__CTCTCDGCT').length)
			$('#tbody__id__CTCTCDGCT').on('click', '[data-button="suaCTCTCDGCT"]', function(){
				try
				{
					$('#button__id__capNhatCTCTCDGCT').attr('data-original-title', 'Cập nhật');
		            $('#div__id__formCTCTCDGCT').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__formCTCTCDGCT").offset().top
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