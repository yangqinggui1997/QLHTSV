<script>
$(function(){
	try
	{
		/*click button thêm*/
		if($('#button__id__them').length)
			$('#button__id__them').on('click', function(){
	            try
	            {
	            	$('#button__id__capNhat').attr('data-original-title', 'Thêm mới');
		            $('#div__id__formThongBao').slideDown(800);
		            $('html, body').animate({
		                scrollTop: $("#div__id__formThongBao").offset().top
		            }, 800);
		            // var dt = $('#table__id__thongBao').dataTable();
		            // dt.fnAddData(['<input type="checkbox">',1, 2, 3, 4,'']);
		            // dt.fnUpdate('dada',0,0);
		            // dt.fnDeleteRow(0);
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