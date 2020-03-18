<?php

namespace App\Events\HanhChinh;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PhongBan implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $phongban;
    public $thaotac;
    
    public function __construct($phong, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            
            $ttkhoa= array(
                'tenphong' => $phong->TenPhong,
                'tenkhoa' => $phong->Khoa->TenKhoa,
                'cn' => $phong->ChucNang,
                'sophong' => $phong->SoPhong,
                'tang' => $phong->Tang,
                'id' => $phong->IdPB
            );
            $this->phongban= $ttkhoa;$this->thaotac=$thaotac;
        }
        else{
            $this->phongban= $phong;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('PhongBan');
    }
}