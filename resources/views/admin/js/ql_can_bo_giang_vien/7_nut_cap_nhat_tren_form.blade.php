<script>
$(function(){
	try
	{
		var btnCN = $('#button__id__capNhat');
		/*click button cập nhật khoa*/
		if(btnCN.length)
			btnCN.on('click', function(){
				try
	            {
	            	var $this = $(this);
		        	var formData = new FormData();
		        	var hdMaPB = $('#hidden__id__phong');
		        	var sdt = $('#number__id__soDienThoai').val().trim();
		        	var email = $('#textBox__id__email').val().trim();
		        	var anh = $('#img__id__anh').prop('files');
		        	var tenCB = $('#textBox__id__tenCB').val();
		        	var gt = $('#radio__id__gtNam').prop('checked');
		        	var hv = $('#select__id__hocVi').val();
		        	var cm = $('#select__id__chuyenMon').val();
		        	var nghiepVu = $('#select__id__nghiepVu').val();
		        	var cv = $('#select__id__chucVu').val();
		        	var maCB = $this.attr('data-button-maCB');
		        	if($('#div__id__formCanBo').find('.alert').length)
		        		throw new TypeError('Vui lòng điền đầy đủ thông tin!');
		        	if(isNaN(sdt))
		        		throw new TypeError('Số điện thoại hợp lệ phải có 10 chữ số!');
		        	if(!checkEmail(email))
		        		throw new TypeError('Email không hợp lệ!');
		        	if(!hdMaPB)
		        		throw new TypeError('Phòng/ Bộ môn không tồn tại!');
		        	formData.append('_token', $('#_token').attr('content'));
		        	if($this.attr('data-button-command') === 'capnhat')
		        		formData.append('maCB', maCB);
		        	formData.append('tenCB', tenCB);
		        	formData.append('gt', (gt ? 1 : 0));
		        	formData.append('sdt', sdt);
		        	formData.append('email', email);
		        	formData.append('hv', hv);
		        	formData.append('cm', cm);
		        	formData.append('nghiepVu', nghiepVu);
		        	formData.append('cv', cv);
		        	formData.append('maPB', hdMaPB.val());
		        	if(anh.length && anh[0])
			        	formData.append('file', anh[0]);
		        	$.ajax({
		        		type: 'POST',
		        		dataType: 'JSON',
		        		url: 'admin/quan_ly_can_bo__giang_vien/' + ($this.attr('data-button-command') === 'capnhat' ? 'cap_nhat' : 'them'),
		        		xhr: xhrSetting,
		        		cache: false,
		        		contentType: false,
		        		processData: false,
		        		data: formData,
		        		success: function(data)
		        		{
		        			try
		        			{
		        				var tbl = $('#table__id__canBo');
		        				var chkMaCB = null;
		        				var _length = 0;
		        				var btnNews = null;
		        				var dtb = null;
		        				var idx = null;
		        				var chk = null;
								if(data.flag)
								{
									if(!data.per)
		                            {
		                                alert('Bạn không có quyền chỉnh sửa!');
		                                return false;
		                            }
									if($this.attr('data-button-command') === 'them')
									{
										_length = tbl.DataTable().rows().indexes().length;
										tbl.dataTable().fnAddData(['<input type="checkbox" data-checkbox-maCB="' + data.maCB + '" data-checkbox-tenCB="' + tenCB +'" data-checkbox-cb="c">', (_length + 1), data.maCB, tenCB, (gt ? 'Nam' : 'Nữ'), sdt, email, $('option[value="' + hv + '"]').text(), $('option[value="' + cm + '"]').text(), $('option[value="' + nghiepVu + '"]').text(), '<div class="btn-group">\
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Sửa" data-button-id="sua" data-button-maCB="' + data.maCB + '" data-button-new><i class="glyphicon glyphicon-edit"></i></button>\
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-id="xoa" data-button-maCB="' + data.maCB + '" data-button-tenCB="' + tenCB + '" data-button-new><i class="glyphicon glyphicon-trash"></i></button>' + ($('[data-button-id="phanCongGD"]').length ? '\
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Phân công giảng dạy" data-button-id="phanCongGD" data-button-maCB="' + data.maCB + '" data-button-new><i class="fa fa-suitcase"></i></button>\
					                            ' : '') + '\
				                          	</div>']);
										tbl.dataTable().fnSort([1, 'desc']);
										btnNews = $('[data-button-new]');
							            btnNews.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							            btnNews.removeAttr('data-button-new');
			        					chkMaCB = $('[data-checkbox-maCB="' + data.maCB + '"]');
			        					chkMaCB.closest('td').attr('data-th-td', '');
		            					chkMaCB.closest('tr').children().eq(3).addClass('text-center');
			        					alert('Thêm thành công!');
									}
									else
									{
										idx = getIndexToDel(tbl, 0, {'property': 'data-checkbox-maCB', 'value': $this.attr('data-button-maCB')});
										if(idx >= 0)
										{
											dtb = getRowData(tbl, idx);
											if(dtb)
											{
												chk = $(dtb[0]);
												chk.attr('data-checkbox-tenCB', tenCB);
												tbl.dataTable().fnUpdate([chk.outerHTML, dtb[1], maCB, tenCB, (gt ? 'Nam' : 'Nữ'), sdt, email, $('option[value="' + hv + '"]').text(), $('option[value="' + cm + '"]').text(), $('option[value="' + nghiepVu + '"]').text(), '<div class="btn-group">\
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Sửa" data-button-id="sua" data-button-maCB="' + maCB + '" data-button-new><i class="glyphicon glyphicon-edit"></i></button>\
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-id="xoa" data-button-maCB="' + maCB + '" data-button-tenCB="' + tenCB + '" data-button-new><i class="glyphicon glyphicon-trash"></i></button>' + ($('[data-button-id="phanCongGD"]').length ? '\
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Phân công giảng dạy" data-button-id="phanCongGD" data-button-maCB="' + maCB + '" data-button-new><i class="fa fa-suitcase"></i></button>\
					                            ' : '')], idx, null, false, false);
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