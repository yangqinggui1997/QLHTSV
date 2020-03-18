<script>
$(function() {
	try
	{
		/*Định nghĩa hàm khởi tạo bảng*/
		function init_DataTables(){
			try
			{
				if(console.log("run_datatables"),"undefined"!=typeof $.fn.DataTable)
				{
					@if(!is_bool(strpos($nd->thaoTac, 'saochep')))
					{
						sortElementTable('table__id__khoa', 'khoa', [[1,"asc"]], [{orderable:!1,targets:[0]}, {orderable:!1,targets:[6]}], true, true, 0, true);
						sortElementTable('table__id__boMon', 'boMon', [[1,"asc"]], [{orderable:!1,targets:[0]}, {orderable:!1,targets:[6]}], true, true, 0, true);
						sortElementTable('table__id__canBo', 'canBo', [], [{orderable:!1,targets:[2]}], false, true, 0, true);
					}
					@else
					{
						sortElementTable('table__id__khoa', 'khoa', [[1,"asc"]], [{orderable:!1,targets:[0]}, {orderable:!1,targets:[6]}], true, false, 0, true);
						sortElementTable('table__id__boMon', 'boMon', [[1,"asc"]], [{orderable:!1,targets:[0]}, {orderable:!1,targets:[6]}], true, false, 0, true);
						sortElementTable('table__id__canBo', 'canBo', [], [{orderable:!1,targets:[2]}], false, false, 0, true);
					}
					@endif
	    			return true;
    			}
				return false;
			}
			catch(err)
			{
				alert('Lỗi: ' + err.stack + '!');
				return false;
			}
		}
		/*Khởi tạo bảng chứa dữ liệu*/
		init_DataTables();
		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>