<script>
$(function(){
	try
	{
		/*click vùng chứa danh sách người nhận*/
		if($('#div__id__danhSachNNArea').length)
		{
			$('#div__id__danhSachNNArea').on('mousedown', function(){
	            try
	            {
	            	$('#textBox__id__nguoiNhan').unbind('blur');
		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

			$('#div__id__danhSachNNArea').on('mouseup', function(){
				try
				{
					$('#textBox__id__nguoiNhan').bind('blur', function(){
						try
						{
							if($('#div__id__danhSachNN').children().length)
			            	{
								$('#div__id__danhSachNNArea').css('display', 'none');
			            		$('#div__id__danhSachNN').children().css('display', 'none');
			            	}
							return true;
						}
						catch(err)
						{
							alert('Lỗi: ' + err.stack + '!');
							return false;
						}
					});
					$('#textBox__id__nguoiNhan').focus();
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