<script>
$(function(){
	try
	{
		 var btnCN = $('#button__id__capNhat');
		/*click button cập nhật trên form*/
		if(btnCN.length)
			btnCN.on('click', function(){
	            try
	            {
	            	var $this = $(this);
	            	var hdMaCB = $('#hidden__id__maCanBo');
	            	var maND = hdMaCB.val();
	            	var loaiND = '';
	            	var _length = 0;
	            	var formData = null;
	            	var csrf_token = '';
	            	var _url = (($this.attr('data-button-command') === 'them') ? 'admin/quan_ly_nguoi_dung/them' : 'admin/quan_ly_nguoi_dung/cap_nhat');
	            	var selectTrangThai = $('#select__id__trangThai').val();
	            	var chkThem = $('[data-checkbox-code="them"]').prop('checked');
            		var chkSua = $('[data-checkbox-code="capnhat"]').prop('checked');
            		var chkXoa = $('[data-checkbox-code="xoa"]').prop('checked');
            		var chkSaoChep = $('[data-checkbox-code="saochep"]').prop('checked');
	            	var thaoTac = (chkThem ? (chkXoa ? (chkSua ? (chkSaoChep ? (thaoTac = 'them|xoa|sua|saochep') : (thaoTac = 'them|xoa|sua')) : (chkSaoChep ? (thaoTac = 'them|xoa|saochep') : (thaoTac = 'them|xoa'))) : (chkSua ? (chkSaoChep ? (thaoTac = 'them|sua|saochep') : (thaoTac = 'them|sua')) : (chkSaoChep ? (thaoTac = 'them|saochep') : (thaoTac = 'them')))) : (chkXoa ? (chkSua ? (chkSaoChep ? (thaoTac = 'xoa|sua|saochep') : (thaoTac = 'xoa|sua')) : (chkSaoChep ? (thaoTac = 'xoa|saochep') : (thaoTac = 'xoa'))) : (chkSua ? (chkSaoChep ? (thaoTac = 'sua|saochep') : (thaoTac = 'sua')) : (chkSaoChep ? (thaoTac = 'saochep') : ''))));
	            	if(!maND || $('#div__id__formNguoiDung').find('.alert').length)
	            		throw new TypeError('Thông tin sai hoặc chưa đầy đủ!<br>');
            		if(!thaoTac)
	            		throw new TypeError('Hãy chỉ định các thao tác được phép của người dùng!<br>');
            		if(maND.toUpperCase().indexOf('CB') >= 0)
            			loaiND = 'cb';
            		else
            			loaiND = 'sv';
            		csrf_token = $('#_token').attr('content');
            		formData = new FormData();
            		formData.append('_token', csrf_token);
            		formData.append('maND', maND);
            		formData.append('loaiND', loaiND);
            		formData.append('thaoTac', thaoTac);
        			formData.append('trangThai', selectTrangThai);
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
            					var tblND = $('#table__id__nguoiDung');
            					var chkMaND = null;
            					var txtMaCB = null;
            					var _length = 0;
            					var td = null;
            					var tenND = hdMaCB.attr('data-hidden-tenND');
            					var comm = $this.attr('data-button-command');
            					if(data.flag)
            					{
            						if(!data.per)
                                    {
                                        alert('Bạn không có quyền ' + (comm === 'them' ? 'thêm' : 'chỉnh sửa') + '!');
                                        return false;
                                    }
            						if(comm === 'them')
                                	{
                                		$('option[value="' + maND + '"]').remove();
	        							_length = tblND.DataTable().rows().indexes().length;
		            					tblND.dataTable().fnAddData(['<input type="checkbox" data-checkbox-maND="' + maND + '" data-checkbox-user="c" data-checkbox-tenND="' + tenND +'">', (_length + 1), '<a href="javascript:void(0)">\
								        		<label>\
								        			<div class="avatar-wrap">\
		                                                <div class="avatarTiny avatar-tiny">\
											        		<img src="' + data.anh + '" alt="Ảnh người dùng">\
		                                                </div>\
		                                            </div>\
								        		</label>\
								        		<br>\
								        		<span style="line-height: unset;margin-top:2px">' + tenND + '</span>\
								        	</a>', $('#textBox__id__email').val(), $('#textBox__id__quyen').val(), data.ngayTao, data.ngayCapNhat, 0, data.dangNhapLC, ((selectTrangThai === 'bi_khoa') ? 'Bị khoá' : 'Đăng xuất'), '<div class="btn-group">\
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Sửa" data-button-new data-button-id="sua" data-button-maND="' + maND + '" data-button-tenND="' + tenND +'"><i class="glyphicon glyphicon-edit"></i></button>\
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-new data-button-id="xoa" data-button-maND="' + maND + '" data-button-tenND="' + tenND + '"><i class="glyphicon glyphicon-trash"></i></button>\
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem các quyền hạn chi tiết" data-button-new data-button-id="xemQuyenCT" data-button-maND="' + maND + '"  data-button-tenND="' + tenND +'"><i class="fa fa-users"></i></button>\
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Khoá tài khoản này" data-button-new data-button-id="khoataikhoan" data-button-maND="' + maND + '"><i class="glyphicon glyphicon-lock"></i></button>\
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Mở khoá tài khoản này" data-button-new data-button-id="mktaikhoan" data-button-maND="' + maND + '"><i class="fa fa-unlock-alt"></i></button>\
				                          	</div>']);
		            					tblND.dataTable().fnSort([1, 'desc']);
		            					btnNews = $('[data-button-new]');
							            btnNews.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							            btnNews.removeAttr('data-button-new');
		            					chkMaND = $('[data-checkbox-maND="' + maND + '"]');
		            					chkMaND.closest('td').attr('data-th-td', '');
		            					td = chkMaND.closest('tr').children();
		            					td.eq(1).addClass('text-center');
		            					td.eq(5).addClass('text-center');
		            					td.eq(6).addClass('text-center');
		            					td.eq(7).addClass('text-center');
		            					txtMaCB = $('#textBox__id__maCanBo');
		            					txtMaCB.val('');
		            					txtMaCB.trigger('input');
		            					alert('Thêm thành công!');
                                	}
                                	else if(data.kd)
            							alert('Thông tin không thay đổi!');
            						else
            						{
            							tblND.dataTable().fnUpdate(((selectTrangThai === 'bi_khoa') ? 'Bị khoá' : 'Đăng xuất'), $this.attr('data-button-index'), 9, false, false);
            							$('#button__id__huy').attr('data-button-thaoTac', thaoTac);
		            					alert('Cập nhật thành công!');
            						}
            					}
            					else
	            					throw new TypeError((comm === 'them' ? 'Thêm' : 'Cập nhật') + ' thất bại!<br>' +  data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
            				if($this.attr('data-button-command') === 'them')
	            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Thêm', 1, 'người dùng');
	            			else
	            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Cập nhật', 1, 'người dùng');
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