<script>
$(function() {
	try
	{
		// /*Khởi tạo datetimepicker*/
		if($('#div__id__thoiGianBDDK').length)
    		$('#div__id__thoiGianBDDK').datetimepicker({
    			format: 'DD/MM/YYYY hh:mm:ss A',
    			date: new Date(),
    			allowInputToggle: true
    		});

    	if($('#div__id__thoiGianKTDK').length)
    		$('#div__id__thoiGianKTDK').datetimepicker({
    			format: 'DD/MM/YYYY hh:mm:ss A',
    			date: new Date(),
    			allowInputToggle: true
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