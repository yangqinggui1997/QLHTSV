<script>
$(function(){
	try
	{
		var wrapTB = $('#table__id__thongBao_wrapper');
		/*click button xoá trên danh sách*/
		if(wrapTB.length)
			wrapTB.on('click', '#button__id__xoaNhieuTB', function(){
	            try
	            {
	            	var maTB = new Array();
	            	var dsTieuDeTBStr = '';
	            	var dsTieuDeTB = new Array();
	            	var i = 1;
	            	var message = '';
	            	var subThis = null;
	            	var table = $('#table__id__thongBao');
	            	var dsTBCheck = getChkCheck(table, 0);
	            	$.each(dsTBCheck, function(){
	            		subThis = this;
	            		maTB.push(subThis.chk.attr('data-checkbox-maTB'));
	            		dsTieuDeTB.push(subThis.chk.attr('data-checkbox-tieuDeTB'));
	            		dsTieuDeTBStr += (dsTieuDeTBStr ? ((dsTBCheck.length === i) ? (' và ' + subThis.chk.attr('data-checkbox-tieuDeTB')) : (', ' + subThis.chk.attr('data-checkbox-tieuDeTB'))) : subThis.chk.attr('data-checkbox-tieuDeTB'));
	            		++i;
	            	});
	            	if(!maTB.length)
	            		throw new TypeError('Chưa chọn thông báo nào!<br>');
	            	message = ((maTB.length > 1) ? ('Bạn có thực sự muốn xoá các thông báo ' + dsTieuDeTBStr) : ('Bạn có thực sự muốn xoá thông báo ' + dsTieuDeTBStr));
		            confirm(message + '?', function(){
		            	var formData = new FormData();
            			formData.append('_token', $('#_token').attr('content'));
            			formData.append('maTB', maTB);
            			formData.append('dsTieuDeTB', dsTieuDeTB);
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
            						var divBMXML = $('#div__id__bieuMauDangXML');
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
	        							if(maTB.length === 1)
	        							{
			           						idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maTB', 'value': maTB[0]});
		                                    if(idx >= 0)
		                                    {
		                                    	if((!divBMXML.is(':hidden') || !divBMXML[0].hasAttribute('hidden')) && divBMXML.attr('data-div-maTB') === maTB[0])
				           						{
				           							divBMXML.css('display', 'none');
				           							$('#form__id__noiDungBieuMauXML').html('');
				           						}
		            							table.dataTable().fnDeleteRow(idx);
		                                    }
	                                        else
	                                            throw new TypeError('Xoá thông báo thất bại!<br>Do không thể định vị vị trí của thông báo trong danh sách hiển thị!<br>');
	        							}
	        							else
	    									for(i = 0; i < maTB.length; ++i)
	    									{
				           						idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maTB', 'value': maTB[i]});
			                                    if(idx >= 0)
			                                    {
			                                    	if((!divBMXML.is(':hidden') || !divBMXML[0].hasAttribute('hidden')) && divBMXML.attr('data-div-maTB') === maTB[i])
		        									{
			            								divBMXML.css('display', 'none');
			            								$('#form__id__noiDungBieuMauXML').html('');
		        									}
			            							table.dataTable().fnDeleteRow(idx);
			                                    }
	                                            else
	                                                dsXoaTB += (dsXoaTB ? ((i === maTB.length - 1) ? (dsXoaTB + ' và ' + dsTieuDeTB[i]) : (dsXoaTB + ', ' + dsTieuDeTB[i])) : dsTieuDeTB[i]);
	    									}
    									if(dsXoaTB)
	                                        throw new TypeError('Xoá thông báo ' + dsXoaTB + ' thất bại!<br>Do không thể định vị vị trí của thông báo trên danh sách hiển thị!<br>');
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
        									idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maTB', 'value': data.dsXoaTC[i]});
		                                    if(idx >= 0)
		                                    {
		                                    	if((!divBMXML.is(':hidden') || !divBMXML[0].hasAttribute('hidden')) && divBMXML.attr('data-div-maTB') === data.dsXoaTC[i])
	        									{
		            								divBMXML.css('display', 'none');
		            								$('#form__id__noiDungBieuMauXML').html('');
	        									}
		            							table.dataTable().fnDeleteRow(idx);
		                                    }
	                                        else
	                                            dsXoaTB += (dsXoaTB ? ((i === data.dsXoaTC.length - 1) ? (dsXoaTB + ' và ' + data.dsTenXoaTC[i]) : (dsXoaTB + ', ' +  data.dsTenXoaTC[i])) :  data.dsTenXoaTC[i]);
        								}
        								reOrderRecords(table, 1);
        								dsTBCheck = getLengthChkCheck(table, 0);
		                                $('#p__id__chonBanGhi').text('Có ' + dsTBCheck + ' thông báo được chọn.');
		                                $('#button__id__xoaNhieuTB').attr('data-original-title', 'Xoá ' + (dsTBCheck > 1 ? 'các ' : '') + 'thông báo đã chọn');
            							throw new TypeError('Xoá thất bại!<br>Một số thông báo như ' + data.dsXoaTB + (dsXoaTB ? (' cùng với ' + dsXoaTB) : '') + ' không thể xoá, do chúng không tồn tại!<br>');
            						}
        							else
            							throw new TypeError('Xoá thất bại!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
            						dsTBCheck = getLengthChkCheck(table, 0);
            						if(!dsTBCheck)
		                                $('#div__id__div_button_thongBao_parent_4').remove();
		                            _length = table.DataTable().rows().indexes().length;
		                            if(dsTBCheck != _length || !_length)
		                                $('[data-checkbox-tb="p"]').prop('checked', false);
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
	            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Xoá', ((maTB.length > 1) ? maTB.length : 1), 'thông báo');
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