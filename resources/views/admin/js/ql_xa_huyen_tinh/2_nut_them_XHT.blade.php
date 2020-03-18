<script>
$(function(){
	try
	{
		/*click button thêm tỉnh*/
		if($('#button__id__them').length)
			$('#button__id__them').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhat').attr('data-original-title', 'Thêm mới');
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

		/*click button thêm huyện*/
		if($('#button__id__themHuyen').length)
			$('#button__id__themHuyen').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhatHuyen').attr('data-original-title', 'Thêm mới');
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

		/*click button thêm xã*/
		if($('#button__id__themXa').length)
			$('#button__id__themXa').on('click', function(){
				try
				{
					$('#button__id__capNhatXa').attr('data-original-title', 'Thêm mới');
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