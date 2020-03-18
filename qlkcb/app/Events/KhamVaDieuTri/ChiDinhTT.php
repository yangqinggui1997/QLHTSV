<?php

namespace App\Events\KhamVaDieuTri;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChiDinhTT implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $cdtt;
    public $thaotac;
    
    public function __construct($cdtt, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $hoten='';$idbn='';$dttn='BHYT';$idba='';$htdt='Nội trú';$phongcd='';
            $nvcd='';
            if(is_object($cdtt->benhAnNgoaiTru)){
                $hoten=$cdtt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                $idbn=$cdtt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->IdBN;
                $idba=$cdtt->benhAnNgoaiTru->benhAnNgoaiTru->IdBANgoaiT;
                if($cdtt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
                $htdt="Ngoại trú";
                $pb=$cdtt->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan;
                $phongcd='Phòng số '.$pb->SoPhong.' - '.$pb->TenPhong;
                $nvcd=$cdtt->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
            }
            else if(is_object($cdtt->benhAnNoiTruCT)){
                $hoten=$cdtt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                $idbn=$cdtt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->IdBN;
                $idba=$cdtt->benhAnNoiTruCT->benhAnNoiTruCT->IdBACT;
                if($cdtt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
                $pb=$cdtt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan;
                $phongcd='Phòng số '.$pb->SoPhong.' - '.$pb->TenPhong;
                $nvcd=$cdtt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
            }

            $ttcd =array(
                'benhnhan' => $hoten,
                'dttn' => $dttn,
                'tentt' => $cdtt->danhMucCLS->TenCLS,
                'ngayracd' => \comm_functions::deDateFormat($cdtt->created_at),
                'nv' => $cdtt->nhanVien->TenNV,
                'phongth'=>$cdtt->phongBan->SoPhong.' - '.$cdtt->phongBan->TenPhong,
                'idtt' => $cdtt->IdThuThuat,
                'idbn' =>$idbn,
                'idba'=>$idba,
                'phongcd'=>$phongcd,
                'pth'=>'Phòng số '.$cdtt->phongBan->SoPhong.' - '.$cdtt->phongBan->TenPhong,
                'nvcd'=>$nvcd,
                'htdt'=>$htdt
            );
            $this->cdtt= $ttcd;$this->thaotac=$thaotac;
        }
        else{
            $this->cdtt= $cdtt;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ChiDinhTT');
    }
}
