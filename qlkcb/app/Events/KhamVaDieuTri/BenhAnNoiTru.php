<?php

namespace App\Events\KhamVaDieuTri;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\HanhChinh\thiet_bi_yt;

class BenhAnNoiTru implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $benhan;
    public $thaotac;
    public $pk;
    
    public function __construct($benhan, $thaotac, $idtbc =NULL, $idtbm=NULL, $pk=NULL)
    {
        //
        if($thaotac == 'them' || $thaotac == 'sua'){
            $benhnhan=$benhan->phieuDKKham->phieuDKKham->benhNhan;
            
            $chuandoan=array();
            foreach ($benhan->chuanDoan as $cd) {
                $chuandoan[]=$cd->danhMucBenh->TenBenh;
            }
            $ngaybddt= \comm_functions::deDateFormat($benhan->created_at); 
            $tinhtrangbn='';
            if($benhan->TTLucVao == 'tinh_tao'){
                if($benhan->GhiChu != ''){
                    $tinhtrangbn='Tỉnh táo - '.$benhan->GhiChu;
                }
                else{
                    $tinhtrangbn='Tỉnh táo';
                }
            }
            else if($benhan->TTLucVao == 'hon_me'){
                if($benhan->GhiChu != ''){
                    $tinhtrangbn='Hôn mê- '.$benhan->GhiChu;
                }
                else{
                    $tinhtrangbn='Hôn mê';
                }
            }
            else{
                if($benhan->GhiChu != ''){
                    $tinhtrangbn='Hôn mê sâu - '.$benhan->GhiChu;
                }
                else{
                    $tinhtrangbn='Hôn mê sâu';
                }
            }
            $dttn='BHYT';
            if($benhan->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                $dttn='Thu phí';
            }
            if($thaotac == 'them'){
                $tb=$benhan->thietBiYT;
                $giuong='<option data-ttsd="1" value="'.$tb->IdTB.'">Giường bệnh số '.$tb->SoTB.' - Phòng số '.$tb->phongBan->SoPhong.' (Đang sử dụng)</option>';
                $ttba= array(
                    'hoten' => $benhnhan->HoTen,
                    'chuandoan'=>$chuandoan,
                    'ngaybddt'=>$ngaybddt,
                    'songaydt'=>1,
                    'trangthaiba'=>'Đang điều trị',
                    'id' => $benhan->IdBANoiT,
                    'idbn' => $benhnhan->IdBN,
                    'lydonv'=>$benhan->LyDoNV,
                    'ttbn'=>$tinhtrangbn,
                    'idtb'=>$tb->IdTB,
                    'giuong'=>$giuong,
                    'gb'=>'Phòng '.$tb->phongBan->SoPhong.' - Giường số '.$tb->SoTB,
                    'id_nv'=>$benhan->IdNV,
                    'dttn'=>$dttn
                );

                $this->benhan= $ttba;$this->thaotac=$thaotac;
            }
            else{
                $flag=FALSE;$giuongc=''; $giuongm='';
                if($idtbc != NULL){
                    //cập nhật lại tình trạng sử dụng của thiết bị
                    $tbc= thiet_bi_yt::where('IdTB', $idtbc)->get()->first();
                    if(count($tbc->benhAnNoiTru) == 0){//thiết bị chỉ được sử dụng trong bệnh án này
                        $tbc->TinhTrangSD=0;
                        $flag=TRUE;
                        $tbc->save();
                    }

                    $tbm= thiet_bi_yt::where('IdTB', $idtbm)->get()->first();
                    if(count($tbm->benhAnNoiTru) == 1){
                        $tbm->TinhTrangSD=1;
                        $tbm->save();
                    }

                    if($flag == TRUE){
                        $giuongc='<option data-ttsd="0" value="'.$tbc->IdTB.'">Giường bệnh số '.$tbc->SoTB.' - Phòng số '.$tbc->phongBan->SoPhong.' (Trống)</option>';
                    }
                    else{
                        $giuongc='<option data-ttsd="1" value="'.$tbc->IdTB.'">Giường bệnh số '.$tbc->SoTB.' - Phòng số '.$tbc->phongBan->SoPhong.' (Đang sử dụng)</option>';
                    }
                    $giuongm='<option data-ttsd="1" value="'.$tbm->IdTB.'">Giường bệnh số '.$tbm->SoTB.' - Phòng số '.$tbm->phongBan->SoPhong.' (Đang sử dụng)</option>';
                }
                
                $trangthaiba='Đang điều trị';
                if($benhan->TrangThaiBA == 0){
                    $trangthaiba='Đã kết thúc điều trị';
                }
                $tb=$benhan->thietBiYT;
                $ttba= array(
                    'hoten' => $benhnhan->HoTen,
                    'chuandoan'=>$chuandoan,
                    'ngaybddt'=>$ngaybddt,
                    'songaydt'=>1,
                    'trangthaiba'=>$trangthaiba,
                    'id' => $benhan->IdBANoiT,
                    'idbn' => $benhnhan->IdBN,
                    'lydonv'=>$benhan->LyDoNV,
                    'ttbn'=>$tinhtrangbn,
                    'giuongc'=>$giuongc,
                    'giuongm'=>$giuongm,
                    'idtbc'=>$idtbc,
                    'idtbm'=>$idtbm,
                    'gb'=>'Phòng '.$tb->phongBan->SoPhong.' - Giường số '.$tb->SoTB,
                    'id_nv'=>$benhan->IdNV
                );

                $this->benhan= $ttba;$this->thaotac=$thaotac;
            }
        }
        else{
            $this->benhan= $benhan;$this->thaotac=$thaotac;
            $this->pk=$pk;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('BenhAnNoiTru');
    }
}
