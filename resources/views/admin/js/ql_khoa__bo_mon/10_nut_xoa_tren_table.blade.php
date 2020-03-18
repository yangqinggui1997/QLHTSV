<script>
$(function(){
	try
	{
		var tbyKhoa = $('#tbody__id__khoa');
		var tbyBM = $('#tbody__id__boMon');
		function xoa($this,type)
		{
        	var tenK_BM = $this.attr('data-button-' + (type === 'k' ? 'tenKhoa' : 'tenBM'));
        	var typeText = (type === 'k' ? 'khoa' : 'bộ môn');
        	var typeCode = (type === 'k' ? 'k' : 'bm');
        	confirm('Bạn có chắc chắn muốn xoá ' + typeText + ' ' + tenK_BM + '?', function(){
        		var maK_BM = $this.attr('data-button-' + (type === 'k' ? 'maKhoa' : 'maBM'));
        		var formData = new FormData();
        		formData.append('_token', $('#_token').attr('content'));
	        	formData.append('maK_BM', maK_BM);
	        	formData.append('type', (type === 'k' ? type : 'bm'));
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
	        				var table = $((type === 'k' ? '#table__id__khoa' : '#table__id__boMon'));
	        				var divKhoa = $('#div__id__formKhoa');
	        				var divBM = $('#div__id__formBoMon');
	        				var divDSCB = $('#div__id__danhSachCanBo');
	        				var divDSBM = $('#div__id__danhSachBoMon');
	        				var dsK_BMCheck = null;
    						var btnParent4 = $('#div__id__div_button_parent_' + (type === 'k' ? 'khoa' : 'boMon' + '_4'));
    						var l = 0;
    						var _length = 0;
							if(data.flag)
							{
								if(!data.per)
                                {
                                    alert('Bạn không có quyền xoá!');
                                    return false;
                                }
								if(type === 'k')
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
								else
								{
									if((!divBM.is(':hidden') || !divBM[0].hasAttribute('hidden')) && $('#button__id__capNhatBM').attr('data-button-maBM') === maK_BM)
	    								divBM.css('display', 'none');
	    							if((!divDSCB.is(':hidden') || !divDSCB[0].hasAttribute('hidden')) && divDSCB.hasAttribute('data-div-dsbm') && divDSCB.attr('data-div-dsbm') === maK_BM)
	    								divDSCB.css('display', 'none');
								}
								table.dataTable().fnDeleteRow(table.DataTable().row($this.closest('tr')).index());
								reOrderRecords(table, 1);
								dsK_BMCheck = getLengthChkCheck(table, 0);
    							l = btnParent4.length;
    							if(l && dsK_BMCheck)
    							{
    								$('#p__id__chonBanGhi' + (type === 'k' ? '' : 'BM')).text('Có ' + dsK_BMCheck + ' ' + typeText + ' được chọn.');
	                                $('#button__id__xoaNhieu' + (type === 'k' ? 'Khoa' : 'BM')).attr('data-original-title', 'Xoá ' + (dsK_BMCheck > 1 ? 'các ' : '') + typeText + ' đã chọn');
    							}
    							else if(l)
    								btnParent4.remove();
    							_length = table.DataTable().rows().indexes().length;
    							if(dsK_BMCheck != _length || !_length)
    								$('[data-checkbox-' + typeCode + '="p"]').prop('checked', false);
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
		}
		/*click button xoá khoa*/
		if(tbyKhoa.length)
			tbyKhoa.on('click', '[data-button-id="xoa"]', function(){
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
		if(tbyBM.length)
			tbyBM.on('click', '[data-button-id="xoa"]', function(){
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