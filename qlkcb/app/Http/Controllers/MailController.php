<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Foundation\Auth\User;
use App\Events\Admin\UserEvent;

class MailController extends Controller
{
    public $tennv;
    public $mk;
    public $email;

    public function send(Request $request)
    {
        try{
            $input = $request->all();

            $user= User::where('email', $input['email'])->get()->first();

            if(is_object($user)){
                $mk=$user->password;
                $this->tennv=$user->nhanVien->TenNV;
                $this->email=$input['email'];

                $pass=str_random(6);

                $user->password=bcrypt($pass);
                $user->save();

                $this->mk=$pass;

                Mail::send('mail_template', array('mk'=>$this->mk, 'tennv'=>$this->tennv), function($message){
                    $message->to($this->email)->subject('Mật khẩu khôi phục tài khoản cho người dùng '.$this->tennv);
                });

                return redirect('reset_password')->with('success', 'Gửi mật khẩu khôi phục thành công, vui lòng đăng nhập tài khoản email của bạn để lấy mật khẩu!');
            }
            else{
                return redirect('reset_password')->with('error', 'Tài khoản email này không tồn tại trong hệ thống, hãy sử dụng email đăng nhập hệ thống của bạn!');
            }
            
        }
        catch(\Exception $ex){
            $err=$ex->getMessage();

            return redirect('reset_password')->with('error', $err);
        }
    }

    public function getCNTK(){
        return view("cap_nhat_tai_khoan");
    }

    public function postCNTK(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            if($request->mkc != '' && $request->hasFile('file')){
                $mkc=$request->mkc;
                if(\Hash::check($mkc, $user->password)){
                    $user->password=bcrypt($request->mkm);
                    $file=$request->file('file');
                    $msg='';
                    $duoi=$file->getClientOriginalExtension();
                    if($duoi!='jpeg' && $duoi != 'jpg' && $duoi != 'png' && $duoi != 'svg'){
                        $msg="ko_ho_tro_kieu_file";
                    }
                    else{
                        $name=$file->getClientOriginalName();
                        $hinh=$name;
                        while(file_exists('public/upload/anhnv/'.$hinh)){
                            $hinh=str_random(4)."_".$name;
                        }
                        if($user->nhanVien->Anh != '' && file_exists("public/upload/anhnv/".$user->nhanVien->Anh)){
                            unlink("public/upload/anhnv/".$user->nhanVien->Anh);
                        }
                        
                        $file->move('public/upload/anhnv/',$hinh);
                        $user->nhanVien->Anh=$hinh;//cập nhật file mới
                        $user->nhanVien->save();
                        $msg='tc';
                    }
                    $user->save();
                    if($msg=='ko_ho_tro_kieu_file'){
                        $response = array(
                            'msg' => 'tc_anh_tb',
                        );
                        return response()->json($response); 
                    }
                    else{
                        $response = array(
                            'msg' => 'tc'
                        );
                        event(new UserEvent($user, 'cntk', $user->nhanVien->Anh));
                        return response()->json($response); 
                    }
                }
                else{
                    $file=$request->file('file');
                    $msg='';
                    $duoi=$file->getClientOriginalExtension();
                    if($duoi!='jpeg' && $duoi != 'jpg' && $duoi != 'png' && $duoi != 'svg'){
                        $msg="ko_ho_tro_kieu_file";
                    }
                    else{
                        $name=$file->getClientOriginalName();
                        $hinh=$name;
                        while(file_exists('public/upload/anhnv/'.$hinh)){
                            $hinh=str_random(4)."_".$name;
                        }
                        if($user->nhanVien->Anh != '' && file_exists("public/upload/anhnv/".$user->nhanVien->Anh)){
                            unlink("public/upload/anhnv/".$user->nhanVien->Anh);
                        }
                        
                        $file->move('public/upload/anhnv/',$hinh);
                        $user->nhanVien->Anh=$hinh;//cập nhật file mới
                        $user->nhanVien->save();
                        $msg='tc';
                    }
                    if($msg=='ko_ho_tro_kieu_file'){
                        $response = array(
                            'msg' => 'mk_anh_tb',
                        );
                        return response()->json($response); 
                    }
                    else{
                        $response = array(
                            'msg' => 'anh_tc',
                        );

                        event(new UserEvent($user, 'cntk', $user->nhanVien->Anh));

                        return response()->json($response);
                    } 
                }
            }
            if($request->mkc == ''){
                $file=$request->file('file');
                $duoi=$file->getClientOriginalExtension();
                if($duoi!='jpeg' && $duoi != 'jpg' && $duoi != 'png' && $duoi != 'svg'){
                    $response = array(
                        'msg' => 'koht',
                    );
                    return response()->json($response); 
                }
                else{
                    $name=$file->getClientOriginalName();
                    $hinh=$name;
                    while(file_exists('public/upload/anhnv/'.$hinh)){
                        $hinh=str_random(4)."_".$name;
                    }
                    if($user->nhanVien->Anh != '' && file_exists("public/upload/anhnv/".$user->nhanVien->Anh)){
                        unlink("public/upload/anhnv/".$user->nhanVien->Anh);
                    }
                    
                    $file->move('public/upload/anhnv/',$hinh);
                    $user->nhanVien->Anh=$hinh;//cập nhật file mới
                    $user->nhanVien->save();
                    $user->save();
                    $response = array(
                        'msg' => 'tc'
                    );
                    event(new UserEvent($user, 'cntk', $user->nhanVien->Anh));
                    return response()->json($response); 
                }
            }
            else{
                $mkc=$request->mkc;
                if(\Hash::check($mkc, $user->password)){
                    $user->password=bcrypt($request->mkm);
                    $user->save();
                    $response = array(
                        'msg' => 'tc'
                    );
                    return response()->json($response);
                }
                else{
                    $response = array(
                        'msg' => 'mksai',
                    );
                    return response()->json($response); 
                }
            }
        }
        catch (\Exception $ex){
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err,
            );
            return response()->json($response); 
        }
    }
}
