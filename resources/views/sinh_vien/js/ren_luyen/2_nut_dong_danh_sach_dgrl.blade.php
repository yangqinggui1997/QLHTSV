<script>
$(function(){
	try
	{
		/*click button đóng danh sách đánh giá rèn luyện*/
		if($('#button__id__dongDanhSachdDGRL').length)
			$('#button__id__dongDanhSachdDGRL').on('click', function(){
				try
				{
					$('#div__id__danhGiaRL').slideUp(800);
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