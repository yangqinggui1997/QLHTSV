<script>
$(function(){
	try
	{
		var wrapCB = $('#table__id__canBo_wrapper');
		/*click button xoá trên danh sách*/
		if(wrapCB.length)
			wrapCB.on('click', '#button__id__xoaNhieuCB', function(){
	            try
	            {
	            	var maCB = new Array();
	            	var dsTenCBStr = '';
	            	var dsTenCB = new Array();
	            	var i = 1;
	            	var message = '';
	            	var dsCBCheck = getChkCheck($('#table__id__canBo'), 0);
	            	var subThis = null;
	            	$.each(dsCBCheck, function(){
	            		subThis = this;
	            		maCB.push(subThis.chk.attr('data-checkbox-maCB'));
	            		dsTenCB.push(subThis.chk.attr('data-checkbox-tenCB'));
	            		dsTenCBStr += (dsTenCBStr ? ((dsCBCheck.length === i) ? (' và ' + subThis.chk.attr('data-checkbox-tenCB')) : (', ' + subThis.chk.attr('data-checkbox-tenCB'))) : subThis.chk.attr('data-checkbox-tenCB'));
	            		++i;
	            	});
	            	if(!maCB.length)
	            		throw new TypeError('Chưa chọn cán bộ nào!<br>');
	            	message = ((maCB.length > 1) ? ('Bạn có thực sự muốn xoá tài khoản của các cán bộ ' + dsTenCBStr) : ('Bạn có thực sự muốn xoá tài khoản của cán bộ ' + dsTenCBStr));
		            confirm(message + '?', function(){
		            	var formData = new FormData();
            			formData.append('_token', $('#_token').attr('content'));
            			formData.append('maCB', maCB);
            			formData.append('dsTenCB', dsTenCB);
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
            						var divCB = $('#div__id__formCanBo');
            						var _length = 0;
            						var idx = 0;
            						var dsXoaTB = '';
            						if(data.flag)
            						{
            							if(!data.per)
            							{
            								alert('Bạn không có quyền xoá!');
            								return false;
            							}
	        							if(maCB.length === 1)
	        							{
			           						idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maCB', 'value': maCB[0]});
			           						if(idx >= 0)
			           						{
			           							if((!divFormCB.is(':hidden') || !divFormCB[0].hasAttribute('hidden')) && $('#button__id__capNhat').attr('data-button-maCB') === maCB[0])
													divFormCB.css('display', 'none');
												if((!dsPCGD.is(':hidden') || !dsPCGD[0].hasAttribute('hidden')) && $('#button__id__themHPGD').attr('data-button-maCB') === maCB[0])
													dsPCGD.css('display', 'none');
												table.dataTable().fnDeleteRow(idx);
			           						}
		            						else
		                                        throw new TypeError('Xoá cán bộ thất bại!<br>Do không thể định vị vị trí của cán bộ này trong danh sách hiển thị!<br>');
	        							}
	        							else
	    									for(i = 0; i < maCB.length; ++i)
	        								{
				           						idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maCB', 'value': maCB[i]});
				           						if(idx >= 0)
				           						{
				           							if((!divFormCB.is(':hidden') || !divFormCB[0].hasAttribute('hidden')) && $('#button__id__capNhat').attr('data-button-maCB') === maCB[i])
														divFormCB.css('display', 'none');
													if((!dsPCGD.is(':hidden') || !dsPCGD[0].hasAttribute('hidden')) && $('#button__id__themHPGD').attr('data-button-maCB') === maCB[i])
														dsPCGD.css('display', 'none');
													table.dataTable().fnDeleteRow(idx);
				           						}
			            						else
		                                        	dsXoaTB += (dsXoaTB ? ((i === maCB.length - 1) ? (dsXoaTB + ' và ' + dsTenCB[i]) : (dsXoaTB + ', ' + dsTenCB[i])) : dsTenCB[i]);
	        								}
        								if(dsXoaTB)
		                                    throw new TypeError('Xoá cán bộ ' + dsXoaTB + ' thất bại!<br>Do không thể định vị vị trí của họ trên danh sách hiển thị!<br>');
	    								reOrderRecords(table, 1);
            							alert('Xoá thành công!');
            						}
            						else if(data.dsXoaTB)
            						{
            							if(!data.per)
            							{
            								alert('Bạn không có quyền xoá!');
            								return false;
            							}
            							for(i = 0; i < data.dsXoaTC.length; ++i)
        								{
			           						idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maCB', 'value': data.dsXoaTC[i]});
			           						if(idx >= 0)
			           						{
			           							if((!divFormCB.is(':hidden') || !divFormCB[0].hasAttribute('hidden')) && $('#button__id__capNhat').attr('data-button-maCB') === data.dsXoaTC[i])
													divFormCB.css('display', 'none');
												if((!dsPCGD.is(':hidden') || !dsPCGD[0].hasAttribute('hidden')) && $('#button__id__themHPGD').attr('data-button-maCB') === data.dsXoaTC[i])
													dsPCGD.css('display', 'none');
												table.dataTable().fnDeleteRow(idx);
			           						}
		            						else
	                                        	dsXoaTB += (dsXoaTB ? ((i === data.dsXoaTC.length - 1) ? (dsXoaTB + ' và ' + data.dsTenXoaTC[i]) : (dsXoaTB + ', ' + data.dsTenXoaTC[i])) : data.dsTenXoaTC[i]);
        								}
        								reOrderRecords(table, 1);
        								dsCBCheck = getLengthChkCheck(table, 0);
		                                $('#p__id__chonBanGhiCBGV').text('Có ' + dsCBCheck + ' cán bộ được chọn.');
		                                $('#button__id__xoaNhieuCB').attr('data-original-title', 'Xoá ' + (dsCBCheck > 1 ? 'các ' : '') + 'cán bộ đã chọn');
            							throw new TypeError('Xoá thất bại!<br>Một số đối tượng như ' + data.dsXoaTB + (dsXoaTB ? (' cùng với ' + dsXoaTB) : '') + ' không thể xoá, do các đối tượng này không tồn tại trong hệ thống hoặc không định vị được vị trí trong danh sách hiển thị!<br>');
            						}
        							else
            							throw new TypeError('Xoá thất bại!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
            						dsCBCheck = getLengthChkCheck(table, 0);
            						if(!dsCBCheck)
		                                $('#div__id__div_button_canBo_parent_4').remove();
		                            _length = table.DataTable().rows().indexes().length;
		                            if(dsCBCheck != _length || !_length)
                                        $('[data-checkbox-cb="p"]').prop('checked', false);
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
	            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Xoá', ((maCB.length > 1) ? maCB.length : 1), 'cán bộ');
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