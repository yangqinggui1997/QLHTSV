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
	            	var txtP = $('#textBox__id__phong');
	            	var frmND = $('#div__id__formCanBo');
	            	$('#textBox__id__tenCB').val('');
	            	$('#radio__id__gtNam').prop('checked');
	            	$('#number__id__soDienThoai').val('');
	            	$('#textBox__id__email').val('');
	            	$('#select__id__hocVi').val('cu_nhan');
	            	$('#select__id__chuyenMon').val('cong_nghe_thong_tin');
	            	$('#select__id__chucVu').val('khong_co');
	            	txtP.val('');
	            	$('#img__id__anh').removeAttr('src');
	            	btnCN.attr('data-original-title', 'Thêm mới');
	            	btnCN.attr('data-button-command', 'them');
					$('#button__id__huy').attr('data-button-command', 'them');
	            	btnCN.removeAttr('data-button-index');
					txtP.trigger('input');
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