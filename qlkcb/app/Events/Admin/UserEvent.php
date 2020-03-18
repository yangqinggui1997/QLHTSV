<?php

namespace App\Events\Admin;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $user;
    public $thaotac;
    public $anh;

    public function __construct($user, $thaotac, $anh=NULL)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $qh='Quản trị hệ thống';
            if($user->Quyen == 'bsk'){
                $qh='Bác sĩ khám và điều trị';
            }
            else if($user->Quyen == 'bskt'){
                $qh='Bác sĩ thực hiện cận lâm sàng';
            }
            else if($user->Quyen == 'qlbv'){
                $qh="Quản lý bệnh viện";
            }
            else if($user->Quyen == 'hc'){
                $qh='Nhân viên hành chính';
            }
            else if($user->Quyen == 'pt'){
                $qh='Nhân viên quầy phát thuốc';
            }
            else if($user->Quyen == 'kt'){
                $qh='Nhân viên kế toán';
            }
            else if($user->Quyen == 'tdkb' || $user->Quyen == 'tdcc'){
                $qh='Nhân viên tiếp đón';
            }
            else if($user->Quyen == 'bscc'){
                $qh='Bác sĩ trực cấp cứu';
            }
            $ttnd= array(
                'tennd' => $user->nhanVien->TenNV,
                'tk' => $user->email,
                'qh' => $qh,
                'tt' => 'Đăng xuất',
                'ngaytao' => \comm_functions::deDateFormat($user->created_at),
                'anh'=>$user->nhanVien->Anh,
                'id'=>$user->id,
                'idnv'=>$user->IdNV
            );
            $this->user= $ttnd;$this->thaotac=$thaotac;
        }
        else if($thaotac == 'cntk'){
            $this->anh=$anh;$this->thaotac=$thaotac;
        }
        else{
            $this->user= $user;$this->thaotac=$thaotac;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('UserEvent');
    }
}