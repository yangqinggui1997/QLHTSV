<?php

namespace App\Events\KhamVaDieuTri;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CapCuu implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $ba;
    public $idnvchuyen;
    public $idnvnhan;
    public $slba;
    public $tt;
    public $idtbchuyen;
    public $idtbnhan;
    public $gchuyen;
    public $gnhan;

    public function __construct($ba, $idnvchuyen, $idnvnhan, $slba, $tt, $idtbchuyen = NULL, $gchuyen = NULL, $idtbnhan = NULL, $gnhan = NULL)
    {
        //
        if($tt == 'them'){
            $hoten=$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen;
            $khoa=$ba->nhanVien->phongBan->Khoa->TenKhoa;
            $nv=$ba->nhanVien->TenNV;

            $ttba =array(
                'bn' => $hoten,
                'nv' => $nv,
                'khoa' => $khoa,
                'idba' => $ba->IdBANoiT
            );
            $this->ba= $ttba;$this->idnvchuyen=$idnvchuyen;$this->idnvnhan=$idnvnhan;$this->tt=$tt;$this->slba=$slba;
        }
        else if($tt == 'nhanba'){
            $benhnhan=$ba->phieuDKKham->phieuDKKham->benhNhan;
            
            $chuandoan=array();
            foreach ($ba->chuanDoan as $cd) {
                $chuandoan[]=$cd->danhMucBenh->TenBenh;
            }
            $ngaybddt= \comm_functions::deDateFormat($ba->created_at); 
            $tinhtrangbn='';
            if($ba->TTLucVao == 'tinh_tao'){
                if($ba->GhiChu != ''){
                    $tinhtrangbn='Tỉnh táo - '.$ba->GhiChu;
                }
                else{
                    $tinhtrangbn='Tỉnh táo';
                }
            }
            else if($ba->TTLucVao == 'hon_me'){
                if($ba->GhiChu != ''){
                    $tinhtrangbn='Hôn mê- '.$ba->GhiChu;
                }
                else{
                    $tinhtrangbn='Hôn mê';
                }
            }
            else{
                if($ba->GhiChu != ''){
                    $tinhtrangbn='Hôn mê sâu - '.$ba->GhiChu;
                }
                else{
                    $tinhtrangbn='Hôn mê sâu';
                }
            }
            $dttn='BHYT';
            if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                $dttn='Thu phí';
            }
            $tb=$ba->thietBiYT;
            $trangthaiba='Đang điều trị';
            if($ba->TrangThaiBA == 0){
                $trangthaiba='Đã kết thúc điều trị';
            }
            $sdnt=1;
            if($ba->TrangThaiBA == 0){
                if(count($ba->benhAnNoiTruCT) > 0){
                    foreach ($ba->benhAnNoiTruCT as $value) {
                        $present= date_create(date('Y-m-d H:m:s', strtotime($value->NgayKT)));
                        $timeba= date_create(date('Y-m-d H:m:s', strtotime($ba->created_at)));
                        $t= date_diff($timeba, $present);
                        $sndt = $t->format('%a') + 1;
                        break;
                    }
                }
            }
            else{
                if(count($ba->benhAnNoiTruCT) > 0){
                    foreach ($ba->benhAnNoiTruCT as $value) {
                        $present= date_create(date('Y-m-d H:m:s', strtotime($value->NgayKT)));
                        $timeba= date_create(date('Y-m-d H:m:s', strtotime($ba->created_at)));
                        $t= date_diff($timeba, $present);
                        $sndt = $t->format('%a') + 1;
                        break;
                    }
                }
                else{
                    $present= date_create(date('Y-m-d H:m:s'));
                    $timeba= date_create(date('Y-m-d H:m:s', strtotime($ba->created_at)));
                    $t= date_diff($timeba, $present);
                    $sndt = $t->format('%a') + 1;
                }
            }
            
            $ttba= array(
                'hoten' => $benhnhan->HoTen,//
                'chuandoan'=>$chuandoan,//
                'ngaybddt'=>$ngaybddt,//
                'songaydt'=>$sndt,//
                'trangthaiba'=>$trangthaiba,//
                'id' => $ba->IdBANoiT,//
                'idbn' => $benhnhan->IdBN,//
                'lydonv'=>$ba->LyDoNV,//
                'ttbn'=>$tinhtrangbn,//
                'gb'=>'Phòng '.$tb->phongBan->SoPhong.' - Giường số '.$tb->SoTB,//
                'dttn'=>$dttn,//
                'idnv'=>$ba->nhanVien->IdNV
            );

            $this->ba= $ttba;$this->idnvchuyen=$idnvchuyen;$this->idnvnhan=$idnvnhan;$this->tt=$tt;$this->slba=$slba;$this->idtbchuyen=$idtbchuyen;$this->idtbnhan=$idtbnhan;$this->gchuyen=$gchuyen;$this->gnhan=$gnhan;
        }
        else{
            $this->ba=$ba;$this->tt=$tt;$this->slba=$slba;$this->idnvchuyen=$idnvchuyen;$this->idnvnhan=$idnvnhan;
        }
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('CapCuu');
    }
}
