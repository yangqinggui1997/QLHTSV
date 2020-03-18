<?php

namespace App\Events\KhamVaDieuTri;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ToaThuoc implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $toathuoc;
    public $thaotac;
    
    public function __construct($toathuoc, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $chuandoan=array();
            $hoten='';$idbn='';$idba='';$dttn='BHYT';
            if(is_object($toathuoc->benhAnNgoaiTru)){
                $hoten=$toathuoc->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                $idbn=$toathuoc->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->IdBN;
                $idba=$toathuoc->benhAnNgoaiTru->benhAnNgoaiTru->IdBANgoaiT;
                foreach ($toathuoc->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan as $cd) {
                    $chuandoan[]=$cd->danhMucBenh->TenBenh;
                }
                if($toathuoc->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
            }
            else if(is_object($toathuoc->benhAnNoiTruCT)){
                $hoten=$toathuoc->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                $idbn=$toathuoc->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham;
                $idba=$toathuoc->benhAnNoiTruCT->benhAnNoiTruCT->IdBACT;
                foreach ($toathuoc->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan as $cd) {
                    $chuandoan[]=$cd->danhMucBenh->TenBenh;
                }
                if($toathuoc->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
            }
            
            $ttlt='Chưa lãnh thuốc';
            if($toathuoc->TTLanhThuoc == 1){
                $ttlt='Đã lãnh thuốc';
            }
            $tttoathuoc= array(
                'benhnhan' =>$hoten,
                'dttn' => $dttn,
                'chuandoan' => $chuandoan,
                'ngayratoa' => data('d/m/Y', strtotime($toathuoc->created_at)),
                'ttlanhthuoc' => $ttlt,
                'idtt' => $toathuoc->IdTT,
                'idbn' =>$idbn,
                'idba'=>$idba
            );
            $this->toathuoc= $tttoathuoc;$this->thaotac=$thaotac;
        }
        else{
            $this->toathuoc= $toathuoc;$this->thaotac=$thaotac;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ToaThuoc');
    }
}
