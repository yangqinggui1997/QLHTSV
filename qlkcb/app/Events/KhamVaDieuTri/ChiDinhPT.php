<?php

namespace App\Events\KhamVaDieuTri;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChiDinhPT implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $cdpt;
    public $thaotac;
    
    public function __construct($cdpt, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $dttn='BHYT';$htdt='Nội trú';$phongcd='';
            $hoten=$cdpt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
            $idbn=$cdpt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->IdBN;
            $idba=$cdpt->benhAnNoiTruCT->IdBACT;
            if($cdpt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                $dttn='Thu phí';
            }
            $pb=$cdpt->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan;
            $phongcd='Phòng số '.$pb->SoPhong.' - '.$pb->TenPhong;
            $nvcd=$cdpt->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
            $ttcd =array(
                'benhnhan' => $hoten,
                'dttn' => $dttn,
                'tenpt' => $cdpt->danhMucCLS->TenCLS,
                'ngayracd' => \comm_functions::deDateFormat($cdpt->created_at),
                'nv' => $cdpt->nhanVien->TenNV,
                'phongth'=>$cdpt->phongBan->SoPhong.' - '.$cdpt->phongBan->TenPhong,
                'idpt' => $cdpt->IdPT,
                'idbn' =>$idbn,
                'idba'=>$idba,
                'ppth'=>$cdpt->PhuongPhapTH,
                'phongcd'=>$phongcd,
                'pth'=>'Phòng số '.$cdpt->phongBan->SoPhong.' - '.$cdpt->phongBan->TenPhong,
                'nvcd'=>$nvcd,
                'htdt'=>$htdt
            );
            $this->cdpt= $ttcd;$this->thaotac=$thaotac;
        }
        else{
            $this->cdpt= $cdpt;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ChiDinhPT');
    }
}
