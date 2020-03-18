<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="d">ffgd</div>
<!-- jQuery -->
<script src="resources/js/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
// Danh sách người dùng đã chọn
var listUserPick = new Array();
// Thêm user vào list
function a()
{
	
try
	{
		sfsf = listUserP.adsad;
		return true;
	}
		catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
}
function addUserTolist(user)
{
try
	{
		a();
listUserP = {'s':1};
		return true;
	}
		catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
}
// Xoá user vào list
function removeUserFromlist(id)
{
	try
	{
		$.each(listUserPick, function(i,v){
			if(v.id === id)
			{
				listUserPick.splice(i,1);
				return false;
			}
		});
		return listUserPick;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
}
$(function(){
	$('#d').click(function(){
		try
		{listUserP = {'s':1};
			addUserTolist();
			return;
		}
		catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
	});
});
</script>
</body>
</html>