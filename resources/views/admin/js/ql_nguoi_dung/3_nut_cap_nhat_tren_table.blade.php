<script>
$(function(){
    try
    {
        var tbyND = $('#tbody__id__nguoiDung');
        /*click button cập nhật*/
        if(tbyND.length)
            tbyND.on('click', '[data-button-id="sua"]', function(){
                try
                {
                    var loaiND = '';
                    var $this = $(this);
                    var maND = $this.attr('data-button-maND');
                    var tenND = $this.attr('data-button-tenND');
                    var csrf_token = $('#_token').attr('content');
                    var formData = new FormData();
                    if($this.attr('data-button-maND').toUpperCase().indexOf('CB') >= 0)
                        loaiND = 'cb';
                    else
                        loaiND = 'sv';
                    formData.append('_token', csrf_token);
                    formData.append('maND', maND);
                    formData.append('loaiND', loaiND);
                    $.ajax({
                        type: 'POST',
                        dataType: 'JSON',
                        url: 'admin/quan_ly_nguoi_dung/lay_tt_cap_nhat',
                        xhr: xhrSetting,
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(data)
                        {
                            try
                            {
                                var thaoTac = [];
                                var i = 0;
                                var txtMaCB = $('#textBox__id__maCanBo');
                                var txthdMaCB = $('#hidden__id__maCanBo');
                                var frmND = $('#div__id__formNguoiDung');
                                var line = $('.ln_solid');
                                var btnCN = $('#button__id__capNhat');
                                var btnHuy = $('#button__id__huy');
                                var ul = null;
                                if(data.flag)
                                {
                                    $('#textBox__id__email').val(data.email);
                                    $('#textBox__id__gioiTinh').val(data.gioiTinh);
                                    $('#textBox__id__nghiepVu').val(data.nghiepVu);
                                    $('#textBox__id__quyen').val(data.quyen);
                                    $('#textarea__id__moTa').val(data.moTa);
                                    $('#img__id__anh').attr('src', ((data.anh && loaiND === 'cb') ? 'resources/images/avatars/anhcanbo/' + data.anh : (data.anh ? 'resources/images/avatars/anhsinhvien/' + data.anh : 'resources/images/avatars/user.png')));
                                    $('[data-checkbox-capQuyenCT]').prop('checked', false);
                                    thaoTac = data.thaoTac.split('|');
                                    for(i; i < thaoTac.length; ++i)
                                        switch(thaoTac[i])
                                        {
                                            case 'them':
                                                $('[data-checkbox-code="them"]').prop('checked', true);
                                                break;
                                            case 'xoa':
                                                $('[data-checkbox-code="xoa"]').prop('checked', true);
                                                break;
                                            case 'sua':
                                                $('[data-checkbox-code="capnhat"]').prop('checked', true);
                                                break;
                                            default:
                                                $('[data-checkbox-code="saochep"]').prop('checked', true);
                                                break;
                                        }
                                    if($('[data-checkbox-code]:checked').length === $('[data-checkbox-code]').length)
                                        $('[data-checkbox-pr]').prop('checked', true);
                                    else
                                        $('[data-checkbox-pr]').prop('checked', false);
                                    $('#select__id__trangThai').val(data.trangThai);
                                    txtMaCB.val(maND + ' - ' + tenND);
                                    frmND.find('.alert').remove();
                                    txthdMaCB.val(maND);
                                    txthdMaCB.attr('data-hidden-tenND', tenND);
                                    txtMaCB.attr('readonly','');
                                    line.show();
                                    line.next().show();
                                    btnHuy.attr('data-button-thaoTac', data.thaoTac);
                                    btnHuy.attr('data-button-trangThai', data.trangThai);
                                    btnHuy.attr('data-button-command', 'capnhat');
                                    ul = $('#ul__id__plt');
                                    if(!ul.find('.close-link').length)
                                        ul.prepend('<li><a class="close-link"><i class="fa fa-close"></i></a></li>');
                                    btnCN.attr('data-button-index', $('#table__id__nguoiDung').DataTable().row($this.closest('tr')).index());
                                    btnCN.attr('data-original-title', 'Cập nhật');
                                    btnCN.attr('data-button-command', 'capnhat');
                                    frmND.slideDown(800);
                                    $('html, body').animate({
                                        scrollTop: frmND.offset().top
                                    }, 800);
                                }
                                else
                                    throw new TypeError('Không thể lấy thông tin người dùng!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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