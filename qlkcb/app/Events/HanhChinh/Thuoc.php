<?php

namespace App\Events\HanhChinh;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Thuoc implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $thuoc;
    public $thaotac;
    
    public function __construct($thuoc, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $dmbhyt='Có';
            if($thuoc->DanhMucBHYT == 0){
                $dmbhyt='Không';
            }
            $ttt= array(
                'id' => $thuoc->IdThuoc,
                'tenthuoc' => $thuoc->TenThuoc,
                'nsx' => $thuoc->NSX,
                'ncu' => $thuoc->NCU,
                'ngaysx' => date('d/m/Y', strtotime($thuoc->NgaySX)),
                'ngayhh' =>date('d/m/Y', strtotime( $thuoc->NgayHH)),
                'sl' => number_format($thuoc->SL),
                'dvt' => $thuoc->DonViTinh,
                'dgn' => number_format($thuoc->DonGiaNhap).' VNĐ',
                'dgb' => number_format($thuoc->DonGiaBan).' VNĐ',
                'dmbhyt' => $dmbhyt,
                'ptbhyt' => $thuoc->BHYTTT.'%',
            );
            
            $this->thuoc= $ttt;$this->thaotac=$thaotac;
        }
        else{
            $this->thuoc= $thuoc;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('Thuoc');
    }
}