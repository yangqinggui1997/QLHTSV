<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bases\can_bo_giang_vien;
use App\Models\Bases\phong_ban;

class QLCBGVController extends Controller
{
   	public function getDanhSach()
    {
    	try 
    	{
            $dsCB = can_bo_giang_vien::orderBy('hoTen', 'ASC')->get();
            $dsCanBo = array();
            $canBo = NULL;
            $dsPhong = phong_ban::orderBy('tenPhong', 'ASC')->get();
            foreach($dsCanBo as $cb)
            {
            	$canBo = new \stdClass();
	            $canBo->idCB = $cb->idCB;
	            $canBo->hoTen = $cb->hoTen;
	            $canBo->classTT = (($cb->canBoGiangVienNguoiDung->nguoiDung->trangThai === 'dang_nhap') ? ' online' : '');
				$canBo->anh = ($cb->anh ? 'resources/images/avatars/anhcanbo/'.$cb->anh : 'resources/images/avatars/user.png');
				$canBo->hoTen = $cb->hoTen;
				$canBo->gioiTinh = ($cb->gioiTinh ? 'Nam' : 'Nữ');
				$canBo->soDienThoai = $cb->SDT;
				$can->email = $cb->email;
				$canBo->hocVi = \comm_functions::decodeHocVi($cb->hocVi);
				$canBo->chuyenMon = \comm_functions::decodeChuyenMon($cb->chuyenMon);
				$canBo->nghiepVu =  (($cb->nghiepVu === 'giang_day') ? 'Giảng dạy' : 'Hành chính');
				$canBo->giangDay = (($cb->nghiepVu === 'giang_day') ? TRUE : FALSE);
				$dsCanBo[] = $canBo;
            }
            
            return view('admin.hanh_chinh.ql_can_bo_giang_vien', ['dsCB' => $dsCanBo, 'dsPhong' => $dsPhong]);
    	} 
    	catch (\Exception $ex)
    	{
    		$err = $ex->getMessage();
    		echo $err;
    	}
    }

    public function postThem(Request $request)
    {
        try
        {
            $k_bm = NULL;
            $maK_BM = \comm_functions::ejectUnicode($request->tenK_BM);
            if(is_bool(strpos(Auth::User()->thaoTac, 'them')))
                return response()->json(array('flag' => TRUE, 'per' => FALSE));
            if($request->type === 'k')
            {
                $k_bm = khoa::where('idKhoa', $maK_BM)->first();
                if($k_bm)
                    throw new \Exception('Khoa đã tồn tại!');
                $k_bm = new khoa;
                $k_bm->idKhoa = $maK_BM;
                $k_bm->tenKhoa = $request->tenK_BM;
            }
            else
            {
                $k_bm = phong_ban::where('idPhong', $maK_BM)->first();
                if($k_bm)
                    throw new \Exception('Bộ môn đã tồn tại!');
                $k_bm = new phong_ban;
                $k_bm->idKhoa = $request->maKhoa;
                $k_bm->idPhong = $maK_BM;
                $k_bm->tenPhong = $request->tenK_BM;
            }
            DB::transaction(function()use($k_bm){$k_bm->save();}, 3);
            return response()->json(array('flag' => TRUE, 'maK_BM' => $maK_BM, 'per' => TRUE));
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
            $k_bm = NULL;
            $kbm = NULL;
            $maK_BM = \comm_functions::ejectUnicode($request->tenK_BM);
            if(is_bool(strpos(Auth::User()->thaoTac, 'sua')))
                return response()->json(array('flag' => TRUE, 'per' => FALSE));
            if($request->type === 'k')
            {
                $k_bm = khoa::where('idKhoa', $request->maK_BM)->first();
                $kbm = $k_bm;
                if(!$kbm)
                	throw new \Exception("Khoa không tồn tại!");
                else
                {
                    $kbm = khoa::where('idKhoa', $maK_BM)->first();
                    if($kbm)
                        if($kbm->idKhoa !== $maK_BM)
                            throw new \Exception("Khoa đã tồn tại!");
                    $k_bm->idKhoa = $maK_BM;
                    $k_bm->tenKhoa = $request->tenK_BM;
                    DB::transaction(function()use($k_bm){$k_bm->save();}, 3);
                }
            }
            else
            {
                $k_bm = phong_ban::where('idPhong', $request->maK_BM)->first();
                $kbm = $k_bm;
                if(!$kbm)
                	throw new \Exception("Bộ môn không tồn tại!");
                else
                {
                    $kbm = phong_ban::where('idPhong', $maK_BM)->first();
                    if($kbm)
                        if($kbm->idPhong !== $maK_BM)
                            throw new \Exception("Bộ môn đã tồn tại!");
                    $k_bm->idPhong = $maK_BM;
                    $k_bm->tenPhong = $request->tenK_BM;
                    DB::transaction(function()use($k_bm){$k_bm->save();}, 3);
                }
            }
            return response()->json(array('flag' => TRUE, 'maK_BM' => $maK_BM, 'per' => TRUE));
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
        try 
        {
            $k_bm = NULL;
            $dsMaK_BM = NULL;
            $dsXoaTB = NULL;
            $dsXoaTBSTR = '';
            $dsXoaTC = NULL;
            $dsTenK_BM = NULL;
            $dsTenXoaTC = NULL;
            $i = 0;
            $c = 0;
            if(is_bool(strpos(Auth::User()->thaoTac, 'xoa')))
                return response()->json(array('flag' => TRUE, 'per' => FALSE));
            if(strpos($request->maK_BM, ','))
            {
                $dsMaK_BM = explode(',', $request->maK_BM);
                $dsTenK_BM = explode(',', $request->dsTenK_BM);
                $dsXoaTB = array();
                $dsXoaTC = array();
                $dsTenXoaTC = array();
                if($request->type === 'k')
	                for($i = 0; $i < count($dsMaK_BM); ++$i)
                    {
                        $k_bm = khoa::where('idKhoa', $dsMaK_BM[$i])->first();
                        if(!$k_bm)
                            $dsXoaTB[] = $dsTenK_BM[$i];
                        else
                        {
                            $dsXoaTC[] = $dsMaK_BM[$i];
                            $dsTenXoaTC[] = $dsTenK_BM[$i];
                            DB::transaction(function()use($k_bm){$k_bm->delete();}, 3);
                        }
                    }
	            else
	                for($i = 0; $i < count($dsMaK_BM); ++$i)
                    {
                        $k_bm = phong_ban::where('idPhong', $dsMaK_BM[$i])->first();
                        if(!$k_bm)
                            $dsXoaTB[] = $dsTenK_BM[$i];
                        else
                        {
                            DB::transaction(function()use($k_bm){$k_bm->delete();}, 3);
                            $dsXoaTC[] = $dsMaK_BM[$i];
                            $dsTenXoaTC[] = $dsTenK_BM[$i];
                        }
                    }
                $c = count($dsXoaTB);
                if($c)
                    for($i = 0; $i < $c; ++$i)
                        $dsXoaTBSTR .= ($dsXoaTBSTR ? (($c - 1 === $i) ? ' và '.$dsXoaTB[$i] : ', '.$dsXoaTB[$i]) : $dsXoaTB[$i]);
            }
            else if($request->type === 'k')
            {
                $k_bm = khoa::where('idKhoa', $request->maK_BM)->first();
                if(!$k_bm)
                	throw new \Exception("Khoa không tồn tại!");
	            DB::transaction(function()use($k_bm){$k_bm->delete();}, 3);
            }
            else
            {
                $k_bm = phong_ban::where('idPhong', $request->maK_BM)->first();
                if(!$k_bm)
                	throw new \Exception("Bộ môn không tồn tại!");
	            DB::transaction(function()use($k_bm){$k_bm->delete();}, 3);
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

    public function postLayDSBM(Request $request)
    {
        try 
        {
            $dsBM = array();
            $bm = NULL;
            $tbm = NULL;
            $dsctdt = NULL;
            $cb = NULL;
            $ctdt = NULL;
            $_ctdt = array();
            $cth = array();
            $_dsBM = phong_ban::where('idKhoa', $request->maKhoa)->select('idPhong', 'tenPhong', 'created_at')->orderBy('created_at', 'DESC')->get();
            foreach($_dsBM as $_bm)
            {
                $bm =  new \stdClass();
                $bm->maBM = $_bm->idPhong;
                $bm->tenBM = $_bm->tenPhong;
                $cb = DB::select('CALL qlk_bm__get_truong_bm(?)', [$_bm->idPhong]);
                $tbm = NULL;
                $cth = array();
                if(count($cb))
                {
                	$tbm = new \stdClass();
	                $tbm->ten = $cb[0]->hoTen;
	                $tbm->anh = $cb[0]->anh;
                    $tbm->classTT = ((can_bo_giang_vien::where('idCB', $cb[0]->idCB)->first()->canBoGiangVienNguoiDung->nguoiDung->trangThai === 'dang_nhap') ? TRUE : FALSE);
                }
                $bm->truongBM = $tbm;
                $bm->soLuongCB = DB::select('SELECT qlk_bm__get_sl_cb_bm(?) AS SLCB', [$_bm->idPhong])[0]->SLCB;
                $dsctdt = DB::select('CALL qlk_bm__get_ctdt_bm(?)', [$_bm->idPhong]);
                foreach($dsctdt as $i => $_cth)
                {
                	$_ctdt[] = $_cth->tenCTDT;
                	if($i && $dsctdt[$i]->heDaoTao !== $dsctdt[$i - 1]->heDaoTao)
                	{
                		$ctdt = new \stdClass();
                		$ctdt->hdt = $dsctdt[$i - 1]->heDaoTao;
                		$ctdt->_ctdt = $_ctdt;
                		$cth[] = $ctdt;
		                $_ctdt = array();
                	}
                	else if($i === count($dsctdt))
                	{
                		$ctdt = new \stdClass();
                		$ctdt->hdt = $_cth->heDaoTao;
                		$ctdt->_ctdt = $_ctdt;
                		$cth[] = $ctdt;
		                $_ctdt = array();
                	}
                }
                $bm->ctdt = (count($cth) ? $cth : NULL);
                $dsBM[] = $bm;
            }
            return response()->json(array('flag' => TRUE, 'dsBM' => $dsBM));
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

    public function postLayDSCB(Request $request)
    {
        try
        {
            $dsCB = array();
            $_dsCB = NULL;
            $cb = NULL;
            $dsCV = NULL;
            $cv = '';
            $_cv = '';
            $i = 0;
            $c = 0;
            if($request->type === 'k')
            	$_dsCB = DB::select('CALL qlk_bm__get_ds_cb_k(?)', [$request->maK_BM]);
            else
            	$_dsCB = can_bo_giang_vien::where('idPhong', $request->maK_BM)->orderBy('hoTen', 'ASC')->get();
            foreach($_dsCB as $_cb)
            {
            	$cb = new \stdClass();
            	$cb->maCB = $_cb->idCB;
            	$cb->tenCB = $_cb->hoTen;
            	$cb->anh = $_cb->anh;
                $cv = '';
                $dsCV = explode('|', $_cb->chucVu);
                $c = count($dsCV);
                if($c)
                    for($i = 0; $i < $c; ++$i)
                    {
                        $_cv = $dsCV[$i];
                        if($_cv !== 'khong_co')
                        {
                            $_cv = \comm_functions::decodeCV($_cv);
                            $cv .= ($cv ? (($c - 1 === $i) ? ' và '.$_cv: ', '.$_cv) : $_cv);
                        }
                    }
            	$cb->cv = ($cv ? $cv : NULL);
            	$cb->gt = ($_cb->gioiTinh ? 'Nam' : 'Nữ');
            	$cb->sdt = $_cb->SDT;
            	$cb->email = $_cb->email;
            	$cb->nghiepVu = ($_cb->nghiepVu === 'hanh_chinh' ? 'Hành chính' : 'Giảng dạy');
            	$cb->hocVi = \comm_functions::decodeHocVi($_cb->hocVi);
            	$cb->chuyenMon = \comm_functions::decodeChuyenMon($_cb->chuyenMon);
                $cb->classTT = ($_cb instanceof \stdClass ? ((can_bo_giang_vien::where('idCB', $_cb->idCB)->first()->canBoGiangVienNguoiDung->nguoiDung->trangThai === 'dang_nhap') ? TRUE : FALSE) : ($_cb->canBoGiangVienNguoiDung->nguoiDung->trangThai === 'dang_nhap' ? TRUE : FALSE));
            	$dsCB[] = $cb;
            }
            return response()->json(array('flag' => TRUE, 'dsCB' => $dsCB));
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
