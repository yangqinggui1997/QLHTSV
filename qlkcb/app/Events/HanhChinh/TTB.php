<?php

namespace App\Events\HanhChinh;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TTB implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $tb;
    public $thaotac;
    
    public function __construct($ttb, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $tttb='Hoạt động tốt';
            if($ttb->TTTB == 'hong_mot_phan'){
                $tttb='Hỏng một phần';
            }
            else if($ttb->TTTB == 'hong_hoan_toan'){
                $tttb='Hỏng hoàn toàn';
            }
            $ttt= array(
                'id' => $ttb->IdTB,
                'tentb' => $ttb->TenTB,
                'nsx' => $ttb->NSX,
                'ncu' => $ttb->NCU,
                'ngaynhap' => date('d/m/Y', strtotime($ttb->NgayNhap)),
                'pl' => \comm_functions::decodeLoaiTB($ttb->PhanLoai),
                'dgn' => number_format($ttb->DonGiaNhap).' VNĐ',
                'cn' => $ttb->ChucNang,
                'sotb' => $ttb->SoTB,
                'tttb' => $tttb,
            );
            
            $this->tb= $ttt;$this->thaotac=$thaotac;
        }
        else{
            $this->tb= $ttb;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('TTB');
    }
}