<script>
$(function(){
	try
	{
		var tbyTB = $('#tbody__id__thongBao');
		/*click button xem nội dung biểu mẫu XML*/
		if(tbyTB.length)
			tbyTB.on('click', '[data-a-idBMXML]', function(){
	            try
	            {
	            	var $this = $(this);
	            	var maBM = $this.attr('data-a-idBMXML');
	            	var maTB = $this.attr('data-a-maTB');
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
	            				var divBMXML = $('#div__id__bieuMauDangXML');
	            				var js = $('#scriptForBM');
	            				if(data.flag)
	            				{
	            					divBMXML.attr('data-div-maTB', maTB);
	            					$('#form__id__noiDungBieuMauXML').html(data.noiDung);
	            					if(js.length)
	            						js.remove();
	            					$('body').append('<script id="scriptForBM">' + data.js + '<\/script>');
	            					$('#h2__id__bieuMauDangXML').text('BIỂU MẪU [' + data.tenBM.toUpperCase() + '] CỦA THÔNG BÁO [' + $this.attr('data-a-tenTB').toUpperCase() + ']');
						            divBMXML.slideDown(800);
									$('html, body').animate({
						                scrollTop: divBMXML.offset().top
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
					alert("Lỗi: " + err.stack + "!");
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