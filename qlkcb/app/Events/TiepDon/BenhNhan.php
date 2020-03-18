<?php

namespace App\Events\TiepDon;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BenhNhan implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $benhnhan;
    public $thaotac;
    
    public function __construct($benhnhan, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $timeStamp = date( "d/m/Y", strtotime($benhnhan->NgaySinh));
            $ngaysinh=$timeStamp;
            $gt="Nam";
            if($benhnhan->GioiTinh == 0){
                $gt="Nữ";
            }
            //date in mm/dd/yyyy format; or it can be in other formats as well
            //explode the date to get month, day and year
            $birthDate = explode("/", date( "m/d/Y", strtotime( $benhnhan->NgaySinh )));
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
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
            $anh=$benhnhan->Anh;
            $diachi="";
            if($benhnhan->DiaChi == ''){
                $diachi="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            else{
                $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            $thebhyt="koco";
            if(is_object($benhnhan->theBHYT))
            {
                $thebhyt="co";
            }
            $ttbn= array(
                'hoten' => $benhnhan->HoTen,
                'ngaysinh' => $ngaysinh,
                'gt' => $gt,
                'scmnd' => $scmnd,
                'sdt' => $sdt,
                'diachi' => $diachi,
                'dantoc' => $dantoc,
                'anh' => $anh, 
                'tuoi' => $age,
                'id' => $benhnhan->IdBN,
                'bncthe' => $thebhyt
            );
            $this->benhnhan= $ttbn;$this->thaotac=$thaotac;
        }
        else{
            $this->benhnhan= $benhnhan;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('BenhNhan');
    }
}