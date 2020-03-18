<script>
$(function(){
	try
	{
		/*click button đóng danh sách đánh giá trường*/
		if($('#button__id__dongDanhSachDGT').length)
			$('#button__id__dongDanhSachDGT').on('click', function(){
				try
				{
					$('#div__id__DGT').slideUp(800);
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