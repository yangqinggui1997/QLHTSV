<?php

namespace App\Events\KhamVaDieuTri;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CanLamSang implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $cls;
    public $thaotac;
    
    public function __construct($cls, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $dttn='BHYT';$htdt='Nội trú';$phongcd='';
            $bn='';$nvcd='';$idba='';
            if(is_object($cls->benhAnNgoaiTru)){
                $bn=$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                
                $idba=$cls->benhAnNgoaiTru->benhAnNgoaiTru->IdBANgoaiT;
                
                $nvcd=$cls->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                
                $htdt='Ngoại trú';
                if($cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
                $pb=$cls->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan;
                $phongcd='Phòng số '.$pb->SoPhong.' - '.$pb->TenPhong;
            }
            else if(is_object($cls->benhAnNoiTruCT)){
                $bn=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                $idba=$cls->benhAnNoiTruCT->benhAnNoiTruCT->IdBACT;
                
                if($cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
                $pb=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan;
                $phongcd='Phòng số '.$pb->SoPhong.' - '.$pb->TenPhong;
                
                $nvcd=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
            }
            
            $ttcls= array(
                'tencls' => $cls->danhMucCLS->TenCLS,//
                'phongth' => $cls->phongBan->SoPhong.' - '.$cls->phongBan->TenPhong,//
                'ngayracd' => \comm_functions::deDateFormat($cls->created_at),//
                'iddmcls' => $cls->danhMucCLS->IdDMCLS,//
                'idcls'=> $cls->IdCLS,//
                'hoten' => $bn->HoTen,//
                'nvcd'=>$nvcd,//
                'idba'=>$idba,//
                'pth'=>'Phòng số '.$cls->phongBan->SoPhong.' - '.$cls->phongBan->TenPhong,//
                'dttn'=>$dttn,//
                'htdt'=>$htdt,//
                'phongcd'=>$phongcd//
                
            );
            $this->cls= $ttcls;$this->thaotac=$thaotac;
        }
        else if($thaotac == 'chuyendv'){
            $bn='';$pk='';$chuandoan='';$nvcd='';$yc=''; $ghichuyc='Không có';$ttbn='';$ktn='';
            if(is_object($cls->benhAnNgoaiTru)){
                $bn=$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                $pk=$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->phongKham;
                $ktn=$pk->Khoa->TenKhoa;
                $i=1;
                foreach ($cls->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan as $cd){
                    if($i == count($cls->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan)){
                        $chuandoan.=$cd->danhMucBenh->TenBenh;
                    }
                    else{
                        $chuandoan.=$cd->danhMucBenh->TenBenh.'|';
                    }
                    $i++;
                }
                $nvcd=$cls->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                $yc=$cls->danhMucCLS->TenCLS;
                if($cls->GhiChu != ''){
                    $ghichuyc=$cls->GhiChu;
                }
                
                if($pk->DTTN=='tinh_tao'){
                    $ttbn='Tỉnh táo';
                }
                else if($pk->DTTN=='hon_me'){
                    $ttbn='Hôn mê';
                }
                else{
                    $ttbn='Hôn mê sâu';
                }
            }
            else if(is_object($cls->benhAnNoiTruCT)){
                $bn=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                $pk=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->phongKham;
                $ktn=$pk->Khoa->TenKhoa;
                $i=1;
                foreach ($cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan as $cd){
                   if($i == count($cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan)){
                        $chuandoan.=$cd->danhMucBenh->TenBenh;
                    }
                    else{
                        $chuandoan.=$cd->danhMucBenh->TenBenh.'|';
                    }
                    $i++;
                }
                
                $nvcd=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                $yc=$cls->danhMucCLS->TenCLS;
                if($cls->GhiChu != ''){
                    $ghichuyc=$cls->GhiChu;
                }
                
                if($pk->DTTN=='tinh_tao'){
                    $ttbn='Tỉnh táo';
                }
                else if($pk->DTTN=='hon_me'){
                    $ttbn='Hôn mê';
                }
                else{
                    $ttbn='Hôn mê sâu';
                }
            }
            
            $ngaysinh=date( "d/m/Y", strtotime($bn->NgaySinh));
            
            $gt="Nam";
            if($bn->GioiTinh == 0){
                $gt="Nữ";
            }
            $scmnd="Chưa cập nhật!";
            if($bn->SoCMND != ''){
                $scmnd=$bn->SoCMND;
            }
            $diachi="";
            if($bn->DiaChi == ''){
                $diachi="Xã ".$bn->phuongXa->TenXa.", huyện ".$bn->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$bn->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            else{
                $diachi=$bn->DiaChi.", xã, ".$bn->phuongXa->TenXa.", huyện ".$bn->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$bn->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            $dantoc ="Chưa cập nhật!";
            if($bn->DanToc != ''){
                $dantoc = \comm_functions::decodeDanToc($bn->DanToc);
            }
            
            $mathe='koco';
            $ngaydk='';$ngayhh='';$noidk='';$doituong='';$mh='';
            if(is_object($bn->theBHYT)){
                $mathe=$bn->theBHYT->IdTheBHYT;
                $ngaydk=date( "d/m/Y", strtotime($bn->theBHYT->NgayDK));
                $ngayhh=date( "d/m/Y", strtotime($bn->theBHYT->NgayHH));
                $doituong=\comm_functions::getDTK($bn->theBHYT->DoiTuongBHYT);
                $noidk=$bn->theBHYT->coSoKhamBHYT->TenCS;
                $mh= \comm_functions::getMucHuongDTK($bn->theBHYT->DoiTuongBHYT).'%';
            }
            //dttn htdt phongcd
            $ttcls= array(
                'idcls'=> $cls->IdCLS,//
                'hoten' => $bn->HoTen,//
                'ngaysinh'=>$ngaysinh,//
                'gt'=>$gt,//
                'idbn'=>$bn->IdBN,//
                'diachi'=>$diachi,//
                'ttbn'=>$ttbn,//
                'nvcd'=>$nvcd,//
                'chuandoan'=>$chuandoan,//
                'ktn'=>$ktn,//
                'yc'=>$yc,//
                'ghichuyc'=>$ghichuyc,//
                'mathe' => $mathe,//
                'ngaydk'=>$ngaydk,//
                'ngayhh'=>$ngayhh,//
                'noidk'=>$noidk,//
                'doituong'=>$doituong,//
                'mh'=>$mh,//
                'scmnd'=>$scmnd,//
                'dantoc'=>$dantoc,//
                'loaicd'=>$cls->LoaiCD,//
                'phong'=>$pk->TenPhong,//
                'idphong'=>$cls->phongBan->IdPB//
                
            );
            $this->cls= $ttcls;$this->thaotac=$thaotac;
        }
        else{
            $this->cls= $cls;$this->thaotac=$thaotac;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('CanLamSang');
    }
}
