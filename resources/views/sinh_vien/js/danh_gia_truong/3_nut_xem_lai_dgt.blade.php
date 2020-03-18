<script>
$(function(){
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTablesXemLaiDGT(){
			try
			{
				if(console.log("run_datatablesXemLaiDGT"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b = $('#table__id__xemLaiDGT');
	    			/*tạo table = script sau đó khởi tạo, insert table vào vùng chứa*/
	    			console.log("init_DataTablesXemLaiDGT");
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
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng đánh giá rèn luyện*/
	    			$('#table__id__xemLaiDGT_wrapper').prepend('<div class="row marginBottom10 div__class__group_button_xemLaiDGT"></div>');

	    			$('#table__id__xemLaiDGT_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_xemLaiDGT_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('#div__id__div_button_parent_xemLaiDGT_1').append($('#table__id__xemLaiDGT_length'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_xemLaiDGT_2"></div>').insertAfter('#div__id__div_button_parent_xemLaiDGT_1');
	    			$('#div__id__div_button_parent_xemLaiDGT_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_xemLaiDGT_3"></div>').insertAfter('#div__id__div_button_parent_xemLaiDGT_2');
	    			$('#div__id__div_button_parent_xemLaiDGT_3').append($('#table__id__xemLaiDGT_filter'));
	    			$('#table__id__xemLaiDGT_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_xemLaiDGT"]').append($('#div__id__div_button_parent_xemLaiDGT_1'));
	    			$('[class*="div__class__group_button_xemLaiDGT"]').append($('#div__id__div_button_parent_xemLaiDGT_2'));
	    			$('[class*="div__class__group_button_xemLaiDGT"]').append($('#div__id__div_button_parent_xemLaiDGT_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_xemLaiDGT');
	    			$('[data-id="button__id__saoChep_xemLaiDGT"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_xemLaiDGT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_xemLaiDGT"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_xemLaiDGT');
	    			$('[data-id="button__id__saoChep_xemLaiDGT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_xemLaiDGT"]').attr('data-original-title', $($('[data-id="button__id__saoChep_xemLaiDGT"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_xemLaiDGT"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_xemLaiDGT"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_xemLaiDGT"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_xemLaiDGT');
	    			$('[data-id="button__id__excel_xemLaiDGT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_xemLaiDGT"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_xemLaiDGT"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_xemLaiDGT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_xemLaiDGT"]').attr('data-original-title', $($('[data-id="button__id__excel_xemLaiDGT"]').children()[0]).html());
	    			$('[data-id="button__id__excel_xemLaiDGT"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_xemLaiDGT"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_xemLaiDGT"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_xemLaiDGT');
	    			$('[data-id="button__id__pdf_xemLaiDGT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_xemLaiDGT"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_xemLaiDGT"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_xemLaiDGT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_xemLaiDGT"]').attr('data-original-title', $($('[data-id="button__id__pdf_xemLaiDGT"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_xemLaiDGT"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_xemLaiDGT"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_xemLaiDGT"]').attr('data-placement', 'left');

	    			/*Khởi tạo tooltip cho các nút export*/
					$('[data-id="button__id__saoChep_xemLaiDGT"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__excel_xemLaiDGT"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__pdf_xemLaiDGT"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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

		/*click button xem lại đánh giá trường*/
		if($('#tbody__id__hocKyHT').length)
			$('#tbody__id__hocKyHT').on('click', '[data-button="xemLaiDGT"]', function(){
				try
	            {
	            	/*destroy and reinit datatable*/
	            	if($('#table__id__xemLaiDGT_wrapper').length)
		    			$('#table__id__xemLaiDGT').dataTable().fnDestroy();
	    			init_DataTablesXemLaiDGT();
		            $('#div__id__xemLaiDGT').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__xemLaiDGT").offset().top
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