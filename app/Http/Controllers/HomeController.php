<?php

namespace App\Http\Controllers;

use App\Marker;
use App\Pasien;
use App\Kelurahan;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        
        $dates = $tanggal;
        
        $kelurahan = Kelurahan::all()->map(function($item, $key){
            $item->pasien = $item->pasien;
            $item->total = count($item->pasien);
            $item->konfirmasi = count($item->pasien->where('hasil', 'KONFIRMASI'));
            $item->suspect = count($item->pasien->where('hasil', 'SUSPECT'));
            $item->probable = count($item->pasien->where('hasil', 'PROBABLE'));
            if($item->konfirmasi == 0 && $item->suspect == 0 && $item->probable == 0){                
                $m = Marker::where('warna','Hijau')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
            }elseif($item->konfirmasi > $item->suspect && $item->konfirmasi > $item->probable){
                           
                $m = Marker::where('warna','Merah')->where('jumlah', '>=', $item->total)->orderBy('jumlah','ASC')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
                
            }elseif($item->suspect > $item->konfirmasi && $item->suspect > $item->probable){
                $m = Marker::where('warna','Kuning')->where('jumlah', '>=', $item->total)->orderBy('jumlah','ASC')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
                
            }elseif($item->probable > $item->konfirmasi && $item->probable > $item->suspect){
                $m = Marker::where('warna','Hitam')->where('jumlah', '>=', $item->total)->orderBy('jumlah','ASC')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
            }elseif($item->konfirmasi == $item->suspect){
                $m = Marker::where('warna','Merah')->where('jumlah', '>=', $item->total)->orderBy('jumlah','ASC')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
                
            }elseif($item->konfirmasi == $item->probable){
                $m = Marker::where('warna','Hitam')->where('jumlah', '>=', $item->total)->orderBy('jumlah','ASC')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
            }elseif($item->suspect == $item->probable){
                $m = Marker::where('warna','Hitam')->where('jumlah', '>=', $item->total)->orderBy('jumlah','ASC')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
            }else{
                $m = Marker::where('warna','Hijau')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
            }
            return $item;
        })->toArray();
        
        return view('index',compact('kelurahan','data'));
    }

    public function home()
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
        
        $dates = $tanggal;
        
        $kelurahan = Kelurahan::all()->map(function($item, $key){
            $item->pasien = $item->pasien;
            $item->total = count($item->pasien);
            $item->konfirmasi = count($item->pasien->where('hasil', 'KONFIRMASI'));
            $item->suspect = count($item->pasien->where('hasil', 'SUSPECT'));
            $item->probable = count($item->pasien->where('hasil', 'PROBABLE'));
            if($item->konfirmasi == 0 && $item->suspect == 0 && $item->probable == 0){                
                $m = Marker::where('warna','Hijau')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
            }elseif($item->konfirmasi > $item->suspect && $item->konfirmasi > $item->probable){
                           
                $m = Marker::where('warna','Merah')->where('jumlah', '>=', $item->total)->orderBy('jumlah','ASC')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
                
            }elseif($item->suspect > $item->konfirmasi && $item->suspect > $item->probable){
                $m = Marker::where('warna','Kuning')->where('jumlah', '>=', $item->total)->orderBy('jumlah','ASC')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
                
            }elseif($item->probable > $item->konfirmasi && $item->probable > $item->suspect){
                $m = Marker::where('warna','Hitam')->where('jumlah', '>=', $item->total)->orderBy('jumlah','ASC')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
            }elseif($item->konfirmasi == $item->suspect){
                $m = Marker::where('warna','Merah')->where('jumlah', '>=', $item->total)->orderBy('jumlah','ASC')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
                
            }elseif($item->konfirmasi == $item->probable){
                $m = Marker::where('warna','Hitam')->where('jumlah', '>=', $item->total)->orderBy('jumlah','ASC')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
            }elseif($item->suspect == $item->probable){
                $m = Marker::where('warna','Hitam')->where('jumlah', '>=', $item->total)->orderBy('jumlah','ASC')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
            }else{
                $m = Marker::where('warna','Hijau')->first();
                if($m == null){
                    $item->icon = '';
                }else{
                    $item->icon = '/storage/'.$m->icon;   
                }
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
