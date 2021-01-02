<?php

use App\Pasien;

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
    $data = count(Pasien::where('hasil','KONFIRMASI')->get());
    return $data;
}

function suspectToday()
{
    $data = count(Pasien::where('hasil','SUSPECT')->get());
    return $data;
}

function probableToday()
{
    $data = count(Pasien::where('hasil','PROBABLE')->get());
    return $data;
}