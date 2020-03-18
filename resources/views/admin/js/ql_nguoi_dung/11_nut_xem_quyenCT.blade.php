<script>
$(function(){
    try
    {
        var tbyND = $('#tbody__id__nguoiDung');
        /*click button xem quyền chi tiết*/
        if(tbyND.length)
            tbyND.on('click', '[data-button-id="xemQuyenCT"]', function(){
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
                        url: 'admin/quan_ly_nguoi_dung/xem_quyen_ct',
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
                                var txtMaCB = $('#textBox__id__maCanBo');
                                var txthdMaCB = $('#hidden__id__maCanBo');
                                var frmND = $('#div__id__formNguoiDung');
                                var i = 0;
                                var line = $('.ln_solid');
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
                                    txtMaCB.attr('readonly','');
                                    txtMaCB.val(maND + ' - ' + tenND);
                                    txthdMaCB.val(maND);
                                    txthdMaCB.attr('data-hidden-tenND', tenND);
                                    line.hide();
                                    line.next().hide();
                                    if(!$('#ul__id__plt').find('.close-link').length)
                                        $('#ul__id__plt').prepend('<li><a class="close-link"><i class="fa fa-close"></i></a></li>');
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