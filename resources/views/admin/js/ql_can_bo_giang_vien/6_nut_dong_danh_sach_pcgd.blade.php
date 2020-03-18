<script>
$(function(){
	try
	{
		var btnHuy = $('#button__id__dongDanhSachHPGD');
		function isUpdate(dsHPMoi, dsHPCu)
		{
			var i = 0;
			var j = 0;
			var flag = false;
			if(dsHPCu.length !== dsHPMoi.length)
				return true;
			for(; i < dsHPCu.length; ++i)
			{
				flag = true;
				for(j = 0; j < dsHPMoi.length; ++j)
					if(dsHPCu[i] === dsHPMoi[j])
					{
						flag = !flag;
						break;
					}
				if(flag)
					return true;
			}
			return false;
		}
		/*click button đóng danh sách phân công giảng dạy*/
		if(btnHuy.length)
			btnHuy.on('click', function(){
				try
				{
					var dsHPCu = $(this).attr('data-button-listHPGD').split('|');
					var dataTbl = null;
					var dsHPMoi = [];
					var i = 0;
					var def = $.Deffered();
					var defs = [];
					var chk = null;
					defs.push(def.promise());
					dataTbl = $('#table__id__hocPhanGD').DataTable().rows().data();
					for(; i < dataTbl.length; ++i)
					{
						chk = $(dataTbl[i][0]);
						if(chk.prop('checked'))
							dsHPMoi.push(chk.attr('data-checkbox-maHP'));
					}
					def.resolve();
					$.when.apply($, defs).then(function(){
						if(isUpdate(dsHPMoi, dsHPCu))
							confirm('Bạn có muốn lưu thay đổi?', function(){
								$('#button__id__themHPGD').trigger('click');
							});
						$('#div__id__danhSachHPGD').slideUp(800);
						$('html, body').animate({
			                scrollTop: $('html').offset().top
			            }, 800);
					});
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