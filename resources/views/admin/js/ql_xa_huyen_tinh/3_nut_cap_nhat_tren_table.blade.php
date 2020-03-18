<script>
$(function(){
	try
	{
		/*click button cập nhật tỉnh*/
		if($('#tbody__id__tinh').length)
			$('#tbody__id__tinh').on('click', '[data-button="sua"]', function(){
	            try
	            {
					$('#button__id__capNhat').attr('data-original-title', 'Cập nhật');
		            $('#div__id__formTinh').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__formTinh").offset().top
		            }, 800);
	            	return true;
	            }
	            catch(err)
				{
					alert("Lỗi: " + err.stack + "!");
					return false;
				}
			});

		/*click button cập nhật huyện*/
		if($('#tbody__id__huyen').length)
			$('#tbody__id__huyen').on('click', '[data-button="sua"]', function(){
	            try
	            {
					$('#button__id__capNhatHuyen').attr('data-original-title', 'Cập nhật');
		            $('#div__id__formHuyen').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__formHuyen").offset().top
		            }, 800);
		            return true;
	            }
	            catch(err)
				{
					alert("Lỗi: " + err.stack + "!");
					return false;
				}
			});

		/*click button cập nhật xã*/
		if($('#tbody__id__xa').length)
			$('#tbody__id__xa').on('click', '[data-button="sua"]', function(){
				try
				{
					$('#button__id__capNhatXa').attr('data-original-title', 'Cập nhật');
		            $('#div__id__formXa').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__formXa").offset().top
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