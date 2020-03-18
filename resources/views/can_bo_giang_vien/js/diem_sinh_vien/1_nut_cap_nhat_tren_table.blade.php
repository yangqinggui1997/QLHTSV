<script>
$(function(){
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTablesBangDiemSV(){
			try
			{
				if(console.log("run_datatablesBangDiemSV"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b = $('#table__id__bangDiemSV');
	    			/*tạo table = script sau đó khởi tạo, insert table vào vùng chứa*/
	    			console.log("init_DataTablesBangDiemSV");
	    			/*Khởi tạo các editable*/
    				$('._editable').editable({
			           type: 'text',
				    });
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
    				
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng điểm sinh viên*/
	    			$('#table__id__bangDiemSV_wrapper').prepend('<div class="row div__class__group_button_bangDiemSV"></div>');
	    			$('#table__id__bangDiemSV_filter').next().remove();
	    			$('<div class="col-sm-5" id="div__id__div_button_parent_bangDiemSV_1"><div class="row"><div class="col-sm-4" id="div__id__button_parent_kqhtrl_1_1"></div><div class="col-sm-8" id="div__id__button_parent_kqhtrl_1_2"></div></div></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-3" id="div__id__div_button_parent_bangDiemSV_2"></div>').insertAfter('#div__id__div_button_parent_bangDiemSV_1');
	    			$('#div__id__div_button_parent_bangDiemSV_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_bangDiemSV_3"></div>').insertAfter('#div__id__div_button_parent_bangDiemSV_2');
	    			$('#div__id__div_button_parent_bangDiemSV_3').append($('#table__id__bangDiemSV_filter'));
	    			$('#table__id__bangDiemSV_filter').css('float', 'left');
	    			$('[class*="div__class__group_button_bangDiemSV"]').append($('#div__id__div_button_parent_bangDiemSV_1'));
	    			$('[class*="div__class__group_button_bangDiemSV"]').append($('#div__id__div_button_parent_bangDiemSV_2'));
	    			$('[class*="div__class__group_button_bangDiemSV"]').append($('#div__id__div_button_parent_bangDiemSV_3'));
	    			$('#div__id__button_parent_kqhtrl_1_1').append($('#div__id__button_group_bangDiemSV'));
	    			$('#div__id__button_parent_kqhtrl_1_2').append($('#table__id__bangDiemSV_length'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_bangDiemSV');
	    			$('[data-id="button__id__saoChep_bangDiemSV"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_bangDiemSV"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_bangDiemSV"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_bangDiemSV');
	    			$('[data-id="button__id__saoChep_bangDiemSV"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_bangDiemSV"]').attr('data-original-title', $($('[data-id="button__id__saoChep_bangDiemSV"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_bangDiemSV"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_bangDiemSV"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_bangDiemSV"]').attr('data-placement', 'right');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_bangDiemSV');
	    			$('[data-id="button__id__excel_bangDiemSV"]').removeClass('btn-sm'); $('[data-id="button__id__excel_bangDiemSV"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_bangDiemSV"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_bangDiemSV"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_bangDiemSV"]').attr('data-original-title', $($('[data-id="button__id__excel_bangDiemSV"]').children()[0]).html());
	    			$('[data-id="button__id__excel_bangDiemSV"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_bangDiemSV"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_bangDiemSV"]').attr('data-placement', 'right');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_bangDiemSV');
	    			$('[data-id="button__id__pdf_bangDiemSV"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_bangDiemSV"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_bangDiemSV"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_bangDiemSV"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_bangDiemSV"]').attr('data-original-title', $($('[data-id="button__id__pdf_bangDiemSV"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_bangDiemSV"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_bangDiemSV"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_bangDiemSV"]').attr('data-placement', 'right');

	    			/*Khởi tạo tooltip cho các nút export*/
					$('[data-id="button__id__saoChep_bangDiemSV"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__excel_bangDiemSV"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__pdf_bangDiemSV"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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

		/*click button cập nhật*/
		if($('#tbody__id__lop').length)
			$('#tbody__id__lop').on('click', '[data-button="sua"]', function(){
				try
	            {
	            	/*destroy and reinit datatable*/
	    			if(typeof $('#table__id__bangDiemSV').dataTable() !== typeof undefined)
	    			{
	    				$('#div__id__bangDiemSVArea').prepend($('#div__id__button_group_bangDiemSV'));
	    				$('#table__id__bangDiemSV').dataTable().fnDestroy();
	    				$('#div__id__button_parent_kqhtrl_1_1').append($('#div__id__button_group_bangDiemSV'));
	    			}
	    			if($('#tbody__id__bangDiemSV').find('.editable-unsaved').length)
	    				$('.editable-unsaved').removeClass('editable-unsaved');
	            	init_DataTablesBangDiemSV();
		            $('#div__id__bangDiemSV').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__bangDiemSV").offset().top
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