<script>
$(function(){
	try
	{
		/*click button đóng danh sách TCDGCT*/
		if($('#button__id__dongDanhSachTCDGCT').length)
			$('#button__id__dongDanhSachTCDGCT').on('click', function(){
				try
				{
					$('#button__id__dongDanhSachTCDGCTCCT').trigger('click');
					$('#div__id__danhSachTCDGCT').slideUp(800);
		            $('#div__id__formTCDGCT').slideUp(800);
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

		/*click button đóng danh sách TCDGCTCCT*/
		if($('#button__id__dongDanhSachTCDGCTCCT').length)
			$('#button__id__dongDanhSachTCDGCTCCT').on('click', function(){
				try
				{
					$('#div__id__danhSachCTCTCDGCT').slideUp(800);
		            $('#div__id__formCTCTCDGCT').slideUp(800);
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