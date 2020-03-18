<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use App\Models\Bases\thong_bao;
use App\Models\Bases\bieu_mau_dang_xml;
use App\Models\Bases\sinh_vien;
use App\Models\Others\Db_Views\Admin\ql_nguoi_dung\qlnd__get_dsnd_is_not_master;
use App\Models\Others\Db_Views\Admin\ql_nguoi_dung\qlnd__get_dsnd_is_not_admin_and_master;

class QLThongBaoNDController extends Controller
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
            return view('admin.he_thong.ql_thong_bao_nguoi_dung', ['danhSachND' => $_danhSachND]);
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
            $tb = NULL;
            $dsXoaTB = NULL;
            $dsXoaTBSTR = '';
            $dsXoaTC = NULL;
            $dsTieuDeTB = NULL;
            $dsTB = NULL;
            $dsTenXoaTC = NULL;
            $i = 0;
            $c = 0;
            if(is_bool(strpos(Auth::User()->thaoTac, 'xoa')))
                return response()->json(array('flag' => TRUE, 'per' => FALSE));
            if(strpos($request->maTB, ','))
            {
                $dsTB = explode(',', $request->maTB);
                $dsTieuDeTB = explode(',', $request->dsTieuDeTB);
                $dsXoaTB = array();
                $dsXoaTC = array();
                $dsTenXoaTC = array();
                for(; $i < count($dsTB); ++$i)
                {
                    $tb = thong_bao::where('idTB', $dsTB[$i])->first();
                    if(!$tb)
                        $dsXoaTB[] = $dsTieuDeTB[$i];
                    else
                    {
                        $dsXoaTC[] = $dsTB[$i];
                        $dsTenXoaTC[] = $dsTieuDeTB[$i];
                        DB::transaction(function()use($tb){$tb->delete();}, 3);
                    }
                }
                $c = count($dsXoaTB);
                if($c)
                    for($i = 0; $i < $c; ++$i)
                        $dsXoaTBSTR .= ($dsXoaTBSTR ? (($c - 1 === $i) ? ' và '.$dsXoaTB[$i] : ', '.$dsXoaTB[$i]) : $dsXoaTB[$i]);
            }
            else
            {
                $tb = thong_bao::where('idTB', $request->maTB)->first();
                if(!$tb)
                    throw new \Exception('Thông báo không tồn tại!');
                DB::transaction(function()use($tb){$tb->delete();}, 3);
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

    public function postLayDanhSachTB(Request $request)
    {
        try 
        {
        	$list = NULL;
        	$nddk = NULL;
            $tb = NULL;
            $dsTB = array();
            $dsBMF = NULL;
            $dsBMXML = NULL;
            $dsVB = NULL;
            $user = User::where('idUSer', $request->maND)->first();
            if(!$user)
            	throw new \Exception('Người dùng không tồn tại!');
            foreach($user->thongBao as $_tb)
            {
            	$dsBMF = array();
            	$dsBMXML = array();
            	$dsVB =  array();
                $tb = new \stdClass();
            	$tb->maTB = $_tb->idTB;
            	$tb->tieuDeTB = $_tb->tieuDe;
            	$tb->noiDung = $_tb->noiDung;
            	foreach($_tb->thongBaoBieuMauDangFile as $bmdf)
            	{
                    $list = new \stdClass();
            		$list->id = $bmdf->idBM;
            		$list->name = $bmdf->bieuMauDangFile->file;
            		$dsBMF[] = $list;
            	}
            	foreach($_tb->thongBaoBieuMauDangXML as $bmdxml)
            	{
                    $list = new \stdClass();
            		$list->id = $bmdxml->idBM;
            		$list->name = $bmdxml->bieuMauDangXml->tieuDe;
            		$dsBMXML[] = $list;
            	}
            	foreach($_tb->thongBaoVanBan as $vb)
            	{
                    $list = new \stdClass();
            		$list->id = $vb->idVB;
            		$list->name = $vb->vanBan->file;
            		$dsVB[] = $list;
            	}
                $nddk = new \stdClass();
            	$nddk->bieuMauFile = $dsBMF;
            	$nddk->bieuMauXml = $dsBMXML;
            	$nddk->vanBan = $dsVB;
            	$tb->noiDungDK = $nddk;
            	$dsTB[] = $tb;
            }
            return response()->json(array('flag' => TRUE, 'dsTB' => $dsTB));
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

    public function postXemNoiDungBMXML(Request $request)
    {
        try
        {
            $bm = bieu_mau_dang_xml::where('idBM', $request->maBM)->first();
            if(!$bm)
            	throw new \Exception("Biểu mẫu không tồn tại!");
            return response()->json(array('flag' => TRUE, 'noiDung' => $bm->noiDung, 'tenBM' => $bm->tieuDe, 'js' => $bm->JS));
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