<script>
$(function(){
	try
	{
		var tbyTB = $('#tbody__id__thongBao');
		/*click button xoá thông báo*/
		if(tbyTB.length)
			tbyTB.on('click', '[data-button-id="xoa"]', function(){
	            try
	            {	var $this = $(this);
	            	confirm('Bạn có chắc chắn muốn xoá thông báo ' + $this.attr('data-button-tieuDeTB') + '?', function(){
		            	var maTB = $this.attr('data-button-maTB');
		            	var tieuDeTB = $this.attr('data-button-tieuDeTB');
		            	var formData = new FormData();
		            	formData.append('_token', $('#_token').attr('content'));
		            	formData.append('maTB', maTB);
		            	$.ajax({
		            		type: 'POST',
		            		dataType: 'JSON',
		            		url: 'admin/quan_ly_thong_bao_nguoi_dung/xoa',
		            		xhr: xhrSetting,
		            		cache: false,
		            		contentType: false,
		            		processData: false,
		            		data: formData,
		            		success: function(data)
		            		{
		            			try
	        					{
	        						var table = $('#table__id__thongBao');
	        						var divBMXML = $('#div__id__bieuMauDangXML');
	        						var dsTBCheck = null;
		    						var btnParent4 = $('#div__id__div_button_thongBao_parent_4');
		    						var l = 0;
		    						var _length = 0;
	        						if(data.flag)
	        						{
	        							if(!data.per)
		                                {
		                                    alert('Bạn không có quyền xoá!');
		                                    return false;
		                                }
	        							if((!divBMXML.is(':hidden') || !divBMXML[0].hasAttribute('hidden')) && divBMXML.attr('data-div-maTB') === maTB)
			           						{
			           							divBMXML.css('display', 'none');
			           							$('#form__id__noiDungBieuMauXML').html('');
			           						}
		           						table.dataTable().fnDeleteRow(table.DataTable().row($this.closest('tr')).index());
	        							reOrderRecords(table, 1);
	        							dsTBCheck = getLengthChkCheck(table, 0);
		    							l = btnParent4.length;
		    							if(l && dsTBCheck)
		    							{
		    								$('#p__id__chonBanGhi').text('Có ' + dsTBCheck + ' thông báo được chọn.');
			                                $('#button__id__xoaNhieuTB').attr('data-original-title', 'Xoá ' + (dsTBCheck > 1 ? 'các ' : '') + 'thông báo đã chọn');
		    							}
		    							else if(l)
		    							{
		    								btnParent4.remove();
		    							}
		    							_length = table.DataTable().rows().indexes().length;
		    							if(dsTBCheck != _length || !_length)
		    								$('[data-checkbox-tb="p"]').prop('checked', false);
		           						alert('Xoá thành công!');
	        						}
	        						else
	        							throw new TypeError('Không thể xoá thông báo [' + tieuDeTB + ']!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
	            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Xoá thông báo của', 1, 'người dùng');
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