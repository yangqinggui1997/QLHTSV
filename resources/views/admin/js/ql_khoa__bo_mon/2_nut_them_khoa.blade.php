 <script>
$(function(){
	try
	{
		var btnThem = $('#button__id__them');
		/*click button thêm*/
		if(btnThem.length)
			btnThem.on('click', function(){
	            try
	            {
	            	var btnCN = $('#button__id__capNhat');
	            	var divKhoa = $('#div__id__formKhoa');
	            	$('#textBox__id__tenKhoa').val('');
	            	btnCN.attr('data-original-title', 'Thêm mới');
	            	btnCN.attr('data-button-command', 'them');
	            	btnCN.removeAttr('data-button-index');
					$('#button__id__huy').attr('data-button-command', 'them');
		            divKhoa.slideDown(800);
					$('html, body').animate({
		                scrollTop: divKhoa.offset().top
		            }, 800);
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