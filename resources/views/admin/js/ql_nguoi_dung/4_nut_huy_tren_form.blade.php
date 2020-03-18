<script>
$(function(){
	try
	{
		var tblND = $('#button__id__huy');
		/*click button đóng*/
		if(tblND.length)
			tblND.on('click', function(){
	            try
	            {
	            	var $this = $(this);
	            	var tt = null;
	            	var chkThem = null;
            		var chkSua = null;
            		var chkXoa = null;
            		var chkSaoChep = null;
	            	var cf = false;
	            	if($this.attr('data-button-command') === 'capnhat')
	            	{
	            		tt = $this.attr('data-button-thaoTac');
		            	chkThem = $('[data-checkbox-code="them"]').prop('checked');
	            		chkSua = $('[data-checkbox-code="capnhat"]').prop('checked');
	            		chkXoa = $('[data-checkbox-code="xoa"]').prop('checked');
	            		chkSaoChep = $('[data-checkbox-code="saochep"]').prop('checked');
		            	if((tt.indexOf('them') >= 0 && !chkThem) || (tt.indexOf('them') < 0 && chkThem))
		            		cf = !cf;
		            	else if((tt.indexOf('sua') >= 0 && !chkSua) || (tt.indexOf('sua') < 0 && chkSua))
		            		cf = !cf;
		            	else if((tt.indexOf('xoa') >= 0 && !chkXoa) || (tt.indexOf('xoa') < 0 && chkXoa))
		            		cf = !cf;
		            	else if((tt.indexOf('saochep') >= 0 && !chkSaoChep) || (tt.indexOf('saochep') < 0 && chkSaoChep))
		            		cf = !cf;
		            	else if($this.attr('data-button-trangThai') !== $('#select__id__trangThai').val())
		            		cf = !cf;
		            	if(cf)
		            		confirm('Bạn có muốn lưu thay đổi?', function(){
		            			$('#button__id__capNhat').trigger('click');
		            		});
	            	}
		            $('#div__id__formNguoiDung').slideUp(800);
		            $('html, body').animate({
		                scrollTop: $('html').offset().top
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