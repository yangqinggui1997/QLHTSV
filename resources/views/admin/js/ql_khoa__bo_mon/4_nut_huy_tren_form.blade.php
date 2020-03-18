<script>
$(function(){
	try
	{
		var btnHuyKhoa = $('#button__id__huy');
		var btnHuyBM = $('#button__id__huyBM');
		/*click button đóng form khoa*/
		if(btnHuyKhoa.length)
			btnHuyKhoa.on('click', function(){
	            try
	            {
	            	var $this = $(this);
	            	if($this.attr('data-button-command') === 'capnhat')
		            	if($this.attr('data-button-tenKhoa') !== $('#textBox__id__tenKhoa').val())
			            	confirm('Bạn có muốn lưu thay đổi?', function(){
			            		$('#button__id__capNhat').trigger('click');
			            	});
		            $('#div__id__formKhoa').slideUp(800);
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
		/*click button đóng form cán bộ*/
		if(btnHuyBM.length)
			btnHuyBM.on('click', function(){
	            try
	            {
	            	var $this = $(this);
	            	if($this.attr('data-button-command') === 'capnhat')
		            	if($this.attr('data-button-tenBM') !== $('#textBox__id__tenBoMon').val())
			            	confirm('Bạn có muốn lưu thay đổi?', function(){
			            		$('#button__id__capNhatBM').trigger('click');
			            	});
		            $('#div__id__formBoMon').slideUp(800);
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