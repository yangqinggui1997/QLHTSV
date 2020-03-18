<script>
$(function(){
	try
	{
		var tblHPGD = $('#table__id__hocPhanGD');
		var tblCB = $('#table__id__canBo');
		function chkHPGDSummaryCheck(checkbox)
		{
			var cbg = $('#p__id__chonBanGhiHPGD');
			var chkCheck = tblHPGD.DataTable().rows().indexes().length;
			var btnParent4 = $('#div__id__div_button_hocPhanGD_parent_4');
			if(checkbox.prop('checked'))
			{
				updateCheckState(tblHPGD, 0, 0, true, true);
				if(!btnParent4.length)
					$('<div class="row" id="div__id__div_button_hocPhanGD_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiHPGD"> Có ' + chkCheck + ' học phần được chọn.</p></div></div>').insertAfter('.div__class__group_button_hocPhanGD');
				else if(cbg.length)
					cbg.html('Có ' + chkCheck +' học phần được chọn.');
			}
			else
			{
				updateCheckState(tblHPGD, 0, 0, true, false);
				if(btnParent4.length)
					btnParent4.remove();
			}
		}
		function chkHPGDCheck()
		{
			var cbg = $('#p__id__chonBanGhiHPGD');
			var chkCheck = getLengthChkCheck(tblHPGD, 0);
			var btnParent4 = $('#div__id__div_button_hocPhanGD_parent_4');
			if(chkCheck === tblHPGD.DataTable().rows().indexes().length)
			{
				$('[data-checkbox-hocPhanGD="p"]').prop('checked', true);
				if(cbg.length)
					cbg.html('Có ' + chkCheck +' học phần được chọn.');
				else
					$('<div class="row" id="div__id__div_button_hocPhanGD_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiHPGD"> Có ' + chkCheck + ' học phần được chọn.</p></div></div>').insertAfter('.div__class__group_button_hocPhanGD');
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
					cbg.html('Có ' + chkCheck +' học phần được chọn.');
				else
					$('<div class="row" id="div__id__div_button_hocPhanGD_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiHPGD"> Có ' + chkCheck + ' học phần được chọn.</p></div></div>').insertAfter('.div__class__group_button_hocPhanGD');
			}
		}
		function chkCBSummaryCheck(checkbox)
		{
			var cbg = $('#p__id__chonBanGhiCBGV');
			var chkCheck = tblCB.DataTable().rows().indexes().length;
			var btnXNCB = $('#button__id__xoaNhieuCB');
			var btnParent4 = $('#div__id__div_button_canBo_parent_4');
			if(checkbox.prop('checked'))
			{
				updateCheckState(tblCB, 0, 0, true, true);
				if(!btnParent4.length)
				{
					$('<div class="row" id="div__id__div_button_canBo_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiCBGV"> Có ' + chkCheck + ' cán bộ được chọn.</p></div><div class="col-sm-3"><div class="btn-group"><button type="button" id="button__id__xoaNhieuCB" class="btn btn-danger _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá tất cả những cán bộ đã chọn"><i class="fa fa-trash-o"></i></button></div></div></div>').insertAfter('.div__class__group_button_canBo');
					btnXNCB = $('#button__id__xoaNhieuCB');
					btnXNCB.attr('data-original-title', 'Xoá những cán bộ đã chọn');
					btnXNCB.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
				else if(cbg.length)
				{
					cbg.html('Có ' + chkCheck +' cán bộ được chọn.');
					btnXNCB.attr('data-original-title', 'Xoá những cán bộ đã chọn');
				}
			}
			else
			{
				updateCheckState(tblCB, 0, 0, true, false);
				if(btnParent4.length)
					btnParent4.remove();
			}
		}
		function chkCBCheck()
		{
			var cbg = $('#p__id__chonBanGhiCBGV');
			var chkCheck = getLengthChkCheck(tblCB, 0);
			var btnXNCB = $('#button__id__xoaNhieuCB');
			var btnParent4 = $('#div__id__div_button_canBo_parent_4');
			if(chkCheck === tblCB.DataTable().rows().indexes().length)
			{
				$('[data-checkbox-tb="p"]').prop('checked', true);
				if(cbg.length)
				{
					cbg.html('Có ' + chkCheck +' cán bộ được chọn.');
					btnXNCB.attr('data-original-title', 'Xoá những cán bộ đã chọn');
				}
				else
				{
					$('<div class="row" id="div__id__div_button_canBo_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiCBGV"> Có ' + chkCheck + ' cán bộ được chọn.</p></div><div class="col-sm-3"><div class="btn-group"><button type="button" id="button__id__xoaNhieuCB" class="btn btn-danger _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá tất cả những cán bộ đã chọn"><i class="fa fa-trash-o"></i></button></div></div></div>').insertAfter('.div__class__group_button_canBo');
					btnXNCB = $('#button__id__xoaNhieuCB');
					btnXNCB.attr('data-original-title', 'Xoá những cán bộ đã chọn');
					btnXNCB.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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
					cbg.html('Có ' + chkCheck +' cán bộ được chọn.');
					if(chkCheck > 1)
						btnXNCB.attr('data-original-title', 'Xoá những cán bộ đã chọn');
					else
						btnXNCB.attr('data-original-title', 'Xoá cán bộ đã chọn');
				}
				else
				{
					$('<div class="row" id="div__id__div_button_canBo_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiCBGV"> Có ' + chkCheck + ' cán bộ được chọn.</p></div><div class="col-sm-3"><div class="btn-group"><button type="button" id="button__id__xoaNhieuCB" class="btn btn-danger _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá tất cả những cán bộ đã chọn"><i class="fa fa-trash-o"></i></button></div></div></div>').insertAfter('.div__class__group_button_canBo');
					btnXNCB = $('#button__id__xoaNhieuCB');
					btnXNCB.attr('data-original-title', 'Xoá cán bộ đã chọn');
					btnXNCB.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
			}
		}
		if(tblHPGD.length)
		{
			/*Sự kiện click lên vùng chứa checkbox*/
			tblHPGD.on('click', '[data-th-td-hocPhanGD]', function(){
				try
				{
					clickParentToCheck($(this), 'hocPhanGD', tblHPGD, chkHPGDSummaryCheck, chkHPGDCheck);
					return true;
				}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
			/*Sự kiện click checkbox*/
			tblHPGD.on('click', '[data-checkbox-hocPhanGD]', function(e){
				try
				{
					clickToCheck(e, $(this), 'hocPhanGD', tblHPGD, chkHPGDSummaryCheck, chkHPGDCheck);
					return true;
				}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
		}
		if(tblCB.length)
		{
			/*Sự kiện click lên vùng chứa checkbox*/
			tblCB.on('click', '[data-th-td-cb]', function(){
				try
				{
					clickParentToCheck($(this), 'cb', tblCB, chkCBSummaryCheck, chkCBCheck);
					return true;
				}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
			/*Sự kiện click checkbox*/
			tblCB.on('click', '[data-checkbox-cb]', function(e){
				try
				{
					clickToCheck(e, $(this), 'cb', tblCB, chkCBSummaryCheck, chkCBCheck);
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