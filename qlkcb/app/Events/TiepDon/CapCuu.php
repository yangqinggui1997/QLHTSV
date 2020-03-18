<?php

namespace App\Events\TiepDon;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CapCuu implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $dkkham;
    public $thaotac;
    
    public function __construct($pdkcc, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $ngaydk= \comm_functions::deDateFormat($pdkcc->created_at);
            $htk="BHYT";$dtk=0;$khambhyt=TRUE;
            if($pdkcc->KhamBHYT == 1){
                $htk="Thu phí";$khambhyt=FALSE;
                $dtk=1;
            }
            $khoa=$pdkcc->phongKham->Khoa->TenKhoa;
            $idphong=$pdkcc->phongKham->IdPB;
            $idphongdk=$pdkcc->nhanVien->phongBan->IdPB;
            $phong=$pdkcc->phongKham->SoPhong.' - '.$pdkcc->phongKham->TenPhong;
            $t='Đúng tuyến';
            $tuyen='Đúng tuyến';
            $giaychuyen='Không có giấy chuyển';$chuyentu='Không chuyển';
            if($pdkcc->TuyenKham == 1){
                $tuyen='Vượt tuyến (huyện)';$chuyentu='Tuyến huyện';$t='Vượt tuyến';
            }
            else if($pdkcc->TuyenKham == 2){
                $tuyen='Vượt tuyến (xã)';$chuyentu='Tuyến xã';$t='Vượt tuyến';
            }
            if($pdkcc->GiayChuyen == 1){
                $giaychuyen='Có giấy chuyển';
            }
            
            $benhnhan=$pdkcc->benhNhan;
            $ngaysinh=date( "d/m/Y", strtotime($benhnhan->NgaySinh));
            $gt="Nam";
            if($benhnhan->GioiTinh == 0){
                $gt="Nữ";
            }
            
            $dantoc ="Chưa cập nhật!";
            if($benhnhan->DanToc != ''){
                $dantoc = \comm_functions::decodeDanToc($benhnhan->DanToc);
            }
            $sdt ="Chưa cập nhật!";
            if($benhnhan->SDT != ''){
                $sdt = $benhnhan->SDT;
            }
            $scmnd="Chưa cập nhật!";
            if($benhnhan->SoCMND != ''){
                $scmnd=$benhnhan->SoCMND;
            }
            $diachi="";
            if($benhnhan->DiaChi == ''){
                $diachi="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            else{
                $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            $thebhyt="koco";$ngaydangky="";$ngayhh="";$noidk="";$mh="";$doituong="";
            if(is_object($benhnhan->theBHYT))
            {
                $thebhyt=$benhnhan->theBHYT->IdTheBHYT;
                $ngaydangky=date( "d/m/Y", strtotime($benhnhan->theBHYT->NgayDK));
                $ngayhh=date( "d/m/Y", strtotime($benhnhan->theBHYT->NgayHH));
                $noidk=$benhnhan->theBHYT->coSoKhamBHYT->TenCS;
                $mh= \comm_functions::getMucHuongDTK($benhnhan->theBHYT->DoiTuongBHYT).'%';
                $doituong= \comm_functions::getDTK($benhnhan->theBHYT->DoiTuongBHYT);
            }
            
            $ttpk= array(
                'hoten' => $pdkcc->benhNhan->HoTen,//
                'khoa' => $khoa,
                'phong' => $phong,//
                'htk' => $htk,//
                'tuyen' => $tuyen,//
                'giaychuyen'=>$giaychuyen,//
                'ngaydk' => $ngaydk,
                'id' => $pdkcc->IdPhieuDKKB,//
                'idbn' => $pdkcc->benhNhan->IdBN,//
                'ngaysinh'=>$ngaysinh,//
                'gt'=>$gt,//
                'dantoc'=>$dantoc,
                'scmnd'=>$scmnd,
                'diachi'=>$diachi,
                'mathe'=>$thebhyt,
                'ngaydk'=>$ngaydangky,//
                'ngayhh'=>$ngayhh,
                'noidk'=>$noidk,
                'doituong'=>$doituong,
                'mh'=>$mh,
                'stt'=>$pdkcc->STT,
                'anh'=>$pdkcc->benhNhan->Anh,
                'idphong'=>$idphong,
                'idphongdk'=>$idphongdk,
                'ngaydkkham'=> \comm_functions::deDateFormat($pdkcc->created_at),
                'dtk'=>$dtk,
                't'=>$t,
                'chuyentu'=>$chuyentu,
                'khambhyt'=>$khambhyt
            );
            $this->dkkham= $ttpk;$this->thaotac=$thaotac;
        }
        else{
            $this->dkkham= $pdkcc;$this->thaotac=$thaotac;
        }
        
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('CapCuu');
    }
}
