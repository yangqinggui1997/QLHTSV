<script>
$(function(){
	try
	{
		if($('#div__id__noiDungBMXML').length)
		{
			/*click nút huỷ thao tác cập nhật hoặc đổi trường / xoá trường*/
			$('#div__id__noiDungBMXML').on('click', '[id*="button__id__xoaTruong_"]', function(){
				try
				{
					var object = null;
					var objectTextBoxTruong = $('#textBox__id__tenTruongBieuMau_' + $(this).attr('data-button-inputNo'));
					var objectLabelTruong = $('#label__id__tenTruongBieuMau_' + $(this).attr('data-button-inputNo'));
					/*click nút xoá trường biểu mẫu*/
					if($(this).attr('data-button-command') === 'xoa')
					{
						object = $(this);
						confirm('Bạn có thực sự muốn xoá trường này?', function(){
							$('#div__id__truongLuu_' + object.attr('data-button-inputNo')).remove();
							if(!$('[data-div-luu="control"]').length)
							{
								$('[data-div-luu="line"]').remove();
								$('[data-div-luu="command"]').remove();
							}
						});
					}
					/*Huỷ cập nhật hoặc đổi trường*/
					else
					{
						if(objectTextBoxTruong.length && objectLabelTruong.length)
						{
							objectTextBoxTruong.val('');
							objectTextBoxTruong.hide();
							objectLabelTruong.show();
						}
						if($(this).attr('data-button-commandDestroy') === 'sua')
						{
							object = $('#button__id__suaTruong_' + $(this).attr('data-button-inputNo'));
							$(object.children()[0]).attr('class', 'fa fa-edit');
							object.attr('data-original-title', 'Sửa trường này');
							object.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							object.attr('data-button-command', 'sua');
							object.removeAttr('data-target');

							object = $('#button__id__doiTruong_' + $(this).attr('data-button-inputNo'));
							if(object.length)
								object.show();
							
							if(typeof $('#button__id__ok').attr('data-button-updateData') !== typeof undefined)
								$('#button__id__ok').removeAttr('data-button-updateData');
						}
						else
						{
							object = $('#button__id__doiTruong_' + $(this).attr('data-button-inputNo'));
							$(object.children()[0]).attr('class', 'fa fa-exchange');
							object.attr('data-original-title', 'Đổi trường khác');
							object.tooltip({trigger: 'manual'}).focus(hideTooltip).blur(hideTooltip).hover(showTooltip, hideTooltip);
							$('#button__id__suaTruong_' + $(this).attr('data-button-inputNo')).show();
							object.attr('data-button-command', "doi");

							$('#div__id__controlArea_' + $(this).attr('data-button-inputNo')).removeClass('text-center');
							$('#div__id__toolBox_' + $(this).attr('data-button-inputNo')).hide();
							$('#' + object.attr('data-button-controlId') + $(this).attr('data-button-inputNo')).show();

							if($('#' + object.attr('data-button-controlLabelId') + $(this).attr('data-button-inputNo')).length)
								$('#' + object.attr('data-button-controlLabelId') + $(this).attr('data-button-inputNo')).show();

							$('[data-label-id="label__data-label-id__toolBoxBM_' + $(this).attr('data-button-inputNo') + '"]').removeClass('active');
							object.removeAttr('data-button-controlName');

							$('[name="radio__name__toolBoxBM_' + $(this).attr('data-button-inputNo') + '"]').prop('checked', false);

							if(typeof $('#button__id__themTruong').attr('data-target') !== typeof undefined)
								$('#button__id__themTruong').removeAttr('data-target');
							
							object = $('#button__id__ok');
							if(typeof object.attr('data-button-controlName') !== typeof undefined)
								object.removeAttr('data-button-controlName');
							if(typeof object.attr('data-button-changeControl') !== typeof undefined)
								object.removeAttr('data-button-changeControl');
							if(typeof object.attr('data-button-controlReplaced') !== typeof undefined)
								object.removeAttr('data-button-controlReplaced');
						}
						$(this).removeAttr('data-button-commandDestroy');
						$(this).attr('data-button-command', 'xoa');
						$('#button__id__xoaTruong_' + $(this).attr('data-button-inputNo')).attr('data-original-title', 'Xoá trường này');
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