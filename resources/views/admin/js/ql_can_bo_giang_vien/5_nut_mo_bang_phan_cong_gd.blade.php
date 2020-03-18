<script>
$(function(){
	try
	{
		var tbyCB = $('#tbody__id__canBo');
		function isUpdate(list, maHP)
		{
			var i = 0;
			for(; i < list.length; ++i)
				if(list[i] === maHP)
					return true;
			return false;
		}
		/*click button mở bảng phân công giảng dạy*/
		if(tbyCB.length)
			tbyCB.on('click', '[data-button-id="phanCongGD"]', function(){
				try
	            {
	            	var $this = $(this);
                    var maCB = $this.attr('data-button-maCB');
                    var csrf_token = $('#_token').attr('content');
                    var formData = new FormData();
                    formData.append('_token', csrf_token);
                    formData.append('maCB', maCB);
                    $.ajax({
                        type: 'POST',
                        dataType: 'JSON',
                        url: 'admin/quan_ly_can_bo__giang_vien/lay_ds_pc_gd',
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
                                var tblPCGD = $("#div__id__danhSachHPGD");
                                var def = $.Deferred();
                                var defs = [];
                                var tblData = null;
                                var chk = null;
                                var obj = null;
                                var table = $('#table__id__hocPhanGD');
                                if(data.flag)
                                {
                                    defs.push(def.promise());
                                    tblData = table.DataTable().rows().data();
                                    for(; i < tblData.length; ++i)
                                    {
                                    	obj = $(tblData[i][0]);
                                    	if(obj.prop('checked'))
                                    	{
                                    		chk = obj.attr('checked', false)[0].outerHTML;
                                    		table.dataTable().fnUpdate(chk, i, 0, false, false);
                                    	}
                                    }
                                	def.resolve();
                                	$.when.apply($, defs).then(function()
                                	{
                                		def = $.Deferred();
                                		defs = [];
                                		defs.push(def.promise());
	                                    tblData = table.DataTable().rows().data();
	                                    for(; i < tblData.length; ++i)
	                                    {
	                                    	obj = $(tblData[i][0]);
	                                    	if(isUpdate(data.list, obj.attr('data-checkbox-maHP')))
	                                    	{
	                                    		chk = obj.attr('checked', true)[0].outerHTML;
	                                    		table.dataTable().fnUpdate(chk, i, 0, false, false);
	                                    	}
	                                    }
	                                	def.resolve();
	                                	$.when.apply($, defs).then(function()
	                                	{
		                                    $('#button__id__themHPGD').attr('data-button-maCB', maCB);
		                                    $('#button__id__dongDanhSachHPGD').attr('data-button-listHPGD', data.list.join('|'));
								            tblPCGD.slideDown(800);
											$('html, body').animate({
								                scrollTop: tblPCGD.offset().top
								            }, 800);
	                                	});
                                	});
                                }
                                else
                                    throw new TypeError('Không thể lấy thông tin danh sách phân công giảng dạy!<br>' + data.error.message + '<br>Dòng: ' + data.error.line + '<br>');
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
                            guiYeuCauThatBai(jqXHR, textStatus, errorThrown, 'Lấy thông tin', 1, 'danh sách phân công giảng dạy');
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