<script>
$(function(){
	try
	{
		var tbyND = $('#tbody__id__nguoiDung');
		function getListFileBMAsString(list, type, maTB, _tdTB)
		{
			var str = '';
			if(list.length === 1)
				return '<li><a ' + (type === 'xml' ? 'href="javascript:void(0)" data-a-idBMXML="' + list[0].id + '" data-a-tenTB="' + _tdTB + '" data-a-maTB="' + maTB + '"' : ('target="_blank" href="resources/files/' + list[0].name)) + '">' + list[0].name + (type === 'xml' ? ' (Dạng XML)' : ' (Dạng File)') + '</a></li>';
			$.each(list, function(i, v){
				str += '<li><a ' + (type === 'xml' ? 'href="javascript:void(0)" data-a-idBMXML="' + v.id + '" data-a-tenTB="' + _tdTB + '" data-a-maTB="' + maTB + '"' : ('target="_blank" href="resources/files/' + v.name)) + '">' + v.name + (type === 'xml' ? ' (Dạng XML)' : ' (Dạng File)') + '</a></li>';
			});
			return str;
		}
		function getListFileVBAsString(list, type)
		{
			var str = '';
			if(list.length === 1)
				return '<li><a target="_blank" href="resources/files/' + list[0].name + '">' + list[0].name + '</a></li>';
			$.each(list, function(i, v){
				str += '<li><a target="_blank" href="resources/files/' + v.name + '">' + v.name + '</a></li>';
			});
			return str;
		}
		/*click button xem danh sách thông báo*/
		if(tbyND.length)
			tbyND.on('click', '[data-button-id="xemDSTB"]', function(){
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
	            		url: 'admin/quan_ly_thong_bao_nguoi_dung/lay_danh_sach_thong_bao',
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
        						var bieuMauFile = null;
        						var bieuMauXML = null;
        						var vanBan = null;
        						var item = null;
        						var _maTB = null;
        						var _tdTB = null;
        						var deferr = null;
	            				var deferrs = [];
	            				var tblTB = $('#table__id__thongBao');
        						var dsTB = $('#div__id__danhSachTB');
	            				var btnNews = null;
        						if(data.flag)
        						{
        							deferr = $.Deferred();
        							deferrs.push(deferr.promise());
        							tblTB.dataTable().fnClearTable();
        							deferr.resolve();
							        $.when.apply($, deferrs).then(function(){
							        	deferr = $.Deferred();
							        	deferrs = [];
	        							deferrs.push(deferr.promise());
							        	tblTB.dataTable().fnSort([1, 'desc']);
	        							for(; i < data.dsTB.length; i++)
	        							{
	        								item = data.dsTB[i];
	        								_maTB = item.maTB;
	        								_tdTB = item.tieuDeTB;
	        								bieuMauFile = item.noiDungDK.bieuMauFile;
	        								bieuMauXml = item.noiDungDK.bieuMauXml;
	        								vanBan = item.noiDungDK.vanBan;
		        							tblTB.dataTable().fnAddData(['<input type="checkbox" data-checkbox-maTB="' + _maTB + '" data-checkbox-tb="c" data-checkbox-tieuDeTB="' +  _tdTB +'">', (i + 1), _tdTB, item.noiDung, ((!bieuMauFile.length && !bieuMauXml.length && !vanBan.length) ? 'Không có' : ((bieuMauFile.length && !bieuMauXml.length && !vanBan.length) ? ((bieuMauFile.length === 1) ? '<a target="_blank" href="resources/files/' + bieuMauFile[0].name + '">' + bieuMauFile[0].name + ' (Dạng File)</a>' : '<ul class="nav chmenu">\
												  <li>\
												  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Biểu mẫu (' + bieuMauFile.length + ')</a>\
												    <ul class="nav _child_menu" style="display:none;">\
												      ' + getListFileBMAsString(bieuMauFile, 'file') + '\
												    </ul>\
												  </li>\
												</ul>') : ((!bieuMauFile.length && bieuMauXml.length && !vanBan.length) ? ((bieuMauXml.length === 1) ? '<a href="javascript:void(0)" data-a-idBMXML="' + bieuMauXml[0].id + '" data-a-tenTB="' + _tdTB + '" data-a-maTB="' + _maTB + '">' + bieuMauXml[0].name + ' (Dạng XML)</a>' : '<ul class="nav chmenu">\
												  <li>\
												  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Biểu mẫu (' + bieuMauXml.length + ')</a>\
												    <ul class="nav _child_menu" style="display:none;">\
												      ' + getListFileBMAsString(bieuMauXml, 'xml', _maTB, _tdTB) + '\
												    </ul>\
												  </li>\
												</ul>') : ((!bieuMauFile.length && !bieuMauXml.length && vanBan.length) ? ((vanBan.length === 1) ? '<a target="_blank" href="resources/files/' + vanBan[0].name + '">' + vanBan[0].name + ' (Văn bản)</a>' : '<ul class="nav chmenu">\
													  <li>\
													  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Văn bản (' + vanBan.length + ')</a>\
													    <ul class="nav _child_menu" style="display:none;">\
													      ' + getListFileVBAsString(vanBan) + '\
													    </ul>\
													  </li>\
													</ul>') : ((bieuMauFile.length && bieuMauXml.length && !vanBan.length) ? '<ul class="nav chmenu">\
													<li>\
													  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Biểu mẫu (' + (bieuMauFile.length + bieuMauXml.length) + ')</a>\
													    <ul class="nav _child_menu" style="display:none;">\
													      ' + getListFileBMAsString(bieuMauFile, 'file') + '\
													      ' + getListFileBMAsString(bieuMauXml, 'xml', _maTB, _tdTB) + '\
													    </ul>\
													  </li>\
													</ul>' : ((bieuMauFile.length && !bieuMauXml.length && vanBan.length) ? ('<ul class="nav chmenu">\
														  <li>\
														  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Biểu mẫu (' + bieuMauFile.length + ')</a>\
														    <ul class="nav _child_menu" style="display:none;">\
														      ' + getListFileBMAsString(bieuMauFile, 'file') + '\
														    </ul>\
														  </li>\
														</ul>' + '<ul class="nav chmenu">\
													  <li>\
													  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Văn bản (' + vanBan.length + ')</a>\
													    <ul class="nav _child_menu" style="display:none;">\
													      ' + getListFileVBAsString(vanBan) + '\
													    </ul>\
													  </li>\
													</ul>') : ((!bieuMauFile.length && bieuMauXml.length && vanBan.length) ? ('<ul class="nav chmenu">\
														  <li>\
														  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Biểu mẫu (' + bieuMauXml.length + ')</a>\
														    <ul class="nav _child_menu" style="display:none;">\
														      ' + getListFileBMAsString(bieuMauXml, 'xml', _maTB, _tdTB) + '\
														    </ul>\
														  </li>\
														</ul>' + '<ul class="nav chmenu">\
													  <li>\
													  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Văn bản (' + vanBan.length + ')</a>\
													    <ul class="nav _child_menu" style="display:none;">\
													      ' + getListFileVBAsString(vanBan) + '\
													    </ul>\
													  </li>\
													</ul>') : ('<ul class="nav chmenu">\
													  <li>\
													  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Biểu mẫu (' + (bieuMauFile.length + bieuMauXml.length) + ')</a>\
													    <ul class="nav _child_menu" style="display:none;">\
													      ' + getListFileBMAsString(bieuMauFile, 'file') + '\
													      ' + getListFileBMAsString(bieuMauXml, 'xml', _maTB, _tdTB) + '\
													    </ul>\
													  </li>\
													</ul>'
													+
													'<ul class="nav chmenu">\
												  <li>\
												  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Văn bản (' + vanBan.length + ')</a>\
												    <ul class="nav _child_menu" style="display:none;">\
												      ' + getListFileVBAsString(vanBan) + '\
												    </ul>\
												  </li>\
												</ul>')))))))), '<div class="btn-group">\
						                            <button class="btn btn-sm  btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá thông báo" data-button-id="xoa" data-button-new="' + _maTB + '" data-button-maTB="' + _maTB + '" data-button-tieuDeTB="' +  _tdTB +'"><i class="glyphicon glyphicon-trash"></i></button>\
				                          	</div>']);
	        								$('[data-checkbox-maTB="' + _maTB + '"]').closest('td').attr('data-th-td', '');
			            					btnNews = $('[data-button-new="' + _maTB + '"]');
								            btnNews.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
								            btnNews.removeAttr('data-button-new');
										}
										deferr.resolve();
	        							$.when.apply($, deferrs).then(function(){
								            tblTB.dataTable().fnSort([1, 'asc']);
	        							});
									});
                                    $('#h2__id__tieuDeDSTB').text('DANH SÁCH THÔNG BÁO CỦA NGƯỜI DÙNG [' + tenND.toUpperCase() + ']');
                                    $('[data-checkbox-tb="p"]').prop('checked', false);
        							if($('#p__id__chonBanGhi').length)
        								$('#div__id__div_button_thongBao_parent_4').remove();
						            dsTB.slideDown(800);
									$('html, body').animate({
						                scrollTop: dsTB.offset().top
						            }, 800);
        						}
        						else
        							throw new TypeError('Không thể lấy danh sách thông báo của người dùng!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Lấy danh sách thông báo của', 1, 'người dùng');
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