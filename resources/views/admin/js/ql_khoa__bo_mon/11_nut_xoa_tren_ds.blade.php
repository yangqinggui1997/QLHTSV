<script>
$(function(){
	try
	{
        var wrapKhoa = $('#table__id__khoa_wrapper');
        var wrapBM = $('#table__id__boMon_wrapper');
        function hideElementKhoa(maK_BM)
        {
            if((!divKhoa.is(':hidden') || !divKhoa[0].hasAttribute('hidden')) && $('#button__id__capNhat').attr('data-button-maKhoa') === maK_BM)
                divKhoa.css('display', 'none');
            if((!divDSBM.is(':hidden') || !divDSBM[0].hasAttribute('hidden')) && $('#button__id__themBM').attr('data-button-maKhoa') === maK_BM)
            {
                divDSBM.css('display', 'none');
                divBM.css('display', 'none');
            }
            if((!divDSCB.is(':hidden') || !divDSCB[0].hasAttribute('hidden')) && divDSCB.hasAttribute('data-div-dsk') && divDSCB.attr('data-div-dsk') === maK_BM)
                divDSCB.css('display', 'none');
        }
        function hideElementBM(maK_BM)
        {
            if((!divBM.is(':hidden') || !divBM[0].hasAttribute('hidden')) && $('#button__id__capNhatBM').attr('data-button-maBM') === maK_BM)
                divBM.css('display', 'none');
            if((!divDSCB.is(':hidden') || !divDSCB[0].hasAttribute('hidden')) && divDSCB.hasAttribute('data-div-dsbm') && divDSCB.attr('data-div-dsbm') === maK_BM)
                divDSCB.css('display', 'none');
        }
		function xoa($this,type)
		{
			var maK_BM = new Array();
        	var dsTenK_BMStr = '';
        	var dsTenK_BM = new Array();
        	var message = '';
            var typeChkObjName = (type === 'k' ? 'khoa' : 'bộ môn');
            var typeObjId = (type === 'k' ? 'khoa' : 'boMon');
            var table = $('#table__id__' + typeObjId);
            var typeChk = (type === 'k' ? 'k' : 'bm');
            var typeChkTen = (type === 'k' ? 'tenKhoa' : 'tenBM');
        	var dsK_BMCheck = getChkCheck(table, 0);
            var subThis = null;
        	$.each(dsK_BMCheck, function(i, v){
                subThis = v;
        		maK_BM.push(subThis.chk.attr('data-checkbox-' + (type === 'k' ? 'maKhoa' : 'maBM')));
                dsTenK_BM.push(subThis.chk.attr('data-checkbox-' + typeChkTen));
                dsTenK_BMStr += (dsTenK_BMStr ? ((dsK_BMCheck.length - 1 === i) ? (' và ' + subThis.chk.attr('data-checkbox-' + typeChkTen)) : (', ' + subThis.chk.attr('data-checkbox-' + typeChkTen))) : subThis.chk.attr('data-checkbox-' + typeChkTen));
        	});
        	if(!maK_BM.length)
        		throw new TypeError('Chưa chọn ' + typeChkObjName + ' nào!<br>');
        	message = ((maK_BM.length > 1) ? ('Bạn có thực sự muốn xoá các ' + typeChkObjName + ' ' + dsTenK_BMStr) : ('Bạn có thực sự muốn xoá ' + typeChkObjName + ' ' + dsTenK_BMStr));
            confirm(message + '?', function(){
            	var formData = new FormData();
    			formData.append('_token', $('#_token').attr('content'));
    			formData.append('maK_BM', maK_BM);
    			formData.append('dsTenK_BM', dsTenK_BM);
                formData.append('type', typeChk);
    			$.ajax({
    				type: 'POST',
    				dataType: 'JSON',
    				url: 'admin/quan_ly_khoa_vs_bo_mon/xoa',
    				xhr: xhrSetting,
    				cache: false,
    				contentType: false,
    				processData: false,
    				data: formData,
    				success: function(data)
    				{
    					try
    					{
                            var divKhoa = $('#div__id__formKhoa');
                            var divBM = $('#div__id__formBoMon');
                            var divDSCB = $('#div__id__danhSachCanBo');
                            var i = 0;
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
    							if(maK_BM.length === 1)
    							{
                                    idx = getIndexToDel(table, 0, {'property': 'data-checkbox-' + (type === 'k' ? 'maKhoa' : 'maBM'), 'value': maK_BM[0]});
                                    if(idx >= 0)
                                    {
                                        if(type === 'k')
                                            hideElementKhoa(maK_BM[0]);
                                        else
                                            hideElementBM(maK_BM[0]);
            							table.dataTable().fnDeleteRow(idx);
                                    }
                                    else
                                        throw new TypeError('Xoá ' + typeChkObjName + ' thất bại!<br>Do không thể định vị vị trí của ' + typeChkObjName + ' này trên bảng!<br>');
    							}
    							else
									for(; i < maK_BM.length; ++i)
    								{
            							idx = getIndexToDel(table, 0, {'property': 'data-checkbox-' + (type === 'k' ? 'maKhoa' : 'maBM'), 'value': maK_BM[i]});
                                        if(idx >= 0)
                                        {
                                            if(type === 'k')
                                                hideElementKhoa(maK_BM[i]);
                                            else
                                                hideElementBM(maK_BM[i]);
                                            table.dataTable().fnDeleteRow(idx);
                                        }
                                        else
                                            dsXoaTB += (dsXoaTB ? ((i === maK_BM.length - 1) ? (dsXoaTB + ' và ' + dsTenK_BM[i]) : (dsXoaTB + ', ' + dsTenK_BM[i])) : dsTenK_BM[i]);
    								}
                                if(dsXoaTB)
                                    throw new TypeError('Xoá ' + typeChkObjName + ' ' + dsXoaTB + ' thất bại!<br>Do không thể định vị vị trí của chúng trên bảng!<br>');
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
    							for(; i < data.dsXoaTC.length; ++i)
								{
        							idx = getIndexToDel(table, 0, {'property': 'data-checkbox-' + (type === 'k' ? 'maKhoa' : 'maBM'), 'value': data.dsXoaTC[i]});
                                    if(idx >= 0)
                                    {
                                        if(type === 'k')
                                            hideElementKhoa(data.dsXoaTC[i]);
                                        else
                                            hideElementBM(data.dsXoaTC[i]);
                                        table.dataTable().fnDeleteRow(idx);
                                    }
                                    else
                                        dsXoaTB += (dsXoaTB ? ((i === data.dsXoaTC.length - 1) ? (dsXoaTB + ' và ' + data.dsTenXoaTC[i]) : (dsXoaTB + ', ' + data.dsTenXoaTC[i])) : data.dsTenXoaTC[i]);
								}
                                dsK_BMCheck = getLengthChkCheck(table, 0);
                                $('#p__id__chonBanGhi' + (type === 'k' ? '' : 'BM')).text('Có ' + dsK_BMCheck + ' ' + typeChkObjName + ' được chọn.');
                                $('#button__id__xoaNhieu' + (type === 'k' ? 'Khoa' : 'BM')).attr('data-original-title', 'Xoá ' + (dsK_BMCheck > 1 ? 'các ' : '') + typeChkObjName + 'đã chọn');
								reOrderRecords(table, 1);
                                $('#div__id__div_button_parent_' + typeObjId + '_4').remove();
    							throw new TypeError('Xoá thất bại!<br>Một số đối tượng như ' + data.dsXoaTB + (dsXoaTB ? (' cùng với ' + dsXoaTB) : '') + ' không thể xoá, do ' + (dsK_BMCheck > 1 ? 'các ' : '') + 'đối tượng này không tồn tại trong hệ thống hoặc không định vị được vị trí trong danh sách hiển thị!<br>');
    						}
							else
    							throw new TypeError('Xoá thất bại!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
                            dsK_BMCheck = getLengthChkCheck(table, 0);
                            if(!dsK_BMCheck)
                                $('#div__id__div_button_parent_' + typeObjId + '_4').remove();
                            _length = table.DataTable().rows().indexes().length;
                            if(dsK_BMCheck != _length || !_length)
                                $('[data-checkbox-' + typeChk + '="p"]').prop('checked', false);
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
        				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Xoá', ((maK_BM.length > 1) ? maK_BM.length : 1), typeChkObjName);
        			}
    			});
            });
		}
		/*click button xoá khoa*/
		if(wrapKhoa.length)
			wrapKhoa.on('click', '#button__id__xoaNhieuKhoa', function(){
				try
	            {
	            	xoa($(this), 'k');
		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
		/*click button xoá bộ môn*/
		if(wrapBM.length)
			wrapBM.on('click', '#button__id__xoaNhieuBM', function(){
				try
	            {
					xoa($(this), 'bm');
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