<script>
$(function(){
    try
    {
        var tbyND = $('#tbody__id__nguoiDung');
        /*click button mở khoá tài khoản*/
        if(tbyND.length)
            tbyND.on('click', '[data-button-id="mktaikhoan"]', function(){
                try
                {
                    var $this = $(this);
                    var csrf_token = $('#_token').attr('content');
                    var formData = new FormData();
                    formData.append('_token', csrf_token);
                    formData.append('maND', $this.attr('data-button-maND'));
                    $.ajax({
                        type: 'POST',
                        dataType: 'JSON',
                        url: 'admin/quan_ly_nguoi_dung/mo_khoa_tk',
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
                                var divND = $('#div__id__formNguoiDung');
                                if(data.flag)
                                {
                                    if(!data.per)
                                    {
                                        alert('Bạn không có quyền chỉnh sửa!');
                                        return false;
                                    }
                                    if((!divND.is(':hidden') || !divND[0].hasAttribute('hidden')) && $('#hidden__id__maCanBo').val() === $this.attr('data-button-maND'))
                                        $('#select__id__trangThai').val('tu_do');
                                    tblND.dataTable().fnUpdate('Đăng xuất', tblND.DataTable().row($this.closest('tr')).index(), 9, false, false);
                                    alert('Mở khoá tài khoản thành công!');
                                }
                                else
                                    throw new TypeError('Không thể mở khoá tài khoản người dùng!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
                            guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Mở khoá tài khoản', 1, 'người dùng');
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