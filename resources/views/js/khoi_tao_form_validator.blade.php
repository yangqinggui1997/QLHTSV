<script>
$(function(){
	try
	{
		/*Khởi tạo form validate*/
		init_validator();
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>