<script>
$(function(){
	try
	{
		var tblTN = $('#table__id__tinNhan');
		function chkTNSummaryCheck(checkbox)
		{
			var cbg = $('#p__id__chonBanGhi');
			var chkCheck = tblTN.DataTable().rows().indexes().length;
			var btnXNNLH = $('#button__id__xoaNhieuNLH');
			var btnParent4 = $('#div__id__div_button_tinNhan_parent_4');
			if(checkbox.prop('checked'))
			{
				updateCheckState(tblTN, 0, 0, true, true);
				if(!btnParent4.length)
				{
					$('<div class="row" id="div__id__div_button_tinNhan_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + chkCheck + ' người liên hệ được chọn.</p></div><div class="col-sm-3"><div class="btn-group"><button type="button" id="button__id__xoaNhieuNLH" class="btn btn-danger _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá tất cả những người liên hệ đã chọn"><i class="fa fa-trash-o"></i></button></div></div></div>').insertAfter('.div__class__group_button_tinNhan');
					btnXNNLH = $('#button__id__xoaNhieuNLH');
					btnXNNLH.attr('data-original-title', 'Xoá những người liên hệ đã chọn');
					btnXNNLH.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
				else if(cbg.length)
				{
					cbg.html('Có ' + chkCheck +' người liên hệ được chọn.');
					btnXNNLH.attr('data-original-title', 'Xoá những người liên hệ đã chọn');
				}
			}
			else
			{
				updateCheckState(tblTN, 0, 0, true, false);
				if(btnParent4.length)
					btnParent4.remove();
			}
		}
		function chkTNCheck()
		{
			var cbg = $('#p__id__chonBanGhi');
			var chkCheck = getLengthChkCheck(tblTN, 0);
			var btnXNNLH = $('#button__id__xoaNhieuNLH');
			var btnParent4 = $('#div__id__div_button_tinNhan_parent_4');
			if(chkCheck === tblTN.DataTable().rows().indexes().length)
			{
				$('[data-checkbox-tn="p"]').prop('checked', true);
				if(cbg.length)
				{
					cbg.html('Có ' + chkCheck +' người liên hệ được chọn.');
					btnXNNLH.attr('data-original-title', 'Xoá những người liên hệ đã chọn');
				}
				else
				{
					$('<div class="row" id="div__id__div_button_tinNhan_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + chkCheck + ' người liên hệ được chọn.</p></div><div class="col-sm-3"><div class="btn-group"><button type="button" id="button__id__xoaNhieuNLH" class="btn btn-danger _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá tất cả những người liên hệ đã chọn"><i class="fa fa-trash-o"></i></button></div></div></div>').insertAfter('.div__class__group_button_tinNhan');
					btnXNNLH = $('#button__id__xoaNhieuNLH');
					btnXNNLH.attr('data-original-title', 'Xoá những người liên hệ đã chọn');
					btnXNNLH.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
			}
			else
			{
				$('[data-checkbox-tn="p"]').prop('checked', false);
				if(!chkCheck)
				{
					if(btnParent4.length)
						btnParent4.remove();
				}
				else if(cbg.length)
				{
					cbg.html('Có ' + chkCheck +' người liên hệ được chọn.');
					if(chkCheck > 1)
						btnXNNLH.attr('data-original-title', 'Xoá những người liên hệ đã chọn');
					else
						btnXNNLH.attr('data-original-title', 'Xoá người liên hệ đã chọn');
				}
				else
				{
					$('<div class="row" id="div__id__div_button_tinNhan_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + chkCheck + ' người liên hệ được chọn.</p></div><div class="col-sm-3"><div class="btn-group"><button type="button" id="button__id__xoaNhieuNLH" class="btn btn-danger _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá tất cả những người liên hệ đã chọn"><i class="fa fa-trash-o"></i></button></div></div></div>').insertAfter('.div__class__group_button_tinNhan');
					btnXNNLH = $('#button__id__xoaNhieuNLH');
					btnXNNLH.attr('data-original-title', 'Xoá người liên hệ đã chọn');
					btnXNNLH.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
			}
		}
		if(tblTN.length)
		{
			/*Sự kiện click lên vùng chứa checkbox*/
			tblTN.on('click', '[data-th-td]', function(){
				try
				{
					clickParentToCheck($(this), 'tn', tblTN, chkTNSummaryCheck, chkTNCheck);
					return true;
				}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
			/*Sự kiện click checkbox*/
			tblTN.on('click', '[data-checkbox-tn]', function(e){
				try
				{
					clickToCheck(e, $(this), 'tn', tblTN, chkTNSummaryCheck, chkTNCheck);
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