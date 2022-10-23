<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('auth.changePassword');
    } 

    public function store(Request $request)
    {
        
        $rules = [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
                
        ];
    
        $messages = [
            'current_password.required' => 'Password saat ini dibutuhkan.',
            'current_password.required' => 'Password saat ini dibutuhkan.',
            'new_password.required' => 'Password baru dibutuhkan.',
            'new_confirm_password.required' => 'Konfirmasi password baru dibutuhkan.',
            'new_confirm_password.same' => 'Konfirmasi Password harus sama dengan password baru'
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
         
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        
        Auth::logout(); // logout the user
        return redirect()->route('login')->with('success', 'Password Berhasil diganti, Silakan Login kembali dengan password baru');
       
    }


}
