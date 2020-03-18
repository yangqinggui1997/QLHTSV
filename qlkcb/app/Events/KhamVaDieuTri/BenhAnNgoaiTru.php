<?php

namespace App\Events\KhamVaDieuTri;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BenhAnNgoaiTru implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $benhan;
    public $thaotac;
    public $pk;
    public function __construct($benhan, $thaotac, $pk = NULL)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $benhnhan=$benhan->phieuDKKham->phieuDKKham->benhNhan;
            $ngaysinh=date( "d/m/Y", strtotime($benhnhan->NgaySinh));
            
            $gt="Nam";
            if($benhnhan->GioiTinh == 0){
                $gt="Nữ";
            }
            
            $birthDate = explode("/", date( "m/d/Y", strtotime( $benhnhan->NgaySinh )));
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));

            $chuandoan=array();
            foreach ($benhan->chuanDoan as $cd) {
                $chuandoan[]=$cd->danhMucBenh->TenBenh;
            }
            $ngaybddt=date( "d/m/Y", strtotime($benhan->created_at)); 
            $dttn='BHYT';
            if($benhan->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                $dttn='Thu phí';
            }
            $ttbn= array(
                'hoten' => $benhnhan->HoTen,
                'ngaysinh' => $ngaysinh,
                'gt' => $gt,
                'tuoi' => $age,
                'chuandoan'=>$chuandoan,
                'ngaybddt'=>$ngaybddt,
                'songaydt'=>$benhan->SoNgayDT,
                'trangthaiba'=>'Đang điều trị',
                'id' => $benhan->IdBANgoaiT,
                'idbn' => $benhnhan->IdBN,
                'idpdk'=>$benhan->phieuDKKham->phieuDKKham->IdPhieuDKKB,
                'idnv'=>$benhan->nhanVien->IdNV,
                'dttn'=>$dttn
            );
            $this->benhan= $ttbn;$this->thaotac=$thaotac;
        }
        else{
            $this->benhan= $benhan;$this->thaotac=$thaotac;
            $this->pk=$pk;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('BenhAnNgoaiTru');
    }
}
