<script>
$(function(){
	try
	{
		/*click button xem danh sách Huyen*/
		if($('#tbody__id__tinh').length)
			$('#tbody__id__tinh').on('click', '[data-button="xemHuyen"]', function(){
	            try
	            {
		            $('#div__id__danhSachHuyen').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__danhSachHuyen").offset().top
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