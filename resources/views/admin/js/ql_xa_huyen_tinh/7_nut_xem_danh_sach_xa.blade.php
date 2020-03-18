<script>
$(function(){
	try
	{
		/*click button mở danh sách xã*/
		if($('#tbody__id__huyen').length)
		{
			$('#tbody__id__huyen').on('click', '[data-button="xemXa"]', function()
			{
				try
	            {
		            $('#div__id__danhSachXa').slideDown(800);
		            $('html, body').animate({
		                scrollTop: $("#div__id__danhSachXa").offset().top
		            }, 800);
	            	return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
		}
		
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>