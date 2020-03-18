<script>
$(function() {
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTables_thongBaoCuaBieuMau(){
			try
			{
				if(console.log("run_datatables_thongBaoCuaBieuMau"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b=$("#table__id__thongBaoCuaBieuMau");
					console.log("init_DataTables_thongBaoCuaBieuMau");
	    			b.dataTable({
	    				order:[[0,"asc"]],
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng thông báo của biểu mẫu*/
	    			$('#table__id__thongBaoCuaBieuMau_wrapper').prepend('<div class="row div__class__group_button_thongBaoCuaBieuMau"></div>');
	    			$('#table__id__thongBaoCuaBieuMau_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_thongBaoCuaBieuMau_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_thongBaoCuaBieuMau_2"></div>').insertAfter('#div__id__div_button_parent_thongBaoCuaBieuMau_1');
	    			$('#div__id__div_button_parent_thongBaoCuaBieuMau_2').append($('[data-id="div__id__button_group"]')[0]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_thongBaoCuaBieuMau_3"></div>').insertAfter('#div__id__div_button_parent_thongBaoCuaBieuMau_2');
	    			$('#div__id__div_button_parent_thongBaoCuaBieuMau_3').append($('#table__id__thongBaoCuaBieuMau_filter'));
	    			$('#table__id__thongBaoCuaBieuMau_filter').css('float', 'left');
	    			$('[class*="div__class__group_button_thongBaoCuaBieuMau"]').append($('#div__id__div_button_parent_thongBaoCuaBieuMau_1'));
	    			$('[class*="div__class__group_button_thongBaoCuaBieuMau"]').append($('#div__id__div_button_parent_thongBaoCuaBieuMau_2'));
	    			$('[class*="div__class__group_button_thongBaoCuaBieuMau"]').append($('#div__id__div_button_parent_thongBaoCuaBieuMau_3'));
	    			$('#div__id__div_button_parent_thongBaoCuaBieuMau_1').append($('#table__id__thongBaoCuaBieuMau_length'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_thongBaoCuaBieuMau');
	    			$('[data-id="button__id__saoChep_thongBaoCuaBieuMau"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_thongBaoCuaBieuMau"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_thongBaoCuaBieuMau"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[0]).attr('data-id', 'button__id__saoChep_thongBaoCuaBieuMau');
	    			$('[data-id="button__id__saoChep_thongBaoCuaBieuMau"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_thongBaoCuaBieuMau"]').attr('data-original-title', $($('[data-id="button__id__saoChep_thongBaoCuaBieuMau"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_thongBaoCuaBieuMau"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_thongBaoCuaBieuMau"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_thongBaoCuaBieuMau"]').attr('data-placement', 'right');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[1]).attr('data-id', 'button__id__excel_thongBaoCuaBieuMau');
	    			$('[data-id="button__id__excel_thongBaoCuaBieuMau"]').removeClass('btn-sm'); $('[data-id="button__id__excel_thongBaoCuaBieuMau"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_thongBaoCuaBieuMau"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_thongBaoCuaBieuMau"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_thongBaoCuaBieuMau"]').attr('data-original-title', $($('[data-id="button__id__excel_thongBaoCuaBieuMau"]').children()[0]).html());
	    			$('[data-id="button__id__excel_thongBaoCuaBieuMau"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_thongBaoCuaBieuMau"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_thongBaoCuaBieuMau"]').attr('data-placement', 'right');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[0]).children()[2]).attr('data-id', 'button__id__pdf_thongBaoCuaBieuMau');
	    			$('[data-id="button__id__pdf_thongBaoCuaBieuMau"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_thongBaoCuaBieuMau"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_thongBaoCuaBieuMau"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_thongBaoCuaBieuMau"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_thongBaoCuaBieuMau"]').attr('data-original-title', $($('[data-id="button__id__pdf_thongBaoCuaBieuMau"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_thongBaoCuaBieuMau"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_thongBaoCuaBieuMau"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_thongBaoCuaBieuMau"]').attr('data-placement', 'right');
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

		function init_DataTables_bieuMauDangFile(){
			try
			{
				if(console.log("run_datatables_bieuMauDangFile"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b=$("#table__id__bieuMauDangFile");
					console.log("init_DataTables_bieuMauDangFile");
	    			b.dataTable({
	    				order:[[1,"asc"]],
	    				columnDefs:[{orderable:!1,targets:[0]}, {orderable:!1,targets:[5]}],
	    				paginate:false,
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng biểu mẫu*/
	    			$('#table__id__bieuMauDangFile_wrapper').prepend('<div class="row div__class__group_button_bieuMauDangFile"></div>');

	    			$('#table__id__bieuMauDangFile_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_bieuMauDangFile_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[1]);
	    			$('#div__id__div_button_parent_bieuMauDangFile_1').append($('#div__id__button_group_bieuMauDangFile'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_bieuMauDangFile_2"></div>').insertAfter('#div__id__div_button_parent_bieuMauDangFile_1');
	    			$('#div__id__div_button_parent_bieuMauDangFile_2').append($('[data-id="div__id__button_group"]')[1]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_bieuMauDangFile_3"></div>').insertAfter('#div__id__div_button_parent_bieuMauDangFile_2');
	    			$('#div__id__div_button_parent_bieuMauDangFile_3').append($('#table__id__bieuMauDangFile_filter'));
	    			$('#table__id__bieuMauDangFile_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_bieuMauDangFile"]').append($('#div__id__div_button_parent_bieuMauDangFile_1'));
	    			$('[class*="div__class__group_button_bieuMauDangFile"]').append($('#div__id__div_button_parent_bieuMauDangFile_2'));
	    			$('[class*="div__class__group_button_bieuMauDangFile"]').append($('#div__id__div_button_parent_bieuMauDangFile_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[0]).attr('data-id', 'button__id__saoChep_bieuMauDangFile');
	    			$('[data-id="button__id__saoChep_bieuMauDangFile"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_bieuMauDangFile"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_bieuMauDangFile"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[0]).attr('data-id', 'button__id__saoChep_bieuMauDangFile');
	    			$('[data-id="button__id__saoChep_bieuMauDangFile"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_bieuMauDangFile"]').attr('data-original-title', $($('[data-id="button__id__saoChep_bieuMauDangFile"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_bieuMauDangFile"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_bieuMauDangFile"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_bieuMauDangFile"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[1]).attr('data-id', 'button__id__excel_bieuMauDangFile');
	    			$('[data-id="button__id__excel_bieuMauDangFile"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_bieuMauDangFile"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_bieuMauDangFile"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_bieuMauDangFile"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_bieuMauDangFile"]').attr('data-original-title', $($('[data-id="button__id__excel_bieuMauDangFile"]').children()[0]).html());
	    			$('[data-id="button__id__excel_bieuMauDangFile"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_bieuMauDangFile"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_bieuMauDangFile"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[1]).children()[2]).attr('data-id', 'button__id__pdf_bieuMauDangFile');
	    			$('[data-id="button__id__pdf_bieuMauDangFile"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_bieuMauDangFile"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_bieuMauDangFile"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_bieuMauDangFile"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_bieuMauDangFile"]').attr('data-original-title', $($('[data-id="button__id__pdf_bieuMauDangFile"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_bieuMauDangFile"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_bieuMauDangFile"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_bieuMauDangFile"]').attr('data-placement', 'left');
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

		function init_DataTables_bieuMauDangXML(){
			try
			{
				if(console.log("run_datatables_bieuMauDangXML"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b=$("#table__id__bieuMauDangXML");
					console.log("init_DataTables_bieuMauDangXML");
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
	    			
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng biểu mẫu*/
	    			$('#table__id__bieuMauDangXML_wrapper').prepend('<div class="row div__class__group_button_bieuMauDangXML"></div>');

	    			$('#table__id__bieuMauDangXML_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_bieuMauDangXML_1"></div>').insertAfter($('[data-id="div__id__button_group"]')[2]);
	    			$('#div__id__div_button_parent_bieuMauDangXML_1').append($('#div__id__button_group_bieuMauDangXML'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_bieuMauDangXML_2"></div>').insertAfter('#div__id__div_button_parent_bieuMauDangXML_1');
	    			$('#div__id__div_button_parent_bieuMauDangXML_2').append($('[data-id="div__id__button_group"]')[2]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_bieuMauDangXML_3"></div>').insertAfter('#div__id__div_button_parent_bieuMauDangXML_2');
	    			$('#div__id__div_button_parent_bieuMauDangXML_3').append($('#table__id__bieuMauDangXML_filter'));
	    			$('#table__id__bieuMauDangXML_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_bieuMauDangXML"]').append($('#div__id__div_button_parent_bieuMauDangXML_1'));
	    			$('[class*="div__class__group_button_bieuMauDangXML"]').append($('#div__id__div_button_parent_bieuMauDangXML_2'));
	    			$('[class*="div__class__group_button_bieuMauDangXML"]').append($('#div__id__div_button_parent_bieuMauDangXML_3'));

	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[2]).children()[0]).attr('data-id', 'button__id__saoChep_bieuMauDangXML');
	    			$('[data-id="button__id__saoChep_bieuMauDangXML"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_bieuMauDangXML"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_bieuMauDangXML"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[2]).children()[0]).attr('data-id', 'button__id__saoChep_bieuMauDangXML');
	    			$('[data-id="button__id__saoChep_bieuMauDangXML"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_bieuMauDangXML"]').attr('data-original-title', $($('[data-id="button__id__saoChep_bieuMauDangXML"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_bieuMauDangXML"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_bieuMauDangXML"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_bieuMauDangXML"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[2]).children()[1]).attr('data-id', 'button__id__excel_bieuMauDangXML');
	    			$('[data-id="button__id__excel_bieuMauDangXML"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_bieuMauDangXML"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_bieuMauDangXML"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_bieuMauDangXML"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_bieuMauDangXML"]').attr('data-original-title', $($('[data-id="button__id__excel_bieuMauDangXML"]').children()[0]).html());
	    			$('[data-id="button__id__excel_bieuMauDangXML"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_bieuMauDangXML"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_bieuMauDangXML"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[2]).children()[2]).attr('data-id', 'button__id__pdf_bieuMauDangXML');
	    			$('[data-id="button__id__pdf_bieuMauDangXML"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_bieuMauDangXML"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_bieuMauDangXML"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_bieuMauDangXML"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_bieuMauDangXML"]').attr('data-original-title', $($('[data-id="button__id__pdf_bieuMauDangXML"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_bieuMauDangXML"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_bieuMauDangXML"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_bieuMauDangXML"]').attr('data-placement', 'left');
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
		init_DataTables_thongBaoCuaBieuMau();
		init_DataTables_bieuMauDangFile();
		init_DataTables_bieuMauDangXML();
		
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>