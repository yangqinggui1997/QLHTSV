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
	    			var b = $("#table__id__hocKyHT");
					console.log("init_DataTables");
	    			b.dataTable({
	    				order:[[1,"asc"]],
	    				columnDefs:[{orderable:!1,targets:[5]}],
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});

	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng danh sách học kỳ học tập*/
	    			$('#table__id__hocKyHT_wrapper').prepend('<div class="row marginBottom10 div__class__group_button_hocKyHT"></div>');

	    			$('#table__id__hocKyHT_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_hocKyHT_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('#div__id__div_button_parent_hocKyHT_1').append($('#table__id__hocKyHT_length'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_hocKyHT_2"></div>').insertAfter('#div__id__div_button_parent_hocKyHT_1');
	    			$('#div__id__div_button_parent_hocKyHT_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_hocKyHT_3"></div>').insertAfter('#div__id__div_button_parent_hocKyHT_2');
	    			$('#div__id__div_button_parent_hocKyHT_3').append($('#table__id__hocKyHT_filter'));
	    			$('#table__id__hocKyHT_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_hocKyHT"]').append($('#div__id__div_button_parent_hocKyHT_1'));
	    			$('[class*="div__class__group_button_hocKyHT"]').append($('#div__id__div_button_parent_hocKyHT_2'));
	    			$('[class*="div__class__group_button_hocKyHT"]').append($('#div__id__div_button_parent_hocKyHT_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_hocKyHT');
	    			$('[data-id="button__id__saoChep_hocKyHT"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_hocKyHT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_hocKyHT"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_hocKyHT');
	    			$('[data-id="button__id__saoChep_hocKyHT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_hocKyHT"]').attr('data-original-title', $($('[data-id="button__id__saoChep_hocKyHT"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_hocKyHT"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_hocKyHT"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_hocKyHT"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_hocKyHT');
	    			$('[data-id="button__id__excel_hocKyHT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_hocKyHT"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_hocKyHT"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_hocKyHT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_hocKyHT"]').attr('data-original-title', $($('[data-id="button__id__excel_hocKyHT"]').children()[0]).html());
	    			$('[data-id="button__id__excel_hocKyHT"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_hocKyHT"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_hocKyHT"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_hocKyHT');
	    			$('[data-id="button__id__pdf_hocKyHT"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_hocKyHT"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_hocKyHT"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_hocKyHT"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_hocKyHT"]').attr('data-original-title', $($('[data-id="button__id__pdf_hocKyHT"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_hocKyHT"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_hocKyHT"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_hocKyHT"]').attr('data-placement', 'left');
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