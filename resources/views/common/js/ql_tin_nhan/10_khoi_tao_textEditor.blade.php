<script>
$(function(){
	try
	{
		/*Khởi tạo text editor cho soạn thảo tin nhắn*/
		if($('#div__id__noiDungTN').length)
			$('#div__id__noiDungTN').summernote({height: 100});
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>