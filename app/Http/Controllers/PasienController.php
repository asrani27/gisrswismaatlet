<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\Kelurahan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Imports\PasienImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    public function index()
    {
        $data = Pasien::orderBy('id', 'DESC')->get();
        return view('admin.pasien.index',compact('data'));
    }
    
    public function add()
    {
        $kelurahan = Kelurahan::get();
        return view('admin.pasien.add',compact('kelurahan'));
    }

    public function edit($id)
    {
        $data = Pasien::find($id);
        $kelurahan = Kelurahan::get();
        return view('admin.pasien.edit',compact('data','kelurahan'));
    }

    public function upload(request $req)
    {
        $validator = Validator::make($req->all(), [
            'file' => 'mimes:csv,xlsx,xls'
        ]);

        if ($validator->fails()) {
            toastr()->error('File Harus Berupa .XLSX / .CSV');
            return back();
        }
        
        $data = Excel::toArray(new PasienImport, request()->file('file'))[0];

        //Mapping Data
        $mapping = collect($data)->map(function($item, $key){
            $value['no_pasien'] = $item[0];
            $value['jkel']      = $item[1];
            $value['umur']      = $item[2];
            $value['pekerjaan'] = $item[3];
            $value['hasil']     = $item[4];
            $value['gejala']     = $item[5];

            try{
                $value['tgl_masuk']         = Carbon::CreateFromFormat('d-M-Y H:i', $item[6])->format('Y-m-d H:i:00');
                $value['tgl_keluar']        = Carbon::CreateFromFormat('d-M-Y H:i', $item[7])->format('Y-m-d H:i:00');
            }catch(\Exception $e){
                $value['tgl_masuk']         = null;
                $value['tgl_keluar']        = null;
            }

            $value['los']               = $item[8];
            $value['status_pulang']     = $item[9];
            $value['provinsi']          = $item[10];
            $value['kabupaten_kota']    = $item[11];
            $value['kecamatan']         = $item[12];
            $value['kelurahan_id']      = Kelurahan::where('nama', $item[13])->first() == null ? null : Kelurahan::where('nama', $item[13])->first()->id;
            
            return $value;
        });
    
        DB::beginTransaction();
        try { 
                foreach($mapping as $item){
                    if($item['no_pasien'] == 'no'){

                    }else{
                        $check = Pasien::where('no_pasien', $item['no_pasien'])->first();
                        if($check == null){
                            Pasien::create($item);
                        }else{
                        }
                    }
                }

                DB::commit(); 
                toastr()->success('Data Pasien Berhasil Di Upload');  
                return back();
            } catch (\Exception $e) {
                dd($e);
                DB::rollback();
                toastr()->error('Upload Data Gagal, Terjadi Kesalahan Format');
                return back();
            }

    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = Pasien::where('no_pasien', $req->no_pasien)->first();
        if($check == null){
            Pasien::create($attr);
            toastr()->success('Data Pasien Berhasil Di Simpan');
            return redirect('/pasien');
        }else{
            toastr()->error('No Pasien Sudah Ada');
            return back();
        }
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $attr['tgl_masuk'] = Carbon::parse($req->tgl_masuk)->format('Y-m-d');
        $attr['tgl_keluar'] = Carbon::parse($req->tgl_keluar)->format('Y-m-d');
        Pasien::find($id)->update($attr);
        toastr()->success('Data Pasien Berhasil Di Update');
        return redirect('/pasien');
    }

    public function delete($id)
    {
        Pasien::find($id)->delete();
        toastr()->success('Data Pasien Berhasil Di Hapus');
        return back();
    }

    public function data($id)
    {
        $data = Kelurahan::find($id)->pasien;
        return view('admin.pasien.data',compact('data'));
    }
}
