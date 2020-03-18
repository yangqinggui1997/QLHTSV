<script>
$(function(){
	try
	{
		var wrapND = $('#table__id__nguoiDung_wrapper');
		/*click button xoá trên danh sách*/
		if(wrapND.length)
			wrapND.on('click', '#button__id__xoaNhieuNguoiDung', function(){
	            try
	            {
	            	var maND = new Array();
	            	var dsTenNDStr = '';
	            	var dsTenND = new Array();
	            	var i = 1;
	            	var message = '';
	            	var dsNDCheck = getChkCheck($('#table__id__nguoiDung'), 0);
	            	var subThis = null;
	            	$.each(dsNDCheck, function(){
	            		subThis = this;
	            		maND.push(subThis.chk.attr('data-checkbox-maND'));
	            		dsTenND.push(subThis.chk.attr('data-checkbox-tenND'));
	            		dsTenNDStr += (dsTenNDStr ? ((dsNDCheck.length === i) ? (' và ' + subThis.chk.attr('data-checkbox-tenND')) : (', ' + subThis.chk.attr('data-checkbox-tenND'))) : subThis.chk.attr('data-checkbox-tenND'));
	            		++i;
	            	});
	            	if(!maND.length)
	            		throw new TypeError('Chưa chọn người dùng nào!<br>');
	            	message = ((maND.length > 1) ? ('Bạn có thực sự muốn xoá tài khoản của các người dùng ' + dsTenNDStr) : ('Bạn có thực sự muốn xoá tài khoản của người dùng ' + dsTenNDStr));
		            confirm(message + '?', function(){
		            	var formData = new FormData();
            			formData.append('_token', $('#_token').attr('content'));
            			formData.append('maND', maND);
            			formData.append('dsTenND', dsTenND);
            			$.ajax({
            				type: 'POST',
            				dataType: 'JSON',
            				url: 'admin/quan_ly_nguoi_dung/xoa',
            				xhr: xhrSetting,
            				cache: false,
            				contentType: false,
            				processData: false,
            				data: formData,
            				success: function(data)
            				{
            					try
            					{
            						var table = $('#table__id__nguoiDung');
            						var divND = $('#div__id__formNguoiDung');
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
	        							if(maND.length === 1)
	        							{
			           						idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maND', 'value': maND[0]});
			           						if(idx >= 0)
			           						{
			           							if((!divND.is(':hidden') || !divND[0].hasAttribute('hidden')) && $('#hidden__id__maCanBo').val() === maND[0])
		            								divND.css('display', 'none');
				           						$('#datalist__id__maCanBo').append('<option data-option-loaiND="' + ((maND[0].toUpperCase().indexOf('CB') >= 0) ? 'cb' : 'sv') + '" value="' + maND[0] + '">' + dsTenND[0] + '</option>');
		            							table.dataTable().fnDeleteRow(idx);
			           						}
		            						else
		                                        throw new TypeError('Xoá người dùng thất bại!<br>Do không thể định vị vị trí của người dùng này trong danh sách hiển thị!<br>');
	        							}
	        							else
	    									for(i = 0; i < maND.length; ++i)
	        								{
				           						idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maND', 'value': maND[i]});
				           						if(idx >= 0)
				           						{
				           							if((!divND.is(':hidden') || !divND[0].hasAttribute('hidden')) && $('#hidden__id__maCanBo').val() === maND[i])
			            								divND.css('display', 'none');
					           						$('#datalist__id__maCanBo').append('<option data-option-loaiND="' + ((maND[i].toUpperCase().indexOf('CB') >= 0) ? 'cb' : 'sv') + '" value="' + maND[i] + '">' + dsTenND[i] + '</option>');
			            							table.dataTable().fnDeleteRow(idx);
				           						}
			            						else
		                                        	dsXoaTB += (dsXoaTB ? ((i === maND.length - 1) ? (dsXoaTB + ' và ' + dsTenND[i]) : (dsXoaTB + ', ' + dsTenND[i])) : dsTenND[i]);
	        								}
        								if(dsXoaTB)
		                                    throw new TypeError('Xoá người dùng ' + dsXoaTB + ' thất bại!<br>Do không thể định vị vị trí của họ trên danh sách hiển thị!<br>');
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
			           						idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maND', 'value': data.dsXoaTC[i]});
			           						if(idx >= 0)
			           						{
			           							if((!divND.is(':hidden') || !divND[0].hasAttribute('hidden')) && $('#hidden__id__maCanBo').val() === data.dsXoaTC[i])
		            								divND.css('display', 'none');
				           						$('#datalist__id__maCanBo').append('<option data-option-loaiND="' + ((data.dsXoaTC[i].toUpperCase().indexOf('CB') >= 0) ? 'cb' : 'sv') + '" value="' + data.dsXoaTC[i] + '">' + data.dsTenXoaTC[i] + '</option>');
		            							table.dataTable().fnDeleteRow(idx);
			           						}
		            						else
	                                        	dsXoaTB += (dsXoaTB ? ((i === data.dsXoaTC.length - 1) ? (dsXoaTB + ' và ' + data.dsTenXoaTC[i]) : (dsXoaTB + ', ' + data.dsTenXoaTC[i])) : data.dsTenXoaTC[i]);
        								}
        								reOrderRecords(table, 1);
        								dsNDCheck = getLengthChkCheck(table, 0);
		                                $('#p__id__chonBanGhi').text('Có ' + dsNDCheck + ' người dùng được chọn.');
		                                $('#button__id__xoaNhieuNguoiDung').attr('data-original-title', 'Xoá ' + (dsNDCheck > 1 ? 'các ' : '') + 'người dùng đã chọn');
            							throw new TypeError('Xoá thất bại!<br>Một số đối tượng như ' + data.dsXoaTB + (dsXoaTB ? (' cùng với ' + dsXoaTB) : '') + ' không thể xoá, do các đối tượng này không tồn tại trong hệ thống hoặc không định vị được vị trí trong danh sách hiển thị!<br>');
            						}
        							else
            							throw new TypeError('Xoá thất bại!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
            						dsNDCheck = getLengthChkCheck(table, 0);
            						if(!dsNDCheck)
		                                $('#div__id__div_button_parent_4').remove();
		                            _length = table.DataTable().rows().indexes().length;
		                            if(dsNDCheck != _length || !_length)
                                        $('[data-checkbox-user="p"]').prop('checked', false);
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
	            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Xoá', ((maND.length > 1) ? maND.length : 1), 'người dùng');
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