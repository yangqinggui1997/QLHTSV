<script>
$(function(){
	try
	{
		/*click checkbox chọn tất cả học phần*/
		if($('#checkbox__id__dtb_hocPhan_chkAll').length)
			$('#checkbox__id__dtb_hocPhan_chkAll').on('change', function(){
				try
				{
					if($(this).prop('checked'))
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]').prop('checked', true);
						if(!$('#div__id__div_button_parent_hocPhan_4').length)
						{
							$('<div class="row" id="div__id__div_button_parent_hocPhan_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length + ' học phần được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuHP" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các học phần đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[class*="div__class__group_button_hocPhan"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuHP').attr('data-original-title', 'Xoá các học phần đã chọn');
							else
								$('#button__id__xoaNhieuHP').attr('data-original-title', 'Xoá học phần đã chọn');

							$('#button__id__xoaNhieuHP').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}

						else
							if($('#p__id__chonBanGhi').length)
							{
								$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length +' học phần được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuHP').attr('data-original-title', 'Xoá các học phần đã chọn');
								else
									$('#button__id__xoaNhieuHP').attr('data-original-title', 'Xoá học phần đã chọn');

								$('#button__id__xoaNhieuHP').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
					else
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]').prop('checked', false);
						if($('#div__id__div_button_parent_hocPhan_4').length)
							$('#div__id__div_button_parent_hocPhan_4').remove();
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click các checkbox từng học phần*/
		if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]').length)
			$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]').on('change', function(){
				try
				{
					if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]').length)
					{
						$('#checkbox__id__dtb_hocPhan_chkAll').prop('checked', true);
						if($('#p__id__chonBanGhi').length)
						{
							$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length +' học phần được chọn.');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuHP').attr('data-original-title', 'Xoá các học phần đã chọn');
							else
								$('#button__id__xoaNhieuHP').attr('data-original-title', 'Xoá học phần đã chọn');

							$('#button__id__xoaNhieuHP').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
						{
							$('<div class="row" id="div__id__div_button_parent_hocPhan_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length + ' học phần được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuHP" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các học phần đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[class*="div__class__group_button_hocPhan"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuHP').attr('data-original-title', 'Xoá các học phần đã chọn');
							else
								$('#button__id__xoaNhieuHP').attr('data-original-title', 'Xoá học phần đã chọn');

							$('#button__id__xoaNhieuHP').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
					}
					else
					{
						$('#checkbox__id__dtb_hocPhan_chkAll').prop('checked', false);
						if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length)
						{
							if($('#div__id__div_button_parent_hocPhan_4').length)
								$('#div__id__div_button_parent_hocPhan_4').remove();
						}
						else
							if($('#p__id__chonBanGhi').length)
							{
								$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length +' học phần được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuHP').attr('data-original-title', 'Xoá các học phần đã chọn');
								else
									$('#button__id__xoaNhieuHP').attr('data-original-title', 'Xoá học phần đã chọn');

								$('#button__id__xoaNhieuHP').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
							else
							{
								$('<div class="row" id="div__id__div_button_parent_hocPhan_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length + ' học phần được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuHP" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá học phần đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[class*="div__class__group_button_hocPhan"]');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_hocPhan_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuHP').attr('data-original-title', 'Xoá các học phần đã chọn');
								else
									$('#button__id__xoaNhieuHP').attr('data-original-title', 'Xoá học phần đã chọn');

								$('#button__id__xoaNhieuHP').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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