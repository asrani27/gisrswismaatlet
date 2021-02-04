@extends('layouts.app')

@push('css') 
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<style>
    #mapid { height: 500px; }
    #mapdapur { height: 500px; }
    #mapbanjir { height: 400px; }
</style>
@endpush


@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            <li class="pt-2 px-3"><h3 class="card-title">Card Title</h3></li>
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Banjir</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Dapur</a>
            </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                <div id="mapbanjir"></div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                <div id="mapdapur"></div>
            </div>
            </div>
        </div>
        <!-- /.card -->
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>

<script>
    var banjir = L.map('mapbanjir').setView([-6.203106313909043, 106.836372623998], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(banjir);
        
    var dapur = L.map('mapdapur').setView([-6.203106313909043, 106.836372623998], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(dapur); 
        
    var homeTab = document.getElementById('custom-tabs-two-home');
        
    var observer1 = new MutationObserver(function(){
        if(homeTab.style.display != 'none'){
            banjir.invalidateSize();
        }
    });
    observer1.observe(homeTab, {attributes: true});  
        
    var menu1Tab = document.getElementById('home');
    var observer2 = new MutationObserver(function(){
        if(menu1Tab.style.display != 'none'){
        dapur.invalidateSize();
        }
    });
    observer2.observe(menu1Tab, {attributes: true}); 
</script>

@endpush