<script>
$(function(){
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTablesTienDoHT(){
			try
			{
				if(console.log("run_datatablesTienDoHT"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b = $('#table__id__tienDoHT');
	    			var count = 0;
	    			var l1 = 0;
	    			var l2 = 0;
	    			var l3 = 0;
	    			/*tạo table = script sau đó khởi tạo, insert table vào vùng chứa*/
	    			console.log("init_DataTablesTienDoHT");
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
	    			l1 = $('#table__id__dangKyHP_wrapper').length;
	    			l2 = $('#table__id__danhGiaGD_wrapper').length;
	    			l3 = $('#table__id__xemLaiDGGD_wrapper').length;
	    			count = ((!l1 && !l2 && l3) || (!l1 && l2 && !l3)  || (l1 && !l2 && !l3)) ? 1 : (((!l1 && l2 && l3) || (l1 && !l2 && !l3)  || (l1 && l2 && !l3)) ? 2 : ((l2 && l1 && l3)  ? 3 : count));
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng tiến độ học tập*/
	    			$('#table__id__tienDoHT_wrapper').prepend('<div class="row marginBottom10 div__class__group_button_tienDoHT"></div>');

	    			$('#table__id__tienDoHT_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_tienDoHT_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[count]);
	    			$('#div__id__div_button_parent_tienDoHT_1').append($('#table__id__tienDoHT_length'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_tienDoHT_2"></div>').insertAfter('#div__id__div_button_parent_tienDoHT_1');
	    			$('#div__id__div_button_parent_tienDoHT_2').append($('[data-id="div__id__button_group"]')[count]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_tienDoHT_3"></div>').insertAfter('#div__id__div_button_parent_tienDoHT_2');
	    			$('#div__id__div_button_parent_tienDoHT_3').append($('#table__id__tienDoHT_filter'));
	    			$('#table__id__tienDoHT_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_tienDoHT"]').append($('#div__id__div_button_parent_tienDoHT_1'));
	    			$('[class*="div__class__group_button_tienDoHT"]').append($('#div__id__div_button_parent_tienDoHT_2'));
	    			$('[class*="div__class__group_button_tienDoHT"]').append($('#div__id__div_button_parent_tienDoHT_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[0]).attr('data-id', 'button__id__saoChep_tienDoHT');
	    			$('[data-id="button__id__saoChep_tienDoHT"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_tienDoHT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_tienDoHT"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[0]).attr('data-id', 'button__id__saoChep_tienDoHT');
	    			$('[data-id="button__id__saoChep_tienDoHT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_tienDoHT"]').attr('data-original-title', $($('[data-id="button__id__saoChep_tienDoHT"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_tienDoHT"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_tienDoHT"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_tienDoHT"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[1]).attr('data-id', 'button__id__excel_tienDoHT');
	    			$('[data-id="button__id__excel_tienDoHT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_tienDoHT"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_tienDoHT"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_tienDoHT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_tienDoHT"]').attr('data-original-title', $($('[data-id="button__id__excel_tienDoHT"]').children()[0]).html());
	    			$('[data-id="button__id__excel_tienDoHT"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_tienDoHT"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_tienDoHT"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[2]).attr('data-id', 'button__id__pdf_tienDoHT');
	    			$('[data-id="button__id__pdf_tienDoHT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_tienDoHT"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_tienDoHT"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_tienDoHT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_tienDoHT"]').attr('data-original-title', $($('[data-id="button__id__pdf_tienDoHT"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_tienDoHT"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_tienDoHT"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_tienDoHT"]').attr('data-placement', 'left');

	    			/*Khởi tạo tooltip cho các nút export*/
					$('[data-id="button__id__saoChep_tienDoHT"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__excel_tienDoHT"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__pdf_tienDoHT"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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

		/*click button xem tiến độ học tập*/
		if($('#tbody__id__nganhHoc').length)
			$('#tbody__id__nganhHoc').on('click', '[data-button="xemTienDoHT"]', function(){
				try
	            {
	            	/*destroy and reinit datatable*/
	            	if($('#table__id__tienDoHT_wrapper').length)
						$('#table__id__tienDoHT').dataTable().fnDestroy();
	    			init_DataTablesTienDoHT();
		            $('#div__id__tienDoHT').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__tienDoHT").offset().top
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