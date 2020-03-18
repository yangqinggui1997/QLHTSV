<script>
$(function(){
	try
	{
		/*click button thêm TCDGT*/
		if($('#button__id__them').length)
			$('#button__id__them').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhat').attr('data-original-title', 'Thêm mới');
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