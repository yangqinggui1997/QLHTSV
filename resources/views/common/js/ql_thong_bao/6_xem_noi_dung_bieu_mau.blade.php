<script>
$(function(){
	try
	{
		/*click thẻ a xem nội dung biểu mẫu*/
		if($('#a__id__xemBieuMauDinhKem').length)
			$('#a__id__xemBieuMauDinhKem').on('click', function(){
	            try
	            {
	            	var hidden = $('#hidden__id__bieuMauDinhKem');
	            	if(!$('#textBox__id__bieuMauDinhKem').val().trim())
	            		throw new Error("Hãy nhập tên biểu mẫu vào!");
	            	if(typeof hidden.attr("data-hidden-maBieuMau") !== typeof undefined && hidden.attr("data-hidden-maBieuMau"))
	            		if(typeof hidden.attr("data-hidden-loaiBM") !== typeof undefined && hidden.attr("data-hidden-loaiBM"))
	            			if(hidden.attr("data-hidden-loaiBM") === 'file')
	            				$(this).attr('href', hidden.attr('data-hidden-file'));
	            			else
            				{
            					$(this).attr('href', 'javascript:(0)');
		            			$('#div__id__noiDungBMXML').html(/*nội dung biễu mẫu xml*/);/*Truy vấn CSDL lấy nội dung biểu mẫu*/
		            			$('#div__id__bieuMauXMLArea').show();
		            			$('#div__id__noiDungBMXML').show();
		            		}
            			else
            				throw new Error("Biểu mẫu không tồn tại!");
            		else 
            			throw new Error("Biểu mẫu không tồn tại!");
		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click thẻ a xem nội dung biểu mẫu đã chọn*/
		if($('#a__id__xemBieuMauDinhKemDaChon').length)
			$('#a__id__xemBieuMauDinhKemDaChon').on('click', function(){
	            try
	            {
	            	var option = null;
	            	if(!$('#select__id__bieuMauDinhKemDaChon').children().length)
	            		throw new Error("Chưa có biểu mẫu nào đính kèm!");
	            	option = $('[data-option-id="' + $('#select__id__bieuMauDinhKemDaChon').val() + '"]');
	            	if(typeof option.attr("data-option-loaiBM") !== typeof undefined && option.attr("data-option-loaiBM"))
            			if(option.attr("data-option-loaiBM") === 'file')
            				$(this).attr('href', option.attr('data-option-src'));
            			else
        				{
        					$(this).attr('href', 'javascript:(0)');
	            			$('#div__id__noiDungBMXML').html(/*nội dung biễu mẫu xml*/);/*Truy vấn CSDL lấy nội dung biểu mẫu*/
	            			$('#div__id__bieuMauXMLArea').show();
	            			$('#div__id__noiDungBMXML').show();
	            		}
        			else
        				throw new Error("Biểu mẫu không tồn tại!");
		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click thẻ a xem nội dung văn bản*/
		if($('#a__id__xemVanBanDinhKem').length)
			$('#a__id__xemVanBanDinhKem').on('click', function(){
	            try
	            {
	            	var hidden = $('#hidden__id__vanBanDinhKem');
	            	if(!$('#textBox__id__vanBanDinhKem').val().trim())
	            		throw new Error("Hãy nhập tên văn bản vào!");
	            	if(typeof hidden.attr("data-hidden-maVanBan") !== typeof undefined && hidden.attr("data-hidden-maVanBan"))
	            		if(typeof hidden.attr("data-hidden-loaiVB") !== typeof undefined && hidden.attr("data-hidden-loaiVB"))
	            			$(this).attr('href', hidden.attr('data-hidden-file'));
            			else
            				throw new Error("Văn bản không tồn tại!");
            		else 
            			throw new Error("Văn bản không tồn tại!");
		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click thẻ a xem nội dung văn bản đã chọn*/
		if($('#a__id__xemVanBanDinhKemDaChon').length)
			$('#a__id__xemVanBanDinhKemDaChon').on('click', function(){
	            try
	            {
	            	var option = null;
	            	if(!$('#select__id__vanBanDinhKemDaChon').children().length)
	            		throw new Error("Chưa có văn bản nào đính kèm!");
	            	option = $('[data-option-id="' + $('#select__id__vanBanDinhKemDaChon').val() + '"]');
	            	if(typeof option.attr("data-option-loaiVB") !== typeof undefined && option.attr("data-option-loaiVB"))
            			$(this).attr('href', option.attr('data-option-src'));
        			else
        				throw new Error("Văn bản không tồn tại!");
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