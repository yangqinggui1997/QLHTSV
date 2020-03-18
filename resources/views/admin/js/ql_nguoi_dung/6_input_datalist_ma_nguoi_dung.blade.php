<script>
$(function(){
	try
	{
		var txtMaCB = $('#textBox__id__maCanBo');
		function resetValInput()
		{
			$('[data-checkbox-capQuyenCT]').prop('checked', false);
			$('#textBox__id__email').val('');
			$('#textBox__id__gioiTinh').val('');
			$('#textBox__id__nghiepVu').val('');
			$('#textBox__id__quyen').val('');
			$('#textarea__id__moTa').val('');
			$('#img__id__anh').removeAttr('src');
		}
		/*input mã người dùng*/
		if(txtMaCB.length)
			txtMaCB.on('input', function(){
				try
	            {
		            var object = $(this);
		            var loaiND = '';
		            var csrf_token = null;
		            var formData = null;
		            var joinStr1 = '';
		            var joinStr2 = '';
		            var hdMaCB = $('#hidden__id__maCanBo');
		            var $subThis = null;
		            var objVal = object.val();
		            var sbVal = '';
		            var sbText = '';
		            if(!objVal)
		            	resetValInput();
		            else
		            	$('#datalist__id__maCanBo').children().each(function(){
		            		$subThis = $(this);
		            		sbVal = $subThis.val();
		            		sbText = $subThis.text();
		            		joinStr1 = sbVal.toLowerCase() + ' - ' + sbText.toLowerCase();
		            		joinStr2 = objVal.toLowerCase();
		            		if(sbVal.toLowerCase() === objVal.toLowerCase() || sbText.toLowerCase() === objVal.toLowerCase() || joinStr1 === joinStr2)
		            		{
		            			object.val(sbVal + ' - ' + sbText);
		            			hdMaCB.val(sbVal);
		            			hdMaCB.attr('data-hidden-tenND', sbText);
		            			csrf_token = $('#_token').attr('content');
		            			if(sbVal.toUpperCase().indexOf('CB') >= 0)
			            			loaiND = 'cb';
			            		else
			            			loaiND = 'sv';
		            			formData = new FormData();
		            			formData.append('_token', csrf_token);
		            			formData.append('maCBSV', sbVal);
		            			formData.append('loaiND', loaiND);
		            			$.ajax({
		            				type: 'POST',
		            				dataType: 'JSON',
		            				url: 'admin/quan_ly_nguoi_dung/lay_thong_tin_cb_sv',
		            				xhr: xhrSetting,
		            				cache: false,
		            				contentType: false,
		            				processData: false,
		            				data: formData,
		            				success: function(data)
		            				{
		            					try
		            					{
		            						if(data.flag)
		            						{
		            							$('#textBox__id__email').val(data.email);
		            							$('#textBox__id__gioiTinh').val(data.gioiTinh);
		            							$('#textBox__id__nghiepVu').val(data.nghiepVu);
		            							$('#textBox__id__quyen').val(data.quyen);
		            							$('#textarea__id__moTa').val(data.moTa);
		            							$('#img__id__anh').attr('src', ((data.anh && loaiND === 'cb') ? 'resources/images/avatars/anhcanbo/' + data.anh : (data.anh ? 'resources/images/avatars/anhsinhvien/' + data.anh : 'resources/images/avatars/user.png')));
		            						}
		            						else
		            						{
		            							resetValInput();
		            							throw new TypeError('Không thể lấy thông tin người dùng!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>'); 
		            						}
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
			            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Lấy thông tin', 1, 'người dùng');
			            			}
		            			});
		            			return false;
		            		}
		            		else
		            		{
		            			hdMaCB.val('');
		            			hdMaCB.removeAttr('data-hidden-tenND');
		            			resetValInput();
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