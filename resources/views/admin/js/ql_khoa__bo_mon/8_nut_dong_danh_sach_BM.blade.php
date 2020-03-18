<script>
$(function(){
	try
	{
		var btnDongDSBM = $('#button__id__dongDanhSachBM');
		/*click button đóng danh sách bộ môn*/
		if(btnDongDSBM.length)
			btnDongDSBM.on('click', function(e, maK_BM){
				try
				{
					var divDSCB = $('#div__id__danhSachCanBo');
					var divBM = $('#div__id__formBoMon');
					if(divDSCB.attr('data-div-dsk') === maK_BM)
						divDSCB.slideUp(800);
					if(typeof maK_BM === typeof undefined || $('#button__id__themBM').attr('data-button-maKhoa') === maK_BM)
					{
						if(!divBM.is(':hidden') || !divBM[0].hasAttribute('hidden'))
						{
							divBM.slideUp(800);
							$('#button__id__huyBM').trigger('click');
						}
						$('#div__id__danhSachBoMon').slideUp(800);
						$('html, body').animate({
			                scrollTop: $('html').offset().top
			            }, 800);
					}
		            return true;
				}
	            catch(err)
				{
					alert("Lỗi: " + err.stack + "!");
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