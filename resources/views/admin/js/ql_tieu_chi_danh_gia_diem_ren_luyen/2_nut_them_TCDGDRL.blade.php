<script>
$(function(){
	try
	{
		/*click button thêm TCDG*/
		if($('#button__id__them').length)
			$('#button__id__them').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhat').attr('data-original-title', 'Thêm mới');
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

		/*click button thêm TCDGCT*/
		if($('#button__id__themTCDGCT').length)
			$('#button__id__themTCDGCT').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhatTCDGCT').attr('data-original-title', 'Thêm mới');
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

		/*click button thêm CTCTCDGCT*/
		if($('#button__id__themCTCTCDGCT').length)
			$('#button__id__themCTCTCDGCT').on('click', function(){
				try
				{
					$('#button__id__capNhatCTCTCDGCT').attr('data-original-title', 'Thêm mới');
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