<script>
$(function(){
	try
	{
		/*check input datalist người nhận*/
		function inputDatalist(danhSachArea, danhSach, textBox)
		{
			try
            {
            	var object = textBox;
            	var lengthOfChildShow = 0;
            	if(!object.val().trim())
            	{
            		if(danhSach.children().length)
            		{
            			danhSachArea.css('display', 'block');
            			danhSach.children().css('display', 'block');
            		}
            	}
            	else
	            	danhSach.children().each(function(){
	            		var tenNguoiNhan = $(this).attr('data-div-tenNguoiNhan') ? $(this).attr('data-div-tenNguoiNhan') : $(this).attr('data-div-tenNguoiNhanDC');
	            		var maNguoiNhan = $(this).attr('data-div-maNguoiNhan')  ? $(this).attr('data-div-maNguoiNhan') : $(this).attr('data-div-maNguoiNhanDC');
	            		var i = 0;
	            		var k = 0;
	            		var _i = -1;
	            		var _k = -1;
	            		var countCharCorrect = 0;
	            		var inputText = object.val().trim();
	            		var mix = maNguoiNhan + '/ ' + tenNguoiNhan;
	            		for(i; i < inputText.length; ++i)
	            			for(k; k < mix.length; ++k)
	            				if((inputText[i].toLowerCase() === mix[k].toLowerCase()) && (i - _i === 1) && (k - _k === 1))
	            				{
	            					_i = i;
	            					_k = k;
	            					++k;
	            					++countCharCorrect;
	            					break;
	            				}
	            				else if(!countCharCorrect)
            						_k = k;
	            		if(countCharCorrect === inputText.length)
            			{
	            			danhSachArea.css('display', 'block');
		            		$(this).css('display', 'block');
		            		++lengthOfChildShow;
            			}
            			else
            			{
            				if(!lengthOfChildShow)
            					danhSachArea.css('display', 'none');
            				$(this).css('display', 'none');
            			}
	            	});
	            return true;
            }
            catch(err)
			{
				alert('Lỗi: ' + err.stack + '!');
				return false;
			}
		}

		if($('#textBox__id__nguoiNhan').length)
		{
			$('#textBox__id__nguoiNhan').on('input', function(){
				try
				{
					inputDatalist($('#div__id__danhSachNNArea'), $('#div__id__danhSachNN'), $(this));
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

			$('#textBox__id__nguoiNhan').on('focus', function(){
				try
				{
					$(this).trigger('input');
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

			$('#textBox__id__nguoiNhan').on('blur', function(){
				try
				{
					if($('#div__id__danhSachNN').children().length)
	            	{
						$('#div__id__danhSachNNArea').css('display', 'none');
	            		$('#div__id__danhSachNN').children().css('display', 'none');
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
			
		/*check input datalist người nhận đã chọn*/
		if($('#textBox__id__nguoiNhanDC').length)
		{
			$('#textBox__id__nguoiNhanDC').on('input', function(){
				try
				{
					inputDatalist($('#div__id__danhSachNNDCArea'), $('#div__id__danhSachNNDC'), $(this));
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

			$('#textBox__id__nguoiNhanDC').on('focus', function(){
				try
				{
					$(this).trigger('input');
					return true;
				}
				catch(err)
				{
					alert('Lỗi: ' + err.stack + '!');
					return false;
				}
			});

			$('#textBox__id__nguoiNhanDC').on('blur', function(){
				try
				{
					if($('#div__id__danhSachNNDC').children().length)
	            	{
						$('#div__id__danhSachNNDCArea').css('display', 'none');
	            		$('#div__id__danhSachNNDC').children().css('display', 'none');
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