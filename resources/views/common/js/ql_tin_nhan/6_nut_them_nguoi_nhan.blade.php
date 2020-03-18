<script>
$(function(){
	try
	{
		/*click button thêm người nhận*/
		if($('[data-button-id="button__data-button-id__themNguoiNhan"]').length)
		{
			$('[data-button-id="button__data-button-id__themNguoiNhan"]').on('mousedown', function(){
	            try
	            {
	            	var option = '';
	            	var flagAdd = true;
	            	var object = $(this);
	            	$('#div__id__danhSachNNDC').children().each(function(){
	            		if($(this).attr('data-div-maNguoiNhanDC') === object.attr('data-button-maNguoiNhan'))
	            		{
	            			flagAdd = false;
	            			return false;
	            		}
	            	});
	            	if(flagAdd)
	            	{
	            		option = '<div class="row marginTop7px hovergray" data-div-tenNguoiNhanDC="' + $(this).attr('data-button-tenNguoiNhan') + '" data-div-maNguoiNhanDC="' + $(this).attr('data-button-maNguoiNhan') + '" data-div-newND>\
	       					<div class="col-sm-2 col-md-2 col-xs-2">\
	       						<span class="user-profile"><img src="' + $(this).attr('data-button-srcImg') + '" alt="Profile Image" class="widthHeight50"/></span>\
	       					</div>\
	       					<div class="col-sm-8 col-md-8 col-xs-8">\
	       						<label class="marginTop15">' + $(this).attr('data-button-maNguoiNhan') + '/ ' + $(this).attr('data-button-tenNguoiNhan') + '</label>\
	       					</div>\
	       					<div class="col-sm-2 col-md-2 col-xs-2">\
	       						<button type="button" class="btn btn-sm btn-danger floatRightMT10" data-toggle="tooltip" data-original-title="Xoá người nhận" data-button-id="button__data-button-id__xoaNguoiNhan" data-button-srcImg="' + $(this).attr('data-button-srcImg') + '" data-button-tenNguoiNhanDC="' + $(this).attr('data-button-tenNguoiNhan') + '" data-button-maNguoiNhanDC="' + $(this).attr('data-button-maNguoiNhan') + '">\
	       							<i class="fa fa-remove"></i>\
	       						</button>\
	       					</div>\
	       				</div>';
	       				$('#div__id__danhSachNNDC').prepend(option);
	            	}

		            return true;
	            }
	            catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});
		}

		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>