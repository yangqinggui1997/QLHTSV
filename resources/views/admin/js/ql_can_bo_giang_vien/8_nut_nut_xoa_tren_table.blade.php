<script>
$(function(){
	try
	{
		var tbyKhoa = $('#tbody__id__canBo');
		/*click button xoá khoa*/
		if(tbyKhoa.length)
			tbyKhoa.on('click', '[data-button-id="xoa"]', function(){
				try
	            {
	            	var $this = $(this);
		        	confirm('Bạn có chắc chắn muốn xoá cán bộ ' + $this.attr('data-button-tenCB') + '?', function(){
		        		var maCB = $this.attr('data-button-tenCB');
		        		var formData = new FormData();
		        		formData.append('_token', $('#_token').attr('content'));
			        	formData.append('maCB', maCB);
			        	$.ajax({
			        		type: 'POST',
			        		dataType: 'JSON',
			        		url: 'admin/quan_ly_can_bo__giang_vien/xoa',
			        		xhr: xhrSetting,
			        		cache: false,
			        		contentType: false,
			        		processData: false,
			        		data: formData,
			        		success: function(data)
			        		{
			        			try
			        			{
			        				var table = $('#table__id__canBo');
			        				var dsPCGD = $('#div__id__danhSachHPGD');
			        				var divFormCB = $('#div__id__formCanBo');
			        				var dsCBCheck = null;
		    						var btnParent4 = $('#div__id__div_button_canBo_parent_4');
		    						var l = 0;
		    						var _length = 0;
									if(data.flag)
									{
										if(!data.per)
		                                {
		                                    alert('Bạn không có quyền xoá!');
		                  		            return false;
		                                }
										if((!divFormCB.is(':hidden') || !divFormCB[0].hasAttribute('hidden')) && $('#button__id__capNhat').attr('data-button-maCB') === maCB)
											divFormCB.css('display', 'none');
										if((!dsPCGD.is(':hidden') || !dsPCGD[0].hasAttribute('hidden')) && $('#button__id__themHPGD').attr('data-button-maCB') === maCB)
											dsPCGD.css('display', 'none');
										table.dataTable().fnDeleteRow(table.DataTable().row($this.closest('tr')).index());
										reOrderRecords(table, 1);
										dsCBCheck = getLengthChkCheck(table, 0);
		    							l = btnParent4.length;
		    							if(l && dsCBCheck)
		    							{
		    								$('#p__id__chonBanGhiCBGV').text('Có ' + dsCBCheck + 'cán bộ được chọn.');
			                                $('#button__id__xoaNhieuCB').attr('data-original-title', 'Xoá ' + (dsCBCheck > 1 ? 'các ' : '') + ' cán bộ đã chọn');
		    							}
		    							else if(l)
		    								btnParent4.remove();
		    							_length = table.DataTable().rows().indexes().length;
		    							if(dsCBCheck != _length || !_length)
		    								$('[data-checkbox-cb="p"]').prop('checked', false);
										alert('Xoá thành công!');
									}
									else
										throw new TypeError('Xoá ' + typeText + ' thất bại!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
			    				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Xoá', 1, typeText);
			    			}
			        	});
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