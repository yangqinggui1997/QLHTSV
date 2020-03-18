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
	    			var b=$("#table__id__qlDangKyHP");
					console.log("init_DataTables");
	    			b.dataTable({
	    				order:[[1,"asc"]],
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[7]}],
	    				paginate:false,
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});

	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng qlDangKyHP*/
	    			$('#table__id__qlDangKyHP_wrapper').prepend('<div class="row" data-id="div__class__group_button_qlDangKyHP"></div>');

	    			$('#table__id__qlDangKyHP_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_qlDangKyHP_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('#div__id__div_button_parent_qlDangKyHP_1').append($('#div__id__button_group_qlDangKyHP'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_qlDangKyHP_2"></div>').insertAfter('#div__id__div_button_parent_qlDangKyHP_1');
	    			$('#div__id__div_button_parent_qlDangKyHP_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_qlDangKyHP_3"></div>').insertAfter('#div__id__div_button_parent_qlDangKyHP_2');
	    			$('#div__id__div_button_parent_qlDangKyHP_3').append($('#table__id__qlDangKyHP_filter'));
	    			$('#table__id__qlDangKyHP_filter').css('float', 'left');

	    			$('[data-id="div__class__group_button_qlDangKyHP"]').append($('#div__id__div_button_parent_qlDangKyHP_1'));
	    			$('[data-id="div__class__group_button_qlDangKyHP"]').append($('#div__id__div_button_parent_qlDangKyHP_2'));
	    			$('[data-id="div__class__group_button_qlDangKyHP"]').append($('#div__id__div_button_parent_qlDangKyHP_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_qlDangKyHP');
	    			$('[data-id="button__id__saoChep_qlDangKyHP"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_qlDangKyHP"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_qlDangKyHP"]').addClass('btn-success');
	    			$('[data-id="button__id__saoChep_qlDangKyHP"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_qlDangKyHP"]').attr('data-original-title', $($('[data-id="button__id__saoChep_qlDangKyHP"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_qlDangKyHP"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_qlDangKyHP"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_qlDangKyHP"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_qlDangKyHP');
	    			$('[data-id="button__id__excel_qlDangKyHP"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_qlDangKyHP"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_qlDangKyHP"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_qlDangKyHP"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_qlDangKyHP"]').attr('data-original-title', $($('[data-id="button__id__excel_qlDangKyHP"]').children()[0]).html());
	    			$('[data-id="button__id__excel_qlDangKyHP"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_qlDangKyHP"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_qlDangKyHP"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_qlDangKyHP');
	    			$('[data-id="button__id__pdf_qlDangKyHP"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_qlDangKyHP"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_qlDangKyHP"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_qlDangKyHP"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_qlDangKyHP"]').attr('data-original-title', $($('[data-id="button__id__pdf_qlDangKyHP"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_qlDangKyHP"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_qlDangKyHP"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_qlDangKyHP"]').attr('data-placement', 'left');
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