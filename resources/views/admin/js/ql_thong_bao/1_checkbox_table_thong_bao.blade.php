<script>
$(function(){
	try
	{
		var tblTB = $('#table__id__thongBao');
		function chkTBSummaryCheck(checkbox)
		{
			var cbg = $('#p__id__chonBanGhi');
			var chkCheck = tblTB.DataTable().rows().indexes().length;
			var btnXNTB = $('#button__id__xoaNhieuTB');
			var btnParent4 = $('#div__id__div_button_thongBao_parent_4');
			if(checkbox.prop('checked'))
			{
				updateCheckState(tblTB, 0, 0, true, true);
				if(!btnParent4.length)
				{
					$('<div class="row" id="div__id__div_button_thongBao_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + chkCheck + ' thông báo được chọn.</p></div><div class="col-sm-3"><div class="btn-group"><button type="button" id="button__id__xoaNhieuTB" data-button-maNG="' + $(this).attr('data-checkbox-maNG') + '" class="btn btn-danger _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá tất cả những thông báo đã chọn"><i class="fa fa-trash-o"></i></button></div></div></div>').insertAfter('.div__class__group_button_thongBao');
					btnXNTB = $('#button__id__xoaNhieuTB');
					btnXNTB.attr('data-original-title', 'Xoá những thông báo đã chọn');
					btnXNTB.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
				else if(cbg.length)
				{
					cbg.html('Có ' + chkCheck +' thông báo được chọn.');
					btnXNTB.attr('data-original-title', 'Xoá những thông báo đã chọn');
				}
			}
			else
			{
				updateCheckState(tblTB, 0, 0, true, false);
				if(btnParent4.length)
					btnParent4.remove();
			}
		}
		function chkTBCheck()
		{
			var cbg = $('#p__id__chonBanGhi');
			var chkCheck = getLengthChkCheck(tblTB, 0);
			var btnXNTB = $('#button__id__xoaNhieuTB');
			var btnParent4 = $('#div__id__div_button_thongBao_parent_4');
			if(chkCheck === tblTB.DataTable().rows().indexes().length)
			{
				$('[data-checkbox-tb="p"]').prop('checked', true);
				if(cbg.length)
				{
					cbg.html('Có ' + chkCheck +' thông báo được chọn.');
					btnXNTB.attr('data-original-title', 'Xoá những thông báo đã chọn');
				}
				else
				{
					$('<div class="row" id="div__id__div_button_thongBao_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + chkCheck + ' thông báo được chọn.</p></div><div class="col-sm-3"><div class="btn-group"><button type="button" id="button__id__xoaNhieuTB" data-button-maNG="' + $(this).attr('data-checkbox-maNG') + '" class="btn btn-danger _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá tất cả những thông báo đã chọn"><i class="fa fa-trash-o"></i></button></div></div></div>').insertAfter('.div__class__group_button_thongBao');
					btnXNTB = $('#button__id__xoaNhieuTB');
					btnXNTB.attr('data-original-title', 'Xoá những thông báo đã chọn');
					btnXNTB.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
			}
			else
			{
				$('[data-checkbox-tb="p"]').prop('checked', false);
				if(!chkCheck)
				{
					if(btnParent4.length)
						btnParent4.remove();
				}
				else if(cbg.length)
				{
					cbg.html('Có ' + chkCheck +' thông báo được chọn.');
					if(chkCheck > 1)
						btnXNTB.attr('data-original-title', 'Xoá những thông báo đã chọn');
					else
						btnXNTB.attr('data-original-title', 'Xoá thông báo đã chọn');
				}
				else
				{
					$('<div class="row" id="div__id__div_button_thongBao_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + chkCheck + ' thông báo được chọn.</p></div><div class="col-sm-3"><div class="btn-group"><button type="button" id="button__id__xoaNhieuTB" data-button-maNG="' + $(this).attr('data-checkbox-maNG') + '" class="btn btn-danger _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá tất cả những thông báo đã chọn"><i class="fa fa-trash-o"></i></button></div></div></div>').insertAfter('.div__class__group_button_thongBao');
					btnXNTB = $('#button__id__xoaNhieuTB');
					btnXNTB.attr('data-original-title', 'Xoá thông báo đã chọn');
					btnXNTB.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
			}
		}
		if(tblTB.length)
		{
			/*Sự kiện click lên vùng chứa checkbox*/
			tblTB.on('click', '[data-th-td]', function(){
				try
				{
					clickParentToCheck($(this), 'tb', tblTB, chkTBSummaryCheck, chkTBCheck);
					return true;
				}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
			/*Sự kiện click checkbox*/
			tblTB.on('click', '[data-checkbox-tb]', function(e){
				try
				{
					clickToCheck(e, $(this), 'tb', tblTB, chkTBSummaryCheck, chkTBCheck);
					return true;
				}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
		}
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>