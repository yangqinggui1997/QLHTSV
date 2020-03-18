<script>
$(function(){
	try
	{
		/*click button thêm*/
		if($('#button__id__themHPHK').length)
			$('#button__id__themHPHK').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhatHPHK').attr('data-original-title', 'Thêm mới');
		            $('#div__id__formHPHK').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__formHPHK").offset().top
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