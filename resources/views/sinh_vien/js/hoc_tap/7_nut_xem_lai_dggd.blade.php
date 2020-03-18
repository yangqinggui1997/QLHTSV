<script>
$(function(){
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTablesXemLaiDGGD(){
			try
			{
				if(console.log("run_datatablesXemLaiDGGD"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b = $('#table__id__xemLaiDGGD');
	    			/*tạo table = script sau đó khởi tạo, insert table vào vùng chứa*/
	    			console.log("init_DataTablesXemLaiDGGD");
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
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng đánh giá giảng dạy*/
	    			$('#table__id__xemLaiDGGD_wrapper').prepend('<div class="row marginBottom10 div__class__group_button_xemLaiDGGD"></div>');

	    			$('#table__id__xemLaiDGGD_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_xemLaiDGGD_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('#div__id__div_button_parent_xemLaiDGGD_1').append($('#table__id__xemLaiDGGD_length'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_xemLaiDGGD_2"></div>').insertAfter('#div__id__div_button_parent_xemLaiDGGD_1');
	    			$('#div__id__div_button_parent_xemLaiDGGD_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_xemLaiDGGD_3"></div>').insertAfter('#div__id__div_button_parent_xemLaiDGGD_2');
	    			$('#div__id__div_button_parent_xemLaiDGGD_3').append($('#table__id__xemLaiDGGD_filter'));
	    			$('#table__id__xemLaiDGGD_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_xemLaiDGGD"]').append($('#div__id__div_button_parent_xemLaiDGGD_1'));
	    			$('[class*="div__class__group_button_xemLaiDGGD"]').append($('#div__id__div_button_parent_xemLaiDGGD_2'));
	    			$('[class*="div__class__group_button_xemLaiDGGD"]').append($('#div__id__div_button_parent_xemLaiDGGD_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_xemLaiDGGD');
	    			$('[data-id="button__id__saoChep_xemLaiDGGD"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_xemLaiDGGD"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_xemLaiDGGD"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_xemLaiDGGD');
	    			$('[data-id="button__id__saoChep_xemLaiDGGD"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_xemLaiDGGD"]').attr('data-original-title', $($('[data-id="button__id__saoChep_xemLaiDGGD"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_xemLaiDGGD"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_xemLaiDGGD"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_xemLaiDGGD"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_xemLaiDGGD');
	    			$('[data-id="button__id__excel_xemLaiDGGD"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_xemLaiDGGD"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_xemLaiDGGD"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_xemLaiDGGD"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_xemLaiDGGD"]').attr('data-original-title', $($('[data-id="button__id__excel_xemLaiDGGD"]').children()[0]).html());
	    			$('[data-id="button__id__excel_xemLaiDGGD"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_xemLaiDGGD"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_xemLaiDGGD"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_xemLaiDGGD');
	    			$('[data-id="button__id__pdf_xemLaiDGGD"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_xemLaiDGGD"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_xemLaiDGGD"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_xemLaiDGGD"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_xemLaiDGGD"]').attr('data-original-title', $($('[data-id="button__id__pdf_xemLaiDGGD"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_xemLaiDGGD"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_xemLaiDGGD"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_xemLaiDGGD"]').attr('data-placement', 'left');

	    			/*Khởi tạo tooltip cho các nút export*/
					$('[data-id="button__id__saoChep_xemLaiDGGD"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__excel_xemLaiDGGD"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__pdf_xemLaiDGGD"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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

		/*click button xem lại đánh giá giảng dạy*/
		if($('#tbody__id__HPHK').length)
			$('#tbody__id__HPHK').on('click', '[data-button="xemLaiDGGD"]', function(){
				try
	            {
	            	/*destroy and reinit datatable*/
	            	if($('#table__id__xemLaiDGGD_wrapper').length)
		    			$('#table__id__xemLaiDGGD').dataTable().fnDestroy();
	    			init_DataTablesXemLaiDGGD();
		            $('#div__id__xemLaiDGGD').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__xemLaiDGGD").offset().top
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