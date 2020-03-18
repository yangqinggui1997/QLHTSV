<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use App\Models\Bases\can_bo_giang_vien;
use App\Models\Bases\sinh_vien;
use App\Models\Relations\can_bo_giang_vien__nguoi_dung;
use App\Models\Relations\sinh_vien__nguoi_dung;
use App\Models\Users\Admin\quyen_han_user;
use App\Models\Others\Db_Views\Admin\ql_nguoi_dung\qlnd__get_dsnd_is_not_master;
use App\Models\Others\Db_Views\Admin\ql_nguoi_dung\qlnd__get_dsnd_is_not_admin_and_master;
use App\Models\Others\Db_Views\Admin\ql_nguoi_dung\qlnd__get_ds_can_bo;
use App\Models\Others\Db_Views\Admin\ql_nguoi_dung\qlnd__get_dssv;

class UserController extends Controller
{
    public function getDanhSach()
    {
    	try 
    	{
            $_danhSachND = array();
            $danhSachND = NULL;
            $nd = NULL;
            $danhSachSV = qlnd__get_dssv::orderBy('gioiTinh', 'DESC')->get();
            $danhSachCB = qlnd__get_ds_can_bo::orderBy('nghiepVu', 'ASC')->orderBy('created_at', 'DESC')->get();
            $user = Auth::user();
            if($user->idQuyen === 'master')
                $danhSachND = qlnd__get_dsnd_is_not_master::orderBy('idQuyen', 'ASC')->orderBy('dangNhapLC', 'DESC')->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
            else
                $danhSachND = qlnd__get_dsnd_is_not_admin_and_master::orderBy('idQuyen', 'ASC')->orderBy('dangNhapLC', 'DESC')->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
            foreach($danhSachND as $_nd)
            {
                $nd = new \stdClass();
                $nd->maND = $_nd->idUser;
                $nd->tenND = ($_nd->canBoGiangVienNguoiDung ? $_nd->canBoGiangVienNguoiDung->canBoGiangVien->hoTen : $_nd->sinhVienNguoiDung->sinhVien->hoTen);
                $nd->email = $_nd->email;
                $nd->ngayTTK = date('h:i:s A', strtotime($_nd->created_at)).'<br>'.date('d/m/Y', strtotime($_nd->created_at));
                $nd->ngayCN = date('h:i:s A', strtotime($_nd->updated_at)).'<br>'.date('d/m/Y', strtotime($_nd->updated_at));
                $nd->dangNhapLC = date('h:i:s A', strtotime($_nd->dangNhapLC)).'<br>'.date('d/m/Y', strtotime($_nd->dangNhapLC));
                $nd->soLanDN = $_nd->soLanDangNhap;
                $nd->classTT = (($_nd->trangThai === 'dang_nhap') ? ' online' : '');
                $nd->trangThai = (($_nd->trangThai === 'dang_xuat') ? 'Đăng xuất' : (($_nd->trangThai === 'dang_nhap') ? 'Đăng nhập' : 'Bị khoá'));
                $nd->anh = ($_nd->canBoGiangVienNguoiDung ? ($_nd->canBoGiangVienNguoiDung->canBoGiangVien ? ($_nd->canBoGiangVienNguoiDung->canBoGiangVien->anh ? (file_exists('resources/images/avatars/anhcanbo/'.$_nd->canBoGiangVienNguoiDung->canBoGiangVien->anh) ? 'resources/images/avatars/anhcanbo/'.$_nd->canBoGiangVienNguoiDung->canBoGiangVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : ($_nd->sinhVienNguoiDung ? ($_nd->sinhVienNguoiDung->sinhVien ? ($_nd->sinhVienNguoiDung->sinhVien->anh ? (file_exists('resources/images/avatars/anhsinhvien/'.$_nd->sinhVienNguoiDung->sinhVien->anh) ? 'resources/images/avatars/anhsinhvien/'.$_nd->sinhVienNguoiDung->sinhVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png'));
                $nd->quyen = $_nd->quyenHanUser->tenQH;
                $_danhSachND[] = $nd;
            }
            return view('admin.he_thong.ql_nguoi_dung', ['danhSachND' => $_danhSachND, 'danhSachCB' => $danhSachCB, 'danhSachSV' => $danhSachSV]);
    	}
    	catch (\Exception $ex)
    	{
    		$err = $ex->getMessage();
    		return redirect('/')->with('loi', $err);
    	}
    }

    public function postThem(Request $request)
    {
        try
        {
            $user = new User;
            $cb_cv__nd = NULL;
            $cb_sv = NULL;
            $anh = '';
            if(is_bool(strpos(Auth::User()->thaoTac, 'them')))
                return response()->json(array('flag' => TRUE, 'per' => FALSE));
            if($request->loaiND === 'cb')
            {
                $cb_sv = can_bo_giang_vien::where('idCB', $request->maND)->first();
                if(!$cb_sv)
                    throw new \Exception('Cán bộ - Giảng viên không tồn tại!');
                $user->idUser = $cb_sv->idCB;
                $user->idQuyen = ($cb_sv->nghiepVu === 'van_phong') ? 'admin' : 'can_bo_giang_vien';
                $user->email = $cb_sv->email;
                $user->password = bcrypt($cb_sv->idCB);
                $user->thaoTac = $request->thaoTac;
                $user->soLanDangNhap = 0;
                if($request->trangThai === 'bi_khoa')
                    $user->trangThai = 'bi_khoa';
                else
                    $user->trangThai = 'dang_xuat';
                $anh = ($user->canBoGiangVienNguoiDung ? ($user->canBoGiangVienNguoiDung->canBoGiangVien->anh ? 'resources/images/avatars/anhcanbo/'.$user->canBoGiangVienNguoiDung->canBoGiangVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png');
                $cb_cv__nd = new can_bo_giang_vien__nguoi_dung;
                $cb_cv__nd->idUser = $cb_sv->idCB;
            }
            else
            {
                $cb_sv = sinh_vien::where('idSV', $request->maND)->first();
                if(!$cb_sv)
                    throw new \Exception('Sinh viên không tồn tại!');
                $user->idUser = $cb_sv->idSV;
                $user->idQuyen = 'sinh_vien';
                $user->email = $cb_sv->email;
                $user->password = bcrypt($cb_sv->idSV);
                $user->thaoTac = $request->thaoTac;
                $user->soLanDangNhap = 0;
                if($request->trangThai === 'bi_khoa')
                    $user->trangThai = 'bi_khoa';
                else
                    $user->trangThai = 'dang_xuat';
                $anh = ($user->sinhVienNguoiDung ? ($user->sinhVienNguoiDung->sinhVien->anh ? 'resources/images/avatars/anhsinhvien/'.$user->sinhVienNguoiDung->sinhVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png');
                $cb_cv__nd = new sinh_vien__nguoi_dung;
                $cb_cv__nd->idUser = $cb_sv->idSV;
            }
            DB::transaction(function()use($user, $cb_cv__nd){
                $user->save();
                $cb_cv__nd->save();
            }, 3);
            return response()->json(array('flag' => TRUE, 'ngayTao' => date('d/m/Y h:i:s A'), 'ngayCapNhat' => date('d/m/Y h:i:s A'), 'dangNhapLC' => date('d/m/Y h:i:s A'), 'anh' => $anh, 'per' => TRUE));
        }
        catch (\Exception $ex)
        {
            $message = $ex->getMessage();
            $line = $ex->getLine();
            $response = array(
                'flag' => FALSE, 
                'error' => array('message' => $message, 'line' => $line)
            );
            return response()->json($response);
        }
    }
    
    public function postCapNhat(Request $request)
    {
        try
        {
            $user = NULL;
            if(is_bool(strpos(Auth::User()->thaoTac, 'sua')))
                return response()->json(array('flag' => TRUE, 'per' => FALSE));
            $user = User::where('idUser', $request->maND)->first();
            if(!$user)
                throw new \Exception('Người dùng không tồn tại!');
            if($user->thaoTac === $request->thaoTac && ($user->trangThai === $request->trangThai || (($user->trangThai === 'dang_xuat' || $user->trangThai === 'dang_nhap') && $request->trangThai === 'tu_do')))
                return response()->json(array('flag' => TRUE, 'kd' => 'kodoi', 'per' => TRUE));
            if($user->trangThai !== $request->trangThai && ($request->trangThai !== 'tu_do' || $user->trangThai === 'bi_khoa'))
                $user->trangThai = ($request->trangThai === 'tu_do' ? 'dang_xuat' : 'bi_khoa');
            if($user->thaoTac !== $request->thaoTac)
                $user->thaoTac = $request->thaoTac;
            DB::transaction(function()use($user){$user->save();}, 3);
            return response()->json(array('flag' => TRUE, 'per' => TRUE));
        }
        catch (\Exception $ex)
        {
            $message = $ex->getMessage();
            $line = $ex->getLine();
            $response = array(
                'flag' => FALSE, 
                'error' => array('message' => $message, 'line' => $line)
            );
            return response()->json($response);
        }
    }

    public function postLayTTCapNhat(Request $request)
    {
        try
        {
            $user = User::where('idUser', $request->maND)->first();
            $cb_sv = NULL;
            if($request->loaiND === 'cb')
            {
                $cb_sv = can_bo_giang_vien::where('idCB', $request->maND)->first();
                if(!$cb_sv || !$user)
                    throw new \Exception('Cán bộ - Giảng viên hoặc tài khoản của họ không tồn tại!');
            }
            else
            {
                $cb_sv = sinh_vien::where('idSV', $request->maND)->first();
                if(!$cb_sv  || !$user)
                    throw new \Exception('Sinh viên hoặc tài khoản của họ không tồn tại!');
            }

            return response()->json(array('flag' => TRUE, 'email' => $cb_sv->email, 'gioiTinh' => ($cb_sv->gioiTinh ? 'Nam' : 'Nữ'), 'nghiepVu' => ($cb_sv->nghiepVu ? ($cb_sv->nghiepVu === 'van_phong' ? 'Văn phòng - Quản trị viên' : 'Giảng dạy') : 'Học tập'), 'quyen' => ($cb_sv->nghiepVu ? ($cb_sv->nghiepVu === 'van_phong' ? 'Quản trị viên' : 'Cán bộ - Giảng viên') : 'Sinh viên'), 'moTa' => ($cb_sv->nghiepVu ? ($cb_sv->nghiepVu === 'van_phong' ? quyen_han_user::where('idQuyen', 'admin')->first()->moTa : quyen_han_user::where('idQuyen', 'can_bo_giang_vien')->first()->moTa) : quyen_han_user::where('idQuyen', 'sinh_vien')->first()->moTa), 'anh' => ($cb_sv->anh ? $cb_sv->anh : NULL), 'trangThai' => (($user->trangThai === 'dang_xuat' || $user->trangThai === 'dang_nhap') ? 'tu_do' : 'bi_khoa'), 'thaoTac' => $user->thaoTac));
        }
        catch (\Exception $ex)
        {
            $message = $ex->getMessage();
            $line = $ex->getLine();
            $response = array(
                'flag' => FALSE, 
                'error' => array('message' => $message, 'line' => $line)
            );
            return response()->json($response);
        }
    }
    
    public function postLayThongTinCBSV(Request $request)
    {
        try
        {
            $cb_sv = NULL;
            if($request->loaiND === 'cb')
            {
                $cb_sv = can_bo_giang_vien::where('idCB', $request->maCBSV)->first();
                if(!$cb_sv)
                    throw new \Exception('Cán bộ - Giảng viên không tồn tại!');
            }
            else
            {
                $cb_sv = sinh_vien::where('idSV', $request->maCBSV)->first();
                if(!$cb_sv)
                    throw new \Exception('Sinh viên không tồn tại!');
            }

            return response()->json(array('flag' => TRUE, 'email' => $cb_sv->email, 'gioiTinh' => ($cb_sv->gioiTinh ? 'Nam' : 'Nữ'), 'nghiepVu' => ($cb_sv->nghiepVu ? ($cb_sv->nghiepVu === 'van_phong' ? 'Văn phòng - Quản trị viên' : 'Giảng dạy') : 'Học tập'), 'quyen' => ($cb_sv->nghiepVu ? ($cb_sv->nghiepVu === 'van_phong' ? 'Quản trị viên' : 'Cán bộ - Giảng viên') : 'Sinh viên'), 'moTa' => ($cb_sv->nghiepVu ? ($cb_sv->nghiepVu === 'van_phong' ? quyen_han_user::where('idQuyen', 'admin')->first()->moTa : quyen_han_user::where('idQuyen', 'can_bo_giang_vien')->first()->moTa) : quyen_han_user::where('idQuyen', 'sinh_vien')->first()->moTa), 'anh' => ($cb_sv->anh ? $cb_sv->anh : NULL)));
        }
        catch (\Exception $ex)
        {
            $message = $ex->getMessage();
            $line = $ex->getLine();
            $response = array(
                'flag' => FALSE, 
                'error' => array('message' => $message, 'line' => $line)
            );
            return response()->json($response);
        }
    }

    private function xoa_khoa_moKhoa(Request $request, $flag = NULL)
    {
        try
        {
            $user = NULL;
            $dsuserId = NULL;
            $dsXoaTB = NULL;
            $dsXoaTBSTR = '';
            $dsXoaTC = NULL;
            $dsTenXoaTC = NULL;
            $dsTenND = NULL;
            $i = 0;
            $c = 0;
            if((($flag === 'khoa' || $flag === 'mkhoa') && is_bool(strpos(Auth::User()->thaoTac, 'sua'))) || (!$flag && is_bool(strpos(Auth::User()->thaoTac, 'xoa')) || Auth::User()->quyen !== 'master'))
                return response()->json(array('flag' => TRUE, 'per' => FALSE));
            if(strpos($request->maND, ','))
            {
                $dsuserId = explode(',', $request->maND);
                $dsTenND = explode(',', $request->dsTenND);
                $dsIdxTC = array();
                $dsXoaTB = array();
                $dsTenXoaTC = array();
                if(!$flag)
                    for($i = 0; $i < count($dsuserId); ++$i)
                    {
                        $user = User::where('idUser', $dsuserId[$i])->first();
                        if(!$user)
                            $dsXoaTB[] = $dsTenND[$i];
                        else
                        {
                            DB::transaction(function()use($user){$user->delete();}, 3);
                            $dsXoaTC[] = $dsuserId[$i];
                            $dsTenXoaTC[] = $dsTenND[$i];
                        }
                    }
                else if($flag === 'khoa')
                    for($i = 0; $i < count($dsuserId); ++$i)
                    {
                        $user = User::where('idUser', $dsuserId[$i])->first();
                        if(!$user)
                            $dsXoaTB[] = $dsTenND[$i];
                        else 
                        {
                            $user->trangThai = 'bi_khoa';
                            DB::transaction(function()use($user){$user->save();}, 3);
                            $dsXoaTC[] = $dsuserId[$i];
                            $dsTenXoaTC[] = $dsTenND[$i];
                        }
                    }
                else
                    for($i = 0; $i < count($dsuserId); ++$i)
                    {
                        $user = User::where('idUser', $dsuserId[$i])->first();
                        if(!$user)
                            $dsXoaTB[] = $dsTenND[$i];
                        else if($user->trangThai === 'bi_khoa')
                        {
                            $user->trangThai = 'dang_xuat';
                            DB::transaction(function()use($user){$user->save();}, 3);
                            $dsXoaTC[] = $dsuserId[$i];
                            $dsTenXoaTC[] = $dsTenND[$i];
                        }
                    }
                $c = count($dsXoaTB);
                if($c)
                    for($i = 0; $i < $c; ++$i)
                        $dsXoaTBSTR .= ($dsXoaTBSTR ? (($c - 1 === $i) ? ' và '.$dsXoaTB[$i] : ', '.$dsXoaTB[$i]) : $dsXoaTB[$i]);
            }
            else
            {
                $user = User::where('idUser', $request->maND)->first();
                if(!$user)
                    throw new \Exception('Người dùng không tồn tại!');
                if(!$flag)
                    DB::transaction(function()use($user){$user->delete();}, 3);
                else if($flag === 'khoa')
                {
                    $user->trangThai = 'bi_khoa';
                    DB::transaction(function()use($user){$user->save();}, 3);
                }
                else if($user->trangThai === 'bi_khoa')
                {
                    $user->trangThai = 'dang_xuat';
                    DB::transaction(function()use($user){$user->save();}, 3);
                }
            }
            if(!$flag)
                return response()->json(array('flag' => ($dsXoaTBSTR ? FALSE : TRUE), 'dsXoaTB' => ($dsXoaTBSTR ? $dsXoaTBSTR : NULL), 'dsXoaTC' => ($dsXoaTBSTR ? $dsXoaTC : NULL), 'dsTenXoaTC' => ($dsXoaTBSTR ? $dsTenXoaTC : NULL), 'per' => TRUE));
            else if($flag === 'khoa')
                return response()->json(array('flag' => ($dsXoaTBSTR ? FALSE : TRUE), 'dsKhoaTB' => ($dsXoaTBSTR ? $dsXoaTBSTR : NULL), 'dsKhoaTC' => ($dsXoaTBSTR ? $dsXoaTC : NULL), 'dsTenKhoaTC' => ($dsXoaTBSTR ? $dsTenXoaTC : NULL), 'per' => TRUE));
            else
                return response()->json(array('flag' => ($dsXoaTBSTR ? FALSE : TRUE), 'dsMKhoaTB' => ($dsXoaTBSTR ? $dsXoaTBSTR : NULL), 'dsMKhoaTC' => ($dsXoaTBSTR ? $dsXoaTC : NULL), 'dsTenMKhoaTC' => ($dsXoaTBSTR ? $dsTenXoaTC : NULL), 'per' => TRUE));
        }
        catch (\Exception $ex)
        {
            $message = $ex->getMessage();
            $line = $ex->getLine();
            $response = array(
                'flag' => FALSE, 
                'error' => array('message' => $message, 'line' => $line)
            );
            return response()->json($response);
        }
    }

    public function postXoa(Request $request)
    {
        return (new UserController)->xoa_khoa_moKhoa($request);
    }

    public function postKhoaTK(Request $request)
    {
        return (new UserController)->xoa_khoa_moKhoa($request, 'khoa');
    }

    public function postMoKhoaTK(Request $request)
    {
        return (new UserController)->xoa_khoa_moKhoa($request, 'mkhoa');
    }
}