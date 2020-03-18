<script>
$(function(){
	try
	{
		/*Click lên vùng chứa radio sẽ check*/
		if($('[data-div-phamViTB]').length)
		{
	        $('[data-div-phamViTB]').on('click', function(){
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