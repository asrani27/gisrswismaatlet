@extends('layouts.app_admin')

@push('css') 
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<style>
    #mapid { height: 500px; }
</style>
@endpush

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0"> <i class="fas fa-virus"></i> Peta Pesebaran Covid-19 </h5>
      </div>
      <div class="card-body">
        <div id="mapid"></div>
        
      </div>
    </div>
  </div>
  <!-- /.col-md-6 -->
</div>
@endsection

@push('js')

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>
<script>
    var map = L.map('mapid').setView([-3.440859890353315, 114.744703599548103], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        var myStyle = {
            "color" : "#ff7800",
            "weight" : 1,
            "opacity" : 0.65,
        }
        var jsonData = {
                "type": "FeatureCollection",
                "name": "landasanulin",
                "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
                "features": [
                { "type": "Feature", "properties": { "id": 1 }, "geometry": { "type": "MultiPolygon", "coordinates": [ [ [ [ 114.744703599548103, -3.440859890353315 ], [ 114.748262120967823, -3.43845699181628 ], [ 114.750983343230018, -3.438822650680021 ], [ 114.752814935137266, -3.439083835496822 ], [ 114.75312892232138, -3.43861370277505 ], [ 114.755536157399433, -3.438979361578688 ], [ 114.755954806978238, -3.43715106615846 ], [ 114.757420080504019, -3.436628695394727 ], [ 114.757838730082824, -3.435688427299309 ], [ 114.758519035648348, -3.432501956310334 ], [ 114.76893294392093, -3.434695921082449 ], [ 114.767624663987149, -3.441852390154976 ], [ 114.780288813745784, -3.444203043454808 ], [ 114.78002715775898, -3.448173022513318 ], [ 114.777096610707446, -3.447911840189664 ], [ 114.769665580683821, -3.445404486233542 ], [ 114.760978601923796, -3.443785149958926 ], [ 114.749308744914856, -3.442688178659643 ], [ 114.745854885889798, -3.442113574141466 ], [ 114.744965255534851, -3.441434495627659 ], [ 114.744703599548103, -3.440859890353315 ] ] ] ] } }
                ]
            }
        L.geoJSON(jsonData).addTo(map).bindPopup('Test Click Di Layer');

        console.log(jsonData);
        
</script>
@endpush