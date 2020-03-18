<?php

namespace App\Events\HanhChinh;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class KhoaEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $khoa;
    public $thaotac;
    
    public function __construct($khoa, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            
            $ttkhoa= array(
                'tenkhoa' => $khoa->TenKhoa,
                'ngaytl' => date('d/m/Y', strtotime($khoa->NgayTL)),
                'cn' => $khoa->ChucNang,
                'id' => $khoa->IdKhoa
            );
            $this->khoa= $ttkhoa;$this->thaotac=$thaotac;
        }
        else{
            $this->khoa= $khoa;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('KhoaEvent');
    }
}