<script>
$(function(){
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTablasDanhGiaGD(){
			try
			{
				if(console.log("run_datatablasDanhGiaGD"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b = $('#table__id__danhGiaGD');
	    			var count = 0;
	    			var l1 = 0;
	    			/*tạo table = script sau đó khởi tạo, insert table vào vùng chứa*/
	    			console.log("init_DataTablasDanhGiaGD");
    				b.dataTable({
	    				order:[[1,"asc"]],
	    				columnDefs:[{orderable:!1,targets:[2]},{orderable:!1,targets:[3]},{orderable:!1,targets:[4]},{orderable:!1,targets:[5]}],
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});
	    			l1 = $('#table__id__xemLaiDGGD_wrapper').length;
	    			count = l1 ? 1 : count;
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng đánh giá giảng dạy*/
	    			$('#table__id__danhGiaGD_wrapper').prepend('<div class="row div__class__group_button_danhGiaGD"></div>');

	    			$('#table__id__danhGiaGD_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_danhGiaGD_1"><div class="row"><div class="col-sm-4" id="div__id__button_parent_danhGiaGD_1_1"></div><div class="col-sm-8" id="div__id__button_parent_danhGiaGD_1_2"></div></div></div>').insertAfter($('[data-id="div__id__button_group"]')[count]);
	    			$('#div__id__div_button_parent_danhGiaGD_1').append($('#table__id__danhGiaGD_length'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_danhGiaGD_2"></div>').insertAfter('#div__id__div_button_parent_danhGiaGD_1');
	    			$('#div__id__div_button_parent_danhGiaGD_2').append($('[data-id="div__id__button_group"]')[count]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_danhGiaGD_3"></div>').insertAfter('#div__id__div_button_parent_danhGiaGD_2');
	    			$('#div__id__div_button_parent_danhGiaGD_3').append($('#table__id__danhGiaGD_filter'));
	    			$('#table__id__danhGiaGD_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_danhGiaGD"]').append($('#div__id__div_button_parent_danhGiaGD_1'));
	    			$('[class*="div__class__group_button_danhGiaGD"]').append($('#div__id__div_button_parent_danhGiaGD_2'));
	    			$('[class*="div__class__group_button_danhGiaGD"]').append($('#div__id__div_button_parent_danhGiaGD_3'));
	    			$('#div__id__button_parent_danhGiaGD_1_1').append($('#div__id__button_group_danhGiaGD'));
	    			$('#div__id__button_parent_danhGiaGD_1_2').append($('#table__id__danhGiaGD_length'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[0]).attr('data-id', 'button__id__saoChep_danhGiaGD');
	    			$('[data-id="button__id__saoChep_danhGiaGD"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_danhGiaGD"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_danhGiaGD"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[0]).attr('data-id', 'button__id__saoChep_danhGiaGD');
	    			$('[data-id="button__id__saoChep_danhGiaGD"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_danhGiaGD"]').attr('data-original-title', $($('[data-id="button__id__saoChep_danhGiaGD"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_danhGiaGD"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_danhGiaGD"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_danhGiaGD"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[1]).attr('data-id', 'button__id__excel_danhGiaGD');
	    			$('[data-id="button__id__excel_danhGiaGD"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_danhGiaGD"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_danhGiaGD"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_danhGiaGD"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_danhGiaGD"]').attr('data-original-title', $($('[data-id="button__id__excel_danhGiaGD"]').children()[0]).html());
	    			$('[data-id="button__id__excel_danhGiaGD"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_danhGiaGD"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_danhGiaGD"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[2]).attr('data-id', 'button__id__pdf_danhGiaGD');
	    			$('[data-id="button__id__pdf_danhGiaGD"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_danhGiaGD"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_danhGiaGD"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_danhGiaGD"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_danhGiaGD"]').attr('data-original-title', $($('[data-id="button__id__pdf_danhGiaGD"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_danhGiaGD"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_danhGiaGD"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_danhGiaGD"]').attr('data-placement', 'left');

	    			/*Khởi tạo tooltip cho các nút export*/
					$('[data-id="button__id__saoChep_danhGiaGD"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__excel_danhGiaGD"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__pdf_danhGiaGD"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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

		/*click button đánh giá giảng dạy*/
		if($('#tbody__id__HPHK').length)
			$('#tbody__id__HPHK').on('click', '[data-button="danhGiaGD"]', function(){
				try
	            {
	            	/*destroy and reinit datatable*/
	            	if($('#table__id__danhGiaGD_wrapper').length)
	            	{
		            	$('#div__id__danhGiaGDArea').prepend($('#div__id__button_group_danhGiaGD'));
		    			$('#table__id__danhGiaGD').dataTable().fnDestroy();
						$('#div__id__button_parent_danhGiaGD_1_1').append($('#div__id__button_group_danhGiaGD'));
					}
	    			init_DataTablasDanhGiaGD();
		            $('#div__id__danhGiaGD').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__danhGiaGD").offset().top
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