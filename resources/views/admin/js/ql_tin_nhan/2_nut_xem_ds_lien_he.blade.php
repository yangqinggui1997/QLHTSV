<script>
$(function(){
	try
	{
		var tbyND = $('#tbody__id__nguoiDung');
		/*click button xem danh sách liên hệ*/
		if(tbyND.length)
			tbyND.on('click', '[data-button-id="xemDSND"]', function(){
	            try
	            {
	            	var $this = $(this);
	            	var maND = $this.attr('data-button-maND');
	            	var tenND = $this.attr('data-button-tenND');
	            	var formData = new FormData();
	            	formData.append('_token', $('#_token').attr('content'));
	            	formData.append('maND', maND);
	            	$.ajax({
	            		type: 'POST',
	            		dataType: 'JSON',
	            		url: 'admin/quan_ly_tin_nhan_nguoi_dung/lay_danh_sach_lien_he',
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
        						var item = null;
        						var _maNN = null;
        						var _tenNN = null;
        						var chkNN = null;
        						var divDSNN = null;
        						var deferr = null;
	            				var deferrs = [];
	            				var tblTN = $('#table__id__tinNhan');
	            				var td = null;
	            				var btnNews = null;
	            				var chkP = $('[data-checkbox-tn="p"]');
        						if(data.flag)
        						{
        							deferr = $.Deferred();
        							deferrs.push(deferr.promise());
        							tblTN.dataTable().fnClearTable();
        							deferr.resolve();
							        $.when.apply($, deferrs).then(function(){
							        	deferr = $.Deferred();
							        	deferrs = [];
	        							deferrs.push(deferr.promise());
							        	tblTN.dataTable().fnSort([1, 'desc']);
	        							for(; i < data.dsNN.length; i++){
	        								item = data.dsNN[i];
	        								_maNN = item.maNN;
	        								_tenNN = item.tenNN;
		        							tblTN.dataTable().fnAddData(['<input type="checkbox" data-checkbox-maNG="' + maND + '" data-checkbox-maNN="' + _maNN + '" data-checkbox-tn="c" data-checkbox-tenNN="' + _tenNN +'">', (i + 1), '<a href="javascript:void(0)">\
										        		<label>\
										        			<div class="avatar-wrap' + (item.classTT ? ' online' : '') + '">\
				                                                <div class="avatarTiny avatar-tiny">\
													        		<img data-img-maNN="' + _maNN + '" src="' + item.anh + '" alt="Ảnh người dùng">\
				                                                </div>\
				                                            </div>\
										        		</label>\
										        		<br>\
										        		<span style="line-height: unset;margin-top:2px">' + _tenNN + '<br>(' + item.loaiNN + ')</span>\
										        	</a>', item.thoiGianBatDauTT, item.thoiGianTTGN, item.tongTGTT, item.tslg, item.tsln, item.trangThaiNN, '<div class="btn-group">\
							                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem nội dung cuộc trò chuyện" data-button-id="xemTinNhan" data-button-new="' + _maNN + '" data-button-maNN="' + _maNN + '" data-button-tenNN="' + _tenNN + '" data-button-maNG="' + maND + '" data-button-tenNG="' + tenND + '"><i class="fa fa-envelope-o"></i></button>\
							                            <button class="btn btn-sm  btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-id="xoa" data-button-new="' + _maNN + '" data-button-maNN="' + _maNN + '" data-button-tenNN="' + _tenNN + '" data-button-maNG="' + maND + '" data-button-tenNG="' + tenND + '"><i class="glyphicon glyphicon-trash"></i></button>\
						                          	</div>']);
		        							chkNN = $('[data-checkbox-maNN="' + _maNN + '"]');
	        								chkNN.closest('td').attr('data-th-td', '');
			            					td = chkNN.closest('tr').children();
			            					td.eq(1).addClass('text-center');
			            					td.eq(2).addClass('text-center');
			            					td.eq(3).addClass('text-center');
			            					td.eq(4).addClass('text-center');
			            					td.eq(5).addClass('text-center');
			            					td.eq(6).addClass('text-center');
			            					td.eq(7).addClass('text-center');
			            					td.eq(8).addClass('text-center');
			            					btnNews = $('[data-button-new="' + _maNN + '"]');
								            btnNews.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
								            btnNews.removeAttr('data-button-new');
										}
										deferr.resolve();
	        							$.when.apply($, deferrs).then(function(){
								            tblTN.dataTable().fnSort([1, 'asc']);
	        							});
									});
									divDSNN = $("#div__id__danhSachNguoiNhan");
                                    $('#h2__id__danhSachNguoiNhan').text('DANH SÁCH LIÊN HỆ CỦA NGƯỜI DÙNG [' + tenND.toUpperCase() + ']');
                                    chkP.prop('checked', false);
                                    chkP.attr('data-checkbox-tenNG', tenND);
        							if($('#p__id__chonBanGhi').length)
        								$('#div__id__div_button_tinNhan_parent_4').remove();
						            divDSNN.slideDown(800);
									$('html, body').animate({
						                scrollTop: divDSNN.offset().top
						            }, 800);
        						}
        						else
        							throw new TypeError('Không thể lấy danh sách liên hệ của người dùng!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Lấy danh sách liên hệ của', 1, 'người dùng');
            			}
	            	});
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