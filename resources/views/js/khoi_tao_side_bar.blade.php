<script>
$(function(){
	try
	{
		/*Khởi tạo side bar*/
		init_sidebar();
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>