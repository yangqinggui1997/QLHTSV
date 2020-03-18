<script>
$(function(){
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTablesDanhGiaRL(){
			try
			{
				if(console.log("run_datatablesDanhGiaRL"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b = $('#table__id__danhGiaRL');
	    			var count = 0;
	    			var l1 = 0;
	    			/*tạo table = script sau đó khởi tạo, insert table vào vùng chứa*/
	    			console.log("init_DataTablesDanhGiaRL");
    				b.dataTable({
	    				order:[[1,"asc"]],
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});
	    			l1 = $('#table__id__xemLaiDGRL_wrapper').length;
	    			count = l1 ? 1 : count;
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng đánh giá rèn luyện*/
	    			$('#table__id__danhGiaRL_wrapper').prepend('<div class="row marginBottom10 div__class__group_button_danhGiaRL"></div>');

	    			$('#table__id__danhGiaRL_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_danhGiaRL_1"><div class="row"><div class="col-sm-4" id="div__id__button_parent_danhGiaRL_1_1"></div><div class="col-sm-8" id="div__id__button_parent_danhGiaRL_1_2"></div></div></div>').insertAfter($('[data-id="div__id__button_group"]')[count]);
	    			$('#div__id__div_button_parent_danhGiaRL_1').append($('#table__id__danhGiaRL_length'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_danhGiaRL_2"></div>').insertAfter('#div__id__div_button_parent_danhGiaRL_1');
	    			$('#div__id__div_button_parent_danhGiaRL_2').append($('[data-id="div__id__button_group"]')[count]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_danhGiaRL_3"></div>').insertAfter('#div__id__div_button_parent_danhGiaRL_2');
	    			$('#div__id__div_button_parent_danhGiaRL_3').append($('#table__id__danhGiaRL_filter'));
	    			$('#table__id__danhGiaRL_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_danhGiaRL"]').append($('#div__id__div_button_parent_danhGiaRL_1'));
	    			$('[class*="div__class__group_button_danhGiaRL"]').append($('#div__id__div_button_parent_danhGiaRL_2'));
	    			$('[class*="div__class__group_button_danhGiaRL"]').append($('#div__id__div_button_parent_danhGiaRL_3'));
	    			$('#div__id__button_parent_danhGiaRL_1_1').append($('#div__id__button_group_danhGiaRL'));
	    			$('#div__id__button_parent_danhGiaRL_1_2').append($('#table__id__danhGiaRL_length'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[0]).attr('data-id', 'button__id__saoChep_danhGiaRL');
	    			$('[data-id="button__id__saoChep_danhGiaRL"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_danhGiaRL"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_danhGiaRL"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[0]).attr('data-id', 'button__id__saoChep_danhGiaRL');
	    			$('[data-id="button__id__saoChep_danhGiaRL"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_danhGiaRL"]').attr('data-original-title', $($('[data-id="button__id__saoChep_danhGiaRL"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_danhGiaRL"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_danhGiaRL"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_danhGiaRL"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[1]).attr('data-id', 'button__id__excel_danhGiaRL');
	    			$('[data-id="button__id__excel_danhGiaRL"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_danhGiaRL"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_danhGiaRL"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_danhGiaRL"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_danhGiaRL"]').attr('data-original-title', $($('[data-id="button__id__excel_danhGiaRL"]').children()[0]).html());
	    			$('[data-id="button__id__excel_danhGiaRL"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_danhGiaRL"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_danhGiaRL"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[2]).attr('data-id', 'button__id__pdf_danhGiaRL');
	    			$('[data-id="button__id__pdf_danhGiaRL"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_danhGiaRL"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_danhGiaRL"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_danhGiaRL"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_danhGiaRL"]').attr('data-original-title', $($('[data-id="button__id__pdf_danhGiaRL"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_danhGiaRL"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_danhGiaRL"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_danhGiaRL"]').attr('data-placement', 'left');

	    			/*Khởi tạo tooltip cho các nút export*/
					$('[data-id="button__id__saoChep_danhGiaRL"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__excel_danhGiaRL"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__pdf_danhGiaRL"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
	    			return true;
    			}
				return false;
			}
			catch(err)
			{
				alert('Lỗi: ' + err.stack + '!');
				return false;
			}
		}

		/*click button xem kết quả học tập*/
		if($('#tbody__id__hocKyHT').length)
			$('#tbody__id__hocKyHT').on('click', '[data-button="xemDiemRLCT"]', function(){
				try
	            {
	            	/*destroy and reinit datatable*/
	            	if($('#table__id__danhGiaRL_wrapper').length)
	            	{
	            		$('#div__id__danhGiaRLArea').prepend($('#div__id__button_group_danhGiaRL'));
		    			$('#table__id__danhGiaRL').dataTable().fnDestroy();
						$('#div__id__button_parent_danhGiaRL_1_1').append($('#div__id__button_group_danhGiaRL'));
	            	}
	    			init_DataTablesDanhGiaRL();
		            $('#div__id__danhGiaRL').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__danhGiaRL").offset().top
		            }, 800);
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