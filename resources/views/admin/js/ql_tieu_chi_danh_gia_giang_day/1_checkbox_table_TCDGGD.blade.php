<script>
$(function(){
	try
	{
		/*click checkbox chọn tất cả tiêu chí đánh giá giảng dạy*/
		if($('#checkbox__id__dtb_tcdggd_chkAll').length)
			$('#checkbox__id__dtb_tcdggd_chkAll').on('change', function(){
				try
				{
					if($(this).prop('checked'))
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]').prop('checked', true);
						if(!$('#div__id__div_button_parent_tcdggd_4').length)
						{
							$('<div class="row" id="div__id__div_button_parent_tcdggd_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length + ' tiêu chí đánh giá giảng dạy được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieutcdggd" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tiêu chí đánh giá giảng dạy đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_tcdggd"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length > 1)
								$('#button__id__xoaNhieutcdggd').attr('data-original-title', 'Xoá các tiêu chí đánh giá giảng dạy đã chọn');
							else
								$('#button__id__xoaNhieutcdggd').attr('data-original-title', 'Xoá tiêu chí đánh giá giảng dạy đã chọn');

							$('#button__id__xoaNhieutcdggd').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}

						else
							if($('#p__id__chonBanGhi').length)
							{
								$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length +' tiêu chí đánh giá giảng dạy được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length > 1)
									$('#button__id__xoaNhieutcdggd').attr('data-original-title', 'Xoá các tiêu chí đánh giá giảng dạy đã chọn');
								else
									$('#button__id__xoaNhieutcdggd').attr('data-original-title', 'Xoá tiêu chí đánh giá giảng dạy đã chọn');

								$('#button__id__xoaNhieutcdggd').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
					else
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]').prop('checked', false);
						if($('#div__id__div_button_parent_tcdggd_4').length)
							$('#div__id__div_button_parent_tcdggd_4').remove();
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click các checkbox từng tiêu chí đánh giá giảng dạy*/
		if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]').length)
			$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]').on('change', function(){
				try
				{
					if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]').length)
					{
						$('#checkbox__id__dtb_tcdggd_chkAll').prop('checked', true);
						if($('#p__id__chonBanGhi').length)
						{
							$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length +' tiêu chí đánh giá giảng dạy được chọn.');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length > 1)
								$('#button__id__xoaNhieutcdggd').attr('data-original-title', 'Xoá các tiêu chí đánh giá giảng dạy đã chọn');
							else
								$('#button__id__xoaNhieutcdggd').attr('data-original-title', 'Xoá tiêu chí đánh giá giảng dạy đã chọn');

							$('#button__id__xoaNhieutcdggd').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
						{
							$('<div class="row" id="div__id__div_button_parent_tcdggd_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length + ' tiêu chí đánh giá giảng dạy được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieutcdggd" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tiêu chí đánh giá giảng dạy đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_tcdggd"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length > 1)
								$('#button__id__xoaNhieutcdggd').attr('data-original-title', 'Xoá các tiêu chí đánh giá giảng dạy đã chọn');
							else
								$('#button__id__xoaNhieutcdggd').attr('data-original-title', 'Xoá tiêu chí đánh giá giảng dạy đã chọn');

							$('#button__id__xoaNhieutcdggd').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
					}
					else
					{
						$('#checkbox__id__dtb_tcdggd_chkAll').prop('checked', false);
						if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length)
						{
							if($('#div__id__div_button_parent_tcdggd_4').length)
								$('#div__id__div_button_parent_tcdggd_4').remove();
						}
						else
							if($('#p__id__chonBanGhi').length)
							{
								$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length +' tiêu chí đánh giá giảng dạy được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length > 1)
									$('#button__id__xoaNhieutcdggd').attr('data-original-title', 'Xoá các tiêu chí đánh giá giảng dạy đã chọn');
								else
									$('#button__id__xoaNhieutcdggd').attr('data-original-title', 'Xoá tiêu chí đánh giá giảng dạy đã chọn');

								$('#button__id__xoaNhieutcdggd').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
							else
							{
								$('<div class="row" id="div__id__div_button_parent_tcdggd_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length + ' tiêu chí đánh giá giảng dạy được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieutcdggd" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá tiêu chí đánh giá giảng dạy đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_tcdggd"]');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tcdggd_chk"]:checked').length > 1)
									$('#button__id__xoaNhieutcdggd').attr('data-original-title', 'Xoá các tiêu chí đánh giá giảng dạy đã chọn');
								else
									$('#button__id__xoaNhieutcdggd').attr('data-original-title', 'Xoá tiêu chí đánh giá giảng dạy đã chọn');

								$('#button__id__xoaNhieutcdggd').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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