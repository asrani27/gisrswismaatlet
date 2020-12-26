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
        $data = Pasien::all();
        return view('admin.pasien.index',compact('data'));
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
    
        try{
            // DB::transaction(function ($mapping) {
                foreach($mapping as $item){
                    if($item['no_pasien'] == 'no'){
    
                    }else{
                        Pasien::create($item);
                    }
                }
            // });
            toastr()->success('Data Pasien Berhasil Di Upload');
            return back();
        }
        catch(\Exception $e)
        {
            toastr()->error('Upload Data Gagal, Terjadi Kesalahan Format');
            return back();
        }

    }
}
