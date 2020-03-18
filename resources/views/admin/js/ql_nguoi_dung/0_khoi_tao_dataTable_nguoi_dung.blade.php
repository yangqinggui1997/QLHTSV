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
						sortElementTable('table__id__nguoiDung', 'nguoiDung', [[1,"asc"]], [{orderable:!1,targets:[0]}, {orderable:!1,targets:[10]}], true, true);
					@else
						sortElementTable('table__id__nguoiDung', 'nguoiDung', [[1,"asc"]], [{orderable:!1,targets:[0]}, {orderable:!1,targets:[10]}], true, false);
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