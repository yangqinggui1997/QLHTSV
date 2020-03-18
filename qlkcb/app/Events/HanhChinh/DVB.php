<?php

namespace App\Events\HanhChinh;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DVB implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $dvb;
    public $thaotac;
    public $pl;
    public $idnvd;
    public $dshuy;
    
    public function __construct($dvb, $thaotac, $pl = NULL, $nvduyet = NULL, $dshuy=NULL)
    {
        //
        if($thaotac == 'them' || $thaotac == 'duyet'){
            $vb= array(
                'id' => $dvb->IdTK,//
                'pl'=>$dvb->PhanLoai,//
                'cd' => $dvb->CD,//
                'src'=>$pl,
                'khoa'=>$dvb->nhanVien->phongBan->Khoa->IdKhoa,
                'nguoigui'=>$dvb->nhanVien->TenNV.' - Phòng '.$dvb->nhanVien->phongBan->TenPhong.'('.$dvb->nhanVien->phongBan->SoPhong.')',//
                'ngaygui' => \comm_functions::deDateFormat($dvb->created_at),//
                'sofile' => count($dvb->File)//
            );
            
            if($thaotac == 'duyet'){
                $nguoiduyet='';$n=1;
                foreach ($dvb->duyetTK as $value) {
                    $cv='';$capbac='';$k=1;
                    foreach ($value->nhanVien->chucVu as $nvd) {
                        if(count($value->nhanVien->chucVu) == 1){
                            $cv=$nvd->chucVu->TenCV;
                        }
                        else{
                            if($k == 1){
                                $capbac=$nvd->chucVu->CB;
                                $cv=$nvd->chucVu->TenCV;
                            }
                            else{
                                if($nvd->chucVu->CB > $capbac){
                                    $capbac=$nvd->chucVu->CB;
                                    $cv=$nvd->chucVu->TenCV;
                                }
                            }
                            $k++;
                        }
                    }
                    
                    if($n == count($dvb->duyetTK)){
                        $nguoiduyet.='+ '.$value->nhanVien->TenNV.' - '.$cv.' [Phòng '.$value->nhanVien->phongBan->TenPhong.'('.$value->nhanVien->phongBan->SoPhong.')]';
                        
                    }
                    else{
                        $nguoiduyet.='+ '.$value->nhanVien->TenNV.' - '.$cv.' [Phòng '.$value->nhanVien->phongBan->TenPhong.'('.$value->nhanVien->phongBan->SoPhong.')]<br>'; 
                    }
                }
                $chucvu='';$cb='';$i=1;
                foreach ($nvduyet->chucVu as $nvd) {
                    if(count($nvduyet->chucVu) == 1){
                        $chucvu=$nvd->chucVu->TenCV;
                    }
                    else{
                        if($i == 1){
                            $cb=$nvd->chucVu->CB;
                            $chucvu=$nvd->chucVu->TenCV;
                        }
                        else{
                            if($nvd->chucVu->CB > $cb){
                                $cb=$nvd->chucVu->CB;
                                $chucvu=$nvd->chucVu->TenCV;
                            }
                        }
                        $i++;
                    }
                }

                $vb= array(
                    'id' => $dvb->IdTK,//
                    'cd' => $dvb->CD,//
                    'pl'=>$dvb->PhanLoai,
                    'idnv'=>$dvb->nhanVien->IdNV,//
                    'idnvd'=>$nvduyet->IdNV,//
                    'nd'=>$nvduyet->TenNV.' - '.$chucvu.' [Phòng '.$nvduyet->phongBan->TenPhong.'('.$nvduyet->phongBan->SoPhong.')]',//
                    'nguoigui'=>$dvb->nhanVien->TenNV.' - '.$dvb->nhanVien->phongBan->TenPhong.'('.$dvb->nhanVien->phongBan->SoPhong.')',//
                    'ngaygui' => \comm_functions::deDateFormat($dvb->created_at),//
                    'ngayduyet' => \comm_functions::deDateFormat($pl),//
                    'nguoiduyet'=>$nguoiduyet,//
                    'sofile' => count($dvb->File)//
                );
            }
            $this->dvb= $vb;$this->thaotac=$thaotac;
        }
        else{
            
            $this->dvb= $dvb;$this->thaotac=$thaotac;$this->pl=$pl;$this->idnvd=$nvduyet->IdNV;
            $this->dshuy=$dshuy;
        }
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('DVB');
    }
}