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
	    			var b=$("#table__id__TCDG");
	    			var c=$('#table__id__TCDGCT');
	    			var d=$('#table__id__CTCTCDGCT');
					console.log("init_DataTables");
	    			b.dataTable({
	    				order:[[1,"asc"]],
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[4]}],
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
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[4]}],
	    				paginate:false,
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});
	    			
	    			d.dataTable({
	    				order:[[1,"asc"]],
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[4]}],
	    				paginate:false,
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});

	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng TCDG*/
	    			$('#table__id__TCDG_wrapper').prepend('<div class="row" data-id="div__class__group_button_TCDG"></div>');

	    			$('#table__id__TCDG_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_TCDG_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[2]);
	    			$('#div__id__div_button_parent_TCDG_1').append($('#div__id__button_group_TCDG'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_TCDG_2"></div>').insertAfter('#div__id__div_button_parent_TCDG_1');
	    			$('#div__id__div_button_parent_TCDG_2').append($('[data-id="div__id__button_group"]')[2]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_TCDG_3"></div>').insertAfter('#div__id__div_button_parent_TCDG_2');
	    			$('#div__id__div_button_parent_TCDG_3').append($('#table__id__TCDG_filter'));
	    			$('#table__id__TCDG_filter').css('float', 'left');

	    			$('[data-id="div__class__group_button_TCDG"]').append($('#div__id__div_button_parent_TCDG_1'));
	    			$('[data-id="div__class__group_button_TCDG"]').append($('#div__id__div_button_parent_TCDG_2'));
	    			$('[data-id="div__class__group_button_TCDG"]').append($('#div__id__div_button_parent_TCDG_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[2]).children()[0]).attr('data-id', 'button__id__saoChep_TCDG');
	    			$('[data-id="button__id__saoChep_TCDG"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_TCDG"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_TCDG"]').addClass('btn-success');
	    			$('[data-id="button__id__saoChep_TCDG"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_TCDG"]').attr('data-original-title', $($('[data-id="button__id__saoChep_TCDG"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_TCDG"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_TCDG"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_TCDG"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[2]).children()[1]).attr('data-id', 'button__id__excel_TCDG');
	    			$('[data-id="button__id__excel_TCDG"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_TCDG"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_TCDG"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_TCDG"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_TCDG"]').attr('data-original-title', $($('[data-id="button__id__excel_TCDG"]').children()[0]).html());
	    			$('[data-id="button__id__excel_TCDG"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_TCDG"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_TCDG"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[2]).children()[2]).attr('data-id', 'button__id__pdf_TCDG');
	    			$('[data-id="button__id__pdf_TCDG"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_TCDG"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_TCDG"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_TCDG"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_TCDG"]').attr('data-original-title', $($('[data-id="button__id__pdf_TCDG"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_TCDG"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_TCDG"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_TCDG"]').attr('data-placement', 'left');

	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng TCDGCT*/
	    			$('#table__id__TCDGCT_wrapper').prepend('<div class="row" data-id="div__class__group_button_TCDGCT"></div>');
	    			$('#table__id__TCDGCT_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_TCDGCT_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[1]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_TCDGCT_2"></div>').insertAfter('#div__id__div_button_parent_TCDGCT_1');
	    			$('#div__id__div_button_parent_TCDGCT_2').append($('[data-id="div__id__button_group"]')[1]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_TCDGCT_3"></div>').insertAfter('#div__id__div_button_parent_TCDGCT_2');
	    			$('#div__id__div_button_parent_TCDGCT_3').append($('#table__id__TCDGCT_filter'));
	    			$('#table__id__TCDGCT_filter').css('float', 'left');
	    			$('[data-id="div__class__group_button_TCDGCT"]').append($('#div__id__div_button_parent_TCDGCT_1'));
	    			$('[data-id="div__class__group_button_TCDGCT"]').append($('#div__id__div_button_parent_TCDGCT_2'));
	    			$('[data-id="div__class__group_button_TCDGCT"]').append($('#div__id__div_button_parent_TCDGCT_3'));
	    			$('#div__id__div_button_parent_TCDGCT_1').append($('#div__id__button_group_TCDGCT'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[0]).attr('data-id', 'button__id__saoChep_TCDGCT');
	    			$('[data-id="button__id__saoChep_TCDGCT"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_TCDGCT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_TCDGCT"]').addClass('btn-success');
	    			$('[data-id="button__id__saoChep_TCDGCT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_TCDGCT"]').attr('data-original-title', $($('[data-id="button__id__saoChep_TCDGCT"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_TCDGCT"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_TCDGCT"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_TCDGCT"]').attr('data-placement', 'right');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[1]).attr('data-id', 'button__id__excel_TCDGCT');
	    			$('[data-id="button__id__excel_TCDGCT"]').removeClass('btn-sm'); $('[data-id="button__id__excel_TCDGCT"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_TCDGCT"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_TCDGCT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_TCDGCT"]').attr('data-original-title', $($('[data-id="button__id__excel_TCDGCT"]').children()[0]).html());
	    			$('[data-id="button__id__excel_TCDGCT"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_TCDGCT"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_TCDGCT"]').attr('data-placement', 'right');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[2]).attr('data-id', 'button__id__pdf_TCDGCT');
	    			$('[data-id="button__id__pdf_TCDGCT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_TCDGCT"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_TCDGCT"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_TCDGCT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_TCDGCT"]').attr('data-original-title', $($('[data-id="button__id__pdf_TCDGCT"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_TCDGCT"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_TCDGCT"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_TCDGCT"]').attr('data-placement', 'right');

	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng CTCTCDGCT*/
	    			$('#table__id__CTCTCDGCT_wrapper').prepend('<div class="row" data-id="div__class__group_button_CTCTCDGCT"></div>');

	    			$('#table__id__CTCTCDGCT_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_CTCTCDGCT_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('#div__id__div_button_parent_CTCTCDGCT_1').append($('#div__id__button_group_TCDGCTCCT'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_CTCTCDGCT_2"></div>').insertAfter('#div__id__div_button_parent_CTCTCDGCT_1');
	    			$('#div__id__div_button_parent_CTCTCDGCT_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_CTCTCDGCT_3"></div>').insertAfter('#div__id__div_button_parent_CTCTCDGCT_2');
	    			$('#div__id__div_button_parent_CTCTCDGCT_3').append($('#table__id__CTCTCDGCT_filter'));
	    			$('#table__id__CTCTCDGCT_filter').css('float', 'left');

	    			$('[data-id="div__class__group_button_CTCTCDGCT"]').append($('#div__id__div_button_parent_CTCTCDGCT_1'));
	    			$('[data-id="div__class__group_button_CTCTCDGCT"]').append($('#div__id__div_button_parent_CTCTCDGCT_2'));
	    			$('[data-id="div__class__group_button_CTCTCDGCT"]').append($('#div__id__div_button_parent_CTCTCDGCT_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_CTCTCDGCT');
	    			$('[data-id="button__id__saoChep_CTCTCDGCT"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_CTCTCDGCT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_CTCTCDGCT"]').addClass('btn-success');
	    			$('[data-id="button__id__saoChep_CTCTCDGCT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_CTCTCDGCT"]').attr('data-original-title', $($('[data-id="button__id__saoChep_CTCTCDGCT"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_CTCTCDGCT"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_CTCTCDGCT"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_CTCTCDGCT"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_CTCTCDGCT');
	    			$('[data-id="button__id__excel_CTCTCDGCT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_CTCTCDGCT"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_CTCTCDGCT"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_CTCTCDGCT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_CTCTCDGCT"]').attr('data-original-title', $($('[data-id="button__id__excel_CTCTCDGCT"]').children()[0]).html());
	    			$('[data-id="button__id__excel_CTCTCDGCT"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_CTCTCDGCT"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_CTCTCDGCT"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_CTCTCDGCT');
	    			$('[data-id="button__id__pdf_CTCTCDGCT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_CTCTCDGCT"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_CTCTCDGCT"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_CTCTCDGCT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_CTCTCDGCT"]').attr('data-original-title', $($('[data-id="button__id__pdf_CTCTCDGCT"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_CTCTCDGCT"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_CTCTCDGCT"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_CTCTCDGCT"]').attr('data-placement', 'left');
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