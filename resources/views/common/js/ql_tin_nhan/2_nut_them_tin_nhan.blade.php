<script>
$(function(){
	try
	{
		/*click button thêm*/
		if($('#button__id__them').length)
			$('#button__id__them').on('click', function(){
	            try
	            {
	            	$('#h2__id__tieuDeFormTN').text('TIN NHẮN MỚI');
	            	$('#button__id__lamMoi').attr('data-button-command', 'them');
	            	$('#button__id__lamMoi').trigger('click');
		            $('#div__id__formTinNhan').slideDown(800);
		            $('html, body').animate({
		                scrollTop: $("#div__id__formTinNhan").offset().top
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