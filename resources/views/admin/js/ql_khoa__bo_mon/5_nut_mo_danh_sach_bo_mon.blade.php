<script>
$(function(){
	try
	{
		var tbyKhoa = $('#tbody__id__khoa');
		function getListCTDTAsString(list)
		{
			var str = '';
			if(list.length === 1)
				if(list[0]._ctdt.length === 1)
					return list[0].hdt + list[0]._ctdt[0];
			$.each(list, function(i, v){
				str += '<ul class="nav">\
					<li>\
					<a data-a-ctdt>\
					<span class="fa fa-chevron-down"></span> ' + v.hdt + ' (' + v._ctdt.length + ')\
					</a>\
					<ul class="nav _child_menu">\
					';
				$.each(v._ctdt, function(_i, _v){
					str += '<li><a href="javascript:void(0)">' + _v +'</a></li>';
				});
				str += '\
				    </ul>\
				  </li>\
				</ul>';
			});
			return str;
		}
		/*click button xem danh sách bộ môn*/
		if(tbyKhoa.length)
			tbyKhoa.on('click', '[data-button-id="xemDanhSachBM"]', function(){
				try
	            {
	            	var $this = $(this);
	            	var maKhoa = $this.attr('data-button-maKhoa');
	            	var tenKhoa = $this.attr('data-button-tenKhoa');
	            	var formData = new FormData();
	            	formData.append('_token', $('#_token').attr('content'));
	            	formData.append('maKhoa', maKhoa);
	            	$.ajax({
	            		type: 'POST',
	            		dataType: 'JSON',
	            		url: 'admin/quan_ly_khoa_vs_bo_mon/lay_danh_sach_bo_mon',
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
	            				var divBM = $('#div__id__danhSachBoMon');
	            				var frmBM = $('#div__id__formBoMon');
	            				var chkMaBM = null;
	            				var item = null;
	            				var _maBM = null;
	            				var _tenBM = null;
	            				var tblBM = $('#table__id__boMon');
	            				var deferr = null;
	            				var deferrs = [];
	            				var anh = null;
	            				var btnThemK = $('#button__id__themBM');
	            				var btnNews = null;
        						if(data.flag)
        						{
        							deferr = $.Deferred();
        							deferrs.push(deferr.promise());
        							tblBM.dataTable().fnClearTable();
        							deferr.resolve();
							        $.when.apply($, deferrs).then(function(){
							        	deferr = $.Deferred();
							        	deferrs = [];
	        							deferrs.push(deferr.promise());
							        	tblBM.dataTable().fnSort([1, 'desc']);
						                for(; i < data.dsBM.length; i++)
	        							{
	        								item = data.dsBM[i];
	        								_maBM = item.maBM;
	        								_tenBM = item.tenBM;
	        								anh = (item.truongBM ? item.truongBM.anh : null);
		        							tblBM.dataTable().fnAddData(['<input type="checkbox" data-checkbox-maBM="' + _maBM + '" data-checkbox-tenBM="' +  _tenBM +'" data-checkbox-bm="c">', (i + 1), _tenBM, (item.truongBM ? '<a href="javascript:void(0)" data-a-maBM="' + _maBM + '">\
									        		<label>\
									        			<div class="avatar-wrap' + (item.truongBM.classTT ? ' online' : '') + '">\
			                                                <div class="avatarTiny avatar-tiny">\
												        		<img src="' + (anh ? ('resources/images/avatars/anhcanbo/' + anh) : 'resources/images/avatars/user.png') + '" alt="Ảnh trưởng bộ môn">\
			                                                </div>\
			                                            </div>\
									        		</label>\
									        		<br>\
									        		<span style="line-height: unset;margin-top:2px">' + item.truongBM.ten + '</span>\
									        	</a>' : 'Chưa chỉ định'), item.soLuongCB, (item.ctdt ? getListCTDTAsString(item.ctdt) : 'Chưa có chương trình đào tạo nào'), '<div class="btn-group">\
							                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Sửa" data-button-id="sua" data-button-maBM="' + _maBM + '" data-button-tenBM="' + _tenBM + '" data-button-new="' + _maBM + '"><i class="glyphicon glyphicon-edit"></i></button>\
							                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-id="xoa" data-button-maBM="' + _maBM + '" data-button-tenBM="' + _tenBM + '" data-button-new="' + _maBM + '"><i class="glyphicon glyphicon-trash"></i></button>\
							                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem danh cán bộ" data-button-id="xemDanhSachCB" data-button-maBM="' + _maBM + '" data-button-tenBM="' + _tenBM + '" data-button-new="' + _maBM + '"><i class="fa fa-male"></i></button>\
						                          	</div>']);
		        							chkMaBM = $('[data-checkbox-maBM="' + _maBM + '"]');
	        								chkMaBM.closest('td').attr('data-th-td-bm', '');
			            					chkMaBM.closest('tr').children().eq(3).addClass('text-center');
								            btnNews = $('[data-button-new="' + _maBM + '"]');
								            btnNews.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
								            btnNews.removeAttr('data-button-new');
										}
	        							deferr.resolve();
	        							$.when.apply($, deferrs).then(function(){
								            tblBM.dataTable().fnSort([1, 'asc']);
	        							});
						            });
                                    $('#h2__id__danhSachBoMon').text('DANH SÁCH BỘ MÔN KHOA [' + tenKhoa.toUpperCase() + ']');
                                    btnThemK.attr('data-button-maKhoa', maKhoa);
                                    btnThemK.attr('data-button-tenKhoa', tenKhoa);
                                    $('#button__id__dongDanhSachBM').attr('data-button-maKhoa', maKhoa);
									if(!frmBM.is(':hidden') || !frmBM[0].hasAttribute('hidden'))
        								$('#button__id__huyBM').trigger('click');
        							$('[data-checkbox-bm="p"]').prop('checked', false);
        							if($('#p__id__chonBanGhiBM').length)
        								$('#div__id__div_button_parent_boMon_4').remove();
						            divBM.slideDown(800);
									$('html, body').animate({
						                scrollTop: divBM.offset().top
						            }, 800);
        						}
        						else
        							throw new TypeError('Không thể lấy danh sách bộ môn!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Lấy danh sách bộ môn của', 1, 'khoa');
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