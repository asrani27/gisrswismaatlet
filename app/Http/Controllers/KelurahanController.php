<?php

namespace App\Http\Controllers;

use App\Kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    public function index()
    {
        $data = Kelurahan::all();
        return view('admin.kelurahan.index',compact('data'));
    }

    public function add()
    {
        return view('admin.kelurahan.add');
    }

    public function edit($id)
    {
        $data = Kelurahan::find($id);
        return view('admin.kelurahan.edit',compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $attr['nama'] = strtoupper($req->nama);
        Kelurahan::create($attr);
        toastr()->success('Data Kelurahan Berhasil Di Simpan');
        return redirect('/kelurahan');
    }
    
    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $attr['nama'] = strtoupper($req->nama);
        Kelurahan::find($id)->update($attr);
        toastr()->success('Data Kelurahan Berhasil Di Update');
        return redirect('/kelurahan');
    }

    public function delete($id)
    {
        Kelurahan::find($id)->delete();
        toastr()->success('Data Kelurahan Berhasil Di Hapus');
        return back();
    }
}
