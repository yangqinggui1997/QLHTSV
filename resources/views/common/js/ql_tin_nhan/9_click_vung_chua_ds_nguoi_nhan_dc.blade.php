<script>
$(function(){
	try
	{
		/*click vùng chứa danh sách người nhận đã chọn*/
		if($('#div__id__danhSachNNDCArea').length)
		{
			$('#div__id__danhSachNNDCArea').on('mousedown', function(){
	            try
	            {
	            	$('#textBox__id__nguoiNhanDC').unbind('blur');
		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

			$('#div__id__danhSachNNDCArea').on('mouseup', function(){
				try
				{
					$('#textBox__id__nguoiNhanDC').bind('blur', function(){
						try
						{
							if($('#div__id__danhSachNNDC').children().length)
			            	{
								$('#div__id__danhSachNNDCArea').css('display', 'none');
			            		$('#div__id__danhSachNNDC').children().css('display', 'none');
			            	}
							return true;
						}
						catch(err)
						{
							alert('Lỗi: ' + err.stack + '!');
							return false;
						}
					});
					$('#textBox__id__nguoiNhanDC').focus();
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