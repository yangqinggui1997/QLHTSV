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
	            	var line = $('.ln_solid');
	            	var btnCN = $('#button__id__capNhat');
	            	var txtMCB = $('#textBox__id__maCanBo');
	            	var frmND = $('#div__id__formNguoiDung');
	            	line.show();
            		line.next().show();
	            	btnCN.attr('data-original-title', 'Thêm mới');
	            	btnCN.attr('data-button-command', 'them');
	            	btnCN.removeAttr('data-button-index');
	            	txtMCB.removeAttr('readonly');
	            	txtMCB.val('');
					txtMCB.trigger('input');
					$('#select__id__trangThai').val('tu_do');
					$('[data-td-capQuyen]').children().prop('checked', false);
					$('#button__id__huy').attr('data-button-command', 'them');
					$('#ul__id__plt').find('.close-link').remove();
		            frmND.slideDown(800);
		            $('html, body').animate({
		                scrollTop: frmND.offset().top
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