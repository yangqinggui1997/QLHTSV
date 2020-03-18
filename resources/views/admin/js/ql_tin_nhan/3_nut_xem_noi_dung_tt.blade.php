<script>
$(function(){
	try
	{
		var tbyTN = $('#tbody__id__tinNhan');
		function getFilesNameListAsString(filesName)
		{
			var i = 0;
			var filesNameAsString = '';
			if(filesName.length === 1)
				return '<a target="_blank" href="resources/files/' + filesName[0] + '">' + filesName[0] + '</a>';
			for(; i < filesName.length; ++i)
				filesNameAsString += (filesNameAsString ? ('<br><a target="_blank" href="resources/files/' + filesName[i] + '">' + (i + 1) + '.&nbsp;' + filesName[i] + '</a>') : '<br><a target="_blank" href="resources/files/' + filesName[i] + '">1.&nbsp;' + filesName[i] + '</a>');
			return filesNameAsString;
		}
		/*click button xem nội dung trò chuyện*/
		if(tbyTN.length)
			tbyTN.on('click', '[data-button-id="xemTinNhan"]', function(){
	            try
	            {
	            	var $this = $(this);
	            	var maNG = $this.attr('data-button-maNG');
	            	var maNN = $this.attr('data-button-maNN');
	            	var tenNN = $this.attr('data-button-tenNN');
	            	var tenNG = $this.attr('data-button-tenNG');
	            	var formData = new FormData();
	            	formData.append('_token', $('#_token').attr('content'));
	            	formData.append('maNG', maNG);
	            	formData.append('maNN', maNN);
	            	$.ajax({
	            		type: 'POST',
	            		dataType: 'JSON',
	            		url: 'admin/quan_ly_tin_nhan_nguoi_dung/xem_noi_dung_tt',
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
	            				var j = 0;
	            				var item = null;
	            				var _maTN = null;
	            				var _type = null;
	            				var _files = null;
	            				var frmTN = null;
        						var deferr = null;
	            				var deferrs = [];
	            				var ttnn = null;
	            				var imgAv = $('#img__id__anhNN');
	            				if(data.flag)
        						{
		            				if(data.messages.length)
		            				{
		            					deferr = $.Deferred();
	        							deferrs.push(deferr.promise());
		            					$('#div__id__noiDungTT').html('');
		            					ttnn = (data.ttnn ? ' online' : '');
		            					for(; i < data.messages.length; i++)
			            				{
		            						item = data.messages[i];
		            						_maTN = item.maTN;
		            						_type = item.type;
		            						_files = item.files;
			            					((_type === 'send') ? ($('#div__id__noiDungTT').append('\
		            							<!-- Send message -->\
						        				<div class="row marginBottom20" data-div-maTN="' + _maTN + '">\
						        					<div class="col-md-12 col-sm-12 col-xs-12">\
						        						<div class="row">\
								        					<div class="col-md-12 col-sm-12 col-xs-12">\
								        						<div class="textSend alert-dismissible">\
								        							<button type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-id="xoaTN" data-button-maNG="' + maNG + '" data-button-maNN="' + maNN + '" data-button-maTN="' + _maTN + '" class="close" style="top: -7px;right: -17px;"><span aria-hidden="true">×</span></button>\
								        							<div>' + item.noiDung + '</div>\
								        						</div>\
								        					</div>\
								        				</div>\
								        				' + (_files ? ('<div class="row">\
								        					<div class="col-md-12 col-sm-12 col-xs-12">\
							        							<label class="textSend">Files: ' + getFilesNameListAsString(_files) + '</label>\
								        					</div>\
								        				</div>') : '') + '\
								        				<div class="row">\
								        					<div class="col-md-12 col-sm-12 col-xs-12 timeSend">\
								        						<label>' + item.timeSendOrRecieve + '</label>\
								        					</div>\
								        				</div>\
						        					</div>\
						        				</div>')) : ((_type === data.messages[j].type && i) ? ($('#div__id__noiDungTT').append('\
			            							<!-- Recieve Mesage -->\
							        				<div class="row marginBottom20"  data-div-maTN="' + _maTN + '">\
							        					<div class="row">\
						        							<div class="col-md-1 col-sm-1 col-xs-1"></div>\
								        					<div class="col-md-11 col-sm-11 col-xs-11">\
								        						<div class="textRecieve alert-dismissible">\
								        							<button type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-id="xoaTN" data-button-maNG="' + maNG + '" data-button-maNN="' + maNN + '" data-button-maTN="' + _maTN + '" class="close" style="top: -7px;right: -17px;"><span aria-hidden="true">×</span></button>\
								        							<div>' + item.noiDung + '</div>\
								        						</div>\
								        					</div>\
								        				</div>\
								        				' + (_files ? ('<div class="row">\
								        					<div class="col-md-1 col-sm-1 col-xs-1"></div>\
									        					<div class="col-md-11 col-sm-11 col-xs-11">\
							        							<label class="textRecieve">Files: ' + getFilesNameListAsString(_files) + '</label>\
								        					</div>\
								        				</div>') : '') + '\
								        				<div class="row">\
								        					<div class="col-md-1 col-sm-1 col-xs-1"></div>\
								        					<div class="col-md-11 col-sm-11 col-xs-11">\
								        						<label>' + item.timeSendOrRecieve + '</label>\
								        					</div>\
								        				</div>\
						        					</div>\
						        				</div>')) : ($('#div__id__noiDungTT').append('\
			            							<!-- Recieve Mesage -->\
							        				<div class="row marginBottom20"  data-div-maTN="' + _maTN + '">\
							        					<div class="row">\
						        							<div class="col-md-1 col-sm-1 col-xs-1" style="padding-left: 25px;">\
							        							<div class="avatar-wrap' + ttnn + '">\
				                                                    <div class="avatarTiny avatar-tiny">\
				                                                        <img src="' + $('[data-img-maNN="' + maNN + '"]').attr('src') + '" alt="' + tenNN + '">\
				                                                    </div>\
				                                                </div>\
						        							</div>\
								        					<div class="col-md-11 col-sm-11 col-xs-11">\
								        						<div class="textRecieve alert-dismissible">\
								        							<button type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-id="xoaTN" data-button-maNG="' + maNG + '" data-button-maNN="' + maNN + '" data-button-maTN="' + _maTN + '" class="close" style="top: -7px;right: -17px;"><span aria-hidden="true">×</span></button>\
								        							<div>' + item.noiDung + '</div>\
								        						</div>\
								        					</div>\
								        				</div>\
								        				' + (_files ? ('<div class="row">\
								        					<div class="col-md-1 col-sm-1 col-xs-1"></div>\
									        					<div class="col-md-11 col-sm-11 col-xs-11">\
							        							<label class="textRecieve">Files: ' + getFilesNameListAsString(_files) + '</label>\
								        					</div>\
								        				</div>') : '') + '\
								        				<div class="row">\
								        					<div class="col-md-1 col-sm-1 col-xs-1"></div>\
								        					<div class="col-md-11 col-sm-11 col-xs-11">\
								        						<label>' + item.timeSendOrRecieve + '</label>\
								        					</div>\
								        				</div>\
						        					</div>\
						        				</div>'))));
			            					j = i;
			            				}
			            				deferr.resolve();
								        $.when.apply($, deferrs).then(function(){
								        	$('[data-button-id="xoaTN"]').tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
								        	$('#h2__id__tieuDeFormTN').text('CUỘC TRÒ CHUYỆN GIỮA NGƯỜI DÙNG [' + tenNG.toUpperCase() + '] & [' + tenNN.toUpperCase() + ']');
											imgAv.attr('src', $('[data-img-maNN="' + maNN + '"]').attr('src'));
											if(data.ttnn)
												imgAv.parent().parent().addClass('online');
											else
												imgAv.parent().parent().removeClass('online');
											$('#label__id__tdctt').html('Cuộc trò chuyện với ' + tenNN + ' &nbsp; &bull; &nbsp; ' + $('#table__id__tinNhan').DataTable().row($this.closest('tr')).data()[3]);
											frmTN = $('#div__id__formTinNhan');
											frmTN.attr('data-div-maNN', maNN);
								            frmTN.slideDown(800);
											$('html, body').animate({
								                scrollTop: frmTN.offset().top
								            }, 800);
								        });
		            				}
		            				else
		            					throw new TypeError('Không có nội dung để xem!<br>');
	            				}
        						else
        							throw new TypeError('Không thể lấy nội dung trò chuyện của người dùng!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
            				guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Lấy nội dung trò truyện với', 1, 'người dùng');
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
