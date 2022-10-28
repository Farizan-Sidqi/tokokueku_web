<?php

namespace App\Http\Controllers;

use DB;
use DataTables;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produk::all();
        return view('produk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $rules = [
        'nama' => 'required',
        'harga' => 'required',
        'modal' => 'required',
        //'foto' => 'required|foto|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'foto' => ['required','mimes:jpeg,png,jpg,svg','max:2048'],
        // 'password' => ['required', 'string', 'min:6', 'confirmed'],

    ];

    $messages = [
        'nama.required' => 'Nama dibutuhkan.',
        'harga.required' => 'harga dibutuhkan.',
        'modal.required' => 'modal dibutuhkan',
        'foto.required' => 'Foto dibutuhkan.',
        'foto.max' => 'Ukuran foto terlalu besar.'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all());
    }

        $input = $request->all();

        if ($foto = $request->file('foto')) {
            $destinationPath = 'foto/';
            $profilefoto = date('YmdHis') . "." . $foto->getClientOriginalExtension();
            $foto->move($destinationPath, $profilefoto);
            $input['foto'] = "$profilefoto";
        }

        Produk::create($input);

        return redirect()->route('produk.index')
                        ->with('success','Produk berhasil ditambah.');

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
    public function edit(Produk $produk)
    {
        return view('produk.edit',compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $rules = [
            'nama' => 'required',
            'harga' => 'required',
            'modal' => 'required',
            'deskripsi' => 'required',

        ];

        $messages = [
            'nama.required' => 'Nama dibutuhkan.',
            'harga.required' => 'Harga dibutuhkan.',
            'modal.required' => 'Modal dibutuhkan',
            'deskripsi.required' => 'Deskripsi dibutuhkan.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $old_image = $produk->foto;
        $input = $request->all();

        if ($foto = $request->file('foto')) {

            if(file_exists(public_path('foto/'.$old_image))) {
                unlink(public_path('foto/'.$old_image));
            }
            $destinationPath = 'foto/';
            $profilefoto = date('YmdHis') . "." . $foto->getClientOriginalExtension();
            $foto->move($destinationPath, $profilefoto);
            $input['foto'] = "$profilefoto";
        }else{
            unset($input['foto']);
        }

        $produk->update($input);

        return redirect()->route('produk.index')
                        ->with('success','Produk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $old_image = $produk->foto;

        if(file_exists(public_path('foto/'.$old_image))) {
            unlink(public_path('foto/'.$old_image));
        }

         $produk->delete();
        // return redirect()->route('produk.index')->with('success','Produk berhasil dihapus');
        return back()->with('success','Produk berhasil dihapus');

    }
}
