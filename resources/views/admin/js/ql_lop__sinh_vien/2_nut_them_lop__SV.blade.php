<script>
$(function(){
	try
	{
		/*click button thêm lớp*/
    	if($('#button__id__themLop').length)
			$('#button__id__themLop').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhatLop').attr('data-original-title', 'Thêm mới');
		            $('#div__id__formLop').slideDown(800);
		            $('html, body').animate({
		                scrollTop: $("#div__id__formLop").offset().top
		            }, 800);
		            // $("#table__id__lop").dataTable().fnAddRow
	            	return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click button thêm sinh viên*/
    	if($('#button__id__themSV').length)
			$('#button__id__themSV').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhatSV').attr('data-original-title', 'Thêm mới');
		            $('#div__id__formSinhVien').slideDown(800);
		            $('html, body').animate({
		                scrollTop: $("#div__id__formSinhVien").offset().top
		            }, 800);
	            	return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
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