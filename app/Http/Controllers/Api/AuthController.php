<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Controllers\Api\AuthController; //tambah
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'nama' => 'required|string|max:200',
            // 'email' => 'required|string|max:200|unique:users',
            // 'password' => 'required|string|min:8',
            // 'no_wa' => 'required|string|max:12|unique:users',
            // 'alamat' => 'required|string|max:200',
            'nama' => 'required|string|max:200',
            'alamat' => 'required|string|max:200',
            'no_wa' => 'required|string|max:12|unique:users',
            'email' => 'required|string|max:200|unique:users',
            'password' => 'required|string|min:8',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'level_akses_id' => 2,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'no_wa' => $request->no_wa
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Akun tidak valid'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'id' => auth()->user()->id,
            'nama' => auth()->user()->nama,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }


    public function getProfile($id)
    {

     $user = User::where('id', $id)->first();



        # $user_id = auth()->user()->id;

            return response()->json([
                'nama' => $user->nama,
                'alamat' => $user->alamat,
                'email' => $user->email,
                'no_wa' => $user->no_wa,
                'id' => $user->id,
                'foto' => $user->foto,

            ]);




    }


    public function updateProfile(Request $request, $id)
    {


    try {

            $rules = [
                'email' => 'required|unique:users,email,' . $id,
                'no_wa' => 'required|unique:users,no_wa,'.$id,
                'nama' => 'required',
                'alamat' => 'required',
                # 'foto' => 'nullable|'mimes:jpeg,png,jpg'|max:2048'
                  'foto' => ['nullable','mimes:jpeg,png,jpg','max:2048']

            ];

            $messages = [
                'email.unique' => 'Email sudah digunakan',
                'email.required' => 'Email dibutuhkan',
                'no_wa.unique' => 'Nomor whatApp tersebut sudah digunakan',
                'no_wa.required' => 'Nomor whatApp dibutuhkan',
                'nama.required' => 'Nama dibutuhkan',
                'alamat.required' => 'Alamat dibutuhkan',
                'foto.max' => 'Ukuran foto terlalu besar'
            ];

             $validator = Validator::make($request->all(), $rules, $messages);



             if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }







        # if($request->foto && $request->foto->isValid()){
        #     #  $file_name = time().'.'.$request->foto->extension();
        #       $file_name = time().'.'.$request->foto-> getClientOriginalExtension();


        #     $request->foto->move(public_path('user_foto'),$file_name);
        #     $path="public/user_foto/$file_name";
        #     User::where('id', $id)->update([
        #     // 'foto' => $profilefoto
        #     'foto' => $file_name
        #     ]);



        # }
$input = $request->all();



     $input = $request->all();

        if ($request->file('foto')) {

            # if(file_exists(public_path('user_foto/'.$old_image))) {
            #     unlink(public_path('user_foto/'.$old_image));
            # }

            $destinationPath = 'user_foto/';
            $profilefoto = date('YmdHis') . "." . $request->foto->getClientOriginalExtension();
            $request->foto->move($destinationPath, $profilefoto);
            $input['foto'] = "$profilefoto";
        }else{
            unset($input['foto']);
        }


        # User::where('id', $id)->update($request->all());
        User::where('id', $id)->update($input);


         return response()->json(['status'=>'true','messages'=>"Profile Updated!", 'data'=>$input]);




        } catch (Exception $e) {
            return response()->json(['status'=>'false', 'message'=>$e->getMessage(), 'data'=>[]], 500);
        }


    }



}
