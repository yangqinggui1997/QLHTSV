<?php

namespace App\Events\TiepDon;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TheBHYT implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $thebhyt;
    public $thaotac;
    
    public function __construct($thebhyt, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $ngaydk=date( "d/m/Y", strtotime($thebhyt->NgayDK));
            $ngayhh=date( "d/m/Y", strtotime($thebhyt->NgayHH));
            $ngayhhsd=date( "d/m/Y", strtotime($thebhyt->NgayHHDT));
            $ttthe= array(
                'hoten' => $thebhyt->benhNhan->HoTen,
                'ngaydk' => $ngaydk,
                'ngayhhsd' => $ngayhhsd,
                'ngayhh' => $ngayhh,
                'ndk' => $thebhyt->coSoKhamBHYT->TenCS,
                'doituong' => \comm_functions::getDTK($thebhyt->DoiTuongBHYT),
                'muchuong' => $thebhyt->BHYTHoTro,
                'id' => $thebhyt->IdTheBHYT,
                'idbn' => $thebhyt->IdBN
            );

            $this->thebhyt= $ttthe;$this->thaotac=$thaotac;
        }
        else{
            $this->thebhyt= $thebhyt;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('TheBHYT');
    }
}
