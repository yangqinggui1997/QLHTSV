<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Bases\thong_bao;

class HomeController extends Controller
{
    private static function gioiThieuSV($sv)
    {
        $relsult = 'Sinh viên '.$sv->sinhVienNguoiDung->sinhVien->hoTen;
        foreach($sv->lopNguoiDung as $lnd)
            if($lnd->idLop)
            {
                $relsult .= ' - Khoa '.$lnd->lop->chuongTrinhDaoTao->phongBan->khoa->tenKhoa.' - Bộ môn '.$lnd->lop->chuongTrinhDaoTao->phongBan->tenPhong.' - Lớp '.$lnd->lop->idLop;
                break;
            }
        return $relsult;
    }

    public function getIndex()
    {
        try 
        {
            $list = NULL;
            $tb = NULL;
            $dsTB = array();
            $dsBMF = NULL;
            $dsVB = NULL;
            $dsBMXML = NULL;
            $_nguoiDung = NULL;
            $_dsTB = thong_bao::orderBy('created_at', 'DESC')->get();
            foreach($_dsTB as $_tb)
            {
                $dsBMF = array();
                $dsVB =  array();
                $dsBMXML = array();
                $tb = new \stdClass();
                $tb->ngayTao = date('h:i A', strtotime($_tb->created_at)).', '.date('d/m/Y', strtotime($_tb->created_at));
                $tb->tieuDe = $_tb->tieuDe;
                $tb->noiDung = $_tb->noiDung;
                foreach($_tb->thongBaoBieuMauDangFile as $bmdf)
                {
                    $list = new \stdClass();
                    $list->tenBM = $bmdf->bieuMauDangFile->tieuDe;
                    $list->file = $bmdf->bieuMauDangFile->file;
                    $dsBMF[] = $list;
                }
                foreach($_tb->thongBaoBieuMauDangXML as $bmdxml)
                {
                    $list = new \stdClass();
                    $list->idBM = $bmdxml->idBM;
                    $list->tieuDe = $bmdxml->bieuMauDangXml->tieuDe;
                    $dsBMXML[] = $list;
                }
                foreach($_tb->thongBaoVanBan as $vb)
                {
                    $list = new \stdClass();
                    $list->tenVB = $vb->vanBan->tieuDe;
                    $list->file = $vb->vanBan->file;
                    $dsVB[] = $list;
                }
                $_nguoiDung = new \stdClass();
                $_nguoiDung->classTT = (($_tb->nguoiDung->trangThai === 'dang_nhap') ? ' online' : '');
                $_nguoiDung->anh = ($_tb->nguoiDung->canBoGiangVienNguoiDung ? ($_tb->nguoiDung->canBoGiangVienNguoiDung->canBoGiangVien ? ($_tb->nguoiDung->canBoGiangVienNguoiDung->canBoGiangVien->anh ? (file_exists('resources/images/avatars/anhcanbo/'.$_tb->nguoiDung->canBoGiangVienNguoiDung->canBoGiangVien->anh) ? 'resources/images/avatars/anhcanbo/'.$_tb->nguoiDung->canBoGiangVienNguoiDung->canBoGiangVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : ($_tb->nguoiDung->sinhVienNguoiDung ? ($_tb->nguoiDung->sinhVienNguoiDung->sinhVien ? ($_tb->nguoiDung->sinhVienNguoiDung->sinhVien->anh ? (file_exists('resources/images/avatars/anhsinhvien/'.$_tb->nguoiDung->sinhVienNguoiDung->sinhVien->anh) ? 'resources/images/avatars/anhsinhvien/'.$_tb->nguoiDung->sinhVienNguoiDung->sinhVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png'));
                $_nguoiDung->gioiThieu = (($_tb->nguoiDung->idQuyen !== 'admin' && $_tb->nguoiDung->idQuyen !== 'master') ? ($_tb->nguoiDung->canBoGiangVienNguoiDung ? ('Giảng viên '.$_tb->nguoiDung->canBoGiangVienNguoiDung->canBoGiangVien->hoTen.' - Khoa '.$_tb->nguoiDung->canBoGiangVienNguoiDung->canBoGiangVien->phongBan->khoa->tenKhoa.' - Bộ môn '.$_tb->nguoiDung->canBoGiangVienNguoiDung->canBoGiangVien->phongBan->tenPhong) : HomeController::gioiThieuSV($_tb->nguoiDung)) : 'Quản trị viên');
                $tb->fileBM = $dsBMF;
                $tb->fileVB = $dsVB;
                $tb->bieuMauXML = $dsBMXML;
                $tb->nguoiDung = $_nguoiDung;
                $dsTB[] = $tb;
            }
        	return view("admin.index", ['dsTB' => $dsTB]);
        }
        catch (\Exception $ex)
        {
            $err = $ex->getMessage();
            // return redirect('/')->with('loi', $err);
            echo $err.'<br>'.$ex->getLine();
        }
    }
    
    public function getCapNhatTK()
    {
    	return view("cap_nhat_tai_khoan");
    }

    public function postCapNhatTK(Request $request)
    {
        try 
        {
        	$file = NULL;
        	$duoi = NULL;
        	$name = NULL;
        	$url = '';
        	$hinh = NULL;
        	$cb_sv = NULL;
        	$fileNameOld = '';
        	$user = User::where('idUser', Auth::user()->idUser)->get()->first();
        	if(!$user)
        		throw new \Exception('Người dùng không tồn tại!');
                  redirect('/');
        	if($request->hasFile('avatar'))
        	{
        		$file=$request->file('avatar');
                $duoi=$file->getClientOriginalExtension();
                if($duoi!='jpeg' && $duoi != 'jpg' && $duoi != 'png' && $duoi != 'svg')
                    return view('cap_nhat_tai_khoan', ['loi' => 'Không hỗ trợ kiểu file! Các kiểu hỗ trợ là png, jpg, jpeg và svg.']);
                else
                {
                    $name=$file->getClientOriginalName();
                    $hinh=Str::random(4)."_".$name;
                    $url = ($user->canBoGiangVienNguoiDung ? 'resources/images/avatars/anhcanbo/' : 'resources/images/avatars/anhsinhvien/');
                    $fileNameOld = ($user->canBoGiangVienNguoiDung ? ($user->canBoGiangVienNguoiDung->canBoGiangVien->anh ? $user->canBoGiangVienNguoiDung->canBoGiangVien->anh : NULL) : ($user->sinhVienNguoiDung->sinhVien->anh ? $user->sinhVienNguoiDung->sinhVien->anh : NULL));
                    $cb_sv = ($user->canBoGiangVienNguoiDung ? $user->canBoGiangVienNguoiDung->canBoGiangVien : $user->sinhVienNguoiDung->sinhVien);
                    while(file_exists($url.$hinh)){
                        $hinh=Str::random(4)."_".$name;
                    }
                    if($fileNameOld)
    	                if(file_exists($url.$fileNameOld)){
    	                    unlink($url.$fileNameOld);
    	                }
                    
                    $file->move($url,$hinh);
                    $cb_sv->anh=$hinh;//cập nhật file mới
                    DB::transaction(function()use($cb_sv){$cb_sv->save();}, 3);
                }
        	}
        	return view("cap_nhat_tai_khoan",['tc' => 'Cập nhật thành công!']);
        }
        catch (\Exception $ex)
        {
            $err = $ex->getMessage();
            return redirect('/tai_khoan_ca_nhan')->with('loi', $err);
        }
    }
}
