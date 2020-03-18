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
	    			var b=$("#table__id__tinNhan");
					console.log("init_DataTables");
	    			b.dataTable({
	    				order:[[1,"asc"]],
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[6]}],
	    				paginate:false,
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});
	    			
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng tin nhắn*/
	    			$('#table__id__tinNhan_wrapper').prepend('<div class="row div__class__group_button_tinNhan"></div>');

	    			$('#table__id__tinNhan_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_tinNhan_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('#div__id__div_button_parent_tinNhan_1').append($('#div__id__button_group_tinNhan'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_tinNhan_2"></div>').insertAfter('#div__id__div_button_parent_tinNhan_1');
	    			$('#div__id__div_button_parent_tinNhan_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_tinNhan_3"></div>').insertAfter('#div__id__div_button_parent_tinNhan_2');
	    			$('#div__id__div_button_parent_tinNhan_3').append($('#table__id__tinNhan_filter'));
	    			$('#table__id__tinNhan_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_tinNhan"]').append($('#div__id__div_button_parent_tinNhan_1'));
	    			$('[class*="div__class__group_button_tinNhan"]').append($('#div__id__div_button_parent_tinNhan_2'));
	    			$('[class*="div__class__group_button_tinNhan"]').append($('#div__id__div_button_parent_tinNhan_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_tinNhan');
	    			$('[data-id="button__id__saoChep_tinNhan"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_tinNhan"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_tinNhan"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_tinNhan');
	    			$('[data-id="button__id__saoChep_tinNhan"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_tinNhan"]').attr('data-original-title', $($('[data-id="button__id__saoChep_tinNhan"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_tinNhan"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_tinNhan"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_tinNhan"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_tinNhan');
	    			$('[data-id="button__id__excel_tinNhan"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_tinNhan"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_tinNhan"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_tinNhan"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_tinNhan"]').attr('data-original-title', $($('[data-id="button__id__excel_tinNhan"]').children()[0]).html());
	    			$('[data-id="button__id__excel_tinNhan"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_tinNhan"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_tinNhan"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_tinNhan');
	    			$('[data-id="button__id__pdf_tinNhan"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_tinNhan"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_tinNhan"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_tinNhan"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_tinNhan"]').attr('data-original-title', $($('[data-id="button__id__pdf_tinNhan"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_tinNhan"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_tinNhan"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_tinNhan"]').attr('data-placement', 'left');
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