<?php

namespace App\Events\KhamVaDieuTri;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class KetQuaCLS implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $kqcls;
    public $thaotac;
    public $phanloai;
    
    public function __construct($kqcls, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            
            $bn='';$dttn='BHYT';$chuandoan='';$nvcd='';$idba='';
            if(is_object($kqcls->canLamSang->benhAnNgoaiTru)){
                $bn=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                $idba=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->IdBANgoaiT;
                $i=1;
                foreach ($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan as $cd){
                    if($i == count($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan)){
                        $chuandoan.='- '.$cd->danhMucBenh->TenBenh;
                    }
                    else{
                        $chuandoan.=' - '.$cd->danhMucBenh->TenBenh.'<br>';
                    }
                    $i++;
                }
                $nvcd=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                if($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
            }
            else if(is_object($kqcls->canLamSang->benhAnNoiTruCT)){
                $bn=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                $idba=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->IdBACT;
                $i=1;
                foreach ($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan as $cd){
                    if($i == count($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan)){
                        $chuandoan.='- '.$cd->danhMucBenh->TenBenh;
                    }
                    else{
                        $chuandoan.=' - '.$cd->danhMucBenh->TenBenh.'<br>';
                    }
                    $i++;
                }
                $nvcd=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                if($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
            }
            $kq=[];
            foreach ($kqcls->ketQuaCLSCT as $kqct){
                $kq[]=$kqct->KetQua;
            }
            $kl=[];
            foreach ($kqcls->ketLuanCLS as $kqct){
                $kl[]=$kqct->KetLuan;
            }
            $kqha=[];
            foreach ($kqcls->anhCLS as $kqct){
                $kqha[]=$kqct->Anh;
            }
            $ttkqcls= array(
                'hoten' => $bn->HoTen,
                'dttn'=>$dttn,
                'nvcd'=>$nvcd,
                'nvth'=>$kqcls->nhanVien->TenNV,
                'phong'=>$kqcls->canLamSang->phongBan->SoPhong.' - '.$kqcls->canLamSang->phongBan->TenPhong,
                'chuandoan'=>$chuandoan,
                'kq'=>$kq,
                'kl'=>$kl,
                'ngayth' => \comm_functions::deDateFormat($kqcls->created_at),
                'idkqcls'=> $kqcls->IdKQCLS,
                'tencls'=>$kqcls->canLamSang->danhMucCLS->TenCLS,
                'kqha'=>$kqha,
                'idba'=>$idba,
                'idnv'=>$kqcls->nhanVien->IdNV
            );
            $this->kqcls= $ttkqcls;$this->thaotac=$thaotac;
        }
        else{
            $this->kqcls= $kqcls;$this->thaotac=$thaotac;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('KetQuaCLS');
    }
}
