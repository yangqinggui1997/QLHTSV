<script>
$(function(){
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTablesKetQuaHTRL(){
			try
			{
				if(console.log("run_datatablesKetQuaHTRL"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b=$('#table__id__ketQuaHTRL');
	    			/*tạo table = script sau đó khởi tạo, insert table vào vùng chứa*/
	    			console.log("init_DataTablesKetQuaHTRL");
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
    				
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng kết quả rèn luyện*/
	    			$('#table__id__ketQuaHTRL_wrapper').prepend('<div class="row div__class__group_button_ketQuaHTRL"></div>');
	    			$('#table__id__ketQuaHTRL_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_ketQuaHTRL_1"><div class="row"><div class="col-sm-2" id="div__id__button_parent_kqhtrl_1_1"></div><div class="col-sm-10" id="div__id__button_parent_kqhtrl_1_2"></div></div></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_ketQuaHTRL_2"></div>').insertAfter('#div__id__div_button_parent_ketQuaHTRL_1');
	    			$('#div__id__div_button_parent_ketQuaHTRL_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_ketQuaHTRL_3"></div>').insertAfter('#div__id__div_button_parent_ketQuaHTRL_2');
	    			$('#div__id__div_button_parent_ketQuaHTRL_3').append($('#table__id__ketQuaHTRL_filter'));
	    			$('#table__id__ketQuaHTRL_filter').css('float', 'left');
	    			$('[class*="div__class__group_button_ketQuaHTRL"]').append($('#div__id__div_button_parent_ketQuaHTRL_1'));
	    			$('[class*="div__class__group_button_ketQuaHTRL"]').append($('#div__id__div_button_parent_ketQuaHTRL_2'));
	    			$('[class*="div__class__group_button_ketQuaHTRL"]').append($('#div__id__div_button_parent_ketQuaHTRL_3'));
	    			$('#div__id__button_parent_kqhtrl_1_1').append($('#div__id__button_group_ketQuaHTRL'));
	    			$('#div__id__button_parent_kqhtrl_1_2').append($('#table__id__ketQuaHTRL_length'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_ketQuaHTRL');
	    			$('[data-id="button__id__saoChep_ketQuaHTRL"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_ketQuaHTRL"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_ketQuaHTRL"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_ketQuaHTRL');
	    			$('[data-id="button__id__saoChep_ketQuaHTRL"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_ketQuaHTRL"]').attr('data-original-title', $($('[data-id="button__id__saoChep_ketQuaHTRL"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_ketQuaHTRL"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_ketQuaHTRL"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_ketQuaHTRL"]').attr('data-placement', 'right');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_ketQuaHTRL');
	    			$('[data-id="button__id__excel_ketQuaHTRL"]').removeClass('btn-sm'); $('[data-id="button__id__excel_ketQuaHTRL"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_ketQuaHTRL"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_ketQuaHTRL"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_ketQuaHTRL"]').attr('data-original-title', $($('[data-id="button__id__excel_ketQuaHTRL"]').children()[0]).html());
	    			$('[data-id="button__id__excel_ketQuaHTRL"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_ketQuaHTRL"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_ketQuaHTRL"]').attr('data-placement', 'right');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_ketQuaHTRL');
	    			$('[data-id="button__id__pdf_ketQuaHTRL"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_ketQuaHTRL"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_ketQuaHTRL"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_ketQuaHTRL"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_ketQuaHTRL"]').attr('data-original-title', $($('[data-id="button__id__pdf_ketQuaHTRL"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_ketQuaHTRL"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_ketQuaHTRL"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_ketQuaHTRL"]').attr('data-placement', 'right');

	    			/*Khởi tạo tooltip cho các nút export*/
					$('[data-id="button__id__saoChep_ketQuaHTRL"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__excel_ketQuaHTRL"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__pdf_ketQuaHTRL"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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

		/*click button mở danh sách xem kết quả học tập rèn luyện*/
		function moDanhSachKQHTRL()
		{
			try
            {
            	/*destroy and reinit datatable*/
            	if($('#table__id__ketQuaHTRL_wrapper').length)
            	{
            		$('#div__id__ketQuaHTRLArea').prepend($('#div__id__button_group_ketQuaHTRL'));
					$('#table__id__ketQuaHTRL').dataTable().fnDestroy();
					$('#div__id__button_parent_kqhtrl_1_1').append($('#div__id__button_group_ketQuaHTRL'));
            	}
            	init_DataTablesKetQuaHTRL();
	            $('#div__id__ketQuaHTRL').slideDown(800);
	            $('html, body').animate({
	                scrollTop: $("#div__id__ketQuaHTRL").offset().top
	            }, 800);
            	return true;
            }
            catch(err)
			{
				alert('Lỗi: ' + err.stack + '!');
				return false;
			}
		}

		if($('#tbody__id__sinhVien').length)
		{
			$('#tbody__id__sinhVien').on('click', '[data-button-id="xemKQRLSV"]', moDanhSachKQHTRL);
			$('#tbody__id__sinhVien').on('click', '[data-button-id="xemKQHTSV"]', moDanhSachKQHTRL);
		}

		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>