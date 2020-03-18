<script>
	$(function(){
	var CSRF_TOKEN = $('meta[name*="_token"]').attr('content').trim();

	init_validator();init_DataTables();init_sidebar();
	
	/*difined some funcions*/
	function reset_all_checkbox()
	{
		$('[data-checkbox-id*="checkbox__id__chkCapQuyen"]').prop('checked', false);
		$('[data-checkbox-id="checkbox__id__chkCapQuyen"]').attr('data-checkbox-primary', '');
		if(typeof $('[data-checkbox-id*="checkbox__id__chkCapQuyen"]').attr('disabled') != typeof undefined || $('[data-checkbox-id*="checkbox__id__chkCapQuyen"]').attr('disabled'))
			$('[data-checkbox-id*="checkbox__id__chkCapQuyen"]').removeAttr('disabled');
	}

	function reset_value_fields(deferr = null)
	{
		$('#textbox__id__maCanBo').val(null);
		if(typeof $('#textbox__id__maCanBo').attr('value') != typeof undefined || $('#textbox__id__maCanBo').attr('value'))
			$('#textbox__id__maCanBo').removeAttr('value');

		$('#textbox__id__email').val(null);
		if(typeof $('#textbox__id__email').attr('value') != typeof undefined || $('#textbox__id__email').attr('value'))
			$('#textbox__id__email').removeAttr('value');

		$('#radio__id__gtNam').prop('checked', false);
		$('#radio__id__gtNu').prop('checked', false);

		$('#div__id__congViec').html(null);
		$('#div__id__chucVu').html(null);

		$('#textbox__id__quyenMacDinh').val(null);
		if(typeof $('#textbox__id__quyenMacDinh').attr('value') != typeof undefined || $('#textbox__id__quyenMacDinh').attr('value'))
			$('#textbox__id__quyenMacDinh').removeAttr('value');

		$('#img__id__anh').attr('src', null);
		if(typeof $('#img__id__anh').attr('src') != typeof undefined || $('#img__id__anh').attr('src'))
			$('#img__id__anh').removeAttr('src');
		reset_all_checkbox();
		$('[data-td-id]').html(null);
		if(typeof $('#button__id__quyenPhu').attr('data-button-id') != typeof undefined || $('#button__id__quyenPhu').attr('data-button-id'))
			$('#button__id__quyenPhu').removeAttr('data-button-id');
		if(typeof $('#button__id__quyenPhu').attr('data-target') != typeof undefined || $('#button__id__quyenPhu').attr('data-target'))
		$('#button__id__quyenPhu').removeAttr('data-target', '.bs-example-modal-lg');
		if(deferr)
			deferr.resolve();
	}

	// function inputMaCanBo() {
	// 	try
	// 	{
	// 		for(var i = 0; i < $('#datalist__id__danhSachCanBo option').length; ++i)
	// 			if($('#datalist__id__danhSachCanBo option')[i].value.trim() == $(this).val().trim() || $('#datalist__id__danhSachCanBo option')[i].innerText.trim() == $(this).val().trim())
	// 			{
	// 				// $(this).val($('#datalist__id__danhSachCanBo option')[i].innerText.trim());
	// 				// $('#textbox__id__maCanBoHide').val($('#datalist__id__danhSachCanBo option')[i].value.trim());
	// 				inputMaCanBo.flag = false;
	// 				break;
	// 			}
	// 			else
	// 			{
	// 				if(!inputMaCanBo.flag)
	// 					alert("asdsad");
	// 				inputMaCanBo.flag = true;
	// 			}
	// 	}
	// 	catch(err)
	// 	{
	// 		if(typeof err.name == typeof undefined || !err.name || typeof err.message == typeof undefined || !err.message)
	// 			alert("Lỗi: " + err + ".");
	// 		else
	// 			alert("Lỗi: " + err.name  + ". "+ err.message);
	// 	}
	// }

	function xemQuyen(idUser, deferr)
	{
		var i = 0, k = 0, noiDungQuyen = null, quyen = null, quyenChiTiet=null;
		reset_all_checkbox();
		quyen = $('[data-hidden-flag="hidden__data-hidden-flag__quyen"][data-hidden-id="' + idUser + '"]').attr('data-hidden-content');
		quyen = quyen.split(";");
		if(quyen.length)
		{
			for(i = 0; i < quyen.length; ++i)
			{
				noiDungQuyen = null;
				noiDungQuyen = quyen[i].split(',');
				if(noiDungQuyen.length == 5)
					if(noiDungQuyen[4].trim())
					{
						$('#textbox__id__quyenMacDinh').val(noiDungQuyen[1].trim());
						quyenChiTiet = noiDungQuyen[3].split('|');
						if(quyenChiTiet.length)
						{
							$('[data-checkbox-id="checkbox__id__chkCapQuyen"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);
							$('[data-checkbox-id="checkbox__id__chkCapQuyen"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').attr('data-checkbox-primary', 1);
							$('[data-checkbox-id="checkbox__id__chkCapQuyen"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').attr('disabled','');
							$('[data-td-id="' + noiDungQuyen[0].trim() + '"]').html('Chính');

							for(k = 0; k < quyenChiTiet.length; ++k)
							{
								if(quyenChiTiet[k].trim() == 'them')
								{
									$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_Them"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);
									continue;
								}

								if(quyenChiTiet[k].trim() == 'xoa')
								{
									$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_Xoa"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);
									continue;
								}

								if(quyenChiTiet[k].trim() == 'capnhat')
								{
									$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_CapNhat"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);
									continue;
								}

								if(quyenChiTiet[k].trim() == 'saochep')
								{
									$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_SaoChep"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);
									continue;
								}
							}
						}
						else
						{
							if(noiDungQuyen[3].trim() == 'them')
								$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_Them"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);

							if(noiDungQuyen[3].trim() == 'xoa')
								$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_Xoa"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);

							if(noiDungQuyen[3].trim() == 'capnhat')
								$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_CapNhat"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);

							if(noiDungQuyen[3].trim() == 'saochep')
								$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_SaoChep"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);
						}
					}
					else
					{
						//Đỗ dữ liệu lên modal quyền bổ sung
						quyenChiTiet = noiDungQuyen[3].split('|');
						if(quyenChiTiet.length)
						{
							$('[data-checkbox-id="checkbox__id__chkCapQuyen"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);
							$('[data-checkbox-id="checkbox__id__chkCapQuyen"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').attr('data-checkbox-primary', 0);
							$('[data-td-id="' + noiDungQuyen[0].trim() + '"]').html('Phụ');
							for(k = 0; k < quyenChiTiet.length; ++k)
							{
								if(quyenChiTiet[k].trim() == 'them')
								{
									$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_Them"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);
									continue;
								}

								if(quyenChiTiet[k].trim() == 'xoa')
								{
									$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_Xoa"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);
									continue;
								}

								if(quyenChiTiet[k].trim() == 'capnhat')
								{
									$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_CapNhat"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);
									continue;
								}

								if(quyenChiTiet[k].trim() == 'saochep')
								{
									$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_SaoChep"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);
									continue;
								}
							}
						}
						else
						{
							if(noiDungQuyen[3].trim() == 'them')
								$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_Them"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);

							if(noiDungQuyen[3].trim() == 'xoa')
								$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_Xoa"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);

							if(noiDungQuyen[3].trim() == 'capnhat')
								$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_CapNhat"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);

							if(noiDungQuyen[3].trim() == 'saochep')
								$('[data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_SaoChep"][data-checkbox-content="' + noiDungQuyen[0].trim() + '"]').prop('checked', true);
						}
					}
			}
		}
		$.each($('[data-checkbox-id="checkbox__id__chkCapQuyen"]'), function(){
			if(!$(this).prop('checked'))
			{
				$(this).attr('data-checkbox-primary', 0);
				$('[data-td-id="' + $(this).attr('data-checkbox-content').trim() + '"]').html('Phụ');
			}
		});
		deferr.resolve();
	}

	function moFormCapNhatNguoiDung()
	{
		try
		{
			var deferr = $.Deferred(), deferrs = [];
			var idUser = $(this).attr('data-button-id').trim(), email = $(this).attr('data-button-email'), gioiTinh = $(this).attr('data-button-gioiTinh') ? true : false, congViec = $(this).attr('data-button-congViec'), anh = $(this).attr('data-button-anh'), chucVu = null, HTMLContent = null;
			if (!idUser) throw new Error("Mã người dùng không xác định");
			
			deferrs.push(deferr.promise());
			reset_value_fields(deferr);
			$.when.apply($, deferrs).then(function(){
				deferr = $.Deferred(); deferrs = [];
				congViec = congViec.split("|");
				chucVu = $('[data-hidden-flag="hidden__data-hidden-flag__chucVu"][data-hidden-id="' + idUser + '"]').attr('data-hidden-content');
				chucVu = chucVu.split("|");

				$('#textbox__id__maCanBo').val(idUser);

				$('#textbox__id__email').val(email);
				if(gioiTinh)
				{
					$('#radio__id__gtNam').prop('checked', true);
				}
				else
					$('#radio__id__gtNu').prop('checked', true);
				if(congViec.length > 1)
				{
					for(i = 0; i < congViec.length; ++i)
						HTMLContent += '<option>' + congViec[i].trim() + '</option>';
					HTMLContent += '<select class="form-control col-md-7 col-xs-12">' + HTMLContent + '</select>';
				}
				else
					if(congViec.length > 0)
						HTMLContent = '<input class="form-control col-md-7 col-xs-12" readonly value="' + congViec[0].trim() + '">';
					else
						HTMLContent = '<input class="form-control col-md-7 col-xs-12" readonly value="Không xác định">';
				$('#div__id__congViec').html(HTMLContent);
				$('#button__id__quyenPhu').attr('data-button-id', idUser);
				
				HTMLContent = null;
				if(chucVu.length == 1)
				{
					if(chucVu[0].trim() == 'khong_co')
					{

						HTMLContent = '<input class="form-control col-md-7 col-xs-12" readonly value="Không có">';
					}
					else
						HTMLContent = '<input class="form-control col-md-7 col-xs-12" readonly value="' + chucVu[0].trim() + '">';
				}
				else
					if(chucVu.length > 0){
						for(i = 0; i < chucVu.length; ++i)
							HTMLContent += '<option>' + chucVu[i].trim() + '</option>';
						HTMLContent += '<select class="form-control col-md-7 col-xs-12">' + HTMLContent + '</select>';
					}
					else
						execSuccess = false;
				$('#div__id__chucVu').html(HTMLContent);

				if(anh.trim() != 'khong_co')
					$('#img__id__anh').attr('src', 'resources/images/' + anh.trim());
				else
					$('#img__id__anh').attr('src', 'resources/images/user.png');

				deferrs.push(deferr.promise());
				xemQuyen(idUser, deferr);
				$.when.apply($, deferrs).then(function(){$('#div__id__formNguoiDung').slideDown(800);});
			});
			return true;
		}
		catch(err)
		{
			alert("Lỗi: " + err.stack + "!");
			return false;
		}
	}

	function myXhrSetting()
	{
		return $.ajaxSettings.xhr();
	}

	function guiYeuCauThanhCong(data, action, deferr = null, outputString = null, countObject = 1, object = null)
	{
		var tr = null, i = 0;
			alert("dfdfdf");
		if(data.flag)
		{
			if(action == 'capnhat')
			{
				tr = '<tr>\
			        <td>\
						<input type="checkbox" data-checkbox-content="' + data.idCanBo + '" data-checkbox-content-name="' + data.hoTen + '" data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk">\
					</td>\
			        <td>' + data.hoTen + '</td>\
			        <td>' + data.email + '</td>\
			        <td>' + data.quyenHan + '</td>\
			        <td>' + data.ngayTaoTaiKhoan + '</td>\
			        <td>' + data.ngayCapNhatTaiKhoan + '</td>\
			        <td>' + data.soLanDangNhap + '</td>\
			        <td>' + data.dangNhapLanCuoi + '</td>\
			        <td>' + data.trangThai + '</td>\
			        <td>\
			        	<div class="btn-group">\
                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Sửa" data-button="sua" data-button-id="' + data.idCanBo + '" data-button-email="' + data.email + '" data-button-gioitinh="' + data.gioiTinh + '" data-button-congviec="' + data.congViec + '" data-button-anh="' + data.anh + '"><i class="glyphicon glyphicon-edit"></i></button></div></div</div>\
                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Xoá" data-button="xoa" data-button-id="' + data.idCanBo + '"><i class="glyphicon glyphicon-trash"></i></button></div></div</div>\
                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Xem các quyền hạn chi tiết" data-button="xemQuyenCT" data-button-id="' + data.idCanBo + '"><i class="glyphicon glyphicon-info-sign"></i></button></div></div</div>\
                            <input type="hidden" data-hidden-flag="hidden__data-hidden-flag__quyen" data-hidden-id="' + data.idCanBo + '" data-hidden-content="' + data.danhSachQuyen + '">\
                            <input type="hidden" data-hidden-flag="hidden__data-hidden-flag__chucVu" data-hidden-id="' + data.idCanBo + '" data-hidden-content="' + data.chucVu + '">\
                      	</div>\
                    </td>\
			    </tr>';
				// $('#tbody__id__nguoiDung tr').has('td div').has(object).replaceWith(tr);
				alert('Cập nhật thành công!');
			}
			else if(action == 'xoa')
			{
				if($.isArray(object))
				{
					for(i = 0; i< object.length; ++i)
						$('#tbody__id__nguoiDung tr').has('td div').has('button[data-button-id="' + object[i] + '"]').remove();
					alert('Xoá các người dùng thành công!');
				}
				else
				{
					$('#tbody__id__nguoiDung tr').has('td div').has('button[data-button-id="' + object + '"]').remove();
					alert('Xoá người dùng thành công!');
				}
			}
			else
				outputString.val = data.message;
		}
		else
		{
			if(action == 'capnhat')
				alert('Cập nhật người dùng thất bại. Lỗi server: ' + data.error['message'] + '. Dòng: ' + data.error['line'] + "!");
			else if(action == 'xoa')
			{
				if(countObject > 1)
					alert('Xoá các người dùng thất bại. Lỗi server: ' + data.error['message'] + '. Dòng: ' + data.error['line'] + "!");
				else
					alert('Xoá người dùng thất bại. Lỗi server: ' + data.error['message'] + '. Dòng: ' + data.error['line'] + "!");
			}
			else
			
				alert('Kiểm tra thay đổi quyền người dùng thất bại. Lỗi server: ' + data.error['message'] + '. Dòng: ' + data.error['line'] + "!");
		}
			
		if(deferr)
			deferr.resolve();
	}

	function guiYeuCauThatBai(jqXHR, textStatus, errorThrown, action, countObject, deferr = null)
	{
		if(countObject > 1)
		{
			if(jqXHR.status == 419)
				alert(action + ' các người dùng thất bại! Người dùng không được xác thực (có thể đã đăng xuất hoặc có thể do cookie hoặc session đã bị xoá). Mô tả: ' + jqXHR.responseText + ' ; ' + textStatus + ' ; ' + errorThrown);
			else if(jqXHR.status == 500)
				alert(action + ' các người dùng thất bại! Đã phát hiện lỗi trên máy chủ phục vụ. Mô tả: ' + jqXHR.responseText + ' ; ' + textStatus + ' ; ' + errorThrown);
			else
				alert(action + ' các người dùng thất bại! Lỗi server: ' + jqXHR.responseText + ' ; ' + textStatus + ' ; ' + errorThrown);
		}
		else if(jqXHR.status == 419)
			alert(action + ' người dùng thất bại! Người dùng không được xác thực (có thể đã đăng xuất hoặc có thể do cookie hoặc session đã bị xoá). Mô tả: ' + jqXHR.responseText + ' ; ' + textStatus + ' ; ' + errorThrown);
		else if(jqXHR.status == 500)
			alert(action + ' người dùng thất bại! Đã phát hiện lỗi trên máy chủ phục vụ. Mô tả: ' + jqXHR.responseText + ' ; ' + textStatus + ' ; ' + errorThrown);
		else
			alert(action + ' người dùng thất bại! Lỗi server: ' + jqXHR.responseText + ' ; ' + textStatus + ' ; ' + errorThrown);
		if(deferr)
			deferr.resolve();
	}

	function kiemTraThayDoiQuyen(deferr, idUser, danhSachQuyen, outputString)
	{
		var formData = new FormData(), def = $.Deferred(), defs = [];
		defs.push(def.promise());
		formData.append('_token', CSRF_TOKEN);
		formData.append('idUser', idUser);
		formData.append('danhSachQuyen', danhSachQuyen);

		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: '/QLHTSV/admin/quan_ly_nguoi_dung/kiem_tra_thay_doi_quyen',
			xhr: myXhrSetting, //put function without parameter equal function definetion!
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			success: function(data){
				guiYeuCauThanhCong(data, 'kiemtraquyen', def, outputString);
				$.when.apply($, defs).then(function(){
					deferr.resolve();
				});
			},
			error: function(jqXHR, textStatus, errorThrown){
				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Kiểm tra thay đổi quyền', 1, def);
				$.when.apply($, defs).then(function(){
					deferr.resolve();
				});
			}
		});
	}

	function capNhatNguoiDung()
	{
		try
		{
			var formData = null, deferrs = null, deferr = null;
			var idUser = $('#textbox__id__maCanBo').val(), danhSachQuyen = null, danhSachQuyenChiTiet = null, i = 0, j = 0;
			var outputString = {'val':''};

			if(!idUser) throw new Error("Mã người dùng không xác định");
			if(!$('[data-checkbox-id="checkbox__id__chkCapQuyen"]:checked').length)
				throw new Error("Chưa cấp quyền người dùng!");

			deferrs = [];
			deferr = $.Deferred();
			danhSachQuyen = [];
			

			deferrs.push(deferr.promise());
			for (i = 0; i < $('[data-checkbox-id="checkbox__id__chkCapQuyen"]').length; i++)
				if($($('[data-checkbox-id="checkbox__id__chkCapQuyen"]')[i]).prop('checked'))
				{
					if(i)
						danhSachQuyen.push('|');
					danhSachQuyenChiTiet = [];
					danhSachQuyen.push($($('[data-checkbox-id="checkbox__id__chkCapQuyen"]')[i]).attr('data-checkbox-content').trim());
					danhSachQuyen.push(';');
					danhSachQuyen.push($($('[data-checkbox-id="checkbox__id__chkCapQuyen"]')[i]).attr('data-checkbox-primary').trim());
					for (j = 0; j < $('[data-checkbox-id*="checkbox__id__chkCapQuyenChiTiet"][data-checkbox-content="' + $($('[data-checkbox-id="checkbox__id__chkCapQuyen"]')[i]).attr('data-checkbox-content').trim() + '"]').length; j++)
						if($($('[data-checkbox-id*="checkbox__id__chkCapQuyenChiTiet"][data-checkbox-content="' + $($('[data-checkbox-id="checkbox__id__chkCapQuyen"]')[i]).attr('data-checkbox-content').trim() + '"]')[j]).prop('checked'))
							danhSachQuyenChiTiet.push($($('[data-checkbox-id*="checkbox__id__chkCapQuyenChiTiet"][data-checkbox-content="' + $($('[data-checkbox-id="checkbox__id__chkCapQuyen"]')[i]).attr('data-checkbox-content').trim() + '"]')[j]).attr('data-checkbox-code').trim());
					danhSachQuyen.push(';');
					danhSachQuyen.push(danhSachQuyenChiTiet);
				}
			kiemTraThayDoiQuyen(deferr, idUser, danhSachQuyen, outputString);
			$.when.apply($, deferrs).then(function(){
				if(outputString.val)
				{
					confirm('Xác nhận', outputString.val + " Bạn có muốn tiếp tục?", 
						function dongYCapNhat(){
							formData = new FormData();
							formData.append('_token', CSRF_TOKEN);
							formData.append('idUser', idUser);
							formData.append('danhSachQuyen', danhSachQuyen);
							$.ajax(
							{
								type: 'POST',
								dataType: 'JSON',
								url: '/QLHTSV/admin/quan_ly_nguoi_dung/cap_nhat_tt_nguoi_dung',
								xhr: myXhrSetting,
								cache: false,
								contentType: false,
								processData: false,
								data: formData,
								success: function(data){
									guiYeuCauThanhCong(data, 'capnhat', null, null, 1, $('[data-button-id="' + idUser +'"]'));
								},
								error: function(jqXHR, textStatus, errorThrown){
									guiYeuCauThatBai(jqXHR, textStatus, errorThrown, "Cập nhật", 1);
								}
							});
					}, null);
				}
				else
				{
					alert("Quyền hạn không thay đổi!");
				}
			});
			return true;
		}
		catch(err)
		{
			alert('Cập nhật người dùng thất bại. Lỗi: ' + err.stack + "!");
			return false;
		}
	}

	function dongFormCapNhat()
	{
		try
		{
			reset_value_fields();
			if(typeof $('[data-checkbox-id="checkbox__id__chkCapQuyen"]').attr('data-checkbox-primary') != typeof undefined || $('[data-checkbox-id*="checkbox__id__chkCapQuyen"]').attr('data-checkbox-primary'))
			$('[data-checkbox-id*="checkbox__id__chkCapQuyen"]').removeAttr('data-checkbox-primary');
			$('#div__id__formNguoiDung').slideUp(800);
			return true;
		}
		catch(err)
		{
			alert('Lỗi: ' + err.stack + '!');
			return false;
		}
	}

	function ajaxXoaNguoiDung(idUser)
	{
		var formData = new FormData(), deferr = $.Deferred(), deferrs = [];
		deferr = $.Deferred();
		deferrs.push(deferr.promise());
		formData.append('_token', CSRF_TOKEN);
		formData.append('idUser', idUser);

		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: '/QLHTSV/admin/quan_ly_nguoi_dung/xoa_nguoi_dung',
			xhr: myXhrSetting,
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			success: function(data){guiYeuCauThanhCong(data, 'xoa', null, countObject, idUser);},
			error: function(jqXHR, textStatus, errorThrown){guiYeuCauThatBai(jqXHR, textStatus, errorThrown, "Xoá", countObject)}
		});
	}

	function xoaNguoiDung(countObject)
	{
		try
		{
			var idUser = null, name = null, i = 0, string = 'các tài khoản';
			if(countObject > 1)
			{
				countObject = $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]:checked').length,
				idUser = [];
				for(i = 0; i < countObject; i++)
				{
					idUser[i] = $($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]:checked')[i]).attr('data-checkbox-content').trim();
					if(i < countObject - 1)
						name += $($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]:checked')[i]).attr('data-checkbox-content-name').trim() + ', ';
					else
						name += $($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]:checked')[i]).attr('data-checkbox-content-name').trim();
				}
			}
			else
			{
				idUser = $(this).attr('data-button-id').trim();
				name = $('[data-checkbox-content="' + $(this).attr('data-button-id').trim() + '"]').attr('data-checkbox-content-name');
				string = 'tài khoản';
			}
			if (!idUser) throw new Error("Mã người dùng không xác định");
			confirm('Xác nhận', 'Bạn có thực sự muốn xoá ' + string + ' của người dùng ' + name +'?', function dongYXoa(){ajaxXoaNguoiDung(idUser);});

			return true;
		}
		catch(err)
		{
			if(countObject > 1)
				alert('Xoá các người dùng thất bại. Lỗi: ' + err.stack + "!");
			else
				alert('Xoá người dùng thất bại. Lỗi: ' + err.stack + "!");
			return false;
		}
	}

	function xemChiTietQuyenNguoiDung()
	{
		try
		{
			var idUser = $(this).attr('data-button-content').trim(), deferr = null, deferrs = null;
			if (!idUser) throw new Error("Mã người dùng không xác định");
			reset_all_checkbox();
			if (typeof $(this).attr('data-target') != typeof undefined || $(this).attr('data-target'))
				$(this).removeAttr('data-target');
			deferr = $.Deferred(); deferrs = [];
			deferrs.push(deferr.promise());
			xemQuyen(idUser, deferr);
			$.Swhen.apply($, deferrs).then(function(){
				$('[data-checkbox-id*="checkbox__id__chkCapQuyen"]').attr('disabled','');
				$(this).attr('data-target', '.bs-example-modal-lg');
			});
		}
		catch(err)
		{
			alert('Lỗi: ' + err.stack + '!');
			return false;
		}
	}

	// $('#textbox__id__maCanBo').on('input', inputMaCanBo);

	// $('#button__id__themNguoiDung').on('click', function(){
	// 	try
	// 	{
	// 		var deferr = $.Deferred();
	// 		deferrs.push(deferr.promise());
	// 		if(!reset_value_fields(deferr)) throw "Lỗi: Gọi phương thức làm sạch các trường dữ liệu thất bại!";
	// 		$.when.apply($, deferrs).then(function(){
	// 			$('#div__id__formNguoiDung').slideDown(800);
	// 		});
	// 	}
	// 	catch(err)
	// 	{
	// 		if(typeof err.name == typeof undefined || !err.name || typeof err.message == typeof undefined || !err.message)
	// 			alert("Lỗi: " + err + ".");
	// 		else
	// 			alert("Lỗi: " + err.name  + " -> "+ err.message +"!");
	// 		return false;
	// 	}
	// });

	/*bind envets to elements*/
	/*mỏ form cập nhật người dùng*/
	$('#tbody__id__nguoiDung').on('click', '[data-button="sua"]', moFormCapNhatNguoiDung);

	/*cập nhật vào csdl*/
	$('#button__id__capNhat').on('click', capNhatNguoiDung);

	/*đóng form cập nhật người dùng*/
	$('#button__id__huy').on('click', dongFormCapNhat);

	/*click checkbox chọn tất cả người dùng*/
	$('#checkbox__id__dtb_user_chkAll').on('change', function(){
		try
		{
			if($(this).prop('checked'))
			{
				$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]').prop('checked', true);
				if(!$('#div__id__div_button_parent_1').length)
					$('<div class="col-sm-4" id="div__id__div_button_parent_1"><div class="row"><div class="col-sm-8"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]:checked').length + ' người dùng được chọn.</p></div><div class="col-sm-4"><button type="button" id="button__id__xoaNhieuNguoiDung" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Xoá các người dùng đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div</div>').insertAfter($('#div__id__div_button_parent_3'));
				else
					if($('#p__id__chonBanGhi').length)
						$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]:checked').length +' người dùng được chọn.');
			}
			else
			{
				$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]').prop('checked', false);
				if($('#div__id__div_button_parent_1').length)
					$('#div__id__div_button_parent_1').remove();
			}
		}
		catch(err)
		{
			alert('Lỗi: ' + err.stack + '!');
		}
	});

	/*click các checkbox từng người dùng*/
	$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]').on('change', function(){
		try
		{
			if($('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]:checked').length == $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]').length)
			{
				$('#checkbox__id__dtb_user_chkAll').prop('checked', true);
				if($('#p__id__chonBanGhi').length)
					$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]:checked').length +' người dùng được chọn.');
				else
					$('<div class="col-sm-4" id="div__id__div_button_parent_1"><div class="row"><div class="col-sm-8"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]:checked').length + ' người dùng được chọn.</p></div><div class="col-sm-4"><button type="button" id="button__id__xoaNhieuNguoiDung" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Xoá các người dùng đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div</div>').insertAfter($('#div__id__div_button_parent_3'));
			}
			else
			{
				$('#checkbox__id__dtb_user_chkAll').prop('checked', false);
				if(!$('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]:checked').length)
				{
					if($('#div__id__div_button_parent_1').length)
						$('#div__id__div_button_parent_1').remove();
				}
				else
					if($('#p__id__chonBanGhi').length)
						$('#p__id__chonBanGhi').html('Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]:checked').length +' người dùng được chọn.');
					else
						$('<div class="col-sm-4" id="div__id__div_button_parent_1"><div class="row"><div class="col-sm-8"><p style="color: red;margin: 5px 0;" id="p__id__chonBanGhi"> Có ' + $('[data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk"]:checked').length + ' người dùng được chọn.</p></div><div class="col-sm-4"><button type="button" id="button__id__xoaNhieuNguoiDung" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Xoá các người dùng đã chọn"><i class="glyphicon glyphicon-trash"></i></button></div></div</div>').insertAfter($('#div__id__div_button_parent_3'));
			}
		}
		catch(err)
		{
			alert('Lỗi: ' + err.stack + '!');
		}
	});

	/*mở modal cấp quyền người dùng*/
	$('#button__id__quyenPhu').on('click', function(){
		try
		{
			$(this).attr('data-target', '.bs-example-modal-lg');
		}
		catch(err)
		{
			alert('Lỗi: ' + err.stack + '!');
		}
	});

	/*mở modal xem chi tiết quyền người dùng*/
	$('[data-button-id="xemQuyenCT"]').on('click', xemChiTietQuyenNguoiDung);

	/*xoá một người dùng*/
	$('#tbody__id__nguoiDung').on('click', '[data-button="xoa"]', function(){xoaNguoiDung(1)});

	/*xoá nhiều người dùng*/
	$('#button__id__xoaNhieuNguoiDung').on('click', function(){xoaNguoiDung(2)});

});
</script>