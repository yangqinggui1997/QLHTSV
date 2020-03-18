<script>
$(function(){
	try
	{
		var tbyKhoa = $('#tbody__id__khoa');
		var tbyBM = $('#tbody__id__boMon');
		function layDanhSachCB($this,type)
		{
			var maK_BM = $this.attr('data-button-' + (type === 'k' ? 'maKhoa' : 'maBM'));
        	var tenK_BM = $this.attr('data-button-' + (type === 'k' ? 'tenKhoa' : 'tenBM'));
        	var formData = new FormData();
        	formData.append('_token', $('#_token').attr('content'));
        	formData.append('maK_BM', maK_BM);
        	formData.append('type', (type === 'k' ? type : 'bm'));
        	$.ajax({
        		type: 'POST',
        		dataType: 'JSON',
        		url: 'admin/quan_ly_khoa_vs_bo_mon/lay_danh_sach_can_bo',
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
        				var divDSCB = $('#div__id__danhSachCanBo');
        				var item = null;
        				var _maCB = null;
        				var _cv = null;
        				var tblCB = $('#table__id__canBo');
        				var deferr = null;
        				var deferrs = [];
        				var anh = null;
						if(data.flag)
						{
							deferr = $.Deferred();
							deferrs.push(deferr.promise());
							tblCB.dataTable().fnClearTable();
							deferr.resolve();
					        $.when.apply($, deferrs).then(function(){
								for(; i < data.dsCB.length; i++)
								{
									item = data.dsCB[i];
									_maCB = item.maCB;
									_cv = item.cv;
									anh = item.anh;
	    							tblCB.dataTable().fnAddData([(i + 1), _maCB, '<a href="javascript:void(0)" data-a-maCB="' + _maCB + '">\
							        		<label>\
							        			<div class="avatar-wrap' + (item.classTT ? ' online' : '') + '">\
	                                                <div class="avatarTiny avatar-tiny">\
										        		<img src="' + (anh ? ('resources/images/avatars/anhcanbo/' + anh) : 'resources/images/avatars/user.png') + '" alt="Ảnh cán bộ">\
	                                                </div>\
	                                            </div>\
							        		</label>\
							        		<br>\
							        		<span style="line-height: unset;margin-top:2px">' + item.tenCB + (_cv ? ('<br>(' + _cv + ')') : '') + '</span>\
							        	</a>', item.gt, item.sdt, item.email, item.hocVi, item.chuyenMon, item.nghiepVu]);
	            					$('[data-a-maCB="' + _maCB + '"]').closest('td').addClass('text-center');
								}
							});
                            $('#h2__id__danhSachCanBo').text('DANH SÁCH CÁN BỘ CỦA ' + (type === 'k' ? 'KHOA' : 'BỘ MÔN') + ' [' + tenK_BM.toUpperCase() + ']');
                            if(type === 'k')
                            	divDSCB.attr('data-div-dsk', maK_BM);
                        	else
                        	{
                            	divDSCB.attr('data-div-dsk', $('#button__id__themBM').attr('data-button-maKhoa'));
                            	divDSCB.attr('data-div-dsbm', maK_BM);
                            }
				            divDSCB.slideDown(800);
							$('html, body').animate({
				                scrollTop: $('html').offset().top
				            }, 800);
						}
						else
							throw new TypeError('Không thể lấy danh sách cán bộ của ' + (type === 'k' ? 'khoa' : 'bộ môn') + '!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
    				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Lấy danh sách cán bộ của', 1, (type === 'k' ? 'khoa' : 'bộ môn'));
    			}
        	});
		}
		/*click button xem danh sách cán bộ của bộ môn*/
		if(tbyBM.length)
			tbyBM.on('click', '[data-button-id="xemDanhSachCB"]', function(){
				try
				{
					layDanhSachCB($(this), 'bm');
		            return true;
				}
	            catch(err)
				{
					alert("Lỗi: " + err.stack + "!");
					return false;
				}
			});

		/*click button xem danh sách cán bộ của khoa*/
		if(tbyKhoa.length)
			tbyKhoa.on('click', '[data-button-id="xemDanhSachCBK"]', function(){
				try
				{
					layDanhSachCB($(this), 'k');
		            return true;
				}
	            catch(err)
				{
					alert("Lỗi: " + err.stack + "!");
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