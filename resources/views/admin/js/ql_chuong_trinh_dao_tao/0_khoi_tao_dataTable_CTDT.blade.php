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
	    			var b = $("#table__id__hocPhanHK");
	    			var c = $("#table__id__ctdt");
					console.log("init_DataTables");
					b.dataTable({
	    				order:[[1,"asc"]],
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[10]}],
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
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[9]}, {orderable:!1,targets:[10]}],
	    				paginate:false,
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});
	    			
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng chương trình đào tạo học kỳ*/
	    			$('#table__id__hocPhanHK_wrapper').prepend('<div class="row div__class__group_button_hocPhanHK"></div>');

	    			$('#table__id__hocPhanHK_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_hocPhanHK_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('#div__id__div_button_parent_hocPhanHK_1').append($('#div__id__button_group_hocPhanHK'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_hocPhanHK_2"></div>').insertAfter('#div__id__div_button_parent_hocPhanHK_1');
	    			$('#div__id__div_button_parent_hocPhanHK_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_hocPhanHK_3"></div>').insertAfter('#div__id__div_button_parent_hocPhanHK_2');
	    			$('#div__id__div_button_parent_hocPhanHK_3').append($('#table__id__hocPhanHK_filter'));
	    			$('#table__id__hocPhanHK_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_hocPhanHK"]').append($('#div__id__div_button_parent_hocPhanHK_1'));
	    			$('[class*="div__class__group_button_hocPhanHK"]').append($('#div__id__div_button_parent_hocPhanHK_2'));
	    			$('[class*="div__class__group_button_hocPhanHK"]').append($('#div__id__div_button_parent_hocPhanHK_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_hocPhanHK');
	    			$('[data-id="button__id__saoChep_hocPhanHK"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_hocPhanHK"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_hocPhanHK"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_hocPhanHK');
	    			$('[data-id="button__id__saoChep_hocPhanHK"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_hocPhanHK"]').attr('data-original-title', $($('[data-id="button__id__saoChep_hocPhanHK"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_hocPhanHK"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_hocPhanHK"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_hocPhanHK"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_hocPhanHK');
	    			$('[data-id="button__id__excel_hocPhanHK"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_hocPhanHK"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_hocPhanHK"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_hocPhanHK"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_hocPhanHK"]').attr('data-original-title', $($('[data-id="button__id__excel_hocPhanHK"]').children()[0]).html());
	    			$('[data-id="button__id__excel_hocPhanHK"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_hocPhanHK"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_hocPhanHK"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_hocPhanHK');
	    			$('[data-id="button__id__pdf_hocPhanHK"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_hocPhanHK"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_hocPhanHK"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_hocPhanHK"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_hocPhanHK"]').attr('data-original-title', $($('[data-id="button__id__pdf_hocPhanHK"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_hocPhanHK"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_hocPhanHK"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_hocPhanHK"]').attr('data-placement', 'left');
	    			
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng chương trình đào tạo*/
	    			$('#table__id__ctdt_wrapper').prepend('<div class="row div__class__group_button_ctdt"></div>');

	    			$('#table__id__ctdt_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_ctdt_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[1]);
	    			$('#div__id__div_button_parent_ctdt_1').append($('#div__id__button_group_ctdt'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_ctdt_2"></div>').insertAfter('#div__id__div_button_parent_ctdt_1');
	    			$('#div__id__div_button_parent_ctdt_2').append($('[data-id="div__id__button_group"]')[1]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_ctdt_3"></div>').insertAfter('#div__id__div_button_parent_ctdt_2');
	    			$('#div__id__div_button_parent_ctdt_3').append($('#table__id__ctdt_filter'));
	    			$('#table__id__ctdt_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_ctdt"]').append($('#div__id__div_button_parent_ctdt_1'));
	    			$('[class*="div__class__group_button_ctdt"]').append($('#div__id__div_button_parent_ctdt_2'));
	    			$('[class*="div__class__group_button_ctdt"]').append($('#div__id__div_button_parent_ctdt_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[0]).attr('data-id', 'button__id__saoChep_ctdt');
	    			$('[data-id="button__id__saoChep_ctdt"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_ctdt"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_ctdt"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[0]).attr('data-id', 'button__id__saoChep_ctdt');
	    			$('[data-id="button__id__saoChep_ctdt"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_ctdt"]').attr('data-original-title', $($('[data-id="button__id__saoChep_ctdt"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_ctdt"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_ctdt"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_ctdt"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[1]).attr('data-id', 'button__id__excel_ctdt');
	    			$('[data-id="button__id__excel_ctdt"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_ctdt"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_ctdt"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_ctdt"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_ctdt"]').attr('data-original-title', $($('[data-id="button__id__excel_ctdt"]').children()[0]).html());
	    			$('[data-id="button__id__excel_ctdt"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_ctdt"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_ctdt"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[2]).attr('data-id', 'button__id__pdf_ctdt');
	    			$('[data-id="button__id__pdf_ctdt"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_ctdt"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_ctdt"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_ctdt"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_ctdt"]').attr('data-original-title', $($('[data-id="button__id__pdf_ctdt"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_ctdt"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_ctdt"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_ctdt"]').attr('data-placement', 'left');
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