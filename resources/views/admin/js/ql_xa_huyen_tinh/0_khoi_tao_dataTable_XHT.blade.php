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
	    			var b=$("#table__id__tinh");
	    			var c=$('#table__id__huyen');
	    			var d=$('#table__id__xa');
					console.log("init_DataTables");
	    			b.dataTable({
	    				order:[[1,"asc"]],
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[3]}],
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
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[3]}],
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
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[3]}],
	    				paginate:false,
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});

	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng tỉnh*/
	    			$('#table__id__tinh_wrapper').prepend('<div class="row" data-id="div__class__group_button_tinh"></div>');

	    			$('#table__id__tinh_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_tinh_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[2]);
	    			$('#div__id__div_button_parent_tinh_1').append($('#button__id__them'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_tinh_2"></div>').insertAfter('#div__id__div_button_parent_tinh_1');
	    			$('#div__id__div_button_parent_tinh_2').append($('[data-id="div__id__button_group"]')[2]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_tinh_3"></div>').insertAfter('#div__id__div_button_parent_tinh_2');
	    			$('#div__id__div_button_parent_tinh_3').append($('#table__id__tinh_filter'));
	    			$('#table__id__tinh_filter').css('float', 'left');

	    			$('[data-id="div__class__group_button_tinh"]').append($('#div__id__div_button_parent_tinh_1'));
	    			$('[data-id="div__class__group_button_tinh"]').append($('#div__id__div_button_parent_tinh_2'));
	    			$('[data-id="div__class__group_button_tinh"]').append($('#div__id__div_button_parent_tinh_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[2]).children()[0]).attr('data-id', 'button__id__saoChep_tinh');
	    			$('[data-id="button__id__saoChep_tinh"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_tinh"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_tinh"]').addClass('btn-success');
	    			$('[data-id="button__id__saoChep_tinh"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_tinh"]').attr('data-original-title', $($('[data-id="button__id__saoChep_tinh"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_tinh"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_tinh"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_tinh"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[2]).children()[1]).attr('data-id', 'button__id__excel_tinh');
	    			$('[data-id="button__id__excel_tinh"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_tinh"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_tinh"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_tinh"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_tinh"]').attr('data-original-title', $($('[data-id="button__id__excel_tinh"]').children()[0]).html());
	    			$('[data-id="button__id__excel_tinh"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_tinh"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_tinh"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[2]).children()[2]).attr('data-id', 'button__id__pdf_tinh');
	    			$('[data-id="button__id__pdf_tinh"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_tinh"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_tinh"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_tinh"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_tinh"]').attr('data-original-title', $($('[data-id="button__id__pdf_tinh"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_tinh"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_tinh"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_tinh"]').attr('data-placement', 'left');

	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng huyện*/
	    			$('#table__id__huyen_wrapper').prepend('<div class="row" data-id="div__class__group_button_huyen"></div>');
	    			$('#table__id__huyen_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_huyen_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[1]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_huyen_2"></div>').insertAfter('#div__id__div_button_parent_huyen_1');
	    			$('#div__id__div_button_parent_huyen_2').append($('[data-id="div__id__button_group"]')[1]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_huyen_3"></div>').insertAfter('#div__id__div_button_parent_huyen_2');
	    			$('#div__id__div_button_parent_huyen_3').append($('#table__id__huyen_filter'));
	    			$('#table__id__huyen_filter').css('float', 'left');
	    			$('[data-id="div__class__group_button_huyen"]').append($('#div__id__div_button_parent_huyen_1'));
	    			$('[data-id="div__class__group_button_huyen"]').append($('#div__id__div_button_parent_huyen_2'));
	    			$('[data-id="div__class__group_button_huyen"]').append($('#div__id__div_button_parent_huyen_3'));
	    			$('#div__id__div_button_parent_huyen_1').append($('#div__id__button_group_huyen'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[0]).attr('data-id', 'button__id__saoChep_huyen');
	    			$('[data-id="button__id__saoChep_huyen"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_huyen"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_huyen"]').addClass('btn-success');
	    			$('[data-id="button__id__saoChep_huyen"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_huyen"]').attr('data-original-title', $($('[data-id="button__id__saoChep_huyen"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_huyen"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_huyen"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_huyen"]').attr('data-placement', 'right');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[1]).attr('data-id', 'button__id__excel_huyen');
	    			$('[data-id="button__id__excel_huyen"]').removeClass('btn-sm'); $('[data-id="button__id__excel_huyen"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_huyen"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_huyen"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_huyen"]').attr('data-original-title', $($('[data-id="button__id__excel_huyen"]').children()[0]).html());
	    			$('[data-id="button__id__excel_huyen"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_huyen"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_huyen"]').attr('data-placement', 'right');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[2]).attr('data-id', 'button__id__pdf_huyen');
	    			$('[data-id="button__id__pdf_huyen"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_huyen"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_huyen"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_huyen"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_huyen"]').attr('data-original-title', $($('[data-id="button__id__pdf_huyen"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_huyen"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_huyen"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_huyen"]').attr('data-placement', 'right');

	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng xã*/
	    			$('#table__id__xa_wrapper').prepend('<div class="row" data-id="div__class__group_button_xa"></div>');

	    			$('#table__id__xa_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_xa_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('#div__id__div_button_parent_xa_1').append($('#div__id__button_group_xa'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_xa_2"></div>').insertAfter('#div__id__div_button_parent_xa_1');
	    			$('#div__id__div_button_parent_xa_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_xa_3"></div>').insertAfter('#div__id__div_button_parent_xa_2');
	    			$('#div__id__div_button_parent_xa_3').append($('#table__id__xa_filter'));
	    			$('#table__id__xa_filter').css('float', 'left');

	    			$('[data-id="div__class__group_button_xa"]').append($('#div__id__div_button_parent_xa_1'));
	    			$('[data-id="div__class__group_button_xa"]').append($('#div__id__div_button_parent_xa_2'));
	    			$('[data-id="div__class__group_button_xa"]').append($('#div__id__div_button_parent_xa_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_xa');
	    			$('[data-id="button__id__saoChep_xa"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_xa"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_xa"]').addClass('btn-success');
	    			$('[data-id="button__id__saoChep_xa"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_xa"]').attr('data-original-title', $($('[data-id="button__id__saoChep_xa"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_xa"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_xa"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_xa"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_xa');
	    			$('[data-id="button__id__excel_xa"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_xa"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_xa"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_xa"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_xa"]').attr('data-original-title', $($('[data-id="button__id__excel_xa"]').children()[0]).html());
	    			$('[data-id="button__id__excel_xa"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_xa"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_xa"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_xa');
	    			$('[data-id="button__id__pdf_xa"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_xa"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_xa"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_xa"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_xa"]').attr('data-original-title', $($('[data-id="button__id__pdf_xa"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_xa"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_xa"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_xa"]').attr('data-placement', 'left');
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