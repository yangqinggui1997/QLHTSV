<script>
$(function(){
	try
	{
		var btnHuy = $('#button__id__huy');
		/*click button đóng*/
		if(btnHuy.length)
			btnHuy.on('click', function(){
	            try
	            {
	            	var $this = $(this);
	            	var cf = false;
	            	if($this.attr('data-button-command') === 'capnhat')
	            	{
	            		if($this.attr('data-button-tenCB') !== $('#textBox__id__tenCB').val().trim())
	            			cf = !cf;
	            		else if(($('#radio__id__gtNam').prop('checked') && $this.attr('data-button-gt') === '0') || (!$('#radio__id__gtNam').prop('checked') && $this.attr('data-button-gt') === '1'))
	            			cf = !cf;
	            		else if($this.attr('data-button-sdt') !== $('#number__id__soDienThoai').val().trim())
	            			cf = !cf;
	            		else if($this.attr('data-button-email') !== $('#textBox__id__email').val().trim())
	            			cf = !cf;
	            		else if($this.attr('data-button-hv') !== $('#select__id__hocVi').val())
	            			cf = !cf;
	            		else if($this.attr('data-button-cm') !== $('#select__id__chuyenMon').val())
	            			cf = !cf;
	            		else if($this.attr('data-button-nghiepVu') !== $('#select__id__nghiepVu').val())
	            			cf = !cf;
	            		else if($this.attr('data-button-cv') !== $('#select__id__chucVu').val())
	            			cf = !cf;
	            		else if($this.attr('data-button-pb') !== $('#hidden__id__phong').attr('data-button-maPB'))
	            			cf = !cf;
		            	if(cf)
		            		confirm('Bạn có muốn lưu thay đổi?', function(){
		            			$('#button__id__capNhat').trigger('click');
		            		});
	            	}
		            $('#div__id__formCanBo').slideUp(800);
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