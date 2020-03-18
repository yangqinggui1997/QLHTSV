<script>
$(function(){
	try
	{
		var tbt = $('#div__id__thongBaoTruong');
		var bmxml = $('#div__id__bieuMauDangXML');
		/*click button mở form đăng ký */
		if(tbt.length)
			tbt.on('click', '[data-button-id="dangKy"]', function(){
	            try
	            {
	            	var $this = $(this);
	            	var maBM = $this.attr('data-button-maBM');
	            	var formData = new FormData();
	            	formData.append('_token', $('#_token').attr('content'));
	            	formData.append('maBM', maBM);
	            	$.ajax({
	            		type: 'POST',
	            		dataType: 'JSON',
	            		url: 'admin/quan_ly_thong_bao_nguoi_dung/xem_noi_dung_bm_xml',
	            		xhr: xhrSetting,
	            		cache: false,
	            		contentType: false,
	            		processData: false,
	            		data: formData,
	            		success: function(data)
	            		{
	            			try
	            			{
	            				var js = $('#scriptForBM');
	            				if(data.flag)
	            				{
	            					$('#form__id__noiDungBieuMauXML').html(data.noiDung);
	            					if(js.length)
	            						js.remove();
	            					$('body').append('<script id="scriptForBM">' + data.js + '<\/script>');
	            					$('#h2__id__bieuMauDangXML').text('BIỂU MẪU [' + data.tenBM.toUpperCase() + '] CỦA THÔNG BÁO [' + $this.attr('data-button-tenTB').toUpperCase() + ']');
						            bmxml.slideDown(800);
						            $('html, body').animate({
						                scrollTop: bmxml.offset().top
						            }, 800);
	            				}
        						else
        							throw new TypeError('Không thể lấy nội dung biểu mẫu!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
					            return true;
	            			}
	            			catch(err)
	            			{
	            				alert('Lỗi: ' + err.stack + '!');
	            				return false;
	            			}
	            		},
	            		error: function(jqXHR, textStatus, errorThrown)
            			{
            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Lấy nội dung biểu mẫu đính kèm của', 1, 'thông báo');
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