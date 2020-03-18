<script>
$(function(){
	try
	{
		/*click checkbox chọn tất cả biểu mẫu dạng file*/
		if($('#checkbox__id__dtb_bieuMauDangFile_chkAll').length)
			$('#checkbox__id__dtb_bieuMauDangFile_chkAll').on('change', function(){
				try
				{
					if($(this).prop('checked'))
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]').prop('checked', true);
						if(!$('#div__id__div_button_parent_bieuMauDangFile_4').length)
						{
							$('<div class="row" id="div__id__div_button_parent_bieuMauDangFile_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiBieuMauDangFile"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length + ' biểu mẫu dạng file được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuBieuMauDangFile" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các biểu mẫu dạng file đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[class*="div__class__group_button_bieuMauDangFile"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuBieuMauDangFile').attr('data-original-title', 'Xoá các biểu mẫu dạng file đã chọn');
							else
								$('#button__id__xoaNhieuBieuMauDangFile').attr('data-original-title', 'Xoá biểu mẫu dạng file đã chọn');

							$('#button__id__xoaNhieuBieuMauDangFile').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}

						else
							if($('#p__id__chonBanGhiBieuMauDangFile').length)
							{
								$('#p__id__chonBanGhiBieuMauDangFile').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length +' biểu mẫu dạng file được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuBieuMauDangFile').attr('data-original-title', 'Xoá các biểu mẫu dạng file đã chọn');
								else
									$('#button__id__xoaNhieuBieuMauDangFile').attr('data-original-title', 'Xoá biểu mẫu dạng file đã chọn');

								$('#button__id__xoaNhieuBieuMauDangFile').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
					else
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]').prop('checked', false);
						if($('#div__id__div_button_parent_bieuMauDangFile_4').length)
							$('#div__id__div_button_parent_bieuMauDangFile_4').remove();
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click các checkbox từng biểu mẫu dạng file*/
		if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]').length)
			$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]').on('change', function(){
				try
				{
					if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]').length)
					{
						$('#checkbox__id__dtb_bieuMauDangFile_chkAll').prop('checked', true);
						if($('#p__id__chonBanGhiBieuMauDangFile').length)
						{
							$('#p__id__chonBanGhiBieuMauDangFile').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length +' biểu mẫu dạng file được chọn.');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuBieuMauDangFile').attr('data-original-title', 'Xoá các biểu mẫu dạng file đã chọn');
							else
								$('#button__id__xoaNhieuBieuMauDangFile').attr('data-original-title', 'Xoá biểu mẫu dạng file đã chọn');

							$('#button__id__xoaNhieuBieuMauDangFile').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
						{
							$('<div class="row" id="div__id__div_button_parent_bieuMauDangFile_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiBieuMauDangFile"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length + ' biểu mẫu dạng file được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuBieuMauDangFile" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các biểu mẫu dạng file đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[class*="div__class__group_button_bieuMauDangFile"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuBieuMauDangFile').attr('data-original-title', 'Xoá các biểu mẫu dạng file đã chọn');
							else
								$('#button__id__xoaNhieuBieuMauDangFile').attr('data-original-title', 'Xoá biểu mẫu dạng file đã chọn');

							$('#button__id__xoaNhieuBieuMauDangFile').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
					}
					else
					{
						$('#checkbox__id__dtb_bieuMauDangFile_chkAll').prop('checked', false);
						if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length)
						{
							if($('#div__id__div_button_parent_bieuMauDangFile_4').length)
								$('#div__id__div_button_parent_bieuMauDangFile_4').remove();
						}
						else
							if($('#p__id__chonBanGhiBieuMauDangFile').length)
							{
								$('#p__id__chonBanGhiBieuMauDangFile').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length +' biểu mẫu dạng file được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuBieuMauDangFile').attr('data-original-title', 'Xoá các biểu mẫu dạng file đã chọn');
								else
									$('#button__id__xoaNhieuBieuMauDangFile').attr('data-original-title', 'Xoá biểu mẫu dạng file đã chọn');

								$('#button__id__xoaNhieuBieuMauDangFile').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
							else
							{
								$('<div class="row" id="div__id__div_button_parent_bieuMauDangFile_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiBieuMauDangFile"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length + ' biểu mẫu dạng file được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuBieuMauDangFile" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá biểu mẫu dạng file đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[class*="div__class__group_button_bieuMauDangFile"]');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangFile_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuBieuMauDangFile').attr('data-original-title', 'Xoá các biểu mẫu dạng file đã chọn');
								else
									$('#button__id__xoaNhieuBieuMauDangFile').attr('data-original-title', 'Xoá biểu mẫu dạng file đã chọn');

								$('#button__id__xoaNhieuBieuMauDangFile').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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

		/*click checkbox chọn tất cả biểu mẫu dạng XML*/
		if($('#checkbox__id__dtb_bieuMauDangXML_chkAll').length)
			$('#checkbox__id__dtb_bieuMauDangXML_chkAll').on('change', function(){
				try
				{
					if($(this).prop('checked'))
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]').prop('checked', true);
						if(!$('#div__id__div_button_parent_bieuMauDangXML_4').length)
						{
							$('<div class="row" id="div__id__div_button_parent_bieuMauDangXML_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiBieuMauDangXML"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length + ' biểu mẫu dạng XML được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuBieuMauDangXML" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các biểu mẫu dạng XML đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[class*="div__class__group_button_bieuMauDangXML"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuBieuMauDangXML').attr('data-original-title', 'Xoá các biểu mẫu dạng XML đã chọn');
							else
								$('#button__id__xoaNhieuBieuMauDangXML').attr('data-original-title', 'Xoá biểu mẫu dạng XML đã chọn');

							$('#button__id__xoaNhieuBieuMauDangXML').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}

						else
							if($('#p__id__chonBanGhiBieuMauDangXML').length)
							{
								$('#p__id__chonBanGhiBieuMauDangXML').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length +' biểu mẫu dạng XML được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuBieuMauDangXML').attr('data-original-title', 'Xoá các biểu mẫu dạng XML đã chọn');
								else
									$('#button__id__xoaNhieuBieuMauDangXML').attr('data-original-title', 'Xoá biểu mẫu dạng XML đã chọn');

								$('#button__id__xoaNhieuBieuMauDangXML').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
					else
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]').prop('checked', false);
						if($('#div__id__div_button_parent_bieuMauDangXML_4').length)
							$('#div__id__div_button_parent_bieuMauDangXML_4').remove();
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click các checkbox từng biểu mẫu dạng XML*/
		if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]').length)
			$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]').on('change', function(){
				try
				{
					if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]').length)
					{
						$('#checkbox__id__dtb_bieuMauDangXML_chkAll').prop('checked', true);
						if($('#p__id__chonBanGhiBieuMauDangXML').length)
						{
							$('#p__id__chonBanGhiBieuMauDangXML').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length +' biểu mẫu dạng XML được chọn.');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuBieuMauDangXML').attr('data-original-title', 'Xoá các biểu mẫu dạng XML đã chọn');
							else
								$('#button__id__xoaNhieuBieuMauDangXML').attr('data-original-title', 'Xoá biểu mẫu dạng XML đã chọn');

							$('#button__id__xoaNhieuBieuMauDangXML').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
						{
							$('<div class="row" id="div__id__div_button_parent_bieuMauDangXML_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiBieuMauDangXML"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length + ' biểu mẫu dạng XML được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuBieuMauDangXML" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các biểu mẫu dạng XML đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[class*="div__class__group_button_bieuMauDangXML"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuBieuMauDangXML').attr('data-original-title', 'Xoá các biểu mẫu dạng XML đã chọn');
							else
								$('#button__id__xoaNhieuBieuMauDangXML').attr('data-original-title', 'Xoá biểu mẫu dạng XML đã chọn');

							$('#button__id__xoaNhieuBieuMauDangXML').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
					}
					else
					{
						$('#checkbox__id__dtb_bieuMauDangXML_chkAll').prop('checked', false);
						if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length)
						{
							if($('#div__id__div_button_parent_bieuMauDangXML_4').length)
								$('#div__id__div_button_parent_bieuMauDangXML_4').remove();
						}
						else
							if($('#p__id__chonBanGhiBieuMauDangXML').length)
							{
								$('#p__id__chonBanGhiBieuMauDangXML').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length +' biểu mẫu dạng XML được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuBieuMauDangXML').attr('data-original-title', 'Xoá các biểu mẫu dạng XML đã chọn');
								else
									$('#button__id__xoaNhieuBieuMauDangXML').attr('data-original-title', 'Xoá biểu mẫu dạng XML đã chọn');

								$('#button__id__xoaNhieuBieuMauDangXML').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
							else
							{
								$('<div class="row" id="div__id__div_button_parent_bieuMauDangXML_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiBieuMauDangXML"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length + ' biểu mẫu dạng XML được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuBieuMauDangXML" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá biểu mẫu dạng XML đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[class*="div__class__group_button_bieuMauDangXML"]');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_bieuMauDangXML_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuBieuMauDangXML').attr('data-original-title', 'Xoá các biểu mẫu dạng XML đã chọn');
								else
									$('#button__id__xoaNhieuBieuMauDangXML').attr('data-original-title', 'Xoá biểu mẫu dạng XML đã chọn');

								$('#button__id__xoaNhieuBieuMauDangXML').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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