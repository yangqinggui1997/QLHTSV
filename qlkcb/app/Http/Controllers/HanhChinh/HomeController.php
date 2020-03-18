<?php

namespace App\Http\Controllers\HanhChinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\thong_ke;
use App\Models\HanhChinh\file_tk;
use App\Events\HanhChinh\DVB;
use Illuminate\Foundation\Auth\User;

class HomeController extends Controller
{
    //
    
    public function getIndex(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        $flag=FALSE;$sl=[];
        foreach ($user->capQuyen as $value) {
            if($value->Quyen == 'khth'){
                $flag=TRUE;
                break;
            }
        }
        if($flag == FALSE){
            $dsbc= thong_ke::where([['PhanLoai','thong_ke'], ['IdNV', '<>', $idnv]])->get();
            foreach ($dsbc as $value) {
                # code...
                $f=FALSE;
                foreach($value->duyetTK as $d){
                    if($d->IdNV == $idnv){
                        $f=TRUE;
                        break;
                    }
                }
                if($f==FALSE){
                    $sl[]=$value;
                }
            }
        }
        else{
            $dsbc= thong_ke::where('IdNV', '<>', $idnv)->get();
            foreach ($dsbc as $value) {
                # code...
                $f=FALSE;
                foreach($value->duyetTK as $d){
                    if($d->IdNV == $idnv){
                        $f=TRUE;
                        break;
                    }
                }
                if($f==FALSE){
                    $sl[]=$value;
                }
            }
        }
        
        return view("hanh_chinh.index", ['dsbc'=>$sl]);
    }    

    public function postUpFile(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;

            $tk=new thong_ke;
            $tk->IdTK=HomeController::TaoMaNNTK();
            $tk->CD=$request->cd;
            $tk->PhanLoai=$request->pl;
            $tk->IdNV=$idnv;
            $tk->save();

            $src='';$i=1;
            if($request->hasFile('file')){
                $files=$request->file('file');
                foreach ($files as $file){
                    $duoi=$file->getClientOriginalExtension();
                    if($duoi!='docx' && $duoi != 'pdf'){
                        $response = array(
                            'msg' => "ko_ho_tro_kieu_file"
                        );
                        return response()->json($response); 
                    }
                    $file_tk =new file_tk;
                    $file_tk->IdFile= HomeController::TaoMaNNFile();
                    $file_tk->IdTK=$tk->IdTK;


                    $name=$file->getClientOriginalName();
                    $tenfile=$name;
                    while(file_exists('public/upload/baocao/'.$tenfile)){
                        $tenfile=str_random(4)."_".$name;
                    }
                    $file_tk->TenFile=$tenfile;
                    $file_tk->save();

                    $file->move('public/upload/baocao/',$tenfile);  
                    if($i==count($files)){
                        $src.=$tenfile;
                    }
                    else{
                        $src.=$tenfile.'|';
                    }  
                    $i++;   
                }

            }

            event(new DVB($tk, 'them', $src));

            $response = array(
                'msg' => 'tc'
            );
            return response()->json($response); 
        }
        catch (\Exception $ex){
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err,
            );
            return response()->json($response); 
        }
    } 

    public static function TaoMaNNTK(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= thong_ke::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $tk) {
                   if($tk->IdTK == $ran){
                        $ran= \comm_functions::BigRandomNumber(0000000001, 1000000000);
                        $flag=TRUE;
                        break;
                    }
                    else{
                        $flag=FALSE;
                    }  
                }
            }
        }

        return str_pad($ran, 10, 0, STR_PAD_LEFT); 
    }

    public static function TaoMaNNFile(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= file_tk::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $file) {
                   if($file->IdFile == $ran){
                        $ran= \comm_functions::BigRandomNumber(0000000001, 1000000000);
                        $flag=TRUE;
                        break;
                    }
                    else{
                        $flag=FALSE;
                    }  
                }
            }
        }

        return str_pad($ran, 10, 0, STR_PAD_LEFT); 
    }
}
