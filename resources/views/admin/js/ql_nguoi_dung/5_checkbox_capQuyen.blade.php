<script>
$(function(){
	try
	{
		var tdCQ = $('[data-td-capQuyen]');
		if(tdCQ.length)
		{
			/*Sự kiện click lên vùng chứa checkbox*/
			tdCQ.on('click', function(){
				try
	        	{
	        		var child = $(this).children();
			        if(child[0].hasAttribute('data-checkbox-pr'))
			        {
			        	if(child.prop('checked'))
			        	{
			        		$('[data-checkbox-code]').prop('checked', false);
				            child.prop('checked', false);
			        	}
				        else
				        {
			        		$('[data-checkbox-code]').prop('checked', true);
				        	child.prop('checked', true);
				        }
			        }
		        	else if(child.prop('checked'))
		        	{
		        		$('[data-checkbox-pr]').prop('checked', false);
			            child.prop('checked', false);
		        	}
			        else
			        {
		        		child.prop('checked', true);
			        	if($('[data-checkbox-code]:checked').length === $('[data-checkbox-code]').length)
			        		$('[data-checkbox-pr]').prop('checked', true);
			        }
		        	return true;
	        	}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
			/*Sự kiện click checkbox*/
			tdCQ.children().on('click', function(e){
				try
				{
					var $this = $(this);
					e.stopPropagation();
					if($this[0].hasAttribute('data-checkbox-pr'))
						if($this.prop('checked'))
							$('[data-checkbox-code]').prop('checked', true);
						else
							$('[data-checkbox-code]').prop('checked', false);
		        	else
		        		if($this.prop('checked') && $('[data-checkbox-code]:checked').length === $('[data-checkbox-code]').length)
			        		$('[data-checkbox-pr]').prop('checked', true);
			        	else
			        		$('[data-checkbox-pr]').prop('checked', false);
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