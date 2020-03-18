<script>
$(function(){
	try
	{
		/*click checkbox chọn tất cả lớp*/
		if($('#checkbox__id__dtb_lop_chkAll').length)
			$('#checkbox__id__dtb_lop_chkAll').on('change', function(){
				try
				{
					if($(this).prop('checked'))
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]').prop('checked', true);
						if(!$('#div__id__div_button_parent_lop_4').length)
						{
							$('<div class="row" id="div__id__div_button_parent_lop_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiLop"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length + ' lớp được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuLop" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các lớp đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[class*="div__class__group_button_lop"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuLop').attr('data-original-title', 'Xoá các lớp đã chọn');
							else
								$('#button__id__xoaNhieuLop').attr('data-original-title', 'Xoá lớp đã chọn');

							$('#button__id__xoaNhieuLop').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
							if($('#p__id__chonBanGhiLop').length)
							{
								$('#p__id__chonBanGhiLop').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length +' lớp được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuLop').attr('data-original-title', 'Xoá các lớp đã chọn');
								else
									$('#button__id__xoaNhieuLop').attr('data-original-title', 'Xoá lớp đã chọn');

								$('#button__id__xoaNhieuLop').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
					else
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]').prop('checked', false);
						if($('#div__id__div_button_parent_lop_4').length)
							$('#div__id__div_button_parent_lop_4').remove();
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click các checkbox từng lớp*/
		if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]').length)
			$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]').on('change', function(){
				try
				{
					if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]').length)
					{
						$('#checkbox__id__dtb_lop_chkAll').prop('checked', true);
						if($('#p__id__chonBanGhiLop').length)
						{
							$('#p__id__chonBanGhiLop').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length +' lớp được chọn.');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuLop').attr('data-original-title', 'Xoá các lớp đã chọn');
							else
								$('#button__id__xoaNhieuLop').attr('data-original-title', 'Xoá lớp đã chọn');

							$('#button__id__xoaNhieuLop').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
						{
							$('<div class="row" id="div__id__div_button_parent_lop_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiLop"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length + ' lớp được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuLop" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các lớp đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[class*="div__class__group_button_lop"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuLop').attr('data-original-title', 'Xoá các lớp đã chọn');
							else
								$('#button__id__xoaNhieuLop').attr('data-original-title', 'Xoá lớp đã chọn');

							$('#button__id__xoaNhieuLop').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
					}
					else
					{
						$('#checkbox__id__dtb_lop_chkAll').prop('checked', false);
						if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length)
						{
							if($('#div__id__div_button_parent_lop_4').length)
								$('#div__id__div_button_parent_lop_4').remove();
						}
						else
							if($('#p__id__chonBanGhiLop').length)
							{
								$('#p__id__chonBanGhiLop').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length +' lớp được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuLop').attr('data-original-title', 'Xoá các lớp đã chọn');
								else
									$('#button__id__xoaNhieuLop').attr('data-original-title', 'Xoá lớp đã chọn');

								$('#button__id__xoaNhieuLop').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
							else
							{
								$('<div class="row" id="div__id__div_button_parent_lop_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiLop"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length + ' lớp được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuLop" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá lớp đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[class*="div__class__group_button_lop"]');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_lop_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuLop').attr('data-original-title', 'Xoá các lớp đã chọn');
								else
									$('#button__id__xoaNhieuLop').attr('data-original-title', 'Xoá lớp đã chọn');

								$('#button__id__xoaNhieuLop').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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