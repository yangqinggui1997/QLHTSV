<script>
$(function(){
	try
	{
		/*click button đóng form lớp*/
		if($('#button__id__huyLop').length)
			$('#button__id__huyLop').on('click', function(){
	            try
	            {
		            $('#div__id__formLop').slideUp(800);
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
		
		/*click button đóng form sinh viên*/
		if($('#button__id__huySV').length)
			$('#button__id__huySV').on('click', function(){
	            try
	            {
		            $('#div__id__formSinhVien').slideUp(800);
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