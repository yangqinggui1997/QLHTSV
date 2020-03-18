<?php

namespace App\Events\HanhChinh;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Benh implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $benh;
    public $thaotac;
    
    public function __construct($benh, $thaotac, $macu=NULL)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            
            $ttb= array(
                    'id' => $benh->IdBenh,
                    'tenbenh' => $benh->TenBenh,
                    'ngayph' => date('d/m/Y', strtotime($benh->NgayPH)),
                    'chungvsgb' => $benh->ChungVSGayBenh,
                    'trieuchung' => $benh->TrieuChungLS,
                    'chungvskb' => $benh->ChungKhang,
                    'macu'=>$macu
                );
            
            $this->benh= $ttb;$this->thaotac=$thaotac;
        }
        else{
            $this->benh= $benh;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('Benh');
    }
}