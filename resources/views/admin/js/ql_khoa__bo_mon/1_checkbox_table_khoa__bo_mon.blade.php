<script>
$(function(){
	try
	{
		var tblKhoa = $('#table__id__khoa');
		var tblBM = $('#table__id__boMon');
		function chkKhoaSummaryCheck(checkbox)
		{
			var chkKhoaChildCheck = tblKhoa.DataTable().rows().indexes().length;
			var btnXoaKhoa = $('#button__id__xoaNhieuKhoa');
			var divKhoaP4 = $('#div__id__div_button_parent_khoa_4');
			var pBG = $('#p__id__chonBanGhi');
			if(checkbox.prop('checked'))
			{
				updateCheckState(tblKhoa, 0, 0, true, true);
				if(!divKhoaP4.length)
				{
					$('<div class="row" id="div__id__div_button_parent_khoa_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + chkKhoaChildCheck + ' khoa được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuKhoa" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các khoa đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('.div__class__group_button_khoa');
					btnXoaKhoa = $('#button__id__xoaNhieuKhoa');
					btnXoaKhoa.attr('data-original-title', 'Xoá các khoa đã chọn');
					btnXoaKhoa.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
				else if(pBG.length)
				{
					pBG.html('Có ' + chkKhoaChildCheck +' khoa được chọn.');
					btnXoaKhoa.attr('data-original-title', 'Xoá các khoa đã chọn');
				}
			}
			else
			{
				updateCheckState(tblKhoa, 0, 0, true, false);
				if(divKhoaP4.length)
					divKhoaP4.remove();
			}
		}
		function chkKhoaCheck()
		{
			var chkKhoaChildCheck = getLengthChkCheck(tblKhoa, 0);
			var btnXoaKhoa = $('#button__id__xoaNhieuKhoa');
			var divKhoaP4 = $('#div__id__div_button_parent_khoa_4');
			var pBG = $('#p__id__chonBanGhi');
			if(chkKhoaChildCheck === tblKhoa.DataTable().rows().indexes().length)
			{
				$('[data-checkbox-k="p"]').prop('checked', true);
				if(pBG.length)
				{
					pBG.html('Có ' + chkKhoaChildCheck +' khoa được chọn.');
					btnXoaKhoa.attr('data-original-title', 'Xoá các khoa đã chọn');
				}
				else
				{
					$('<div class="row" id="div__id__div_button_parent_khoa_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + chkKhoaChildCheck + ' khoa được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuKhoa" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các khoa đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('.div__class__group_button_khoa');
					btnXoaKhoa = $('#button__id__xoaNhieuKhoa');
					btnXoaKhoa.attr('data-original-title', 'Xoá các khoa đã chọn');
					btnXoaKhoa.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
			}
			else
			{
				$('[data-checkbox-k="p"]').prop('checked', false);
				if(!chkKhoaChildCheck)
				{
					if(divKhoaP4.length)
						divKhoaP4.remove();
				}
				else if(pBG.length)
				{
					pBG.html('Có ' + chkKhoaChildCheck +' khoa được chọn.');
					if(chkKhoaChildCheck > 1)
						btnXoaKhoa.attr('data-original-title', 'Xoá các khoa đã chọn');
					else
						btnXoaKhoa.attr('data-original-title', 'Xoá khoa đã chọn');
				}
				else
				{
					$('<div class="row" id="div__id__div_button_parent_khoa_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + chkKhoaChildCheck + ' khoa được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuKhoa" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá khoa đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('.div__class__group_button_khoa');
					btnXoaKhoa = $('#button__id__xoaNhieuKhoa');
					btnXoaKhoa.attr('data-original-title', 'Xoá khoa đã chọn');
					btnXoaKhoa.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
			}
		}
		function chkBMSummaryCheck(checkbox)
		{
			var chkBMChildCheck = tblBM.DataTable().rows().indexes().length;
			var btnXoaBM = $('#button__id__xoaNhieuBM');
			var divBMP4 = $('#div__id__div_button_parent_boMon_4');
			var pBG = $('#p__id__chonBanGhiBM');
			if(checkbox.prop('checked'))
			{
				updateCheckState(tblBM, 0, 0, true, true);
				if(!divBMP4.length)
				{
					$('<div class="row" id="div__id__div_button_parent_boMon_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiBM"> Có ' + chkBMChildCheck + ' bộ môn được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuBM" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các bộ môn đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('.div__class__group_button_boMon');
					btnXoaBM = $('#button__id__xoaNhieuBM');
					btnXoaBM.attr('data-original-title', 'Xoá các bộ môn đã chọn');
					btnXoaBM.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
				else if(pBG.length)
				{
					pBG.html('Có ' + chkBMChildCheck +' bộ môn được chọn.');
					btnXoaBM.attr('data-original-title', 'Xoá các bộ môn đã chọn');
				}
			}
			else
			{
				updateCheckState(tblBM, 0, 0, true, false);
				if(divBMP4.length)
					divBMP4.remove();
			}
		}
		function chkBMCheck()
		{
			var chkBMChildCheck = getLengthChkCheck(tblBM, 0);
			var btnXoaBM = $('#button__id__xoaNhieuBM');
			var divBMP4 = $('#div__id__div_button_parent_boMon_4');
			var pBG = $('#p__id__chonBanGhiBM');
			if(chkBMChildCheck === tblBM.DataTable().rows().indexes().length)
			{
				$('[data-checkbox-bm="p"]').prop('checked', true);
				if(pBG.length)
				{
					pBG.html('Có ' + chkBMChildCheck +' bộ môn được chọn.');
					btnXoaBM.attr('data-original-title', 'Xoá các bộ môn đã chọn');
				}
				else
				{
					$('<div class="row" id="div__id__div_button_parent_boMon_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiBM"> Có ' + chkBMChildCheck + ' bộ môn được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuBM" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các bộ môn đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('.div__class__group_button_boMon');
					btnXoaBM = $('#button__id__xoaNhieuBM');
					btnXoaBM.attr('data-original-title', 'Xoá các bộ môn đã chọn');
					btnXoaBM.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
			}
			else
			{
				$('[data-checkbox-bm="p"]').prop('checked', false);
				if(!chkBMChildCheck)
				{
					if(divBMP4.length)
						divBMP4.remove();
				}
				else if(pBG.length)
				{
					pBG.html('Có ' + chkBMChildCheck +' bộ môn được chọn.');
					if(chkBMChildCheck > 1)
						btnXoaBM.attr('data-original-title', 'Xoá các bộ môn đã chọn');
					else
						btnXoaBM.attr('data-original-title', 'Xoá bộ môn đã chọn');
				}
				else
				{
					$('<div class="row" id="div__id__div_button_parent_boMon_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiBM"> Có ' + chkBMChildCheck + ' bộ môn được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuBM" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá bộ môn đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('.div__class__group_button_boMon');
					btnXoaBM = $('#button__id__xoaNhieuBM');
					btnXoaBM.attr('data-original-title', 'Xoá bộ môn đã chọn');
					btnXoaBM.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
			}
		}
		if(tblKhoa.length)
		{
			/*Sự kiện click lên vùng chứa checkbox*/
			tblKhoa.on('click', '[data-th-td-k]', function(){
				try
				{
					clickParentToCheck($(this), 'k', tblKhoa, chkKhoaSummaryCheck, chkKhoaCheck);
					return true;
				}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
			/*Sự kiện click checkbox*/
			tblKhoa.on('click', '[data-checkbox-k]', function(e){
				try
				{
					clickToCheck(e, $(this), 'k', tblKhoa, chkKhoaSummaryCheck, chkKhoaCheck);
					return true;
				}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
		}
		if(tblBM.length)
		{
			/*Sự kiện click lên vùng chứa checkbox*/
			tblBM.on('click', '[data-th-td-bm]', function(){
				try
				{
					clickParentToCheck($(this), 'bm', tblBM, chkBMSummaryCheck, chkBMCheck);
					return true;
				}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
			/*Sự kiện click checkbox*/
			tblBM.on('click', '[data-checkbox-bm]', function(e){
				try
				{
					clickToCheck(e, $(this), 'bm', tblBM, chkBMSummaryCheck, chkBMCheck);
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