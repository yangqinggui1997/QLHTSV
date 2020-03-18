<script>
$(function(){
	try
	{
		var tbyTN = $('#tbody__id__tinNhan');
		/*click button xoá tất cả nội dung trò chuyện*/
		if(tbyTN.length)
			tbyTN.on('click', '[data-button-id="xoa"]', function(){
	            try
	            {
	            	var $this = $(this);
	            	confirm('Bạn có chắc chắn muốn xoá người này khỏi danh bạ của người dùng ' + $this.attr('data-button-tenNG') + '?', function(){
	            		var maNG = $this.attr('data-button-maNG');
		            	var maNN = $this.attr('data-button-maNN');
		            	var tenNN = $this.attr('data-button-tenNN');
		            	var formData = new FormData();
		            	formData.append('_token', $('#_token').attr('content'));
		            	formData.append('maNG', maNG);
		            	formData.append('maNN', maNN);
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
	        						var frmTN = $('#div__id__formTinNhan');
	        						var dsTNCheck = null;
		    						var btnParent4 = $('#div__id__div_button_tinNhan_parent_4');
		    						var l = 0;
		    						var _length = 0;
	        						if(data.flag)
	        						{
	        							if(!data.per)
		                                {
		                                    alert('Bạn không có quyền xoá!');
		                                    return false;
		                                }
	        							if((!frmTN.is(':hidden') || !frmTN[0].hasAttribute('hidden')) && frmTN.attr('data-div-maNN') === maNN)
			           						{
			           							frmTN.css('display', 'none');
			           							$('#div__id__noiDungTT').html('');
			           						}
		           						table.dataTable().fnDeleteRow(table.DataTable().row($this.closest('tr')).index());
	        							reOrderRecords(table, 1);
	        							dsTNCheck = getLengthChkCheck(table, 0);
		    							l = btnParent4.length;
		    							if(l && dsTNCheck)
		    							{
		    								$('#p__id__chonBanGhi').text('Có ' + dsTNCheck + ' người liên hệ được chọn.');
			                                $('#button__id__xoaNhieuNLH').attr('data-original-title', 'Xoá ' + (dsTNCheck > 1 ? 'các ' : '') + 'người liên hệ đã chọn');
		    							}
		    							else if(l)
		    							{
		    								btnParent4.remove();
		    							}
		    							_length = table.DataTable().rows().indexes().length;
		    							if(dsTNCheck != _length || !_length)
		    								$('[data-checkbox-tn="p"]').prop('checked', false);
		           						alert('Xoá thành công!');
	        						}
	        						else
	        							throw new TypeError('Không thể xoá tất cả nội dung trò chuyện với người dùng ' + tenNN + '!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
	            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Xoá tất cả nội dung trò chuyện với', 1, 'người dùng');
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