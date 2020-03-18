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
	    			var b=$("#table__id__tcdggd");
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

	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng tcdggd*/
	    			$('#table__id__tcdggd_wrapper').prepend('<div class="row" data-id="div__class__group_button_tcdggd"></div>');

	    			$('#table__id__tcdggd_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_tcdggd_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('#div__id__div_button_parent_tcdggd_1').append($('#div__id__button_group_tcdggd'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_tcdggd_2"></div>').insertAfter('#div__id__div_button_parent_tcdggd_1');
	    			$('#div__id__div_button_parent_tcdggd_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_tcdggd_3"></div>').insertAfter('#div__id__div_button_parent_tcdggd_2');
	    			$('#div__id__div_button_parent_tcdggd_3').append($('#table__id__tcdggd_filter'));
	    			$('#table__id__tcdggd_filter').css('float', 'left');

	    			$('[data-id="div__class__group_button_tcdggd"]').append($('#div__id__div_button_parent_tcdggd_1'));
	    			$('[data-id="div__class__group_button_tcdggd"]').append($('#div__id__div_button_parent_tcdggd_2'));
	    			$('[data-id="div__class__group_button_tcdggd"]').append($('#div__id__div_button_parent_tcdggd_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_tcdggd');
	    			$('[data-id="button__id__saoChep_tcdggd"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_tcdggd"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_tcdggd"]').addClass('btn-success');
	    			$('[data-id="button__id__saoChep_tcdggd"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_tcdggd"]').attr('data-original-title', $($('[data-id="button__id__saoChep_tcdggd"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_tcdggd"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_tcdggd"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_tcdggd"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_tcdggd');
	    			$('[data-id="button__id__excel_tcdggd"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_tcdggd"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_tcdggd"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_tcdggd"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_tcdggd"]').attr('data-original-title', $($('[data-id="button__id__excel_tcdggd"]').children()[0]).html());
	    			$('[data-id="button__id__excel_tcdggd"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_tcdggd"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_tcdggd"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_tcdggd');
	    			$('[data-id="button__id__pdf_tcdggd"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_tcdggd"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_tcdggd"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_tcdggd"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_tcdggd"]').attr('data-original-title', $($('[data-id="button__id__pdf_tcdggd"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_tcdggd"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_tcdggd"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_tcdggd"]').attr('data-placement', 'left');
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