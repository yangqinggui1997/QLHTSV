<script>
$(function(){
	try
	{
		var btnThemBM = $('#button__id__themBM');
		/*click button thêm*/
		if(btnThemBM.length)
			btnThemBM.on('click', function(){
	            try
	            {
	            	var btnCN = $('#button__id__capNhatBM');
	            	var divBM = $('#div__id__formBoMon');
	            	$('#textBox__id__tenBoMon').val('');
	            	$('#h2__id__formBoMon').text('THÔNG TIN BỘ MÔN - KHOA [' + $(this).attr('data-button-tenKhoa').toUpperCase() + ']');
	            	btnCN.attr('data-original-title', 'Thêm mới');
	            	btnCN.attr('data-button-command', 'them');
	            	btnCN.removeAttr('data-button-index');
					$('#button__id__huyBM').attr('data-button-command', 'them');
		            divBM.slideDown(800);
					$('html, body').animate({
		                scrollTop: divBM.offset().top
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