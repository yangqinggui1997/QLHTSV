<?php

namespace App\Events\HanhChinh;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DMKT implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $dmkt;
    public $thaotac;
    
    public function __construct($dmkt, $thaotac)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            
            $pl='Cận lâm sàng';
            if($dmkt->PhanLoai == 'thu_thuat'){
                $pl='Thủ thuật';
            }
            else if($dmkt->PhanLoai == 'phau_thuat'){
                $pl='Phẫu thuật';
            }
            $dm='Có';
            if($dmkt->DanhMucBHYT == 0){
                $dm='Không';
            }
            $ttt= array(
                'id' => $dmkt->IdDMCLS,
                'tendm' => $dmkt->TenCLS,
                'dg' => number_format($dmkt->DonGia).' VNĐ' ,
                'pl' => $pl,
                'dmbhyt' => $dm,
                'ptbhyt' => $dmkt->BHYTTT.'%'
            );
            
            $this->dmkt= $ttt;$this->thaotac=$thaotac;
        }
        else{
            $this->dmkt= $dmkt;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('DMKT');
    }
}