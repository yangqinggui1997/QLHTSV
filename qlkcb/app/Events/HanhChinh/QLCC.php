<?php

namespace App\Events\HanhChinh;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class QLCC implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $cc;
    public $ccc;
    public $thaotac;
    
    public function __construct($cc, $thaotac, $ccc=NULL, $flag=NULL)
    {
        //
        if($thaotac == 'sua'){
            
            $ttcc= array(
                'id' => $cc->IdCC,
                'snc' => $ccc,
                'flag'=>$flag
            );
            
            $this->cc= $ttcc;$this->thaotac=$thaotac;
        }
        else if($thaotac == 'tl'){
            $cv='';$i=1;
            if(count($cc->nhanVien->chucVu) == 0){
                $cv='Nhân viên';
            }
            else{
                foreach ($cc->nhanVien->chucVu as $value) {
                    if($i==count($cc->nhanVien->chucVu)){
                        $cv.='- '.$value->chucVu->TenCV;
                    }
                    else{
                        $cv.='- '.$value->chucVu->TenCV.'<br>';
                    }
                    $i++;
                }
            }

            $ttcc= array(
                'id' => $cc->IdCC,
                'hoten' => $cc->nhanVien->TenNV,
                'nvl' => date('d/m/Y', strtotime($cc->nhanVien->created_at)),
                'ntcc' => \comm_functions::dedateFormat($cc->created_at),
                'ncn' => \comm_functions::dedateFormat($cc->updated_at),
                'cv' => $cv,
                'congviec'=>\comm_functions::decodeCongViec($cc->nhanVien->CV),
                'snc'=>1
            );
            
            $ttlscc= array(
                'id' => $ccc->IdCC,
                'hoten' => $ccc->nhanVien->TenNV,
                'nvl' => date('d/m/Y', strtotime($ccc->nhanVien->created_at)),
                'ntcc' => \comm_functions::dedateFormat($ccc->created_at),
                'ncn' => \comm_functions::dedateFormat($ccc->updated_at),
                'cv' => $cv,
                'congviec'=>\comm_functions::decodeCongViec($ccc->nhanVien->CV),
                'snc'=>$ccc->SoNgayCong
            );

            $this->cc= $ttcc;$this->ccc= $ttlscc;$this->thaotac=$thaotac;
        }
        else{
            $this->cc= $cc;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('QLCC');
    }
}