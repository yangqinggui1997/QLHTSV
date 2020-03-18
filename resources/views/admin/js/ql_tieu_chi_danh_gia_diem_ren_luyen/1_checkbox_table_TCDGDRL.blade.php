<script>
$(function(){
	try
	{
		/*click checkbox chọn tất cả tiêu chí đánh giá rèn luyện tổng quát*/
		if($('#checkbox__id__dtb_TCDG_chkAll').length)
			$('#checkbox__id__dtb_TCDG_chkAll').on('change', function(){
				try
				{
					if($(this).prop('checked'))
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]').prop('checked', true);
						if(!$('#div__id__div_button_parent_TCDG_4').length)
						{
							$('<div class="row" id="div__id__div_button_parent_TCDG_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length + ' tiêu chí đánh giá rèn luyện tổng quát được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuTCDG" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tiêu chí đánh giá rèn luyện tổng quát đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_TCDG"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá các tiêu chí đánh giá rèn luyện tổng quát đã chọn');
							else
								$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá tiêu chí đánh giá rèn luyện tổng quát đã chọn');

							$('#button__id__xoaNhieuTCDG').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}

						else
							if($('#p__id__chonBanGhi').length)
							{
								$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length +' tiêu chí đánh giá rèn luyện tổng quát được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá các tiêu chí đánh giá rèn luyện tổng quát đã chọn');
								else
									$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá tiêu chí đánh giá rèn luyện tổng quát đã chọn');

								$('#button__id__xoaNhieuTCDG').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
					else
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]').prop('checked', false);
						if($('#div__id__div_button_parent_TCDG_4').length)
							$('#div__id__div_button_parent_TCDG_4').remove();
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click các checkbox từng tiêu chí đánh giá rèn luyện tổng quát*/
		if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]').length)
			$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]').on('change', function(){
				try
				{
					if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]').length)
					{
						$('#checkbox__id__dtb_TCDG_chkAll').prop('checked', true);
						if($('#p__id__chonBanGhi').length)
						{
							$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length +' tiêu chí đánh giá rèn luyện tổng quát được chọn.');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá các tiêu chí đánh giá rèn luyện tổng quát đã chọn');
							else
								$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá tiêu chí đánh giá rèn luyện tổng quát đã chọn');

							$('#button__id__xoaNhieuTCDG').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
						{
							$('<div class="row" id="div__id__div_button_parent_TCDG_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length + ' tiêu chí đánh giá rèn luyện tổng quát được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuTCDG" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tiêu chí đánh giá rèn luyện tổng quát đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_TCDG"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá các tiêu chí đánh giá rèn luyện tổng quát đã chọn');
							else
								$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá tiêu chí đánh giá rèn luyện tổng quát đã chọn');

							$('#button__id__xoaNhieuTCDG').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
					}
					else
					{
						$('#checkbox__id__dtb_TCDG_chkAll').prop('checked', false);
						if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length)
						{
							if($('#div__id__div_button_parent_TCDG_4').length)
								$('#div__id__div_button_parent_TCDG_4').remove();
						}
						else
							if($('#p__id__chonBanGhi').length)
							{
								$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length +' tiêu chí đánh giá rèn luyện tổng quát được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá các tiêu chí đánh giá rèn luyện tổng quát đã chọn');
								else
									$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá tiêu chí đánh giá rèn luyện tổng quát đã chọn');

								$('#button__id__xoaNhieuTCDG').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
							else
							{
								$('<div class="row" id="div__id__div_button_parent_TCDG_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length + ' tiêu chí đánh giá rèn luyện tổng quát được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuTCDG" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá tiêu chí đánh giá rèn luyện tổng quát đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_TCDG"]');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDG_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá các tiêu chí đánh giá rèn luyện tổng quát đã chọn');
								else
									$('#button__id__xoaNhieuTCDG').attr('data-original-title', 'Xoá tiêu chí đánh giá rèn luyện tổng quát đã chọn');

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

		/*click checkbox chọn tất cả tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha]*/
		if($('#checkbox__id__dtb_TCDGCT_chkAll').length)
			$('#checkbox__id__dtb_TCDGCT_chkAll').on('change', function(){
				try
				{
					if($(this).prop('checked'))
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]').prop('checked', true);
						if(!$('#div__id__div_button_parent_TCDGCT_4').length)
						{
							$('<div class="row" id="div__id__div_button_parent_TCDGCT_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiTCDGCT"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length + ' tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuTCDGCT" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_TCDGCT"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuTCDGCT').attr('data-original-title', 'Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');
							else
								$('#button__id__xoaNhieuTCDGCT').attr('data-original-title', 'Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');

							$('#button__id__xoaNhieuTCDGCT').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}

						else
							if($('#p__id__chonBanGhiTCDGCT').length)
							{
								$('#p__id__chonBanGhiTCDGCT').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length +' tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuTCDGCT').attr('data-original-title', 'Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');
								else
									$('#button__id__xoaNhieuTCDGCT').attr('data-original-title', 'Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');

								$('#button__id__xoaNhieuTCDGCT').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
					else
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]').prop('checked', false);
						if($('#div__id__div_button_parent_TCDGCT_4').length)
							$('#div__id__div_button_parent_TCDGCT_4').remove();
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click các checkbox từng tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha]*/
		if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]').length)
			$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]').on('change', function(){
				try
				{
					if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]').length)
					{
						$('#checkbox__id__dtb_TCDGCT_chkAll').prop('checked', true);
						if($('#p__id__chonBanGhiTCDGCT').length)
						{
							$('#p__id__chonBanGhiTCDGCT').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length +' tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] được chọn.');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuTCDGCT').attr('data-original-title', 'Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');
							else
								$('#button__id__xoaNhieuTCDGCT').attr('data-original-title', 'Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');

							$('#button__id__xoaNhieuTCDGCT').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
						{
							$('<div class="row" id="div__id__div_button_parent_TCDGCT_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiTCDGCT"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length + ' tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuTCDGCT" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_TCDGCT"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuTCDGCT').attr('data-original-title', 'Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');
							else
								$('#button__id__xoaNhieuTCDGCT').attr('data-original-title', 'Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');

							$('#button__id__xoaNhieuTCDGCT').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
					}
					else
					{
						$('#checkbox__id__dtb_TCDGCT_chkAll').prop('checked', false);
						if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length)
						{
							if($('#div__id__div_button_parent_TCDGCT_4').length)
								$('#div__id__div_button_parent_TCDGCT_4').remove();
						}
						else
							if($('#p__id__chonBanGhiTCDGCT').length)
							{
								$('#p__id__chonBanGhiTCDGCT').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length +' tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuTCDGCT').attr('data-original-title', 'Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');
								else
									$('#button__id__xoaNhieuTCDGCT').attr('data-original-title', 'Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');

								$('#button__id__xoaNhieuTCDGCT').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
							else
							{
								$('<div class="row" id="div__id__div_button_parent_TCDGCT_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiTCDGCT"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length + ' tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuTCDGCT" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_TCDGCT"]');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_TCDGCT_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuTCDGCT').attr('data-original-title', 'Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');
								else
									$('#button__id__xoaNhieuTCDGCT').attr('data-original-title', 'Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');

								$('#button__id__xoaNhieuTCDGCT').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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

		/*click checkbox chọn tất cả tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha]*/
		if($('#checkbox__id__dtb_CTCTCDGCT_chkAll').length)
			$('#checkbox__id__dtb_CTCTCDGCT_chkAll').on('change', function(){
				try
				{
					if($(this).prop('checked'))
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]').prop('checked', true);
						if(!$('#div__id__div_button_parent_CTCTCDGCT_4').length)
						{
							$('<div class="row" id="div__id__div_button_parent_CTCTCDGCT_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiCTCTCDGCT"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length + ' tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuCTCTCDGCT" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_CTCTCDGCT"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuCTCTCDGCT').attr('data-original-title', 'Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');
							else
								$('#button__id__xoaNhieuCTCTCDGCT').attr('data-original-title', 'Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');

							$('#button__id__xoaNhieuCTCTCDGCT').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}

						else
							if($('#p__id__chonBanGhiCTCTCDGCT').length)
							{
								$('#p__id__chonBanGhiCTCTCDGCT').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length +' tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuCTCTCDGCT').attr('data-original-title', 'Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');
								else
									$('#button__id__xoaNhieuCTCTCDGCT').attr('data-original-title', 'Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');

								$('#button__id__xoaNhieuCTCTCDGCT').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
					}
					else
					{
						$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]').prop('checked', false);
						if($('#div__id__div_button_parent_CTCTCDGCT_4').length)
							$('#div__id__div_button_parent_CTCTCDGCT_4').remove();
					}
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click các checkbox từng tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha]*/
		if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]').length)
			$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]').on('change', function(){
				try
				{
					if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]').length)
					{
						$('#checkbox__id__dtb_CTCTCDGCT_chkAll').prop('checked', true);
						if($('#p__id__chonBanGhiCTCTCDGCT').length)
						{
							$('#p__id__chonBanGhiCTCTCDGCT').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length +' tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] được chọn.');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuCTCTCDGCT').attr('data-original-title', 'Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');
							else
								$('#button__id__xoaNhieuCTCTCDGCT').attr('data-original-title', 'Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');

							$('#button__id__xoaNhieuCTCTCDGCT').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
						else
						{
							$('<div class="row" id="div__id__div_button_parent_CTCTCDGCT_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiCTCTCDGCT"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length + ' tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuCTCTCDGCT" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_CTCTCDGCT"]');

							if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length > 1)
								$('#button__id__xoaNhieuCTCTCDGCT').attr('data-original-title', 'Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');
							else
								$('#button__id__xoaNhieuCTCTCDGCT').attr('data-original-title', 'Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');

							$('#button__id__xoaNhieuCTCTCDGCT').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
						}
					}
					else
					{
						$('#checkbox__id__dtb_CTCTCDGCT_chkAll').prop('checked', false);
						if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length)
						{
							if($('#div__id__div_button_parent_CTCTCDGCT_4').length)
								$('#div__id__div_button_parent_CTCTCDGCT_4').remove();
						}
						else
							if($('#p__id__chonBanGhiCTCTCDGCT').length)
							{
								$('#p__id__chonBanGhiCTCTCDGCT').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length +' tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] được chọn.');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuCTCTCDGCT').attr('data-original-title', 'Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');
								else
									$('#button__id__xoaNhieuCTCTCDGCT').attr('data-original-title', 'Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');

								$('#button__id__xoaNhieuCTCTCDGCT').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							}
							else
							{
								$('<div class="row" id="div__id__div_button_parent_CTCTCDGCT_4"><div class="col-sm-4"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhiCTCTCDGCT"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length + ' tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] được chọn.</p></div><div class="col-sm-1"><button type="button" id="button__id__xoaNhieuCTCTCDGCT" class="btn btn-danger" data-toggle="tooltip" data-original-title="Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div>').insertAfter('[data-id="div__class__group_button_CTCTCDGCT"]');

								if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_CTCTCDGCT_chk"]:checked').length > 1)
									$('#button__id__xoaNhieuCTCTCDGCT').attr('data-original-title', 'Xoá các tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');
								else
									$('#button__id__xoaNhieuCTCTCDGCT').attr('data-original-title', 'Xoá tiêu chí đánh giá chi tiết của tiêu chí [tên tiêu chí cha] đã chọn');

								$('#button__id__xoaNhieuCTCTCDGCT').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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