<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\Kelurahan;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $date = Carbon::now();
        $s = $date->startOfWeek()->format('Y-m-d');
        $e = $date->endOfWeek()->format('Y-m-d');
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
        
        $dates = $tanggal;
        
        $kelurahan = Kelurahan::all()->map(function($item, $key){
            $item->pasien = $item->pasien;
            $item->konfirmasi = count($item->pasien->where('hasil', 'KONFIRMASI'));
            $item->suspect = count($item->pasien->where('hasil', 'SUSPECT'));
            $item->probable = count($item->pasien->where('hasil', 'PROBABLE'));
            if($item->konfirmasi > $item->suspect && $item->konfirmasi > $item->probable){
                $item->icon = '/storage/icon_red_32.png';
            }elseif($item->suspect > $item->konfirmasi && $item->suspect > $item->probable){
                $item->icon = '/storage/yellow_icon_32.png';
            }elseif($item->probable > $item->konfirmasi && $item->probable > $item->suspect){
                $item->icon = '/storage/black_icon_32.png';
            }elseif($item->konfirmasi == $item->suspect){
                $item->icon = '/storage/icon_red_32.png';
            }elseif($item->konfirmasi == $item->probable){
                $item->icon = '/storage/black_icon_32.png';
            }elseif($item->suspect == $item->probable){
                $item->icon = '/storage/black_icon_32.png';
            }else{
                $item->icon = '/storage/icon_green_32.png';
            }
            return $item;
        })->toArray();
        
        return view('index',compact('kelurahan','data'));
    }

    public function home()
    {
        $date = Carbon::now();
        $s = $date->startOfWeek()->format('Y-m-d');
        $e = $date->endOfWeek()->format('Y-m-d');
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
        
        $dates = $tanggal;
        
        $kelurahan = Kelurahan::all()->map(function($item, $key){
            $item->pasien = $item->pasien;
            $item->konfirmasi = count($item->pasien->where('hasil', 'KONFIRMASI'));
            $item->suspect = count($item->pasien->where('hasil', 'SUSPECT'));
            $item->probable = count($item->pasien->where('hasil', 'PROBABLE'));
            if($item->konfirmasi > $item->suspect && $item->konfirmasi > $item->probable){
                $item->icon = '/storage/icon_red_32.png';
            }elseif($item->suspect > $item->konfirmasi && $item->suspect > $item->probable){
                $item->icon = '/storage/yellow_icon_32.png';
            }elseif($item->probable > $item->konfirmasi && $item->probable > $item->suspect){
                $item->icon = '/storage/black_icon_32.png';
            }elseif($item->konfirmasi == $item->suspect){
                $item->icon = '/storage/icon_red_32.png';
            }elseif($item->konfirmasi == $item->probable){
                $item->icon = '/storage/black_icon_32.png';
            }elseif($item->suspect == $item->probable){
                $item->icon = '/storage/black_icon_32.png';
            }else{
                $item->icon = '/storage/icon_green_32.png';
            }
            return $item;
        })->toArray();
        return view('admin.home',compact('kelurahan','data'));
    }

    public function polygon()
    {
        return view('admin.polygon');
    }

    public function data($id)
    {
        $data = Kelurahan::find($id)->pasien;
        return view('data',compact('data'));
    }
}
