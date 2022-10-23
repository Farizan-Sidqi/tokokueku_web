<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('user.index', compact('data'));
        //return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getProfile()
    {
        return view('auth.profile');
    }


    public function updateProfile(Request $request)
    {

        $rules = [
            'email' => 'required|unique:users,email,'.auth()->user()->id,
            'no_wa' => 'required|unique:users,no_wa,'.auth()->user()->id,
            'nama' => 'required',
            'alamat' => 'required',
            'foto' => 'max:2048'

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

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $foto = auth()->user()->foto;

        $old_image = auth()->user()->foto;
        $input = $request->all();

        if ($foto = $request->file('foto')) {

            if(file_exists(public_path('user_foto/'.$old_image))) {
                unlink(public_path('user_foto/'.$old_image));
            }

            $destinationPath = 'user_foto/';
            $profilefoto = date('YmdHis') . "." . $foto->getClientOriginalExtension();
            $foto->move($destinationPath, $profilefoto);
            $input['foto'] = "$profilefoto";
        }else{
            unset($input['foto']);
        }


        auth()->user()->update($input);

        // auth()->user()->update([
        //     'nama' => $request->nama,
        //     'foto' => $profilefoto,
        //     'alamat' => $request->alamat,
        //     'email' => $request->email,
        //     'no_wa' => $request->no_wa
        // ]);

        return redirect()->back()->with('success', 'Profile berhasil diperbarui');
    }

}
