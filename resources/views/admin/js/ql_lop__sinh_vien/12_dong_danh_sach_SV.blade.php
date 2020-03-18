<script>
$(function(){
	try
	{
		/*click button đóng danh sách sinh viên*/
		if($('#button__id__dongDanhSachSV').length)
			$('#button__id__dongDanhSachSV').on('click', function(){
				try
				{
					$('#div__id__ketQuaHTRL').slideUp(800);
					$('#div__id__formSinhVien').slideUp(800);
		            $('#div__id__danhSachSV').slideUp(800);
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