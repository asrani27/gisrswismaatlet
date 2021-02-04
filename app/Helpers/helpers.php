<?php

use App\Pasien;
use Carbon\Carbon;

function sekarang()
{
    return Carbon::now()->format('Y-m-d');
}

function subDay2()
{
    return Carbon::now()->subDay(2)->format('Y-m-d');
}

function subDay1()
{
    return Carbon::now()->subDay(1)->format('Y-m-d');
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

function konfirmasiSubDay2()
{
    $data = count(Pasien::where('hasil','KONFIRMASI')->where('tgl_masuk', 'LIKE', '%'.subDay2().'%')->get());
    return $data;
}

function konfirmasiSubDay1()
{
    $data = count(Pasien::where('hasil','KONFIRMASI')->where('tgl_masuk', 'LIKE', '%'.subDay1().'%')->get());
    return $data;
}

function suspectSubDay2()
{
    $data = count(Pasien::where('hasil','SUSPECT')->where('tgl_masuk', 'LIKE', '%'.subDay2().'%')->get());
    return $data;
}

function suspectSubDay1()
{
    $data = count(Pasien::where('hasil','SUSPECT')->where('tgl_masuk', 'LIKE', '%'.subDay1().'%')->get());
    return $data;
}

function probableSubDay2()
{
    $data = count(Pasien::where('hasil','PROBABLE')->where('tgl_masuk', 'LIKE', '%'.subDay2().'%')->get());
    return $data;
}

function probableSubDay1()
{
    $data = count(Pasien::where('hasil','PROBABLE')->where('tgl_masuk', 'LIKE', '%'.subDay1().'%')->get());
    return $data;
}

function konfirmasiPersen()
{
    $result = 100 / konfirmasiSubDay2();
    $res = konfirmasiSubDay2() - konfirmasiSubDay1();
    $hasil = $result * $res;
    return $hasil;
}
function suspectPersen()
{
    $result = 100 / suspectSubDay2();
    $res = suspectSubDay2() - suspectSubDay1();
    $hasil = $result * $res;
    return $hasil;
}

function probablePersen()
{
    $result = 100 / probableSubDay2();
    $res = probableSubDay2() - probableSubDay1();
    $hasil = $result * $res;
    return $hasil;
}
