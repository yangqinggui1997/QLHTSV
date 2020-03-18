<script>
$(function(){
	try
	{
		var btnCNKhoa = $('#button__id__capNhat');
		var btnCNBM = $('#button__id__capNhatBM');
		function capNhat($this,type)
		{
			var typeMK = (type === 'k' ? 'maKhoa' : 'maBM');
			var typeTK = (type === 'k' ? 'khoa' : 'bộ môn');
			var typeTenK = (type === 'k' ? 'tenKhoa' : 'tenBM');
			var maK_BM = $this.attr('data-button-' + typeMK);
			var typeCommad = $this.attr('data-button-command');
			var typeObj = (type === 'k' ? type : 'bm');
        	var tenK_BM = $('#textBox__id__ten' + (type === 'k' ? 'Khoa' : 'BoMon')).val();
        	var formData = new FormData();
        	var _url = (typeCommad === 'them' ? 'admin/quan_ly_khoa_vs_bo_mon/them' : 'admin/quan_ly_khoa_vs_bo_mon/cap_nhat');
        	formData.append('_token', $('#_token').attr('content'));
        	if(!tenK_BM)
        		throw new TypeError('Tên ' + typeTK + ' không được trống!');
	        switch(type)
	        {
	        	case 'bm':
	        		switch(typeCommad)
	        		{
	        			case 'them':
	        				formData.append('maKhoa', $('#button__id__themBM').attr('data-button-maKhoa'));
        					break;
    					case 'capnhat':
    						if($this.attr('data-button-tenBM') === tenK_BM)
    						{
    							alert('Thông tin không thay đổi!');
    							return true;
    						}
    						formData.append('maK_BM', maK_BM);
    						break;
						default:
							throw new TypeError('Dịch vụ yêu cầu không tồn tại!'); 
	        		}
	        		break;
        		case 'k':
        			switch(typeCommad)
	        		{
	        			case 'them': break;
    					case 'capnhat':
    						if($this.attr('data-button-tenKhoa') === tenK_BM)
    						{
    							alert('Thông tin không thay đổi!');
    							return true;
    						}
    						formData.append('maK_BM', maK_BM);
    						break;
						default:
							throw new TypeError('Dịch vụ yêu cầu không tồn tại!');
	        		}
	        		break;
        		default:
					throw new TypeError('Thao tác trên đối tượng không tồn tại!'); 
	        }
        	formData.append('tenK_BM', tenK_BM);
        	formData.append('type', typeObj);
        	$.ajax({
        		type: 'POST',
        		dataType: 'JSON',
        		url: _url,
        		xhr: xhrSetting,
        		cache: false,
        		contentType: false,
        		processData: false,
        		data: formData,
        		success: function(data)
        		{
        			try
        			{
        				var tbl = $((type === 'k' ? '#table__id__khoa' : '#table__id__boMon'));
        				var chkMaK_BM = null;
        				var _length = 0;
        				var _maK_BM = null;
        				var btnNews = null;
        				var dtb = null;
        				var idx = 0;
						if(data.flag)
						{
							if(!data.per)
                            {
                                alert('Bạn không có quyền ' + (typeCommad === 'them' ? 'thêm' : 'chỉnh sửa') + '!');
                                return false;
                            }
							if(typeCommad === 'them')
							{
								_length = tbl.DataTable().rows().indexes().length;
								_maK_BM = data.maK_BM;
								tbl.dataTable().fnAddData(['<input type="checkbox" data-checkbox-' + typeMK + '="' + _maK_BM + '" data-checkbox-' + (type === 'k' ? 'tenKhoa' : 'tenBM') + '="' + tenK_BM +'" data-checkbox-' + (type === 'k' ? 'k' : 'bm') + '="c">', (_length + 1), tenK_BM, 'Chưa chỉ định', 0, 'Chưa có chương trình đào tạo nào', (type === 'k' ? '<div class="btn-group">\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Sửa" data-button-new data-button-id="sua" data-button-maKhoa="' + _maK_BM + '" data-button-tenKhoa="' + tenK_BM +'"><i class="glyphicon glyphicon-edit"></i></button>\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-new data-button-id="xoa" data-button-maKhoa="' + _maK_BM + '" data-button-tenKhoa="' + tenK_BM +'"><i class="glyphicon glyphicon-trash"></i></button>\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem danh sách bộ môn" data-button-new data-button-id="xemDanhSachBM" data-button-maKhoa="' + _maK_BM + '" data-button-tenKhoa="' + tenK_BM +'"><i class="fa fa-list"></i></button>\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem danh sách cán bộ" data-button-new data-button-id="xemDanhSachCBK" data-button-maKhoa="' + _maK_BM + '" data-button-tenKhoa="' + tenK_BM +'"><i class="fa fa-male"></i></button>\
		                          	</div>' : '<div class="btn-group">\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Sửa" data-button-new data-button-id="sua" data-button-maBM="' + _maK_BM + '" data-button-tenBM="' + tenK_BM + '"><i class="glyphicon glyphicon-edit"></i></button>\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-new data-button-id="xoa" data-button-maBM="' + _maK_BM + '" data-button-tenBM="' + tenK_BM + '"><i class="glyphicon glyphicon-trash"></i></button>\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem danh cán bộ" data-button-new data-button-id="xemDanhSachCB" data-button-maBM="' + _maK_BM + '" data-button-tenBM="' + tenK_BM + '"><i class="fa fa-male"></i></button>\
		                          	</div>')]);
								tbl.dataTable().fnSort([1, 'desc']);
								btnNews = $('[data-button-new]');
					            btnNews.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
					            btnNews.removeAttr('data-button-new');
	        					chkMaK_BM = $('[data-checkbox-' + typeMK + '="' + _maK_BM + '"]');
	        					chkMaK_BM.closest('td').attr('data-th-td-' + typeObj, '');
            					chkMaK_BM.closest('tr').children().eq(3).addClass('text-center');
	        					alert('Thêm thành công!');
							}
							else
							{
								_maK_BM = data.maK_BM;
								idx = getIndexToDel(tbl, 0, {'property': ('data-checkbox-' + typeMK), 'value': maK_BM});
								if(idx >= 0)
								{
									dtb = getRowData(tbl, idx);
									if(dtb)
									{
										$('[data-button-' + typeTenK + '][data-button-' + typeMK + '="' + maK_BM + '"]').attr('data-button-' + typeTenK, tenK_BM);
										$('[data-button-' + typeMK + '="' + maK_BM + '"]').attr('data-button-' + typeMK, _maK_BM);
										$('[data-div-ds' + typeObj + '="' + maK_BM + '"]').attr('data-div-ds' + typeObj, _maK_BM);
										tbl.dataTable().fnUpdate(['<input type="checkbox" data-checkbox-' + typeMK + '="' + _maK_BM + '" data-checkbox-' + (type === 'k' ? 'tenKhoa' : 'tenBM') + '="' + tenK_BM +'" data-checkbox-' + (type === 'k' ? 'k' : 'bm') + '="c">', dtb[1], tenK_BM, dtb[3], dtb[4], dtb[5], (type === 'k' ? '<div class="btn-group">\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Sửa" data-button-new data-button-id="sua" data-button-maKhoa="' + _maK_BM + '" data-button-tenKhoa="' + tenK_BM +'"><i class="glyphicon glyphicon-edit"></i></button>\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-new data-button-id="xoa" data-button-maKhoa="' + _maK_BM + '" data-button-tenKhoa="' + tenK_BM +'"><i class="glyphicon glyphicon-trash"></i></button>\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem danh sách bộ môn" data-button-new data-button-id="xemDanhSachBM" data-button-maKhoa="' + _maK_BM + '" data-button-tenKhoa="' + tenK_BM +'"><i class="fa fa-list"></i></button>\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem danh sách cán bộ" data-button-new data-button-id="xemDanhSachCBK" data-button-maKhoa="' + _maK_BM + '" data-button-tenKhoa="' + tenK_BM +'"><i class="fa fa-male"></i></button>\
		                          	</div>' : '<div class="btn-group">\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Sửa" data-button-new data-button-id="sua" data-button-maBM="' + _maK_BM + '" data-button-tenBM="' + tenK_BM + '"><i class="glyphicon glyphicon-edit"></i></button>\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-new data-button-id="xoa" data-button-maBM="' + _maK_BM + '" data-button-tenBM="' + tenK_BM + '"><i class="glyphicon glyphicon-trash"></i></button>\
			                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem danh cán bộ" data-button-new data-button-id="xemDanhSachCB" data-button-maBM="' + _maK_BM + '" data-button-tenBM="' + tenK_BM + '"><i class="fa fa-male"></i></button>\
		                          	</div>')], idx, null, false, false);
										alert('Cập nhật thành công!');
										return true;
									}
								}
								throw new TypeError('Cập nhật ' + typeTK + ' thất bại!<br>Do không thể định vị vị trí của ' + typeTK + ' này trong danh sách hiển thị!<br>');
							}
						}
						else
							throw new TypeError((typeCommad === 'them' ? 'Thêm ' : 'Cập nhật ') + typeTK + ' thất bại!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
    				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, (typeCommad === 'them' ? 'Thêm' : 'Cập nhật'), 1, typeTK);
    			}
        	});
		}
		/*click button cập nhật khoa*/
		if(btnCNKhoa.length)
			btnCNKhoa.on('click', function(){
				try
	            {
	            	capNhat($(this), 'k');
		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

		/*click button cập nhật bộ môn*/
		if(btnCNBM.length)
			btnCNBM.on('click', function(){
				try
	            {
					capNhat($(this), 'bm');
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