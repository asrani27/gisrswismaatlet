<?php

use App\Pasien;
use Carbon\Carbon;

function sekarang()
{
    return Carbon::now()->format('Y-m-d');
}

function konfirmasi()
{
    $data = count(Pasien::where('hasil','KONFIRMASI')->get());
    return $data;
}

function suspect()
{
    $data = count(Pasien::where('hasil','SUSPECT')->get());
    return $data;
}

function probable()
{
    $data = count(Pasien::where('hasil','PROBABLE')->get());
    return $data;
}

function konfirmasiToday()
{
    $data = count(Pasien::where('hasil','KONFIRMASI')->where('created_at', 'LIKE', '%'.sekarang().'%')->get());
    return $data;
}

function suspectToday()
{
    $data = count(Pasien::where('hasil','SUSPECT')->where('created_at', 'LIKE', '%'.sekarang().'%')->get());
    return $data;
}

function probableToday()
{
    $data = count(Pasien::where('hasil','PROBABLE')->where('created_at', 'LIKE', '%'.sekarang().'%')->get());
    return $data;
}