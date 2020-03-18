<script>
$(function(){
	try
	{
		/*click button thêm*/
		if($('#button__id__them').length)
			$('#button__id__them').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhat').attr('data-original-title', 'Thêm mới');
		            $('#div__id__formSinhVien').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__formSinhVien").offset().top
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