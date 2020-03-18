<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Relations\thong_bao__khoa;
use App\Models\Bases\bieu_mau_dang_xml;
use Illuminate\Http\Request;
// use App\Models\CanBo\Admin\lay_nguoi_dung_khac_quan_tri_vien_va_master;ky_thuat_phan_mem
// use App\Models\Users\;
Route::get('/bai_thu_php', function(){
	$ary[] = "ASCII";
$ary[] = "JIS";
$ary[] = "EUC-JP";
$ary[] = "UTF-8";
var_dump(mb_detect_encoding('ào', $ary));
});

Route::post('/bai_thu_js', function(Request $request){
	$bm = new bieu_mau_dang_xml;
	$bm->idUser = Auth::User()->idUser;
	$bm->tieuDe = 'dfd';
	$bm->noiDung = 'dsd';
	$bm->JS = $request->maND;
	$bm->save();
	return response()->json(array('flag'=>TRUE));
});

Route::get('/', "Auth\\LoginController@getDangNhap");

Route::post('/', "Auth\\LoginController@postDangNhap");

Route::get('dang_xuat', "Auth\\LogOutController@getDangXuat");

Route::group(["prefix" => "admin", "middleware" => "UserAdmin"], 
	
	function()
	{
		Route::get("", "Admin\\HomeController@getIndex");

		Route::get("tai_khoan_ca_nhan", "Admin\\HomeController@getCapNhatTK");

		Route::post("tai_khoan_ca_nhan", "Admin\\HomeController@postCapNhatTK");

		Route::group(["prefix" => "quan_ly_nguoi_dung"], 
			
			function()
			{
				Route::get("", "Admin\\UserController@getDanhSach");

				Route::post("them", "Admin\\UserController@postThem");

				Route::post("cap_nhat", "Admin\\UserController@postCapNhat");

				Route::post("lay_tt_cap_nhat", "Admin\\UserController@postLayTTCapNhat");

				Route::post("lay_thong_tin_cb_sv", "Admin\\UserController@postLayThongTinCBSV");
				
				Route::post("xoa", "Admin\\UserController@postXoa");

				Route::post("xem_quyen_ct", "Admin\\UserController@postLayTTCapNhat");

				Route::post("khoa_tk", "Admin\\UserController@postKhoaTK");

				Route::post("mo_khoa_tk", "Admin\\UserController@postMoKhoaTK");
			}
		);

		Route::group(["prefix" => "quan_ly_tin_nhan_nguoi_dung"], 
			
			function()
			{
				Route::get("", "Admin\\QLTinNhanNDController@getDanhSach");

				Route::post("xoa", "Admin\\QLTinNhanNDController@postXoa");

				Route::post("lay_danh_sach_lien_he", "Admin\\QLTinNhanNDController@postLayDanhSachLH");

				Route::post("xem_noi_dung_tt", "Admin\\QLTinNhanNDController@postXemNoiDungTT");
			}
		);
		
		Route::group(["prefix" => "quan_ly_thong_bao_nguoi_dung"], 
			
			function()
			{
				Route::get("", "Admin\\QLThongBaoNDController@getDanhSach");

				Route::post("xoa", "Admin\\QLThongBaoNDController@postXoa");

				Route::post("lay_danh_sach_thong_bao", "Admin\\QLThongBaoNDController@postLayDanhSachTB");

				Route::post("xem_noi_dung_bm_xml", "Admin\\QLThongBaoNDController@postXemNoiDungBMXML");
			}
		);
		
		Route::group(["prefix" => "quan_ly_khoa_vs_bo_mon"], 
			
			function()
			{
				Route::get("", "Admin\\QLKBMController@getDanhSach");

				Route::post("xoa", "Admin\\QLKBMController@postXoa");

				Route::post("them", "Admin\\QLKBMController@postThem");

				Route::post("cap_nhat", "Admin\\QLKBMController@postCapNhat");

				Route::post("lay_danh_sach_bo_mon", "Admin\\QLKBMController@postLayDSBM");

				Route::post("lay_danh_sach_can_bo", "Admin\\QLKBMController@postLayDSCB");
			}
		);

		Route::group(["prefix" => "quan_ly_can_bo__giang_vien"], 
			
			function()
			{
				Route::get("", "Admin\\QLCBGVController@getDanhSach");

				Route::post("xoa", "Admin\\QLCBGVController@postXoa");

				Route::post("them", "Admin\\QLCBGVController@postThem");

				Route::post("cap_nhat", "Admin\\QLCBGVController@postCapNhat");

				Route::post("lay_danh_sach_bo_mon", "Admin\\QLCBGVController@postLayDSBM");

				Route::post("lay_danh_sach_can_bo", "Admin\\QLCBGVController@postLayDSCB");
			}
		);
	}
);

