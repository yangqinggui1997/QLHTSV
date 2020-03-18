<script>
$(function(){
	try
	{
		var divNDTT = $('#div__id__noiDungTT');
		function deleteRowInDtSrc(table, idGui, idNhan)
		{
			var data = table.DataTable().rows().data();
			var i = 0;
			var chk = null;
			for(;i < data.length; ++i)
			{
				chk = $(data[i][0]);
				if(chk.attr('data-checkbox-maNG') === idGui && chk.attr('data-checkbox-maNN') === idNhan)
				{
					table.dataTable().fnDeleteRow(i);
					return true;
				}
			}
			return false;
		}

		/*click button xoá nội dung trò chuyện trên form*/
		if(divNDTT.length)
			divNDTT.on('click', '[data-button-id="xoaTN"]', function(){
	            try
	            {
	            	var $this = $(this);
	            	confirm('Bạn có thực sự muốn xoá nội dung tin nhắn này?', function(){
		            	var maTN = $this.attr('data-button-maTN');
		            	var formData = new FormData();
		            	formData.append('_token', $('#_token').attr('content'));
		            	formData.append('maTN', maTN);
		            	$.ajax({
		            		type: 'POST',
		            		dataType: 'JSON',
		            		url: 'admin/quan_ly_tin_nhan_nguoi_dung/xoa',
		            		xhr: xhrSetting,
		            		cache: false,
		            		contentType: false,
		            		processData: false,
		            		data: formData,
		            		success: function(data)
		            		{
		            			try
	        					{
	        						var table = $('#table__id__tinNhan');
	        						var dataDiv = $('[data-div-maTN="' + maTN + '"]');
	        						if(data.flag)
	        						{
	        							if(!data.per)
		                                {
		                                    alert('Bạn không có quyền xoá!');
		                                    return false;
		                                }
	        							dataDiv.remove();
	        							if(!$('[data-button-id="xoaTN"]').length)
	        							{
	        								$('#div__id__formTinNhan').css('display', 'none');
	        								if(deleteRowInDtSrc(table, $this.attr('data-button-maNG'), $this.attr('data-button-maNN')))
			        							reOrderRecords(table, 1);
			        						else
			        							throw new TypeError('Xoá người liên hệ thất bại!<br>Do không thể định vị vị trí của họ trong danh sách hiển thị!<br>');
	        							}
	        							alert('Xoá thành công!');
	        						}
	        						else
	        							throw new TypeError('Không thể xoá nội dung tin nhắn này!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
	            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Xoá nội dung tin nhắn của', 1, 'người dùng');
	            			}
		            	});
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