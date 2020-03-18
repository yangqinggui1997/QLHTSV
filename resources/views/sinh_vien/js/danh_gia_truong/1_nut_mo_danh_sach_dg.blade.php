<script>
$(function(){
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTablesDGT(){
			try
			{
				if(console.log("run_datatablesDGT"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b = $('#table__id__DGT');
	    			var count = 0;
	    			var l1 = 0;
	    			/*tạo table = script sau đó khởi tạo, insert table vào vùng chứa*/
	    			console.log("init_DataTablesDGT");
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
	    			l1 = $('#table__id__xemLaiDGT_wrapper').length;
	    			count = l1 ? 1 : count;
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng đánh giá rèn luyện*/
	    			$('#table__id__DGT_wrapper').prepend('<div class="row marginBottom10 div__class__group_button_DGT"></div>');

	    			$('#table__id__DGT_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_DGT_1"><div class="row"><div class="col-sm-4" id="div__id__button_parent_DGT_1_1"></div><div class="col-sm-8" id="div__id__button_parent_DGT_1_2"></div></div></div>').insertAfter($('[data-id="div__id__button_group"]')[count]);
	    			$('#div__id__div_button_parent_DGT_1').append($('#table__id__DGT_length'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_DGT_2"></div>').insertAfter('#div__id__div_button_parent_DGT_1');
	    			$('#div__id__div_button_parent_DGT_2').append($('[data-id="div__id__button_group"]')[count]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_DGT_3"></div>').insertAfter('#div__id__div_button_parent_DGT_2');
	    			$('#div__id__div_button_parent_DGT_3').append($('#table__id__DGT_filter'));
	    			$('#table__id__DGT_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_DGT"]').append($('#div__id__div_button_parent_DGT_1'));
	    			$('[class*="div__class__group_button_DGT"]').append($('#div__id__div_button_parent_DGT_2'));
	    			$('[class*="div__class__group_button_DGT"]').append($('#div__id__div_button_parent_DGT_3'));
	    			$('#div__id__button_parent_DGT_1_1').append($('#div__id__button_group_DGT'));
	    			$('#div__id__button_parent_DGT_1_2').append($('#table__id__DGT_length'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[0]).attr('data-id', 'button__id__saoChep_DGT');
	    			$('[data-id="button__id__saoChep_DGT"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_DGT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_DGT"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[0]).attr('data-id', 'button__id__saoChep_DGT');
	    			$('[data-id="button__id__saoChep_DGT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_DGT"]').attr('data-original-title', $($('[data-id="button__id__saoChep_DGT"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_DGT"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_DGT"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_DGT"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[1]).attr('data-id', 'button__id__excel_DGT');
	    			$('[data-id="button__id__excel_DGT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_DGT"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_DGT"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_DGT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_DGT"]').attr('data-original-title', $($('[data-id="button__id__excel_DGT"]').children()[0]).html());
	    			$('[data-id="button__id__excel_DGT"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_DGT"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_DGT"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[2]).attr('data-id', 'button__id__pdf_DGT');
	    			$('[data-id="button__id__pdf_DGT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_DGT"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_DGT"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_DGT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_DGT"]').attr('data-original-title', $($('[data-id="button__id__pdf_DGT"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_DGT"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_DGT"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_DGT"]').attr('data-placement', 'left');

	    			/*Khởi tạo tooltip cho các nút export*/
					$('[data-id="button__id__saoChep_DGT"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__excel_DGT"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__pdf_DGT"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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

		/*click button mở danh sách đánh giá trường*/
		if($('#tbody__id__hocKyHT').length)
			$('#tbody__id__hocKyHT').on('click', '[data-button="danhGiaTruong"]', function(){
				try
	            {
	            	/*destroy and reinit datatable*/
	            	if($('#table__id__DGT_wrapper').length)
	            	{
	            		$('#div__id__dgtArea').prepend($('#div__id__button_group_DGT'));
		    			$('#table__id__DGT').dataTable().fnDestroy();
						$('#div__id__button_parent_DGT_1_1').append($('#div__id__button_group_DGT'));
	            	}
	    			init_DataTablesDGT();
		            $('#div__id__DGT').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__DGT").offset().top
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