<script>
$(function(){
	try
	{
		var tbyCB = $('#tbody__id__canBo');
		/*click button cập nhật*/
		if(tbyCB.length)
			tbyCB.on('click', '[data-button-id="sua"]', function(){
				try
	            {
	            	var $this = $(this);
                    var maCB = $this.attr('data-button-maCB');
                    var csrf_token = $('#_token').attr('content');
                    var formData = new FormData();
                    formData.append('_token', csrf_token);
                    formData.append('maCB', maCB);
                    $.ajax({
                        type: 'POST',
                        dataType: 'JSON',
                        url: 'admin/quan_ly_can_bo__giang_vien/lay_tt_cap_nhat',
                        xhr: xhrSetting,
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(data)
                        {
                            try
                            {
                                var i = 0;
                                var frmCB = $('#div__id__formCanBo');
                                var line = $('.ln_solid');
                                var btnCN = $('#button__id__capNhat');
                                var btnHuy = $('#button__id__huy');
                                var txtPB = $('#textBox__id__phong');
                                if(data.flag)
                                {
                                    $('#textBox__id__tenCB').val(data.tenCB);
                                    $('#radio__id__gtN' + (data.gt ? 'am' : 'u')).prop('checked', true);
                                    $('#number__id__soDienThoai').val(data.sdt);
                                    $('#textBox__id__email').val(data.email);
                                    $('#select__id__hocVi').val(data.hv);
                                    $('#select__id__chuyenMon').val(data.cm);
                                    $('#select__id__nghiepVu').val(data.nghiepVu);
                                    $('#select__id__chucVu').val(data.cv);
                                    txtPB.val(data.pb);
                                    txtPB.trigger('input');
                                    $('#img__id__anh').attr('src', (data.anh ? 'resources/images/avatars/anhcanbo/' + data.anh : 'resources/images/avatars/user.png'));
                                    btnHuy.attr('data-button-tenCB', data.tenCB);
                                    btnHuy.attr('data-button-gt', (data.gt ? 1 : 0));
                                    btnHuy.attr('data-button-sdt', data.sdt);
                                    btnHuy.attr('data-button-email', data.email);
                                    btnHuy.attr('data-button-hv', data.hv);
                                    btnHuy.attr('data-button-cm', data.cm);
                                    btnHuy.attr('data-button-nghiepVu', data.nghiepVu);
                                    btnHuy.attr('data-button-cv', data.cv);
                                    btnHuy.attr('data-button-pb', data.pb);
                                    btnHuy.attr('data-button-command', 'capnhat');
				                    btnCN.attr('data-button-index', $('#table__id__canBo').DataTable().row($this.closest('tr')).index());
				                    btnCN.attr('data-original-title', 'Cập nhật');
				                    btnCN.attr('data-button-command', 'capnhat');
                                    btnCN.attr('data-button-maCB', maCB);
                                    frmCB.find('.alert').remove();
						            frmCB.slideDown(800);
									$('html, body').animate({
						                scrollTop: frmCB.offset().top
						            }, 800);
                                }
                                else
                                    throw new TypeError('Không thể lấy thông tin cán bộ!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
                            guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Lấy thông tin', 1, 'cán bộ');
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