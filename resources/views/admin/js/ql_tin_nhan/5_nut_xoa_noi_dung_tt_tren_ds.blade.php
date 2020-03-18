<script>
$(function(){
	try
	{
		var wrapTN = $('#table__id__tinNhan_wrapper');
		/*click button xoá trên danh sách*/
		if(wrapTN.length)
			wrapTN.on('click', '#button__id__xoaNhieuNLH', function(){
	            try
	            {
	            	var subThis = null;
	            	var maNN = new Array();
	            	var maNG = null;
	            	var dsTenNNStr = '';
	            	var dsTenNN = new Array();
	            	var i = 1;
	            	var message = '';
            		var table = $('#table__id__tinNhan');
	            	var dsNNCheck = getChkCheck(table, 0);
	            	var tenNG = $('[data-checkbox-tn="p"]').attr('data-checkbox-tenNG');
	            	$.each(dsNNCheck, function(){
	            		subThis = this;
	            		maNG = subThis.chk.attr('data-checkbox-maNG');
	            		maNN.push(subThis.chk.attr('data-checkbox-maNN'));
	            		dsTenNN.push(subThis.chk.attr('data-checkbox-tenNN'));
	            		dsTenNNStr += (dsTenNNStr ? ((dsNNCheck.length === i) ? (' và ' + subThis.chk.attr('data-checkbox-tenNN')) : (', ' + subThis.chk.attr('data-checkbox-tenNN'))) : subThis.chk.attr('data-checkbox-tenNN'));
	            		++i;
	            	});
	            	if(!maNN.length)
	            		throw new TypeError('Chưa chọn người liên hệ nào!<br>');
	            	message = ((maNN.length > 1) ? ('Bạn có thực sự muốn xoá các người dùng ' + dsTenNNStr + ' khỏi danh bạ của người dùng ' + tenNG) : ('Bạn có thực sự muốn xoá người dùng ' + dsTenNNStr + ' khỏi danh bạ của người dùng ' + tenNG));
		            confirm(message + '?', function(){
		            	var formData = new FormData();
            			formData.append('_token', $('#_token').attr('content'));
            			formData.append('maNG', maNG);
            			formData.append('maNN', maNN);
            			formData.append('dsTenNN', dsTenNN);
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
            						var frmTN = $('#div__id__formTinNhan');
		                            var idx = 0;
		                            var _length = 0;
	                                var dsXoaTB = '';
            						if(data.flag)
            						{
            							if(!data.per)
		                                {
		                                    alert('Bạn không có quyền xoá!');
		                                    return false;
		                                }
	        							if(maNN.length === 1)
	        							{
			           						idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maNN', 'value': maNN[0]});
		                                    if(idx >= 0)
		                                    {
		                                    	if((!frmTN.is(':hidden') || !frmTN[0].hasAttribute('hidden')) && frmTN.attr('data-div-maNN') === maNN[0])
				           						{
				           							frmTN.css('display', 'none');
				           							$('#div__id__noiDungTT').html('');
				           						}
		            							table.dataTable().fnDeleteRow(idx);
		                                    }
	                                        else
	                                            throw new TypeError('Xoá người liên hệ thất bại!<br>Do không thể định vị vị trí của họ trong danh sách hiển thị!<br>');
	        							}
	        							else
	    									for(i = 0; i < maNN.length; ++i)
	    									{
	        									idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maNN', 'value': maNN[i]});
			                                    if(idx >= 0)
			                                    {
			                                    	if((!frmTN.is(':hidden') || !frmTN[0].hasAttribute('hidden')) && frmTN.attr('data-div-maNN') === maNN[i])
		        									{
			            								frmTN.css('display', 'none');
			            								$('#div__id__noiDungTT').html('');
		        									}
			            							table.dataTable().fnDeleteRow(idx);
			                                    }
	                                            else
	                                                dsXoaTB += (dsXoaTB ? ((i === maNN.length - 1) ? (dsXoaTB + ' và ' + dsTenNN[i]) : (dsXoaTB + ', ' + dsTenNN[i])) : dsTenNN[i]);
	    									}
    									if(dsXoaTB)
	                                        throw new TypeError('Xoá người liên hệ ' + dsXoaTB + ' thất bại!<br>Do không thể định vị vị trí của họ trên danh sách hiển thị!<br>');
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
        									idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maNN', 'value': data.dsXoaTC[i]});
		                                    if(idx >= 0)
		                                    {
		                                    	if((!frmTN.is(':hidden') || !frmTN[0].hasAttribute('hidden')) && frmTN.attr('data-div-maNN') === data.dsXoaTC[i])
	        									{
		            								frmTN.css('display', 'none');
		            								$('#div__id__noiDungTT').html('');
	        									}
		            							table.dataTable().fnDeleteRow(idx);
		                                    }
	                                        else
	                                            dsXoaTB += (dsXoaTB ? ((i === data.dsXoaTC.length - 1) ? (dsXoaTB + ' và ' + data.dsTenXoaTC[i]) : (dsXoaTB + ', ' +  data.dsTenXoaTC[i])) :  data.dsTenXoaTC[i]);
        								}
        								reOrderRecords(table, 1);
        								dsNNCheck = getLengthChkCheck(table, 0);
		                                $('#p__id__chonBanGhi').text('Có ' + dsNNCheck + ' người liên hệ được chọn.');
		                                $('#button__id__xoaNhieuNLH').attr('data-original-title', 'Xoá ' + (dsNNCheck > 1 ? 'các ' : '') + 'người liên hệ đã chọn');
            							throw new TypeError('Xoá thất bại!<br>Một số nội dung trò chuyện với người dùng ' + data.dsXoaTB + (dsXoaTB ? (' cùng với ' + dsXoaTB) : '') + ' không thể xoá, do không tồn tại nội dung trò chuyện nào giữa họ hoặc không định vị được vị trí trong danh sách hiển thị!<br>');
            						}
        							else
            							throw new TypeError('Xoá thất bại!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
            						dsNNCheck = getLengthChkCheck(table, 0);
            						if(!dsNNCheck)
		                                $('#div__id__div_button_tinNhan_parent_4').remove();
		                            _length = table.DataTable().rows().indexes().length;
		                            if(dsNNCheck != _length || !_length)
		                                $('[data-checkbox-tn="p"]').prop('checked', false);
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
	            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Xoá', ((maNN.length > 1) ? maNN.length : 1), 'nội dung trò chuyện với người dùng');
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