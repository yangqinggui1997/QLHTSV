<script>
$(function(){
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTablesXemLaiDGRL(){
			try
			{
				if(console.log("run_datatablesXemLaiDGRL"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b = $('#table__id__xemLaiDGRL');
	    			/*tạo table = script sau đó khởi tạo, insert table vào vùng chứa*/
	    			console.log("init_DataTablesXemLaiDGRL");
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
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng đánh giá rèn luyện*/
	    			$('#table__id__xemLaiDGRL_wrapper').prepend('<div class="row marginBottom10 div__class__group_button_xemLaiDGRL"></div>');

	    			$('#table__id__xemLaiDGRL_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_xemLaiDGRL_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('#div__id__div_button_parent_xemLaiDGRL_1').append($('#table__id__xemLaiDGRL_length'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_xemLaiDGRL_2"></div>').insertAfter('#div__id__div_button_parent_xemLaiDGRL_1');
	    			$('#div__id__div_button_parent_xemLaiDGRL_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_xemLaiDGRL_3"></div>').insertAfter('#div__id__div_button_parent_xemLaiDGRL_2');
	    			$('#div__id__div_button_parent_xemLaiDGRL_3').append($('#table__id__xemLaiDGRL_filter'));
	    			$('#table__id__xemLaiDGRL_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_xemLaiDGRL"]').append($('#div__id__div_button_parent_xemLaiDGRL_1'));
	    			$('[class*="div__class__group_button_xemLaiDGRL"]').append($('#div__id__div_button_parent_xemLaiDGRL_2'));
	    			$('[class*="div__class__group_button_xemLaiDGRL"]').append($('#div__id__div_button_parent_xemLaiDGRL_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_xemLaiDGRL');
	    			$('[data-id="button__id__saoChep_xemLaiDGRL"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_xemLaiDGRL"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_xemLaiDGRL"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_xemLaiDGRL');
	    			$('[data-id="button__id__saoChep_xemLaiDGRL"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_xemLaiDGRL"]').attr('data-original-title', $($('[data-id="button__id__saoChep_xemLaiDGRL"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_xemLaiDGRL"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_xemLaiDGRL"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_xemLaiDGRL"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_xemLaiDGRL');
	    			$('[data-id="button__id__excel_xemLaiDGRL"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_xemLaiDGRL"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_xemLaiDGRL"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_xemLaiDGRL"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_xemLaiDGRL"]').attr('data-original-title', $($('[data-id="button__id__excel_xemLaiDGRL"]').children()[0]).html());
	    			$('[data-id="button__id__excel_xemLaiDGRL"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_xemLaiDGRL"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_xemLaiDGRL"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_xemLaiDGRL');
	    			$('[data-id="button__id__pdf_xemLaiDGRL"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_xemLaiDGRL"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_xemLaiDGRL"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_xemLaiDGRL"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_xemLaiDGRL"]').attr('data-original-title', $($('[data-id="button__id__pdf_xemLaiDGRL"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_xemLaiDGRL"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_xemLaiDGRL"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_xemLaiDGRL"]').attr('data-placement', 'left');

	    			/*Khởi tạo tooltip cho các nút export*/
					$('[data-id="button__id__saoChep_xemLaiDGRL"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__excel_xemLaiDGRL"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__pdf_xemLaiDGRL"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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
			$('#tbody__id__hocKyHT').on('click', '[data-button="xemLaiDGRL"]', function(){
				try
	            {
	            	/*destroy and reinit datatable*/
	            	if($('#table__id__xemLaiDGRL_wrapper').length)
		    			$('#table__id__xemLaiDGRL').dataTable().fnDestroy();
	    			init_DataTablesXemLaiDGRL();
		            $('#div__id__xemLaiDGRL').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__xemLaiDGRL").offset().top
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