<script>
$(function(){
	try
	{
		var rel = $('[rel="tooltip"]');
		var data_toggle = $('[data-toggle="tooltip"]');
		/*Khởi tạo tooltip cho thuộc tính rel*/
		if(rel.length)
			rel.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);

		/*Khởi tạo tooltip cho thuộc tính data-toggle*/
		if(data_toggle.length)
    		data_toggle.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
    	return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>