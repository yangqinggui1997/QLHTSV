<script>
$(function() {
	try
	{
		// /*Khởi tạo datetimepicker*/
		if($('#div__id__ngaySinh').length)
    		$('#div__id__ngaySinh').datetimepicker({
    			format: 'DD/MM/YYYY',
    			date: new Date(),
    			allowInputToggle: true,
    			maxDate: new Date()
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