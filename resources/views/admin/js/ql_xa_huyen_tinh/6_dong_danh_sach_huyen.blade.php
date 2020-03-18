<script>
$(function(){
	try
	{
		/*click button đóng danh sách Huyen*/
		if($('#button__id__dongDanhSachHuyen').length)
			$('#button__id__dongDanhSachHuyen').on('click', function(){
				try
				{
					$('#button__id__dongDanhSachXa').trigger('click');
					$('#div__id__danhSachHuyen').slideUp(800);
		            $('#div__id__formHuyen').slideUp(800);
					$('html, body').animate({
		                scrollTop: $('html').offset().top
		            }, 800);
		            return true;
				}
	            catch(err)
				{
					alert("Lỗi: " + err.stack + "!");
					return false;
				}
			});

		/*click button đóng danh sách xã*/
		if($('#button__id__dongDanhSachXa').length)
			$('#button__id__dongDanhSachXa').on('click', function(){
				try
				{
					$('#div__id__danhSachXa').slideUp(800);
		            $('#div__id__formXa').slideUp(800);
					$('html, body').animate({
		                scrollTop: $('html').offset().top
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