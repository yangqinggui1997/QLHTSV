<script>
$(function(){
	try
	{
		/*click button đóng danh sách đánh giá giảng dạy*/
		if($('#button__id__dongDanhSachDGGD').length)
			$('#button__id__dongDanhSachDGGD').on('click', function(){
				try
				{
					$('#div__id__danhGiaGD').slideUp(800);
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