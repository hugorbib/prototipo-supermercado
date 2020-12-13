@extends('layouts.layout')
@section('contenido')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/datatables/dataTables.bootstrap4.css')}}">
<link href="{{ asset('css/bootstrap-switch.min.css')}}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-switch.css')}}" rel="stylesheet">
<style type="text/css">#map { height:65vh; width: 75hw;}</style>
<style type="text/css">#mapz { height:65vh; width: 75hw;}</style>
<style type="text/css">#idmap { height:65vh; width: 75hw;}</style>
<link rel="stylesheet" href="{{ asset('css/leaflet/leaflet.css')}}">
<script src="{{ asset('js/dashboard/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('js/switch/bootstrap-switch.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/mapkey-icon/MapkeyIcons.css')}}" />
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">· Colectores Registrados</h4>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down"><i class="ti-paint-bucket"></i> Alertas</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down"><i class="ti-location-arrow"></i> Registrados</span></a></li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"><i class="ti-paint-roller"></i> En Reparaci&oacute;n </span></a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                    {{-- TAB 1 --}}
                    <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="p-20">
                                <h4 class="card-title">Colectores en estado de emergencia</h4>
                                <h5>Colectores por encima del 50% de su capacidad.</h5>
                            </div>
                            <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Latitud</th>
                                                <th>Longitud</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sewers2 as $sewer2)
                                            <tr>
                                                @if ($sewer2->status == 2)
        
                                                <td>{{$sewer2->name}}</td>
                                                <td>{{$sewer2->latitude}}</td>
                                                <td>{{$sewer2->length}}</td>
                                                <td><span class="label label-danger">Emergencia</span> </td>
                                                <td><a href="#" class="addreff2 addid btn btn-primary"  data-toggle="modal" data-target="#leafletModal" data-ltd="{{$sewer2->latitude}}" data-lng="{{$sewer2->length}}" data-swr="{{$sewer2->name}}" data-swrid="{{$sewer2->id}}"><i class="fa fa-location-arrow" aria-hidden="true"></i></a>
                                                    <a href="#" class="addidswr2 btn btn-warning"  data-toggle="modal" data-target="#smModal2" data-idcomplaint="{{$sewer2->id}}"><i class="fa fa-pencil-alt"></i></a></td>
                                                    </tr>  
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- MODAL MAP--}}
                        <div class="modal fade bd-example" id="leafletModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    
                                                  </div>
                                        <div class="modal-body">
                                                <div class="card">
                                                        <div class="card-body">
                                            
                                                            <div id="mapz"></div>
                                            
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             {{-- small MODAL --}}
                             <div class="modal fade" id="smModal2" role="dialog">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Estado de la denuncia</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="{{ route('alerts.status')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                            <div class="col-lg-12 bt-switch">
                                                <center>
                                                    <div class="m-b-30">
                                                        <div class="form-group">
                                                            <label for="option1">Emergencia </label>
                                                            <input id="option1" type="radio" name="radiobt" value="2" class="radio-switch" checked> </div>
                                                        <div class="form-group">
                                                            <label for="option2">En Rep. </label>
                                                            <input id="option2" type="radio" name="radiobt" value="3" class="radio-switch" > </div>
                                                    </div>
                                                    <input type="hidden" id="ideswr" name="idcompliment">
                                                </center>
                                                </div>                                            
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-info">Guardar Cambio</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div>                                            
                                    </form>
                                  </div>
                                </div>
                            </div>

                            </div>

                            {{-- TAB 2  --}}
                    <div class="tab-pane  p-20" id="profile" role="tabpanel">
                            <div class="p-20">
                                    <h4 class="card-title">Colectores registrados</h4>
                                    <h5>Colectores Registrados</h5>
                            </div>
                    <div class="table-responsive m-t-40">
                            <table id="example24" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Latitud</th>
                                        <th>Longitud</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sewers as $sewer)
                                    <tr>
                                        @if ($sewer->status == 1)

                                        <td>{{$sewer->name}}</td>
                                        <td>{{$sewer->latitude}}</td>
                                        <td>{{$sewer->length}}</td>
                                        <td><span class="label label-info">Activo</span> </td>
                                        <td><a href="#" class="addreff btn btn-primary"  data-toggle="modal" data-target="#mapModal2" data-ltd="{{$sewer->latitude}}" data-lng="{{$sewer->length}}" data-swr="{{$sewer->name}}" data-swrid="{{$sewer->id}}"><i class="fa fa-location-arrow" aria-hidden="true"></i></a>
                                            <a href="#" class="addid btn btn-warning"  data-toggle="modal" data-target="#smModal2"><i class="fa fa-pencil-alt"></i></a></td>
                                    </tr>  
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                                {{-- MODAL --}}
                                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">  
                                                    <h4 class="modal-title" id="exampleModalLabel1">Información de la denuncia</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><b> Fecha de creaci&oacute;n: </b></p>
                                                    <center><p id="latd3"> </p></center> 
                                                    
                                                    <p><b> Info: </b></p>
                                                    <center><p id="long3"> </p></center> 
                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        {{-- MODAL MAP--}}
                        <div class="modal fade bd-example" id="mapModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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


                    </div>

                 {{-- TAB 3  --}}
                 <div class="tab-pane  p-20" id="messages" role="tabpanel">
                    <div class="p-20">
                            <h4 class="card-title">Colectores en reparaci&oacute;n</h4>
                            <h5>Colectores que continuan en reparaci&oacute;n</h5>
                    </div>
                    <div class="table-responsive m-t-40">
                            <table id="example25" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Latitud</th>
                                        <th>Longitud</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sewers3 as $sewer3)
                                    <tr>
                                        @if ($sewer3->status == 3)
    
                                        <td>{{$sewer3->name}}</td>
                                        <td>{{$sewer3->latitude}}</td>
                                        <td>{{$sewer3->length}}</td>
                                        <td><span class="label label-warning">Reparación</span> </td>
                                        <td><a href="#" class="addreff3 btn btn-primary"  data-toggle="modal" data-target="#fixModal" data-ltd="{{$sewer3->latitude}}" data-lng="{{$sewer3->length}}" data-swr="{{$sewer3->name}}" data-swrid="{{$sewer3->id}}"><i class="fa fa-location-arrow" aria-hidden="true"></i></a>
                                            <a href="#" class="addchange btn btn-warning"  data-toggle="modal" data-target="#smModal3" data-cnge="{{$sewer3->id}}"><i class="fa fa-pencil-alt"></i></a></td>
                                    </tr>  
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                          {{-- MODAL MAP--}}
                          <div class="modal fade bd-example" id="fixModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                
                                              </div>
                                    <div class="modal-body">
                                            <div class="card">
                                                    <div class="card-body">
                                        
                                                        <div id="idmap"></div>
                                        
                                                    </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- small MODAL --}}
                        <div class="modal fade" id="smModal3" role="dialog">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Estado de la denuncia</h4>

                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="{{ route('alerts.fixing')}}" method="post">
                                            @csrf
                                    <div class="modal-body">
                                            <div class="col-lg-12 bt-switch">
                                                <center>
                                                    <div class="m-b-30">
                                                        <div class="form-group">
                                                            <label for="radio4">En Rep. </label>
                                                            <input id="radio4" type="checkbox" name="fixingbtn" checked data-on-color="warning" data-off-color="danger" value="3" checked></div>
                                                            <div class="form-group">
                                                            <label for="radio5">Resuelto </label>
                                                            <input id="radio5" type="checkbox" name="fixingbtn" data-on-color="warning" data-off-color="danger" value="1"></div>
                                                    </div>
                                                    <input type="hidden" id="idchange" name="idcompliment2">
                                                </center>
                                                </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-info">Guardar Cambio</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div>                                            
                                    </form>
                                  </div>
                                </div>
                            </div>
                </div>
                

        </div>
    </div>
</div>
</div>
</div>
        <script src="{{ asset('js/dashboard/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/buttons/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/buttons/buttons.flash.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/buttons/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/buttons/buttons.print.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/jszip.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/pdf/pdfmake.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/pdf/vfs_fonts.js')}}"></script>

        <script src="{{ asset('js/leaflet/leaflet.js')}}"></script>
        <script src="{{ asset('js/mapkey-icon/L.Icon.Mapkey.js')}}"></script>
        @include('sweetalert::alert')
        <script>
                $(function() {
                $('#myTable').DataTable();
                $(document).ready(function() {
                var table = $('#example').DataTable({
                "columnDefs": [{
                "visible": false,
                "targets": 2
                }],
                "order": [
                [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                page: 'current'
                }).data().each(function(group, i) {
                if (last !== group) {
                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                last = group;
                }
                });
                }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
                } else {
                table.order([2, 'asc']).draw();
                }
                });
                });
                });
                $('#example23').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                 text: 'NUEVO COLECTOR',
                 action: function (e, dt, button, config){
                     window.location="{{route('sewers.location')}}";
                 }
                }
                ]
                });
                $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
        </script>
        <script>
                    $(function() {
                    $('#myTable').DataTable();
                    $(document).ready(function() {
                    var table = $('#example').DataTable({
                    "columnDefs": [{
                    "visible": false,
                    "targets": 2
                    }],
                    "order": [
                    [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                    page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                    page: 'current'
                    }).data().each(function(group, i) {
                    if (last !== group) {
                    $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                    last = group;
                    }
                    });
                    }
                    });
                    // Order by the grouping
                    $('#example tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                    } else {
                    table.order([2, 'asc']).draw();
                    }
                    });
                    });
                    });
                    $('#example24').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                     text: 'NUEVO COLECTOR',
                     action: function (e, dt, button, config){
                         window.location="{{route('sewers.location')}}";
                     }
                    }
                    ]
                    });
                    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
        </script>
        <script>
                $(function() {
                $('#myTable').DataTable();
                $(document).ready(function() {
                var table = $('#example').DataTable({
                "columnDefs": [{
                "visible": false,
                "targets": 2
                }],
                "order": [
                [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                page: 'current'
                }).data().each(function(group, i) {
                if (last !== group) {
                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                last = group;
                }
                });
                }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
                } else {
                table.order([2, 'asc']).draw();
                }
                });
                });
                });
                $('#example25').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                 text: 'NUEVO COLECTOR',
                 action: function (e, dt, button, config){
                     window.location="{{route('sewers.location')}}";
                 }
                }
                ]
                });
                $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
        </script>
        <script type="text/javascript">
            $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
            var radioswitch = function() {
                var bt = function() {
                    $(".radio-switch").on("switch-change", function() {
                        $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
                    }), $(".radio-switch").on("switch-change", function() {
                        $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
                    })
                };
                return {
                    init: function() {
                        bt()
                    }
                }
            }();
            $(document).ready(function() {
                radioswitch.init()
            });
        </script>
<script>
$('.addidswr2').on('click', function(){
            var ide = $(this).attr("data-idcomplaint");
            document.getElementById("ideswr").value = ide;
        });
</script>

<script>
        $('.addchange').on('click', function(){
                    var ide2 = $(this).attr("data-cnge");
                    document.getElementById("idchange").value = ide2;
                });
</script>


<script>
        var mymap = L.map('mapz').setView([-16.50587,-68.13266], 17);
       
       $(function() {
       $('#leafletModal').on("show.bs.modal", function () {
           setTimeout(function() {
            mymap.invalidateSize();
       }, 400);
       });
   });
   
      
   
   $('.addreff2').on('click', function(){
               var latitude = $(this).attr("data-ltd");
               var length = $(this).attr("data-lng");
               var swrname = $(this).attr("data-swr");
               var swrid = $(this).attr("data-swrid");
   
   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mymap);
   
   //COLLECTION A JSON! var data = '{{ json_encode($sewers) }}'; var hugh = JSON.parse(data.replace(/&quot;/g,'"'));
   var mki = L.icon.mapkey({icon:"waterwork",color:'#ffe0ea',background:'#ff3358',size:30});
   
   var data = @json($sewers2);
   
   for (var i = 0; i < data.length; i++) {
       var hugh = data[i];
   
           if (swrid == hugh.id) {
               var marker = L.marker([hugh.latitude, hugh.length],{icon: mki}).bindPopup(hugh.name).openPopup().addTo(mymap);
           }      
   }
   //FIN JSON ENCODE 2 GEOJSON
   
    $(function() {
       $('#leafletModal').on("hidden.bs.modal", function () {
           marker.remove();
       });
   });
   
   var popup = L.popup();
   });
   
   </script>
 {{-- R E G I S T R A D O S  --}}
<script>
     var map = L.map('map').setView([-16.50587,-68.13266], 17);
    
    $(function() {
    $('#mapModal2').on("show.bs.modal", function () {
        setTimeout(function() {
        map.invalidateSize();
    }, 400);
    });
});

   

$('.addreff').on('click', function(){
            var latitude = $(this).attr("data-ltd");
            var length = $(this).attr("data-lng");
            var swrname = $(this).attr("data-swr");
            var swrid = $(this).attr("data-swrid");

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

//COLLECTION A JSON! var data = '{{ json_encode($sewers) }}'; var hugh = JSON.parse(data.replace(/&quot;/g,'"'));
var mki = L.icon.mapkey({icon:"waterwork",color:'#ffe0ea',background:'#576ca8',size:30});

var data = @json($sewers);

for (var i = 0; i < data.length; i++) {
    var hugh = data[i];

        if (swrid == hugh.id) {
            var marker = L.marker([hugh.latitude, hugh.length],{icon: mki}).bindPopup(hugh.name).openPopup().addTo(map);
        }      
}
//FIN JSON ENCODE 2 GEOJSON

 $(function() {
    $('#mapModal2').on("hidden.bs.modal", function () {
        marker.remove();
    });
});

var popup = L.popup();
});

</script>

{{-- R E P A R A C I O N --}}

<script>
    var memap = L.map('idmap').setView([-16.50587,-68.13266], 17);
   
   $(function() {
   $('#fixModal').on("show.bs.modal", function () {
       setTimeout(function() {
        memap.invalidateSize();
   }, 400);
   });
});

  

$('.addreff3').on('click', function(){
           var latitude = $(this).attr("data-ltd");
           var length = $(this).attr("data-lng");
           var swrname = $(this).attr("data-swr");
           var swrid = $(this).attr("data-swrid");

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(memap);

//COLLECTION A JSON! var data = '{{ json_encode($sewers) }}'; var hugh = JSON.parse(data.replace(/&quot;/g,'"'));
var mki = L.icon.mapkey({icon:"waterwork",color:'#ffb8f',background:'#ffee2e',size:30});

var data = @json($sewers3);

for (var i = 0; i < data.length; i++) {
   var hugh = data[i];

       if (swrid == hugh.id) {
           var marker = L.marker([hugh.latitude, hugh.length],{icon: mki}).bindPopup(hugh.name).openPopup().addTo(memap);
       }      
}
//FIN JSON ENCODE 2 GEOJSON

$(function() {
   $('#fixModal').on("hidden.bs.modal", function () {
       marker.remove();
   });
});

var popup = L.popup();
});

</script>
@endsection