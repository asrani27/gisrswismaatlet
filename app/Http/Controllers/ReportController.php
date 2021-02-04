<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\Kelurahan;
use Carbon\Carbon;
use PDF;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        
        $e = Carbon::today()->subDay(1)->format('Y-m-d');
        $s = Carbon::today()->subDay(8)->format('Y-m-d');
        
        $period = CarbonPeriod::create($s, $e);
        $tanggal = [];
        foreach ($period as $dated) {
            $tanggal[] = $dated->format('Y-m-d');
        }
        $data['tanggal'] = collect($tanggal)->map(function($item){
            return Carbon::parse($item)->format('d/M/Y');
        }); 
        $data['konfirmasi'] = collect($tanggal)->map(function($item){
            $item = count(Pasien::whereDate('tgl_masuk', $item)->where('hasil','KONFIRMASI')->get());
            return $item;
        })->toArray(); 
        $data['suspect'] = collect($tanggal)->map(function($item){
            $item = count(Pasien::whereDate('tgl_masuk', $item)->where('hasil','SUSPECT')->get());
            return $item;
        })->toArray(); 
        $data['probable'] = collect($tanggal)->map(function($item){
            $item = count(Pasien::whereDate('tgl_masuk', $item)->where('hasil','PROBABLE')->get());
            return $item;
        })->toArray(); 

        return view('admin.report.index',compact('data'));
    }

    public function akumulasi()
    {
        $angka = Carbon::now()->format('Ymd-his');
        $dat = Kelurahan::get();
        $data = $dat->map(function($item){
            $item->konfirmasi = count($item->pasien->where('hasil', 'KONFIRMASI'));
            $item->suspect = count($item->pasien->where('hasil', 'SUSPECT'));
            $item->probable = count($item->pasien->where('hasil', 'PROBABLE'));
            return $item;
        });
        
        $pdf = PDF::loadView('admin.report.pdf_akumulasi', compact('data'));
        return $pdf->download($angka.'akumulasi.pdf');
    }

    public function search(Request $req)
    {
        $angka = Carbon::now()->format('Ymd-his');
        $kel = Kelurahan::find($req->kelurahan_id);
        $data = $kel->pasien;
        $pdf = PDF::loadView('admin.report.pdf_search', compact('data', 'kel'));
        return $pdf->download($angka.'datapasien.pdf');
        
    }
}
