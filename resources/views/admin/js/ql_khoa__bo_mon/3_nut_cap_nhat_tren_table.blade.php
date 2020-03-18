<script>
$(function(){
	try
	{
		var tbyKhoa = $('#tbody__id__khoa');
		var tbyBM = $('#tbody__id__boMon');
		/*click button cập nhật khoa*/
		if(tbyKhoa.length)
			tbyKhoa.on('click', '[data-button-id="sua"]', function(){
				try
	            {
	            	var $this = $(this);
	            	var divKhoa = $('#div__id__formKhoa');
	            	var btnCN = $('#button__id__capNhat');
	            	var tenKhoa = $this.attr('data-button-tenKhoa');
	            	var maKhoa = $this.attr('data-button-maKhoa');
	            	var btnHuy = $('#button__id__huy');
	            	$('#textBox__id__tenKhoa').val(tenKhoa);
	            	btnCN.attr('data-button-tenKhoa', tenKhoa);
	            	divKhoa.find('.alert').remove();
					btnCN.attr('data-original-title', 'Cập nhật');
					btnCN.attr('data-button-maKhoa', maKhoa);
					btnCN.attr('data-button-index', $('#table__id__khoa').DataTable().row($this.closest('tr')).index());
					btnCN.attr('data-button-command', 'capnhat');
					btnHuy.attr('data-button-command', 'capnhat');
					btnHuy.attr('data-button-maKhoa', maKhoa);
					btnHuy.attr('data-button-tenKhoa', tenKhoa);
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
		/*click button cập nhật bộ môn*/
		if(tbyBM.length)
			tbyBM.on('click', '[data-button-id="sua"]', function(){
				try
	            {
	            	var $this = $(this);
	            	var divBM = $('#div__id__formBoMon');
	            	var btnCN = $('#button__id__capNhatBM');
	            	var tenBM = $this.attr('data-button-tenBM');
	            	var maBM = $this.attr('data-button-maBM');
	            	var btnHuy = $('#button__id__huyBM');
	            	btnCN.attr('data-button-tenBM', tenBM);
	            	$('#textBox__id__tenBoMon').val(tenBM);
	            	$('#h2__id__formBoMon').text('THÔNG TIN BỘ MÔN - KHOA [' + $('#button__id__themBM').attr('data-button-tenKhoa').toUpperCase() + ']');
	            	divBM.find('.alert').remove();
					btnCN.attr('data-original-title', 'Cập nhật');
					btnCN.attr('data-button-maBM', maBM);
					btnCN.attr('data-button-index', $('#table__id__boMon').DataTable().row($this.closest('tr')).index());
					btnCN.attr('data-button-command', 'capnhat');
					btnHuy.attr('data-button-command', 'capnhat');
					btnHuy.attr('data-button-maBM', maBM);
					btnHuy.attr('data-button-tenBM', tenBM);
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