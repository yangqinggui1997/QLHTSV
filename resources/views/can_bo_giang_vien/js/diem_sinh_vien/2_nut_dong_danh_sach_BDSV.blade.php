<script>
$(function(){
	try
	{
		/*click button đóng bảng điểm sinh viên*/
		if($('#button__id__dongDanhSach').length)
			$('#button__id__dongDanhSach').on('click', function(){
				try
				{
					if($('#tbody__id__bangDiemSV').find('.editable-unsaved').length)
						confirm("Dữ liệu chưa được lưu. Bạn có chắc chắn muốn đóng?", function(){
							$('#div__id__bangDiemSV').slideUp(800);
							$('html, body').animate({
				                scrollTop: $('html').offset().top
				            }, 800);
						}, function(){return;});
					else
					{
						$('#div__id__bangDiemSV').slideUp(800);
						$('html, body').animate({
			                scrollTop: $('html').offset().top
			            }, 800);
					}
						
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