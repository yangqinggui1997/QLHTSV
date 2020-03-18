<script>
$(function() {
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTables(){
			try
			{
				if(console.log("run_datatables"),"undefined"!=typeof $.fn.DataTable)
    			{
	    			var b=$("#table__id__lop");
	    			var c=$('#table__id__sinhVien');
					console.log("init_DataTables");
	    			b.dataTable({
	    				order:[[1,"asc"]],
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[8]}],
	    				paginate:false,
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});

	    			c.dataTable({
	    				order:[[1,"asc"]],
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[12]}],
	    				paginate:false,
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});

	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng lớp*/
	    			$('#table__id__lop_wrapper').prepend('<div class="row div__class__group_button_lop"></div>');

	    			$('#table__id__lop_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_lop_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[1]);
	    			$('#div__id__div_button_parent_lop_1').append($('#div__id__button_group_lop'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_lop_2"></div>').insertAfter('#div__id__div_button_parent_lop_1');
	    			$('#div__id__div_button_parent_lop_2').append($('[data-id="div__id__button_group"]')[1]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_lop_3"></div>').insertAfter('#div__id__div_button_parent_lop_2');
	    			$('#div__id__div_button_parent_lop_3').append($('#table__id__lop_filter'));
	    			$('#table__id__lop_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_lop"]').append($('#div__id__div_button_parent_lop_1'));
	    			$('[class*="div__class__group_button_lop"]').append($('#div__id__div_button_parent_lop_2'));
	    			$('[class*="div__class__group_button_lop"]').append($('#div__id__div_button_parent_lop_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[0]).attr('data-id', 'button__id__saoChep_lop');
	    			$('[data-id="button__id__saoChep_lop"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_lop"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_lop"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[0]).attr('data-id', 'button__id__saoChep_lop');
	    			$('[data-id="button__id__saoChep_lop"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_lop"]').attr('data-original-title', $($('[data-id="button__id__saoChep_lop"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_lop"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_lop"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_lop"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[1]).attr('data-id', 'button__id__excel_lop');
	    			$('[data-id="button__id__excel_lop"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_lop"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_lop"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_lop"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_lop"]').attr('data-original-title', $($('[data-id="button__id__excel_lop"]').children()[0]).html());
	    			$('[data-id="button__id__excel_lop"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_lop"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_lop"]').attr('data-placement', 'left');
	    			$('[data-id="button__id__excel_lop"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[2]).attr('data-id', 'button__id__pdf_lop');
	    			$('[data-id="button__id__pdf_lop"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_lop"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_lop"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_lop"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_lop"]').attr('data-original-title', $($('[data-id="button__id__pdf_lop"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_lop"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_lop"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_lop"]').attr('data-placement', 'left');

	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng sinh viên*/
	    			$('#table__id__sinhVien_wrapper').prepend('<div class="row div__class__group_button_sinhVien"></div>');
	    			$('#table__id__sinhVien_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_sinhVien_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_sinhVien_2"></div>').insertAfter('#div__id__div_button_parent_sinhVien_1');
	    			$('#div__id__div_button_parent_sinhVien_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_sinhVien_3"></div>').insertAfter('#div__id__div_button_parent_sinhVien_2');
	    			$('#div__id__div_button_parent_sinhVien_3').append($('#table__id__sinhVien_filter'));
	    			$('#table__id__sinhVien_filter').css('float', 'left');
	    			$('[class*="div__class__group_button_sinhVien"]').append($('#div__id__div_button_parent_sinhVien_1'));
	    			$('[class*="div__class__group_button_sinhVien"]').append($('#div__id__div_button_parent_sinhVien_2'));
	    			$('[class*="div__class__group_button_sinhVien"]').append($('#div__id__div_button_parent_sinhVien_3'));
	    			$('#div__id__div_button_parent_sinhVien_1').append($('#div__id__button_group_sinhVien'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_sinhVien');
	    			$('[data-id="button__id__saoChep_sinhVien"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_sinhVien"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_sinhVien"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_sinhVien');
	    			$('[data-id="button__id__saoChep_sinhVien"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_sinhVien"]').attr('data-original-title', $($('[data-id="button__id__saoChep_sinhVien"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_sinhVien"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_sinhVien"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_sinhVien"]').attr('data-placement', 'right');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_sinhVien');
	    			$('[data-id="button__id__excel_sinhVien"]').removeClass('btn-sm'); $('[data-id="button__id__excel_sinhVien"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_sinhVien"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_sinhVien"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_sinhVien"]').attr('data-original-title', $($('[data-id="button__id__excel_sinhVien"]').children()[0]).html());
	    			$('[data-id="button__id__excel_sinhVien"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_sinhVien"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_sinhVien"]').attr('data-placement', 'right');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_sinhVien');
	    			$('[data-id="button__id__pdf_sinhVien"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_sinhVien"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_sinhVien"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_sinhVien"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_sinhVien"]').attr('data-original-title', $($('[data-id="button__id__pdf_sinhVien"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_sinhVien"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_sinhVien"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_sinhVien"]').attr('data-placement', 'right');
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
    	
		/*Khởi tạo bảng chứa dữ liệu*/
		init_DataTables();
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>