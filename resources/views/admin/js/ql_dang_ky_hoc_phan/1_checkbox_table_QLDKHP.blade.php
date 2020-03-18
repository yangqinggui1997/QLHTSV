<script>
$(function(){
	try
	{
		/*click checkbox chọn tất cả mở đăng ký học phần*/
		if($('#checkbox__id__dtb_qlDangKyHP_chkAll').length)
			$('#checkbox__id__dtb_qlDangKyHP_chkAll').on('change', function(){
				try
				{
					if($(this).prop('checked'))
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]').prop('checked', true);
						if(!$('#div__id__div_button_parent_qlDangKyHP_4').length)
						{
							$('<div class="row" id="div__id__div_button_parent_qlDangKyHP_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length + ' mở đăng ký học phần được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuQlDangKyHP" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các mở đăng ký học phần đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_qlDangKyHP"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuQlDangKyHP').attr('data-original-title', 'Xoá các mở đăng ký học phần đã chọn');
							else
								$('#button__id__xoaNhieuQlDangKyHP').attr('data-original-title', 'Xoá mở đăng ký học phần đã chọn');

							$('#button__id__xoaNhieuQlDangKyHP').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}

						else
							if($('#p__id__chonBanGhi').length)
							{
								$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length +' mở đăng ký học phần được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuQlDangKyHP').attr('data-original-title', 'Xoá các mở đăng ký học phần đã chọn');
								else
									$('#button__id__xoaNhieuQlDangKyHP').attr('data-original-title', 'Xoá mở đăng ký học phần đã chọn');

								$('#button__id__xoaNhieuQlDangKyHP').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
					else
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]').prop('checked', false);
						if($('#div__id__div_button_parent_qlDangKyHP_4').length)
							$('#div__id__div_button_parent_qlDangKyHP_4').remove();
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click các checkbox từng mở đăng ký học phần*/
		if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]').length)
			$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]').on('change', function(){
				try
				{
					if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]').length)
					{
						$('#checkbox__id__dtb_qlDangKyHP_chkAll').prop('checked', true);
						if($('#p__id__chonBanGhi').length)
						{
							$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length +' mở đăng ký học phần được chọn.');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuQlDangKyHP').attr('data-original-title', 'Xoá các mở đăng ký học phần đã chọn');
							else
								$('#button__id__xoaNhieuQlDangKyHP').attr('data-original-title', 'Xoá mở đăng ký học phần đã chọn');

							$('#button__id__xoaNhieuQlDangKyHP').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
						{
							$('<div class="row" id="div__id__div_button_parent_qlDangKyHP_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length + ' mở đăng ký học phần được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuQlDangKyHP" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các mở đăng ký học phần đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_qlDangKyHP"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuQlDangKyHP').attr('data-original-title', 'Xoá các mở đăng ký học phần đã chọn');
							else
								$('#button__id__xoaNhieuQlDangKyHP').attr('data-original-title', 'Xoá mở đăng ký học phần đã chọn');

							$('#button__id__xoaNhieuQlDangKyHP').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
					}
					else
					{
						$('#checkbox__id__dtb_qlDangKyHP_chkAll').prop('checked', false);
						if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length)
						{
							if($('#div__id__div_button_parent_qlDangKyHP_4').length)
								$('#div__id__div_button_parent_qlDangKyHP_4').remove();
						}
						else
							if($('#p__id__chonBanGhi').length)
							{
								$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length +' mở đăng ký học phần được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuQlDangKyHP').attr('data-original-title', 'Xoá các mở đăng ký học phần đã chọn');
								else
									$('#button__id__xoaNhieuQlDangKyHP').attr('data-original-title', 'Xoá mở đăng ký học phần đã chọn');

								$('#button__id__xoaNhieuQlDangKyHP').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
							else
							{
								$('<div class="row" id="div__id__div_button_parent_qlDangKyHP_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length + ' mở đăng ký học phần được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuQlDangKyHP" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá mở đăng ký học phần đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_qlDangKyHP"]');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_qlDangKyHP_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuQlDangKyHP').attr('data-original-title', 'Xoá các mở đăng ký học phần đã chọn');
								else
									$('#button__id__xoaNhieuQlDangKyHP').attr('data-original-title', 'Xoá mở đăng ký học phần đã chọn');

								$('#button__id__xoaNhieuQlDangKyHP').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
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