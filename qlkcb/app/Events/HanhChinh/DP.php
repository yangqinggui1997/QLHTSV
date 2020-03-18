<?php

namespace App\Events\HanhChinh;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DP implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $dp;
    public $thaotac;
    public $loaidp;
    public $macu;
    public $mamoi;

    public function __construct($dp, $thaotac, $loaidp, $macu=NULL, $mamoi=NULL)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $ttdp='';
            if($loaidp == 'tinh'){
                $ttdp= array(
                    'id' => $dp->IdTinh,
                    'tendp' => $dp->TenTinh
                );
            }
            else if($loaidp == 'huyen'){
                $ttdp= array(
                    'id' => $dp->IdHuyen,
                    'tendp' => $dp->TenHuyen
                );
            }
            else{
                $ttdp= array(
                    'id' => $dp->IdXa,
                    'tendp' => $dp->TenXa
                );
            }
            
            $this->dp= $ttdp;$this->thaotac=$thaotac;$this->loaidp=$loaidp;
            if($thaotac == 'sua'){
                $this->macu=$macu;
                $this->mamoi=$mamoi;
            }
        }
        else{
            $this->dp= $dp;$this->thaotac=$thaotac;$this->loaidp=$loaidp;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('DP');
    }
}