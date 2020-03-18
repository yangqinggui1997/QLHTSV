<script>
$(function(){
	try
	{
		/*click button thêm biểu mẫu cho thông báo*/
		if($('#button__id__addBieuMauDinhKem').length)
			$('#button__id__addBieuMauDinhKem').on('click', function(){
	            try
	            {
		            var hidden = $('#hidden__id__bieuMauDinhKem');
	            	if(!$('#textBox__id__bieuMauDinhKem').val().trim())
	            		throw new Error("Hãy nhập tên biểu mẫu vào!");
	            	if(typeof hidden.attr("data-hidden-maBieuMau") !== typeof undefined && hidden.attr("data-hidden-maBieuMau"))
	            		if(typeof hidden.attr("data-hidden-loaiBM") !== typeof undefined && hidden.attr("data-hidden-loaiBM"))
	            			if(hidden.attr("data-hidden-loaiBM") === 'file')
	            				$('#select__id__bieuMauDinhKemDaChon').prepend('<option data-option-id="' + hidden.attr("data-hidden-maBieuMau") + '" value="' + hidden.attr("data-hidden-maBieuMau") + '" data-option-loaiBM="file" data-option-src="' + hidden.attr("data-hidden-file") + '">' + hidden.attr('data-hidden-innerText') + '</option>');
	            			else
		        				$('#select__id__bieuMauDinhKemDaChon').prepend('<option data-option-id="' + hidden.attr("data-hidden-maBieuMau") + '" value="' + hidden.attr("data-hidden-maBieuMau") + '" data-option-loaiBM="xml">' + hidden.attr('data-hidden-innerText') + '</option>')
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

		/*click button thêm văn bản cho thông báo*/
		if($('#button__id__addVanBanDinhKem').length)
			$('#button__id__addVanBanDinhKem').on('click', function(){
	            try
	            {
		            var hidden = $('#hidden__id__vanBanDinhKem');
	            	if(!$('#textBox__id__vanBanDinhKem').val().trim())
	            		throw new Error("Hãy nhập tên văn bản vào!");
	            	if(typeof hidden.attr("data-hidden-maVanBan") !== typeof undefined && hidden.attr("data-hidden-maVanBan"))
	            		if(typeof hidden.attr("data-hidden-loaiVB") !== typeof undefined && hidden.attr("data-hidden-loaiVB"))
	            			$('#select__id__vanBanDinhKemDaChon').prepend('<option data-option-id="' + hidden.attr("data-hidden-maVanBan") + '" value="' + hidden.attr("data-hidden-maVanBan") + '" data-option-loaiVB="file" data-option-src="' + hidden.attr("data-hidden-file") + '">' + hidden.attr('data-hidden-innerText') + '</option>');
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
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>