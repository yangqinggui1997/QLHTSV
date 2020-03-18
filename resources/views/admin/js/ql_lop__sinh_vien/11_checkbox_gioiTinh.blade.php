<script>
$(function(){
	try
	{
		/*Click lên vùng chứa checkbox sẽ check*/
		if($('[data-div-gioiTinh]').length)
		{
	        $('[data-div-gioiTinh]').on('click', function(){
	        	try
	        	{
	        		$($(this).children()[0]).prop('checked', true);
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