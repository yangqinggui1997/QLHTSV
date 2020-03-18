<script>
$(function(){
	try
	{
		/*click button xoá người nhận*/
		if($('#div__id__danhSachNNDC').length)
		{
			$('#div__id__danhSachNNDC').on('mousedown', '[data-button-id="button__data-button-id__xoaNguoiNhan"]', function(){
	            try
	            {
	            	var object = $(this);
	            	$('#div__id__danhSachNNDC').children().each(function(){
	            		if($(this).attr('data-div-maNguoiNhanDC') === object.attr('data-button-maNguoiNhanDC'))
	            		{
	            			$(this).remove();
	            			return false;
	            		}
	            	});
	            	if(!$('#div__id__danhSachNNDC').children().length)
	            	{
	            		$('#div__id__danhSachNNDCArea').css('display', 'none');
	            	}
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