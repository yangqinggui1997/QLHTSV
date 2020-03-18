<script>
$(function(){
    try
    {
        var tblWrapND = $('#table__id__nguoiDung_wrapper');
        /*click button khoá tk trên danh sách*/
        if(tblWrapND.length)
            tblWrapND.on('click', '#button__id__mkNhieuNguoiDung', function(){
                try
                {
                    var maND = new Array();
                    var dsTenND = new Array();
                    var i = 1;
                    var formData = new FormData();
                    var dsNDChk = getChkCheck($('#table__id__nguoiDung'), 0);
                    var $subThis = null;
                    $.each(dsNDChk, function(){
                        $subThis = this;
                        maND.push($subThis.chk.attr('data-checkbox-maND'));
                        dsTenND.push($subThis.chk.attr('data-checkbox-tenND'));
                        ++i;
                    });
                    if(!maND.length)
                        throw new TypeError('Chưa chọn người dùng nào!<br>');
                    formData.append('_token', $('#_token').attr('content'));
                    formData.append('maND', maND);
                    formData.append('dsTenND', dsTenND);
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
                                var table = $('#table__id__nguoiDung');
                                var divND = $('#div__id__formNguoiDung');
                                var idx = 0;
                                var dsMKhoaTB = '';
                                if(data.flag)
                                {
                                    if(!data.per)
                                    {
                                        alert('Bạn không có quyền chỉnh sửa!');
                                        return false;
                                    }
                                    for(i = 0; i < maND.length; ++i)
                                    {
                                        idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maND', 'value': maND[i]});
                                        if(idx >= 0)
                                        {
                                            if((!divND.is(':hidden') || !divND[0].hasAttribute('hidden')) && $('#hidden__id__maCanBo').val() === maND[i])
                                                $('#select__id__trangThai').val('tu_do');
                                            table.dataTable().fnUpdate('Đăng xuất', idx, 9, false, false);
                                        }
                                        else
                                            dsMKhoaTB += (dsMKhoaTB ? ((i === maND.length - 1) ? (dsMKhoaTB + ' và ' + dsTenND[i]) : (dsMKhoaTB + ', ' + dsTenND[i])) : dsTenND[i]);
                                        
                                    }
                                    if(dsMKhoaTB)
                                        throw new TypeError('Mở khoá tài khoản người dùng ' + dsMKhoaTB + ' thất bại!<br>Do không thể định vị vị trí của họ trên danh sách hiển thị!<br>');
                                    if(maND.length > 1)
                                        alert('Mở khoá các tài khoản thành công!');
                                    else
                                        alert('Mở khoá tài khoản thành công!');
                                }
                                else if(data.dsMKhoaTB)
                                {
                                    if(!data.per)
                                    {
                                        alert('Bạn không có quyền chỉnh sửa!');
                                        return false;
                                    }
                                    for(i = 0; i < data.dsMKhoaTC.length; ++i)
                                    {
                                        idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maND', 'value': data.dsMKhoaTC[i]});
                                        if(idx >= 0)
                                        {
                                            if((!divND.is(':hidden') || !divND[0].hasAttribute('hidden')) && $('#hidden__id__maCanBo').val() === data.dsMKhoaTC[i])
                                                $('#select__id__trangThai').val('bi_khoa');
                                            table.dataTable().fnUpdate('Đăng xuất', idx, 9, false, false);
                                        }
                                        else
                                            dsMKhoaTB += (dsMKhoaTB ? ((i === data.dsMKhoaTC.length - 1) ? (dsMKhoaTB + ' và ' + data.dsTenMKhoaTC[i]) : (dsMKhoaTB + ', ' + data.dsTenMKhoaTC[i])) : data.dsTenMKhoaTC[i]);
                                    }
                                    throw new TypeError('Mở khoá các tài khoản thất bại!<br>Một số đối tượng như ' + data.dsMKhoaTB + (dsMKhoaTB ? (' cùng với ' + dsMKhoaTB) : '') + ' không thể mở khoá tài khoản, do các đối tượng này không tồn tại trong hệ thống hoặc không định vị được vị trí trong danh sách hiển thị!<br>');
                                }
                                else
                                    throw new TypeError('Mở khoá tài khoản thất bại!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
                            guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Mở khoá tài khoản', ((maND.length > 1) ? maND.length : 1), 'người dùng');
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