<script>
$(function(){
	try
	{
		/*check input datalist biểu mẫu*/
		if($('#textBox__id__bieuMauDinhKem').length)
			$('#textBox__id__bieuMauDinhKem').on('input', function(){
	            try
	            {
	            	var object = $(this);
	            	$('#datalist__id__bieuMauDinhKem').children().each(function(){
	            		if($(this).val() === object.val() || $(this).text() === object.val())
	            		{
	            			object.val($(this).text());
	            			object = $('#hidden__id__bieuMauDinhKem');
	            			object.attr('data-hidden-maBieuMau', $(this).val());
	            			object.attr('data-hidden-loaiBM', $(this).attr('data-option-loaiBM'));
	            			object.attr('data-hidden-innerText', $(this).text());
	            			if(typeof $(this).attr('data-option-src') !== undefined && $(this).attr('data-option-src'))
	            				object.attr('data-hidden-file', $(this).attr('data-option-src'));
	            			return false;
	            		}
	            		else
	            		{
	            			object = $('#hidden__id__bieuMauDinhKem');
	            			if(typeof object.attr('data-hidden-maBieuMau') !== undefined)
		            			object.removeAttr('data-hidden-maBieuMau');
		            		if(typeof object.attr('data-hidden-loaiBM') !== undefined)
		            			object.removeAttr('data-hidden-loaiBM');
	            			if(typeof object.attr('data-hidden-file') !== undefined)
		            			object.removeAttr('data-hidden-file');
		            		if(typeof object.attr('data-hidden-innerText') !== undefined)
		            			object.removeAttr('data-hidden-innerText');
		            		object = $('#textBox__id__bieuMauDinhKem');
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

		/*check input datalist văn bản*/
		if($('#textBox__id__vanBanDinhKem').length)
			$('#textBox__id__vanBanDinhKem').on('input', function(){
	            try
	            {
	            	var object = $(this);
	            	$('#datalist__id__vanBanDinhKem').children().each(function(){
	            		if($(this).val() === object.val() || $(this).text() === object.val())
	            		{
	            			object.val($(this).text());
	            			object = $('#hidden__id__vanBanDinhKem');
	            			object.attr('data-hidden-maVanBan', $(this).val());
	            			object.attr('data-hidden-loaiVB', $(this).attr('data-option-loaiVB'));
	            			object.attr('data-hidden-file', $(this).attr('data-option-src'));
	            			object.attr('data-hidden-innerText', $(this).text());
	            			return false;
	            		}
	            		else
	            		{
	            			object = $('#hidden__id__vanBanDinhKem');
	            			if(typeof object.attr('data-hidden-maVanBan') !== undefined)
		            			object.removeAttr('data-hidden-maVanBan');
		            		if(typeof object.attr('data-hidden-loaiVB') !== undefined)
		            			object.removeAttr('data-hidden-loaiVB');
	            			if(typeof object.attr('data-hidden-file') !== undefined)
		            			object.removeAttr('data-hidden-file');
		            		if(typeof object.attr('data-hidden-innerText') !== undefined)
		            			object.removeAttr('data-hidden-innerText');
		            		object = $('#textBox__id__vanBanDinhKem');
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

		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>