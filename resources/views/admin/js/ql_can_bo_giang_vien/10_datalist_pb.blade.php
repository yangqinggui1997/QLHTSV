<script>
$(function(){
	try
	{
		var txtMaPhong = $('#textBox__id__phong');
		/*input mã phòng*/
		if(txtMaPhong.length)
			txtMaPhong.on('input', function(){
				try
	            {
		            var object = $(this);
		            var hdMaPhong = $('#hidden__id__phong');
		            var objVal = object.val();
		            if(!objVal)
		            	$('#textBox__id__khoa').val('');
		            else
		            	$('#datalist__id__phong').children().each(function(){
		            		var $this = $(this);
		            		var formData = null;
		            		if(objVal.toUpperCase() === $this.val().toUpperCase() || $this.text().toUpperCase() === objVal.toUpperCase())
		            		{
		            			hdMaPhong.val($this.val());
		            			formData = new FormData();
		            			formData.append('_token', $('#_token').attr('content'));
		            			formData.append('maPhong', $this.val());
		            			$.ajax({
		            				type: 'POST',
		            				dataType: 'JSON',
		            				url: 'admin/quan_ly_can_bo__giang_vien/lay_ten_khoa',
		            				xhr: xhrSetting,
		            				cache: false,
		            				contentType: false,
		            				processData: false,
		            				data: formData,
		            				success: function(data)
		            				{
		            					try
		            					{
		            						if(data.flag)
		            							$('#textBox__id__khoa').val(data.tenKhoa);
		            						else
		            						{
		            							$('#textBox__id__khoa').val('');
		            							throw new TypeError('Không thể lấy tên khoa!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>'); 
		            						}
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
			            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Lấy thông tin', 1, 'khoa');
			            			}
		            			});
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
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>