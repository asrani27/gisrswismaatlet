<?php

namespace App\Http\Controllers;

use App\Marker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarkerController extends Controller
{
    public function index()
    {
        $data = Marker::all();
        return view('admin.marker.index',compact('data'));
    }

    public function add()
    {
        return view('admin.marker.add');
    }

    public function edit($id)
    {
        $data = Marker::find($id);
        return view('admin.marker.edit',compact('data'));
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'file' => 'mimes:png'
        ]);

        if ($validator->fails()) {
            toastr()->error('File Harus Berupa .PNG');
            return back();
        }
        
        if ($req->hasFile('file')) {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-h-i-s') . $filename;
            $req->file->storeAs('/public', $filename);
        }

        $attr = $req->all();
        $attr['icon'] = $filename;
        Marker::create($attr);
        
        toastr()->success('Data Marker Berhasil Di Simpan');
        return redirect('/marker');
    }
    
    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'file' => 'mimes:png'
        ]);

        $attr = $req->all();

        if ($validator->fails()) {
            toastr()->error('File Harus Berupa .PNG / .SVG');
            return back();
        }
        
        if ($req->hasFile('file')) {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-h-i-s') . $filename;
            $req->file->storeAs('/public', $filename);
            $attr['icon'] = $filename;
        }
        
        Marker::find($id)->update($attr);
        toastr()->success('Data Marker Berhasil Di Update');
        return redirect('/marker');
    }

    public function delete($id)
    {
        Marker::find($id)->delete();
        toastr()->success('Data Marker Berhasil Di Hapus');
        return back();
    }
}
