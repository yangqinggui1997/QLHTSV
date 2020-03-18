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
						sortElementTable('table__id__nguoiDung', 'nguoiDung', [[0,"asc"]], [{orderable:!1,targets:[8]}], false, true, 0, true);
						sortElementTable('table__id__thongBao', 'thongBao', [[1,"asc"]], [{orderable:!1,targets:[0]}, {orderable:!1,targets:[5]}], false, true, 0, true);
					}
					@else
					{
						sortElementTable('table__id__nguoiDung', 'nguoiDung', [[0,"asc"]], [{orderable:!1,targets:[8]}], false, false, 0, true);
						sortElementTable('table__id__thongBao', 'thongBao', [[1,"asc"]], [{orderable:!1,targets:[0]}, {orderable:!1,targets:[5]}], false, false, 0, true);
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