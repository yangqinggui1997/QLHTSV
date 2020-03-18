<script>
$(function(){
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTablasDangKyHP(){
			try
			{
				if(console.log("run_datatablasDangKyHP"),"undefined"!=typeof $.fn.DataTable)
				{
	    			var b = $('#table__id__dangKyHP');
	    			var count = 0;
	    			var l1 = 0;
	    			var l2 = 0;
	    			/*tạo table = script sau đó khởi tạo, insert table vào vùng chứa*/
	    			console.log("init_DataTablasDangKyHP");
    				b.dataTable({
	    				order:[[0,"asc"]],
	    				columnDefs:[{orderable:!1,targets:[1]}],
	    				dom:"Blfrtip",
	    				buttons:[
	    					{extend:"copy",className:"btn-sm"},
	    					{extend:"csv",className:"btn-sm"},
	    					{extend:"print",className:"btn-sm"}],
	    				responsive:!1,
	    				keys:!0
	    			});
	    			l1 = $('#table__id__danhGiaGD_wrapper').length;
	    			l2 = $('#table__id__xemLaiDGGD_wrapper').length;
	    			count = ((!l1 && l2) || (l1 && !l2)) ? 1 : ((l2 && l1)  ? 2 : count);
	    			/*Sắp xếp các nút sao chép, xuất excel và in pdf trên bảng đăng ký học phần*/
	    			$('#table__id__dangKyHP_wrapper').prepend('<div class="row div__class__group_button_dangKyHP"></div>');

	    			$('#table__id__dangKyHP_filter').next().remove();
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_dangKyHP_1"><div class="row"><div class="col-sm-4" id="div__id__button_parent_dangKyHP_1_1"></div><div class="col-sm-8" id="div__id__button_parent_dangKyHP_1_2"></div></div></div>').insertAfter($('[data-id="div__id__button_group"]')[count]);
	    			$('#div__id__div_button_parent_dangKyHP_1').append($('#table__id__dangKyHP_length'));
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_dangKyHP_2"></div>').insertAfter('#div__id__div_button_parent_dangKyHP_1');
	    			$('#div__id__div_button_parent_dangKyHP_2').append($('[data-id="div__id__button_group"]')[count]);
	    			$('<div class="col-sm-4" id="div__id__div_button_parent_dangKyHP_3"></div>').insertAfter('#div__id__div_button_parent_dangKyHP_2');
	    			$('#div__id__div_button_parent_dangKyHP_3').append($('#table__id__dangKyHP_filter'));
	    			$('#table__id__dangKyHP_filter').css('float', 'left');

	    			$('[class*="div__class__group_button_dangKyHP"]').append($('#div__id__div_button_parent_dangKyHP_1'));
	    			$('[class*="div__class__group_button_dangKyHP"]').append($('#div__id__div_button_parent_dangKyHP_2'));
	    			$('[class*="div__class__group_button_dangKyHP"]').append($('#div__id__div_button_parent_dangKyHP_3'));
	    			$('#div__id__button_parent_dangKyHP_1_1').append($('#div__id__button_group_dangKyHP'));
	    			$('#div__id__button_parent_dangKyHP_1_2').append($('#table__id__dangKyHP_length'));
	    			/*Reformat btutton copy, export excel and export pdf*/
	    			/*Copy button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[0]).attr('data-id', 'button__id__saoChep_dangKyHP');
	    			$('[data-id="button__id__saoChep_dangKyHP"]').removeClass('btn-default');
	    			$('[data-id="button__id__saoChep_dangKyHP"]').removeClass('btn-sm');
	    			$('[data-id="button__id__saoChep_dangKyHP"]').addClass('btn-success');
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[0]).attr('data-id', 'button__id__saoChep_dangKyHP');
	    			$('[data-id="button__id__saoChep_dangKyHP"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__saoChep_dangKyHP"]').attr('data-original-title', $($('[data-id="button__id__saoChep_dangKyHP"]').children()[0]).html());
	    			$('[data-id="button__id__saoChep_dangKyHP"]').append('<i class="fa fa-copy"></i>');
	    			$($('[data-id="button__id__saoChep_dangKyHP"]').children()[0]).remove();
	    			$('[data-id="button__id__saoChep_dangKyHP"]').attr('data-placement', 'left');

	    			/*Export excel button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[1]).attr('data-id', 'button__id__excel_dangKyHP');
	    			$('[data-id="button__id__excel_dangKyHP"]').removeClass('btn-sm');
	    			$('[data-id="button__id__excel_dangKyHP"]').removeClass('btn-default');
	    			$('[data-id="button__id__excel_dangKyHP"]').addClass('btn-info');
	    			
	    			$('[data-id="button__id__excel_dangKyHP"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__excel_dangKyHP"]').attr('data-original-title', $($('[data-id="button__id__excel_dangKyHP"]').children()[0]).html());
	    			$('[data-id="button__id__excel_dangKyHP"]').append('<i class="fa fa-file-excel-o"></i>');
	    			$($('[data-id="button__id__excel_dangKyHP"]').children()[0]).remove();
	    			$('[data-id="button__id__excel_dangKyHP"]').attr('data-placement', 'left');

	    			/*Export pdf button*/
	    			$($($('[data-id="div__id__button_group"]')[count]).children()[2]).attr('data-id', 'button__id__pdf_dangKyHP');
	    			$('[data-id="button__id__pdf_dangKyHP"]').removeClass('btn-sm');
	    			$('[data-id="button__id__pdf_dangKyHP"]').removeClass('btn-default');
	    			$('[data-id="button__id__pdf_dangKyHP"]').addClass('btn-warning');
	    			
	    			$('[data-id="button__id__pdf_dangKyHP"]').attr('data-toggle', 'tooltip');
	    			$('[data-id="button__id__pdf_dangKyHP"]').attr('data-original-title', $($('[data-id="button__id__pdf_dangKyHP"]').children()[0]).html());
	    			$('[data-id="button__id__pdf_dangKyHP"]').append('<i class="fa fa-file-pdf-o"></i>');
	    			$($('[data-id="button__id__pdf_dangKyHP"]').children()[0]).remove();
	    			$('[data-id="button__id__pdf_dangKyHP"]').attr('data-placement', 'left');

	    			/*Khởi tạo tooltip cho các nút export*/
					$('[data-id="button__id__saoChep_dangKyHP"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__excel_dangKyHP"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					$('[data-id="button__id__pdf_dangKyHP"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
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

		/*click button đăng ký học phần*/
		if($('#tbody__id__HPHK').length)
			$('#tbody__id__HPHK').on('click', '[data-button="dangKyHP"]', function(){
				try
	            {
	            	/*destroy and reinit datatable*/
	            	if($('#table__id__dangKyHP_wrapper').length)
	            	{
		            	$('#div__id__dangKyHPArea').prepend($('#div__id__button_group_dangKyHP'));
		    			$('#table__id__dangKyHP').dataTable().fnDestroy();
						$('#div__id__button_parent_dangKyHP_1_1').append($('#div__id__button_group_dangKyHP'));
					}
	    			init_DataTablasDangKyHP();
		            $('#div__id__dangKyHP').slideDown(800);
					$('html, body').animate({
		                scrollTop: $("#div__id__dangKyHP").offset().top
		            }, 800);
		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>