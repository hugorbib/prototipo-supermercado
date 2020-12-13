@extends('layouts.layoutde')
@section('contenido')
<style> .announce{color: green; }</style>
<link href="{{ asset('css/file-upload.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/leaflet/leaflet.css')}}">
<script src="{{ asset('js/dashboard/jquery/jquery-3.2.1.min.js')}}"></script>

<link rel="stylesheet" href="{{ asset('css/leaflet/geocoder/esri-leaflet-geocoder.css')}}">
<style type="text/css">#map { height:65vh; width: 75hw;}</style>

<div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">· Denuncias</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Crear Denuncias</li>
                </ol>
            </div>
        </div>
</div> 
<form  method="POST" action="{{route('complaints.store')}}" enctype="multipart/form-data">
    @csrf
<div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                        <h4 class="card-title"> > Informaci&oacute;n del denunciante</h4>
                    <h6 class="card-subtitle">Llene su informaci&oacute;n personal </h6>

                        <div class="form-group">
                            <label for="exampleInputuname">Nombre(s)</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                </div>
                            <input type="text" class="form-control" name="name" value="{{$confirmation->name}}" placeholder="Nombres" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputuname">Apellido(s)</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="lastname" value="{{$confirmation->lastname}}" placeholder="Apellidos" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Correo Electr&oacute;nico</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="ti-email"></i></span>
                                </div>
                                <input type="text" class="form-control" name="email" value="{{$confirmation->email}}" placeholder="Email" aria-label="Email" aria-describedby="basic-addon2">
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputuname">Tel&eacute;fono M&oacute;vil</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-mobile"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$confirmation->phone}}" placeholder="Tel&eacute;fono" aria-label="Username" aria-describedby="basic-addon1"> 
                                </div>
                            <small class="announce" class="form-control-feedback"> Confirme su número recibido por <b>SMS</b></small>                              

                            </div>

</div>
</div>
</div>
<div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">> Informaci&oacute;n de la denuncia</h4>
                    <h6 class="card-subtitle">Redacte su denuncia con el mayor detalle posible.</h6>
                        <div class="form-group">
                                <label for="exampleInputuname">Registrar Ubicaci&oacute;n</label>
                                <div class="input-group-prepend">
                                <input type="text" class="form-control" name="ref" value="{{$confirmation->ref}}" id="ref" readonly placeholder="Ubicación"><button type="button" class=" btn btn-block btn-outline-info "  data-toggle="modal" data-target="#myModal"> <i class="ti-location-pin"></i> Seleccionar Ubicaci&oacute;n</button>
                                <input type="hidden" id="ltd" value="{{$confirmation->latitude}}" name="latitude">
                                <input type="hidden" id="lng" value="{{$confirmation->length}}" name="length">
                                    </div>
                                <small  class="form-control-feedback" > Seleccione la ubicaci&oacute;n del incidente en el mapa. </small>                              

                        </div>
                             <div class="form-group">
                                <label for="input-file-now">Agregar archivos</label>
                                     <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                            <i class="fa fa-file fileinput-exists"></i>
                                            <span class="fileinput-filename"></span>
                                        </div>
                                        <span class="input-group-addon btn btn-secondary btn-file"> 
                                            <span class="fileinput-new">Seleccionar Arch</span>
                                        <span class="fileinput-exists">Change</span>
                                <input type="hidden" value="{{$confirmation->img}}" name="img">
                                <input type="file">
                                        </span>
                                        <a href="#" class="input-group-addon btn btn-secondary fileinput-exists" data-dismiss="fileinput">Remove</a> 
                                </div> 
                             <small  class="form-control-feedback"> Adjunte im&aacute;genes en caso de ser necesario. </small>                               
                        </div> 
                            <div class="form-group">
                                <label for="exampleInputuname">· Descripci&oacute;n</label>
                                    {{-- <textarea class="form-control" id="summary-ckeditor" ></textarea> --}}
                                    <textarea class="form-control" name="description" placeholder="Ingrese los detalles de la denuncia">{{$confirmation->description}}</textarea>

                            </div>
                            {{-- MODAL MAP--}}
                            <div class="modal fade bd-example" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                                <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        
                                                      </div>
                                            <div class="modal-body">
                                                    <div class="card">
                                                            <div class="card-body">
                                                
                                                                <div id="map"></div>
                                                
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                         
                        <button type="button"  data-toggle="modal" data-target="#authModal"  id="myModalLabel" class="btn btn-info waves-effect waves-light m-r-10"><i class="ti-check"></i> Confirmar Env&iacute;o</button>
                        <button type="button" class="btn btn-inverse waves-effect waves-light">Cancelar</button>
                    </form>
                      </div>
    
</div>
</div>

{{-- MODAL SMS --}}
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Confirmaci&oacute;n</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <center><p>Ingrese su n&uacute;mero de confirmaci&oacute;n</p></center> 
                    <p>> Ingrese el número de verificaci&oacute;n recibido </p> <center><b><input type="text" style="text-align:center; font-weight:bold;"  name="authnumber"></b></center> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" data-toggle="modal"  class="btn btn-success"><i class="ti-flag-alt"></i> Enviar Denuncia</button>
                </div>
            </div>
        </div>
</div>
{{-- MODAL 'SMS' --}}

@include('sweetalert::alert')

<script src="{{ asset('js/leaflet/leaflet.js')}}"></script>

<script src="{{ asset('js/leaflet/geocoding/esri-leaflet.js')}}"></script>

<script src="{{asset('js/leaflet/geocoding/esri-leaflet-geocoder.js')}}"></script>
<script>
$(window).on('load', function(){        
   $('#exampleModalCenter').modal('show');
    }); 
</script>
<script>
        var map = L.map('map').setView([-16.50587,-68.13266], 17);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

L.marker([-16.50587,-68.13266]).addTo(map).bindPopup("Posición Actual!").openPopup();

$(function() {
    $('#myModal').on("show.bs.modal", function () {
        setTimeout(function() {
        map.invalidateSize();
    }, 400);
    });
});
var geocodeService = L.esri.Geocoding.geocodeService();

var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .openOn(map);
        document.getElementById("ltd").value = e.latlng.lat.toString();
        document.getElementById("lng").value = e.latlng.lng.toString();
}

map.on('click', onMapClick);

map.on('click', function(e) {
    geocodeService.reverse().latlng(e.latlng).run(function(error, result) {
      L.marker(result.latlng).addTo(map).bindPopup(result.address.Match_addr).openPopup();
      document.getElementById("ref").value = result.address.Match_addr;
    });
  });
  
</script>
         

@endsection



