<script>
$(function(){
	try
	{
		/*Hiển thị tên files được chọn lên textarea*/
		if($('#file__id__fileDinhKem').length)
			$('#file__id__fileDinhKem').on('change', function(){
				try
	            {
					var i = 0, filesName = '';
					for(; i < $(this)[0].files.length; ++i)
					{
						if(i == $(this)[0].files.length - 1)
							filesName += (i + 1) + '. ' + $(this)[0].files[i].name;
						else
							filesName += (i + 1) + '. ' + $(this)[0].files[i].name + '\n'; //add new line
					}
					if(filesName)
					{
						$('#textarea__id__fileDinhKem').attr('rows', $(this)[0].files.length);
						$('#textarea__id__fileDinhKem').removeAttr("data-textarea-noFilePick");
						$('#textarea__id__fileDinhKem').text(filesName);
					}
					else
					{
						$('#textarea__id__fileDinhKem').text("Chưa chọn file nào");
						$('#textarea__id__fileDinhKem').attr("data-textarea-noFilePick", "");
						$('#textarea__id__fileDinhKem').attr('rows', 1);
					}
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