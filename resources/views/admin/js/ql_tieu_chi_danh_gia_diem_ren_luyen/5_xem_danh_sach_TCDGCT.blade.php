<script>
$(function(){
	try
	{
		/*click button xem danh sách TCDGCT*/
		if($('#tbody__id__TCDG').length)
			$('#tbody__id__TCDG').on('click', '[data-button-id="xemCT"]', function(){
	            try
	            {
		            $('#div__id__danhSachTCDGCT').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__danhSachTCDGCT").offset().top
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