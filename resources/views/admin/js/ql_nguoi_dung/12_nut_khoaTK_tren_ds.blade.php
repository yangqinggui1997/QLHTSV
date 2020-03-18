<script>
$(function(){
    try
    {
        var tblWrapND = $('#table__id__nguoiDung_wrapper');
        /*click button khoá tk trên danh sách*/
        if(tblWrapND.length)
            tblWrapND.on('click', '#button__id__khoaNhieuNguoiDung', function(){
                try
                {
                    var maND = new Array();
                    var dsTenND = new Array();
                    var i = 1;
                    var formData = new FormData();
                    var dsNDChk = getChkCheck($('#table__id__nguoiDung'), 0);
                    var $subThis = null;
                    $.each(dsNDChk, function(){
                        subThis = this;
                        maND.push(subThis.chk.attr('data-checkbox-maND'));
                        dsTenND.push(subThis.chk.attr('data-checkbox-tenND'));
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
                                var table = $('#table__id__nguoiDung');
                                var divND = $('#div__id__formNguoiDung');
                                var idx = 0;
                                var dsKhoaTB = '';
                                if(data.flag)
                                {
                                    if(!data.per)
                                    {
                                        alert('Bạn không có quyền chỉnh sửa!');
                                        return false;
                                    }
                                    if(maND.length === 1)
                                    {
                                        idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maND', 'value': maND[0]});
                                        if(idx >= 0)
                                        {
                                            if((!divND.is(':hidden') || !divND[0].hasAttribute('hidden')) && $('#hidden__id__maCanBo').val() === maND[0])
                                            $('#select__id__trangThai').val('bi_khoa');
                                            table.dataTable().fnUpdate('Bị khoá', idx, 9, false, false);
                                        }
                                        else
                                            throw new TypeError('Khoá tài khoả người dùng thất bại!<br>Do không thể định vị vị trí của người dùng này trong danh sách hiển thị!<br>');
                                    }
                                    else
                                    {
                                        for(i = 0; i < maND.length; ++i)
                                        {
                                            idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maND', 'value': maND[i]});
                                            if(idx >= 0)
                                            {
                                                if((!divND.is(':hidden') || !divND[0].hasAttribute('hidden')) && $('#hidden__id__maCanBo').val() === maND[i])
                                                    $('#select__id__trangThai').val('bi_khoa');
                                                table.dataTable().fnUpdate('Bị khoá', idx, 9, false, false);
                                            }
                                            else
                                                dsKhoaTB += (dsKhoaTB ? ((i === maND.length - 1) ? (dsKhoaTB + ' và ' + dsTenND[i]) : (dsKhoaTB + ', ' + dsTenND[i])) : dsTenND[i]);
                                        }
                                    }
                                    if(dsKhoaTB)
                                        throw new TypeError('Khoá tài khoản người dùng ' + dsKhoaTB + ' thất bại!<br>Do không thể định vị vị trí của họ trên danh sách hiển thị!<br>');
                                    alert('Khoá tài khoản thành công!');
                                }
                                else if(data.dsKhoaTB)
                                {
                                    if(!data.per)
                                    {
                                        alert('Bạn không có quyền chỉnh sửa!');
                                        return false;
                                    }
                                    for(i = 0; i < data.dsKhoaTC.length; ++i)
                                    {
                                        idx = getIndexToDel(table, 0, {'property': 'data-checkbox-maND', 'value': data.dsKhoaTC[i]});
                                        if(idx >= 0)
                                        {
                                            if((!divND.is(':hidden') || !divND[0].hasAttribute('hidden')) && $('#hidden__id__maCanBo').val() === data.dsKhoaTC[i])
                                                $('#select__id__trangThai').val('bi_khoa');
                                            table.dataTable().fnUpdate('Bị khoá', idx, 9, false, false);
                                        }
                                        else
                                            dsKhoaTB += (dsKhoaTB ? ((i === data.dsKhoaTC.length - 1) ? (dsKhoaTB + ' và ' + data.dsTenKhoaTC[i]) : (dsKhoaTB + ', ' +  data.dsTenKhoaTC[i])) :  data.dsTenKhoaTC[i]);
                                    }
                                    throw new TypeError('Khoá tài khoản thất bại!<br>Một số đối tượng như ' + data.dsKhoaTB + (dsKhoaTB ? (' cùng với ' + dsKhoaTB) : '') + ' không thể khoá tài khoản, do các đối tượng này không tồn tại trong hệ thống hoặc không định vị được vị trí trong danh sách hiển thị!<br>');
                                }
                                else
                                    throw new TypeError('Khoá tài khoản thất bại!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
                            guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Khoá tài khoản', ((maND.length > 1) ? maND.length : 1), 'người dùng');
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