<script>
$(function(){
	try
	{
		var tbyND = $('#tbody__id__nguoiDung');
		/*click button xoá*/
		if(tbyND.length)
			tbyND.on('click', '[data-button-id="xoa"]', function(){
	            try
	            {
	            	var $this = $(this);
		            confirm('Bạn có thực sự muốn xoá tài khoản của người dùng ' + $this.attr('data-button-tenND') + '?', function(){
                              var maND = $this.attr('data-button-maND');
		            	var formData = new FormData();
            			formData.append('_token', $('#_token').attr('content'));
            			formData.append('maND', maND);
            			$.ajax({
            				type: 'POST',
            				dataType: 'JSON',
            				url: 'admin/quan_ly_nguoi_dung/xoa',
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
            						var dsNDCheck = null;
            						var btnParent4 = $('#div__id__div_button_parent_4');
            						var lbtn = 0;
                                                var _length = 0;
            						if(data.flag)
            						{
                                                      if(!data.per)
                                                      {
                                                          alert('Bạn không có quyền xoá!');
                                                          return false;
                                                      }
                                                      if((!divND.is(':hidden') || !divND[0].hasAttribute('hidden')) && $('#hidden__id__maCanBo').val() === maND)
                                                            divND.css('display', 'none');
                                                      $('#datalist__id__maCanBo').append('<option data-option-loaiND="' + ((maND.toUpperCase().indexOf('CB') >= 0) ? 'cb' : 'sv') + '" value="' + maND + '">' + $this.attr('data-button-tenND') + '</option>');
                                                      table.dataTable().fnDeleteRow(table.DataTable().row($this.closest('tr')).index());
                                                      reOrderRecords(table, 1);
                                                      dsNDCheck = getLengthChkCheck(table, 0);
                                                      lbtn = btnParent4.length;
                                                      if(lbtn && dsNDCheck)
                                                      {
                                                            $('#p__id__chonBanGhi').text('Có ' + dsNDCheck + ' người dùng được chọn.');
                                                            $('#button__id__xoaNhieuNguoiDung').attr('data-original-title', 'Xoá ' + (dsNDCheck > 1 ? 'các ' : '') + 'người dùng đã chọn');
                                                      }
                                                      else if(lbtn)
                                                      {
                                                            btnParent4.remove();
                                                      }
                                                      _length = table.DataTable().rows().indexes().length;
                                                      if(dsNDCheck != _length || !_length)
                                                          $('[data-checkbox-user="p"]').prop('checked', false);
                                                      alert('Xoá thành công!');
            						}
            						else
            							throw new TypeError('Xoá thất bại!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
	            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Xoá', 1, 'người dùng');
	            			}
            			});
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