<?php

namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\EmployeeImage;
use App\Models\Designation;
use ImageResize;

class EmployeeService 
{


    public function saveEmployee($request,$id=null){
        if($id){
            $user=User::find($id);
        }
        else{
            $user =new User;
            $password=$request->input('name').Str::random(10);
            $user->password=Crypt::encryptString(str_replace(' ','',$password));
        }
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->designation_id=$request->input('designation');
        $user->save();


        if($request->file('image')){
            $userImage = $user->userImages ?:new EmployeeImage;
            if(isset($userImage->image)){
                unlink(public_path('/uploads/images/thumbnail/'.$userImage->image));
                unlink(public_path('/uploads/images/'.$userImage->image));
            }
            $image = $request->file('image');
            $name = date('YmdHis').$image->getClientOriginalName();
            $thumnailPath = public_path('/uploads/images/thumbnail');
            $img = ImageResize::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumnailPath.'/'.$name);

            $image->move(public_path().'/uploads/images/', $name); 
            $userImage->image=(isset($name)) ? $name :'';
            $user->userImages()->save($userImage);
        }
        return $user;
    }
}
