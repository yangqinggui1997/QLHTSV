<script>
$(function(){
	try
	{
		/*click button làm mới soạn thảo tin nhắn*/
		if($('#button__id__lamMoi').length)
			$('#button__id__lamMoi').on('click', function(){
	            try
	            {
	            	$('#div__id__danhSachNN').html('');
	            	if($(this).attr('data-button-command') === 'them')
		            	$('#div__id__danhSachNNDC').html('');
		            else 
		            	$('#div__id__danhSachNNDC').children('[data-div-newND]').remove();

	            	$('#div__id__noiDungTN').summernote('code', '');
	            	$('#textarea__id__fileDinhKem').text("Chưa chọn file nào");
					$('#textarea__id__fileDinhKem').attr("data-textarea-noFilePick","");
					$('#textarea__id__fileDinhKem').attr('rows', 1);
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