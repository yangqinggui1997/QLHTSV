<script>
$(function(){
	try
	{
		var tblND = $('#table__id__nguoiDung');
		function chkUserSummaryCheck(checkbox)
		{
			var cbg = $('#p__id__chonBanGhi');
			var chkcCheck = tblND.DataTable().rows().indexes().length;
			var btnXNND = $('#button__id__xoaNhieuNguoiDung');
			var btnMKNND = $('#button__id__mkNhieuNguoiDung');
			var btnKNND = $('#button__id__khoaNhieuNguoiDung');
			var btnParent4 = $('#div__id__div_button_parent_4');
			if(checkbox.prop('checked'))
			{
				updateCheckState(tblND, 0, 0, true, true);
				if(!btnParent4.length)
				{
					/*Nếu tài khoản là master thì có nút khoá và xoá tài khoản*/
					$('<div class="row marginBottom10" id="div__id__div_button_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + chkcCheck + ' người dùng được chọn.</p></div><div class="col-sm-3"><div class="btn-group"><button type="button" id="button__id__xoaNhieuNguoiDung" class="btn btn-danger _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tài khoản người dùng đã chọn"><i class="fa fa-trash-o"></i></button><button type="button" id="button__id__mkNhieuNguoiDung" class="btn btn-success _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Mở khoá các người dùng đã chọn"><i class="fa fa-unlock-alt"></i></button><button type="button" id="button__id__khoaNhieuNguoiDung" class="btn btn-warning _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Khoá tài khoản các người dùng đã chọn"><i class="fa fa-lock"></i></button></div></div></div>').insertAfter('.div__class__group_button');
					btnXNND = $('#button__id__xoaNhieuNguoiDung');
					btnKNND = $('#button__id__khoaNhieuNguoiDung');
					btnMKNND = $('#button__id__mkNhieuNguoiDung');
					btnXNND.attr('data-original-title', 'Xoá các người dùng đã chọn');
					btnMKNND.attr('data-original-title', 'Mở khoá các tài khoản người dùng đã chọn');
					btnKNND.attr('data-original-title', 'Khoá các tài khoản người dùng đã chọn');
					btnXNND.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					btnMKNND.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					btnKNND.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
				/*Nếu tài khoản là admin thì chỉ có nút khoá tài khoản*/
				else if(cbg.length)
				{
					cbg.html('Có ' + chkcCheck +' người dùng được chọn.');
					btnXNND.attr('data-original-title', 'Xoá các người dùng đã chọn');
					btnMKNND.attr('data-original-title', 'Mở khoá các tài khoản người dùng đã chọn');
					btnKNND.attr('data-original-title', 'Khoá các tài khoản người dùng đã chọn');
				}
			}
			else
			{
				updateCheckState(tblND, 0, 0, true, false);
				if(btnParent4.length)
					btnParent4.remove();
			}
		}
		function chkUserCheck()
		{
			var cbg = $('#p__id__chonBanGhi');
			var chkcCheck = getLengthChkCheck(tblND, 0);
			var btnXNND = $('#button__id__xoaNhieuNguoiDung');
			var btnMKNND = $('#button__id__mkNhieuNguoiDung');
			var btnKNND = $('#button__id__khoaNhieuNguoiDung');
			var btnParent4 = $('#div__id__div_button_parent_4');
			if(chkcCheck === tblND.DataTable().rows().indexes().length)
			{
				$('[data-checkbox-user="p"]').prop('checked', true);
				if(cbg.length)
				{
					cbg.html('Có ' + chkcCheck +' người dùng được chọn.');
					btnXNND.attr('data-original-title', 'Xoá các người dùng đã chọn');
					btnMKNND.attr('data-original-title', 'Mở khoá các tài khoản người dùng đã chọn');
					btnKNND.attr('data-original-title', 'Khoá tài khoản các người dùng đã chọn');
				}
				else
				{
					$('<div class="row marginBottom10" id="div__id__div_button_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + chkcCheck + ' người dùng được chọn.</p></div><div class="col-sm-3"><div class="btn-group"><button type="button" id="button__id__xoaNhieuNguoiDung" class="btn btn-danger _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tài khoản người dùng đã chọn"><i class="fa fa-trash-o"></i></button><button type="button" id="button__id__mkNhieuNguoiDung" class="btn btn-success _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Mở khoá các người dùng đã chọn"><i class="fa fa-unlock-alt"></i></button><button type="button" id="button__id__khoaNhieuNguoiDung" class="btn btn-warning _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Khoá tài khoản các người dùng đã chọn"><i class="fa fa-lock"></i></button></div></div></div>').insertAfter('.div__class__group_button');
					btnXNND = $('#button__id__xoaNhieuNguoiDung');
					btnMKNND = $('#button__id__mkNhieuNguoiDung');
					btnKNND = $('#button__id__khoaNhieuNguoiDung');
					btnXNND.attr('data-original-title', 'Xoá các người dùng đã chọn');
					btnMKNND.attr('data-original-title', 'Mở khoá các tài khoản người dùng đã chọn');
					btnKNND.attr('data-original-title', 'Khoá tài khoản các người dùng đã chọn');
					btnXNND.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					btnMKNND.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					btnKNND.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
			}
			else
			{
				$('[data-checkbox-user="p"]').prop('checked', false);
				if(!chkcCheck)
				{
					if(btnParent4.length)
						btnParent4.remove();
				}
				else if(cbg.length)
				{
					cbg.html('Có ' + chkcCheck +' người dùng được chọn.');
					if(chkcCheck > 1)
					{
						btnXNND.attr('data-original-title', 'Xoá các người dùng đã chọn');
						btnMKNND.attr('data-original-title', 'Mở khoá các tài khoản người dùng đã chọn');
						btnKNND.attr('data-original-title', 'Khoá tài khoản các người dùng đã chọn');
					}
					else
					{
						btnXNND.attr('data-original-title', 'Xoá người dùng đã chọn');
						btnMKNND.attr('data-original-title', 'Mở khoá tài khoản người dùng đã chọn');
						btnKNND.attr('data-original-title', 'Khoá tài khoản người dùng đã chọn');
					}
				}
				else
				{
					$('<div class="row marginBottom10" id="div__id__div_button_parent_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + chkcCheck + ' người dùng được chọn.</p></div><div class="col-sm-3"><div class="btn-group"><button type="button" id="button__id__xoaNhieuNguoiDung" class="btn btn-danger _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tài khoản người dùng đã chọn"><i class="fa fa-trash-o"></i></button><button type="button" id="button__id__mkNhieuNguoiDung" class="btn btn-success _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Mở khoá các người dùng đã chọn"><i class="fa fa-unlock-alt"></i></button><button type="button" id="button__id__khoaNhieuNguoiDung" class="btn btn-warning _btn-sm" data-toggle="tooltip" data-placement="bottom" data-original-title="Khoá tài khoản các người dùng đã chọn"><i class="fa fa-lock"></i></button></div></div></div>').insertAfter('.div__class__group_button');
					btnXNND = $('#button__id__xoaNhieuNguoiDung');
					btnMKNND = $('#button__id__mkNhieuNguoiDung');
					btnKNND = $('#button__id__khoaNhieuNguoiDung');
					btnXNND.attr('data-original-title', 'Xoá người dùng đã chọn');
					btnMKNND.attr('data-original-title', 'Mở khoá tài khoản người dùng đã chọn');
					btnKNND.attr('data-original-title', 'Khoá tài khoản người dùng đã chọn');
					btnXNND.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					btnMKNND.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					btnKNND.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
				}
			}
		}
		if(tblND.length)
		{
			/*Sự kiện click lên vùng chứa checkbox*/
			tblND.on('click', '[data-th-td]', function(){
				try
				{
					clickParentToCheck($(this), 'user', tblND, chkUserSummaryCheck, chkUserCheck);
					return true;
				}
	        	catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
			/*Sự kiện click checkbox*/
			tblND.on('click', '[data-checkbox-user]', function(e){
				try
				{
					
					clickToCheck(e, $(this), 'user', tblND, chkUserSummaryCheck, chkUserCheck);
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