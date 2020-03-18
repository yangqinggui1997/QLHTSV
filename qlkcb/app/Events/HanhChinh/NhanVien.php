<?php

namespace App\Events\HanhChinh;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NhanVien implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $nhanvien;
    public $thaotac;
    
    public function __construct($nhanvien, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $ngaysinh=date( "d/m/Y", strtotime($nhanvien->NgaySinh));
            $gt="Nam";
            if($nhanvien->GioiTinh == 0){
                $gt="Nữ";
            }
            
            $dantoc ="Chưa cập nhật!";
            if($nhanvien->DanToc != ''){
                $dantoc = \comm_functions::decodeDanToc($nhanvien->DanToc);
            }
            $sdt ="Chưa cập nhật!";
            if($nhanvien->SDT != ''){
                $sdt = $nhanvien->SDT;
            }
            $scmnd="Chưa cập nhật!";
            if($nhanvien->SoCMND != ''){
                $scmnd=$nhanvien->SoCMND;
            }
            $anh=$nhanvien->Anh;
            $diachi="";
            if($nhanvien->DiaChi == ''){
                $diachi="Xã ".$nhanvien->phuongXa->TenXa.", huyện ".$nhanvien->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$nhanvien->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            else{
                $diachi=$nhanvien->DiaChi.", xã, ".$nhanvien->phuongXa->TenXa.", huyện ".$nhanvien->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$nhanvien->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            
            $loainv='Hợp đồng';
            if($nhanvien->LoaiNV == 1){
                $loainv='Biên chế';
            }
            $ttnv= array(
                'hoten' => $nhanvien->TenNV,
                'ngaysinh' => $ngaysinh,
                'gt' => $gt,
                'scmnd' => $scmnd,
                'sdt' => $sdt,
                'diachi' => $diachi,
                'dantoc' => $dantoc,
                'anh' => $anh,
                'id' => $nhanvien->IdNV,
                'sdt'=>$nhanvien->SDT,
                'email'=>$nhanvien->Email,
                'trinhdo'=> \comm_functions::decodeTrinhDo($nhanvien->TrinhDo),
                'chuyenmon'=>$nhanvien->ChuyenMon,
                'loainv'=>$loainv,
                'ngayvaolam'=>date('d/m/Y', strtotime($nhanvien->HopDongTuNgay)),
                'phong'=>$nhanvien->phongBan->SoPhong.' - '.$nhanvien->phongBan->TenPhong
            );
            $this->nhanvien= $ttnv;$this->thaotac=$thaotac;
        }
        else{
            $this->nhanvien= $nhanvien;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('NhanVien');
    }
}