<script>
$(function(){
	try
	{
		/*click button xem nội dung tin nhắn*/
		if($('#table__id__tinNhan').length)
			$('#table__id__tinNhan').on('click', '[data-button="xemTinNhan"]', function(){
	            try
	            {
	            	$('#h2__id__tieuDeFormTN').text('NHẬT KÝ TIN NHẮN VỚI ... ');
	            	$('#button__id__lamMoi').attr('data-button-command', 'xem');
	            	$('#button__id__lamMoi').trigger('click');
	            	/*lấy dữ liệu từ server đỗ lên*/
       				// $('#div__id__danhSachNNDC').prepend('<div class="row marginTop7px hovergray" data-div-tenNguoiNhanDC="' + $(this).attr('data-button-tenNguoiNhan') + '" data-div-maNguoiNhanDC="' + $(this).attr('data-button-maNguoiNhan') + '">\
	       			// 		<div class="col-sm-2 col-md-2 col-xs-2">\
	       			// 			<span class="user-profile"><img src="' + $(this).attr('data-button-srcImg') + '" alt="Profile Image" class="widthHeight50"/></span>\
	       			// 		</div>\
	       			// 		<div class="col-sm-8 col-md-8 col-xs-8">\
	       			// 			<label class="marginTop15">' + $(this).attr('data-button-maNguoiNhan') + '/ ' + $(this).attr('data-button-tenNguoiNhan') + '</label>\
	       			// 		</div>\
       				// 	</div>');
		            $('#div__id__formTinNhan').slideDown(800);
		            $('html, body').animate({
		                scrollTop: $("#div__id__formTinNhan").offset().top
		            }, 800);
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