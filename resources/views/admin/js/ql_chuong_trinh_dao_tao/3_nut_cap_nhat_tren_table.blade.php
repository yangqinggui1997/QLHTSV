<script>
$(function(){
	try
	{
		/*click button cập nhật chương trình đào tạo*/
		if($('#tbody__id__ctdt').length)
			$('#tbody__id__ctdt').on('click', '[data-button="sua"]', function(){
				try
	            {
					$('#button__id__capNhat').attr('data-original-title', 'Cập nhật');
		            $('#div__id__formCTDT').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__formCTDT").offset().top
		            }, 800);
		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click button cập nhật học phần học hỳ*/
		if($('#tbody__id__hocPhanHK').length)
			$('#tbody__id__hocPhanHK').on('click', '[data-button="sua"]', function(){
				try
	            {
					$('#button__id__capNhatHPHK').attr('data-original-title', 'Cập nhật');
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