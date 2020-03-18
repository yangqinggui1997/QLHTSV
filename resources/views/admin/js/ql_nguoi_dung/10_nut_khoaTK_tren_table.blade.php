<script>
$(function(){
    try
    {
        var tbyND = $('#tbody__id__nguoiDung');
        /*click button khoá tài khoản*/
        if(tbyND.length)
            tbyND.on('click', '[data-button-id="khoataikhoan"]', function(){
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
                        url: 'admin/quan_ly_nguoi_dung/khoa_tk',
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
                                var frmND = $('#div__id__formNguoiDung');
                                if(data.flag)
                                {
                                    if(!data.per)
                                    {
                                        alert('Bạn không có quyền chỉnh sửa!');
                                        return false;
                                    }
                                    if((!frmND.is(':hidden') || !frmND[0].hasAttribute('hidden')) && $('#hidden__id__maCanBo').val() === $this.attr('data-button-maND'))
                                        $('#select__id__trangThai').val('bi_khoa');
                                    tblND.dataTable().fnUpdate('Bị khoá', tblND.DataTable().row($this.closest('tr')).index(), 9, false, false);
                                    alert('Khoá tài khoản thành công!');
                                }
                                else
                                    throw new TypeError('Không thể khoá tài khoản người dùng!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
                            guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Khoá tài khoản', 1, 'người dùng');
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