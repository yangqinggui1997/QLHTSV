<script>
$(function(){
	try
	{
		/*click checkbox chọn tất cả tỉnh*/
		if($('#checkbox__id__dtb_tinh_chkAll').length)
			$('#checkbox__id__dtb_tinh_chkAll').on('change', function(){
				try
				{
					if($(this).prop('checked'))
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]').prop('checked', true);
						if(!$('#div__id__div_button_parent_tinh_4').length)
						{
							$('<div class="row" id="div__id__div_button_parent_tinh_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length + ' tỉnh được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuTCDG" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tỉnh đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_tinh"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá các tỉnh đã chọn');
							else
								$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá tỉnh đã chọn');

							$('#button__id__xoaNhieuTCDG').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}

						else
							if($('#p__id__chonBanGhi').length)
							{
								$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length +' tỉnh được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá các tỉnh đã chọn');
								else
									$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá tỉnh đã chọn');

								$('#button__id__xoaNhieuTCDG').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
					else
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]').prop('checked', false);
						if($('#div__id__div_button_parent_tinh_4').length)
							$('#div__id__div_button_parent_tinh_4').remove();
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click các checkbox từng tỉnh*/
		if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]').length)
			$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]').on('change', function(){
				try
				{
					if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]').length)
					{
						$('#checkbox__id__dtb_tinh_chkAll').prop('checked', true);
						if($('#p__id__chonBanGhi').length)
						{
							$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length +' tỉnh được chọn.');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá các tỉnh đã chọn');
							else
								$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá tỉnh đã chọn');

							$('#button__id__xoaNhieuTCDG').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
						{
							$('<div class="row" id="div__id__div_button_parent_tinh_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length + ' tỉnh được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuTCDG" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tỉnh đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_tinh"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá các tỉnh đã chọn');
							else
								$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá tỉnh đã chọn');

							$('#button__id__xoaNhieuTCDG').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
					}
					else
					{
						$('#checkbox__id__dtb_tinh_chkAll').prop('checked', false);
						if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length)
						{
							if($('#div__id__div_button_parent_tinh_4').length)
								$('#div__id__div_button_parent_tinh_4').remove();
						}
						else
							if($('#p__id__chonBanGhi').length)
							{
								$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length +' tỉnh được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá các tỉnh đã chọn');
								else
									$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá tỉnh đã chọn');

								$('#button__id__xoaNhieuTCDG').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
							else
							{
								$('<div class="row" id="div__id__div_button_parent_tinh_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length + ' tỉnh được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuTCDG" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá tỉnh đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_tinh"]');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_tinh_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá các tỉnh đã chọn');
								else
									$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá tỉnh đã chọn');

								$('#button__id__xoaNhieuTCDG').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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

		/*click checkbox chọn tất cả huyện*/
		if($('#checkbox__id__dtb_huyen_chkAll').length)
			$('#checkbox__id__dtb_huyen_chkAll').on('change', function(){
				try
				{
					if($(this).prop('checked'))
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]').prop('checked', true);
						if(!$('#div__id__div_button_parent_huyen_4').length)
						{
							$('<div class="row" id="div__id__div_button_parent_huyen_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiHuyen"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length + ' huyện được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuHuyen" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các huyện đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_huyen"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuHuyen').attr('data-original-title', 'Xoá các huyện đã chọn');
							else
								$('#button__id__xoaNhieuHuyen').attr('data-original-title', 'Xoá huyện đã chọn');

							$('#button__id__xoaNhieuHuyen').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}

						else
							if($('#p__id__chonBanGhiHuyen').length)
							{
								$('#p__id__chonBanGhiHuyen').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length +' huyện được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuHuyen').attr('data-original-title', 'Xoá các huyện đã chọn');
								else
									$('#button__id__xoaNhieuHuyen').attr('data-original-title', 'Xoá huyện đã chọn');

								$('#button__id__xoaNhieuHuyen').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
					else
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]').prop('checked', false);
						if($('#div__id__div_button_parent_huyen_4').length)
							$('#div__id__div_button_parent_huyen_4').remove();
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click các checkbox từng huyện*/
		if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]').length)
			$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]').on('change', function(){
				try
				{
					if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]').length)
					{
						$('#checkbox__id__dtb_huyen_chkAll').prop('checked', true);
						if($('#p__id__chonBanGhiHuyen').length)
						{
							$('#p__id__chonBanGhiHuyen').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length +' huyện được chọn.');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuHuyen').attr('data-original-title', 'Xoá các huyện đã chọn');
							else
								$('#button__id__xoaNhieuHuyen').attr('data-original-title', 'Xoá huyện đã chọn');

							$('#button__id__xoaNhieuHuyen').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
						{
							$('<div class="row" id="div__id__div_button_parent_huyen_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiHuyen"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length + ' huyện được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuHuyen" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các huyện đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_huyen"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuHuyen').attr('data-original-title', 'Xoá các huyện đã chọn');
							else
								$('#button__id__xoaNhieuHuyen').attr('data-original-title', 'Xoá huyện đã chọn');

							$('#button__id__xoaNhieuHuyen').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
					}
					else
					{
						$('#checkbox__id__dtb_huyen_chkAll').prop('checked', false);
						if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length)
						{
							if($('#div__id__div_button_parent_huyen_4').length)
								$('#div__id__div_button_parent_huyen_4').remove();
						}
						else
							if($('#p__id__chonBanGhiHuyen').length)
							{
								$('#p__id__chonBanGhiHuyen').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length +' huyện được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuHuyen').attr('data-original-title', 'Xoá các huyện đã chọn');
								else
									$('#button__id__xoaNhieuHuyen').attr('data-original-title', 'Xoá huyện đã chọn');

								$('#button__id__xoaNhieuHuyen').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
							else
							{
								$('<div class="row" id="div__id__div_button_parent_huyen_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiHuyen"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length + ' huyện được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuHuyen" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá huyện đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_huyen"]');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_huyen_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuHuyen').attr('data-original-title', 'Xoá các huyện đã chọn');
								else
									$('#button__id__xoaNhieuHuyen').attr('data-original-title', 'Xoá huyện đã chọn');

								$('#button__id__xoaNhieuHuyen').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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

		/*click checkbox chọn tất cả xã*/
		if($('#checkbox__id__dtb_xa_chkAll').length)
			$('#checkbox__id__dtb_xa_chkAll').on('change', function(){
				try
				{
					if($(this).prop('checked'))
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]').prop('checked', true);
						if(!$('#div__id__div_button_parent_xa_4').length)
						{
							$('<div class="row" id="div__id__div_button_parent_xa_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiXa"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length + ' xã được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuXa" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các xã đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_xa"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuXa').attr('data-original-title', 'Xoá các xã đã chọn');
							else
								$('#button__id__xoaNhieuXa').attr('data-original-title', 'Xoá xã đã chọn');

							$('#button__id__xoaNhieuXa').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}

						else
							if($('#p__id__chonBanGhiXa').length)
							{
								$('#p__id__chonBanGhiXa').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length +' xã được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuXa').attr('data-original-title', 'Xoá các xã đã chọn');
								else
									$('#button__id__xoaNhieuXa').attr('data-original-title', 'Xoá xã đã chọn');

								$('#button__id__xoaNhieuXa').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
					else
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]').prop('checked', false);
						if($('#div__id__div_button_parent_xa_4').length)
							$('#div__id__div_button_parent_xa_4').remove();
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click các checkbox từng xã*/
		if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]').length)
			$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]').on('change', function(){
				try
				{
					if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]').length)
					{
						$('#checkbox__id__dtb_xa_chkAll').prop('checked', true);
						if($('#p__id__chonBanGhiXa').length)
						{
							$('#p__id__chonBanGhiXa').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length +' xã được chọn.');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuXa').attr('data-original-title', 'Xoá các xã đã chọn');
							else
								$('#button__id__xoaNhieuXa').attr('data-original-title', 'Xoá xã đã chọn');

							$('#button__id__xoaNhieuXa').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
						{
							$('<div class="row" id="div__id__div_button_parent_xa_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiXa"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length + ' xã được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuXa" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các xã đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_xa"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuXa').attr('data-original-title', 'Xoá các xã đã chọn');
							else
								$('#button__id__xoaNhieuXa').attr('data-original-title', 'Xoá xã đã chọn');

							$('#button__id__xoaNhieuXa').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
					}
					else
					{
						$('#checkbox__id__dtb_xa_chkAll').prop('checked', false);
						if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length)
						{
							if($('#div__id__div_button_parent_xa_4').length)
								$('#div__id__div_button_parent_xa_4').remove();
						}
						else
							if($('#p__id__chonBanGhiXa').length)
							{
								$('#p__id__chonBanGhiXa').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length +' xã được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuXa').attr('data-original-title', 'Xoá các xã đã chọn');
								else
									$('#button__id__xoaNhieuXa').attr('data-original-title', 'Xoá xã đã chọn');

								$('#button__id__xoaNhieuXa').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
							else
							{
								$('<div class="row" id="div__id__div_button_parent_xa_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiXa"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length + ' xã được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuXa" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá xã đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_xa"]');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_xa_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuXa').attr('data-original-title', 'Xoá các xã đã chọn');
								else
									$('#button__id__xoaNhieuXa').attr('data-original-title', 'Xoá xã đã chọn');

								$('#button__id__xoaNhieuXa').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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