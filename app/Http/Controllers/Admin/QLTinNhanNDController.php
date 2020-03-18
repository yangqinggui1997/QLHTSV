<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use App\Models\Bases\tin_nhan;
use App\Models\Bases\can_bo_giang_vien;
use App\Models\Bases\sinh_vien;
use App\Models\Others\Db_Views\Admin\ql_nguoi_dung\qlnd__get_dsnd_is_not_master;
use App\Models\Others\Db_Views\Admin\ql_nguoi_dung\qlnd__get_dsnd_is_not_admin_and_master;

class QLTinNhanNDController extends Controller
{
    public function getDanhSach()
    {
    	try 
    	{
            $_danhSachND = array();
            $danhSachND = NULL;
            $nd = NULL;
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
                $nd->dangNhapLC = date('h:i:s A', strtotime($_nd->dangNhapLC)).'<br>'.date('d/m/Y', strtotime($_nd->dangNhapLC));
                $nd->soLanDN = $_nd->soLanDangNhap;
                $nd->classTT = (($_nd->trangThai === 'dang_nhap') ? ' online' : '');
                $nd->trangThai = (($_nd->trangThai === 'dang_xuat') ? 'Đăng xuất' : (($_nd->trangThai === 'dang_nhap') ? 'Đăng nhập' : 'Bị khoá'));
                $nd->anh = ($_nd->canBoGiangVienNguoiDung ? ($_nd->canBoGiangVienNguoiDung->canBoGiangVien ? ($_nd->canBoGiangVienNguoiDung->canBoGiangVien->anh ? (file_exists('resources/images/avatars/anhcanbo/'.$_nd->canBoGiangVienNguoiDung->canBoGiangVien->anh) ? 'resources/images/avatars/anhcanbo/'.$_nd->canBoGiangVienNguoiDung->canBoGiangVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : ($_nd->sinhVienNguoiDung ? ($_nd->sinhVienNguoiDung->sinhVien ? ($_nd->sinhVienNguoiDung->sinhVien->anh ? (file_exists('resources/images/avatars/anhsinhvien/'.$_nd->sinhVienNguoiDung->sinhVien->anh) ? 'resources/images/avatars/anhsinhvien/'.$_nd->sinhVienNguoiDung->sinhVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png'));
                $nd->quyen = $_nd->quyenHanUser->tenQH;
                $_danhSachND[] = $nd;
            }
            return view('admin.he_thong.ql_tin_nhan_nguoi_dung', ['danhSachND' => $_danhSachND]);
    	} 
    	catch (\Exception $ex)
    	{
    		$err = $ex->getMessage();
    		return redirect('/')->with('loi', $err);
    	}
    }

    public function postXoa(Request $request)
    {
        try 
        {
            $tn = NULL;
            $dsXoaTB = NULL;
            $dsXoaTBSTR = '';
            $dsXoaTC = NULL;
            $dsTenXoaTC = NULL;
            $dsTenNN = NULL;
            $dsNN = NULL;
            $i = 0;
            $c = 0;
            if(is_bool(strpos(Auth::User()->thaoTac, 'xoa')))
                return response()->json(array('flag' => TRUE, 'per' => FALSE));
            if($request->maTN)
            {
                $tn = tin_nhan::where('idTN', $request->maTN)->first();
                if(!$tn)
                    throw new \Exception('Tin nhắn không tồn tại!');
                DB::transaction(function()use($tn){$tn->delete();}, 3);
                return response()->json(array('flag' => TRUE));
            }
            else if(strpos($request->maNN, ','))
            {
                $dsNN = explode(',', $request->maNN);
                $dsTenNN = explode(',', $request->dsTenNN);
                $dsXoaTC = array();
                $dsXoaTB = array();
                $dsTenXoaTC = array();
                for(; $i < count($dsNN); ++$i)
                {
                    $tn = tin_nhan::where([['idUserGui', $request->maNG], ['idUserNhan', $dsNN[$i]]])->orWhere([['idUserGui', $dsNN[$i]], ['idUserNhan', $request->maNG]])->get();
                    if(!count($tn))
                        $dsXoaTB[] = $dsTenNN[$i];
                    else
                    {
                        $dsXoaTC[] = $dsNN[$i];
                        $dsTenXoaTC[] = $dsTenNN[$i];
                        foreach($tn as $_tn)
                            DB::transaction(function()use($_tn){$_tn->delete();}, 3);
                    }
                }
                $c = count($dsXoaTB);
                if($c)
                    for($i = 0; $i < $c; ++$i)
                        $dsXoaTBSTR .= ($dsXoaTBSTR ? (($c - 1 === $i) ? ' và '.$dsXoaTB[$i] : ', '.$dsXoaTB[$i]) : $dsXoaTB[$i]);
            }
            else
            {
                $tn = tin_nhan::where([['idUserGui', $request->maNG], ['idUserNhan', $request->maNN]])->orWhere([['idUserGui', $request->maNN], ['idUserNhan', $request->maNG]])->get();
                if(!count($tn))
                    throw new \Exception('Không tồn tại một tin nhắn nào giữa hai người dùng!');
                foreach($tn as $_tn)
                    DB::transaction(function()use($_tn){$_tn->delete();}, 3);
            }
            return response()->json(array('flag' => ($dsXoaTBSTR ? FALSE : TRUE), 'dsXoaTC' => ($dsXoaTBSTR ? $dsXoaTC : NULL), 'dsXoaTB' => ($dsXoaTBSTR ? $dsXoaTBSTR : NULL), 'dsTenXoaTC' => ($dsXoaTBSTR ? $dsTenXoaTC : NULL), 'per' => TRUE));
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

    public function postLayDanhSachLH(Request $request)
    {
        try 
        {
            $nn = NULL;
            $dsNN = array();
            $dsTmp = DB::select('CALL qltn__get_ds_lh(?)', [$request->maND]);
            $tmp = NULL;
            $cb_sv = NULL;
            $user = NULL;
            $tngn = NULL;
            $tndt = NULL;
            $date1 = NULL;
            $date2 = NULL;
            $diff = NULL;
            $dstng = NULL;
            $dstnn = NULL;
            foreach($dsTmp as $_nn)
            {
                $tmp = can_bo_giang_vien::where('idCB', $_nn->maNN)->first();
                $cb_sv = $tmp ? $tmp : sinh_vien::where('idSV', $_nn->maNN)->first();
                if($cb_sv)
                {
                    $user = User::where('idUser', $_nn->maNN)->first();
                    $dstng = tin_nhan::select('created_at')->where([['idUserGui', $request->maND], ['idUserNhan', $_nn->maNN]])->orderBy('created_at', 'ASC')->get();
                    $tndt = $dstng->first();
                    $tngn = tin_nhan::select('created_at')->where([['idUserGui', $request->maND], ['idUserNhan', $_nn->maNN]])->orderBy('created_at', 'DESC')->first();
                    $dstnn = tin_nhan::select('created_at')->where([['idUserGui', $_nn->maNN], ['idUserNhan', $request->maND]])->orderBy('created_at', 'ASC')->get();
                    if(!$tndt && !$tngn)
                    {
                        $tndt = tin_nhan::select('created_at')->where([['idUserGui', $_nn->maNN], ['idUserNhan', $request->maND]])->orderBy('created_at', 'ASC')->first();
                        $tngn = tin_nhan::select('created_at')->where([['idUserGui', $_nn->maNN], ['idUserNhan', $request->maND]])->orderBy('created_at', 'DESC')->first();
                    }
                    if($user && $tndt && $tngn)
                    {
                        $nn = new \stdClass();
                        $nn->maNN = $_nn->maNN;
                        $nn->tenNN = $cb_sv->hoTen;
                        $nn->anh = ($cb_sv->canBoGiangVienNguoiDung ? ($cb_sv->anh ? (file_exists('resources/images/avatars/anhcanbo/'.$cb_sv->anh) ? 'resources/images/avatars/anhcanbo/'.$cb_sv->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : (file_exists('resources/images/avatars/anhsinhvien/'.$cb_sv->anh) ? 'resources/images/avatars/anhsinhvien/'.$cb_sv->anh : 'resources/images/avatars/user.png'));
                        $nn->classTT = ($cb_sv->canBoGiangVienNguoiDung ? ($cb_sv->canBoGiangVienNguoiDung->nguoiDung->trangThai === 'dang_nhap' ? TRUE : FALSE) : ($cb_sv->sinhVienNguoiDung->nguoiDung->trangThai === 'dang_nhap' ? TRUE : FALSE));
                        $nn->thoiGianBatDauTT = date('h:i:s A', strtotime($tndt->created_at)).'<br>'.date('d/m/Y', strtotime($tndt->created_at));
                        $nn->thoiGianTTGN = date('h:i:s A', strtotime($tngn->created_at)).'<br>'.date('d/m/Y', strtotime($tngn->created_at));
                        $date1 = new \DateTime($tndt->created_at);
                        $date2 = new \DateTime($tngn->created_at);
                        $diff = $date1->diff($date2);
                        $nn->tongTGTT = ($diff->y ? $diff->y.' năm ' : '').($diff->m ? $diff->m.' tháng ' : '').($diff->d ? $diff->d.' ngày ' : '').($diff->h ? $diff->h.' giờ ' : '').($diff->i ? $diff->i.' phút ' : '').($diff->s ? $diff->s.' giây ' : '1 giây');
                        $nn->trangThaiNN = ($user->trangThai === 'dang_nhap' ? 'Đăng nhập' : ($user->trangThai === 'dang_xuat' ? 'Đăng xuất' : 'Bị khoá tài khoản'));
                        $nn->loaiNN = $user->quyenHanUser->tenQH;
                        $nn->tslg = count($dstng);
                        $nn->tsln = count($dstnn);
                        $dsNN[] = $nn;
                    }
                }
            }
            return response()->json(array('flag' => TRUE, 'dsNN' => $dsNN));
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

    public function postXemNoiDungTT(Request $request)
    {
        try
        {
            $user = User::where('idUser', $request->maNN)->first();
            $dsTN = tin_nhan::where([['idUserGui', $request->maNG], ['idUserNhan', $request->maNN]])->orWhere([['idUserGui', $request->maNN], ['idUserNhan', $request->maNG]])->orderBy('created_at', 'ASC')->get();
            $messages = array();
            $ms = NULL;
            $dsFile = NULL;
            if(!$user)
                throw new \Exception('Người trò truyện không tồn tại!');
            foreach($dsTN as $tn)
            {
                $ms = new \stdClass();
                $ms->type = ($tn->idUserGui === $request->maNG ? 'send' : 'receive');
                $ms->maTN = $tn->idTN;
                $ms->noiDung = $tn->noiDung;
                if(count($tn->fileCuaTinNhan))
                {
                    $dsFile = array();
                    foreach($tn->fileCuaTinNhan as $_file)
                        $dsFile[] = $_file->file;
                    $ms->files = $dsFile;
                }
                else 
                    $ms->files = NULL;
                $ms->timeSendOrRecieve = date('h:i:s A', strtotime($tn->created_at)).', '.date('d/m/Y', strtotime($tn->created_at));
                $messages[] = $ms;
            }
            return response()->json(array('flag' => TRUE, 'messages' => $messages, 'ttnn' => ($user->trangThai === 'dang_nhap' ? TRUE : FALSE)));
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
}