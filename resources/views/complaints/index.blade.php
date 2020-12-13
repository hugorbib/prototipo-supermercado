@extends('layouts.layout')
@section('contenido')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/datatables/dataTables.bootstrap4.css')}}">

<link href="{{ asset('css/bootstrap-switch.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-switch.css')}}" rel="stylesheet">

<script src="{{ asset('js/dashboard/jquery/jquery-3.2.1.min.js')}}"></script>

<script src="{{ asset('js/switch/bootstrap-switch.min.js')}}"></script>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">· Denuncias</h4>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down"><i class="ti-home"></i> Recibidas</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down"><i class="ti-hummer"></i> En Reparaci&oacute;n</span></a></li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"><i class="ti-brush"></i> Resueltas - </span></a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                    {{-- TAB 1 --}}
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="p-20">
                            <h4 class="card-title">Denuncias recibidas</h4>
                            <h5>Las últimas denuncias recibidas apareceran aquí.</h5>
                        </div>
                        <div class="table-responsive m-t-40">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre(s)</th>
                                            <th>Apellido(s)</th>
                                            <th>Teléfono</th>
                                            <th>Direcci&oacute;n</th>
                                            <th>Recibido</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($complaints as $complaint)
                                        <tr>
                                            @if ($complaint->status == 1)

                                            <td>{{$complaint->name}}</td>
                                            <td>{{$complaint->lastname}}</td>
                                            <td>{{$complaint->phone}}</td>
                                            <td>{{$complaint->ref}}</td>
                                            <td>{{$complaint->created_at}}</td>
                                            <td><span class="label label-info">RECIBIDO</span> </td>
                                        <td><a href="#" class="addreff btn btn-success" data-toggle="modal" data-target="#exampleModal"  id="myModalLabel" data-ltd="{{$complaint->latitude}}" data-lng="{{$complaint->length}}" data-descrip="{{$complaint->description}}" data-mail="{{$complaint->email}}" data-image="{{$complaint->img}}"><i class="fa fa-eye"></i></a>
                                                <a href="#" class="addid btn btn-warning"  data-toggle="modal" data-target="#smModal2"  data-idcomplaint="{{$complaint->id}}" ><i class="fa fa-pencil-alt"></i></a></td>   

                                        </tr>  
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- MODAL --}}
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">  
                                                    <h4 class="modal-title" id="exampleModalLabel1">Información de la denuncia</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><b> Latitud: </b></p>
                                                    <center><p id="latd"> </p></center> 
                                                    
                                                    <p><b> Longitud: </b></p>
                                                    <center><p id="long"> </p></center> 
                                    
                                                    <p><b> Descripci&oacute;n:</b></p>
                                                    <center><p id="descriptionp"> </p></center> 
                                    
                                                    <p><b>Email: </b></p>
                                                    <center><p id="emailp"> </p></center> 
                                    
                                                    <p><b>Im&aacute;gen: </b></p>
                                                    <center><img id="imgp" width="200px"></center> 
                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
                                            <form action="{{ route('complaints.status')}}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                    <div class="col-lg-12 bt-switch">
                                                        <center>
                                                            <div class="m-b-30">
                                                                <div class="form-group">
                                                                    <label for="option1">Recibido </label>
                                                                    <input id="option1" type="radio" name="radiobt" value="1" class="radio-switch" checked> </div>
                                                                <div class="form-group">
                                                                    <label for="option2">En Rep. </label>
                                                                    <input id="option2" type="radio" name="radiobt" value="2" class="radio-switch" > </div>
                                                                <div class="form-group">
                                                                    <label for="option3">Resuelto </label>
                                                                    <input id="option3" type="radio" name="radiobt" value="3" class="radio-switch" > </div>
                                                            </div>
                                                            <input type="hidden" id="idp" name="idcompliment">
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
                                    <h4 class="card-title">Denuncias en reparaci&oacute;n</h4>
                                    <h5>Lista de denuncias que continuan en reparaci&oacute;n</h5>
                            </div>

                            <div class="table-responsive m-t-40">
                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nombre(s)</th>
                                                <th>Apellido(s)</th>
                                                <th>Teléfono</th>
                                                <th>Direcci&oacute;n</th>
                                                <th>Recibido</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($complaints2 as $complaint2)
                                            <tr>
                                                @if ($complaint2->status == 2)
    
                                                <td>{{$complaint2->name}}</td>
                                                <td>{{$complaint2->lastname}}</td>
                                                <td>{{$complaint2->phone}}</td>
                                                <td>{{$complaint2->ref}}</td>
                                                <td>{{$complaint2->created_at}}</td>
                                                <td><span class="label label-warning">EN REPARACIÓN!</span></td>
                                                <td><a href="#" class="addreff btn btn-success" data-toggle="modal" data-target="#exampleModal2"  id="myModalLabel" data-ltd="{{$complaint2->latitude}}"  data-lng="{{$complaint2->length}}" data-descrip="{{$complaint2->description}}" data-mail="{{$complaint2->email}}" data-image="{{$complaint2->img}}"><i class="fa fa-eye"></i></a>
                                                    <a href="#" class="addid2 btn btn-warning"  data-toggle="modal" data-target="#smModal" data-idcomplaint="{{$complaint2->id}}" data-mailer="{{$complaint2->email}}" ><i class="fa fa-pencil-alt"></i></a></td>   
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
                                                        <p><b> Latitud: </b></p>
                                                        <center><p id="latd2"> </p></center> 
                                                        
                                                        <p><b> Longitud: </b></p>
                                                        <center><p id="long2"> </p></center> 
                                        
                                                        <p><b> Descripci&oacute;n:</b></p>
                                                        <center><p id="descriptionp2"> </p></center> 
                                        
                                                        <p><b>Email: </b></p>
                                                        <center><p id="emailp2"> </p></center> 
                                        
                                                        <p><b>Im&aacute;gen: </b></p>
                                                        <center><img id="imgp2" width="200px"></center> 
                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info">Guardar Cambio</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                {{-- small MODAL --}}
                                <div class="modal fade" id="smModal" role="dialog">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Estado de la denuncia</h4>

                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <form action="{{ route('complaints.fixing')}}" method="post">
                                                @csrf
                                        <div class="modal-body">
                                                <div class="col-lg-12 bt-switch">
                                                    <center>
                                                        <div class="m-b-30">
                                                            <div class="form-group">
                                                                <label for="radio4">En Rep. </label>
                                                                <input id="radio4" type="checkbox" name="fixingbtn" checked data-on-color="warning" data-off-color="danger" value="2"></div>
                                                                <div class="form-group">
                                                                <label for="radio5">Resuelto </label>
                                                                <input id="radio5" type="checkbox" name="fixingbtn" data-on-color="warning" data-off-color="danger" value="3"></div>
                                                        </div>
                                                        <input type="hidden" id="idp2" name="idcompliment2">
                                                        <input type="hidden" id="mailcomp" name="mailcompliment2">
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
                    {{-- TAB 3  --}}
                    <div class="tab-pane p-20" id="messages" role="tabpanel">
                            <div class="p-20">
                                    <h4 class="card-title">Denuncias resueltas</h4>
                                    <h5>Lista de denuncias solucionadas.</h5>
                            </div>

                            <div class="table-responsive m-t-40">
                                    <table id="example25" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nombre(s)</th>
                                                <th>Apellido(s)</th>
                                                <th>Teléfono</th>
                                                <th>Direcci&oacute;n</th>
                                                <th>Recibido</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($complaints3 as $complaint3)
                                            <tr>
                                                @if ($complaint3->status == 3)
    
                                                <td>{{$complaint3->name}}</td>
                                                <td>{{$complaint3->lastname}}</td>
                                                <td>{{$complaint3->phone}}</td>
                                                <td>{{$complaint3->ref}}</td>
                                                <td>{{$complaint3->created_at}}</td>
                                                <td><span class="label label-success">RESUELTO</span></td>
                                                <td><a href="#" class="addreff btn btn-success" data-toggle="modal" data-target="#exampleModal3"  id="myModalLabel" data-ltd="{{$complaint3->latitude}}" data-lng="{{$complaint3->length}}" data-descrip="{{$complaint3->description}}" data-mail="{{$complaint3->email}}" data-image="{{$complaint3->img}}"><i class="fa fa-eye"></i></a></td>                                
                                            </tr>  
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
    
                                {{-- MODAL --}}
                                    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">  
                                                        <h4 class="modal-title" id="exampleModalLabel1">Información de la denuncia</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><b> Latitud: </b></p>
                                                        <center><p id="latd3"> </p></center> 
                                                        
                                                        <p><b> Longitud: </b></p>
                                                        <center><p id="long3"> </p></center> 
                                        
                                                        <p><b> Descripci&oacute;n:</b></p>
                                                        <center><p id="descriptionp3"> </p></center> 
                                        
                                                        <p><b>Email: </b></p>
                                                        <center><p id="emailp3"> </p></center> 
                                        
                                                        <p><b>Im&aacute;gen: </b></p>
                                                        <center><img id="imgp3" width="200px"></center> 
                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
{{-- <script>
if(document.getElementById('radio4').checked) {
    document.getElementById('radio5').checked = false;)
} else (document.getElementById('radio5').checked) {
    document.getElementById('radio4').checked = false;)
} 
</script> --}}
<script type="text/javascript">
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
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

        <script src="{{ asset('js/dashboard/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/buttons/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/buttons/buttons.flash.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/buttons/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/buttons/buttons.print.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/jszip.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/pdf/pdfmake.min.js')}}"></script>
        <script src="{{ asset('js/dashboard/datatables/pdf/vfs_fonts.js')}}"></script>
<script>
$('.addreff').on('click', function(){
    var latitude = $(this).attr("data-ltd");
    var length = $(this).attr("data-lng");
    var description = $(this).attr("data-descrip");
    var email = $(this).attr("data-mail");
    var img = $(this).attr("data-image");
    var ide = $(this).attr("data-idcomplaint");
    document.getElementById("latd").innerHTML = latitude;
    document.getElementById("long").innerHTML = length;
    document.getElementById("descriptionp").innerHTML = description;
    document.getElementById("emailp").innerHTML = email;
    document.getElementById("imgp").src = "/storage/".concat(img);
    document.getElementById("idp").value = ide;
});
</script>
<script>
        $('.addid').on('click', function(){
            var ide = $(this).attr("data-idcomplaint");
            document.getElementById("idp").value = ide;
        });
    </script>
<script>

        $('.addid2').on('click', function(){
            var ide = $(this).attr("data-idcomplaint");
            var email = $(this).attr("data-mailer");
            document.getElementById("idp2").value = ide;
            document.getElementById("mailcomp").value = email;
        });
    </script>


<script>
        $('.addreff').on('click', function(){
            var latitude = $(this).attr("data-ltd");
            var length = $(this).attr("data-lng");
            var description = $(this).attr("data-descrip");
            var email = $(this).attr("data-mail");
            var img = $(this).attr("data-image");
            var ide = $(this).attr("data-idcomplaint");            
            document.getElementById("latd2").innerHTML = latitude;
            document.getElementById("long2").innerHTML = length;
            document.getElementById("descriptionp2").innerHTML = description;
            document.getElementById("emailp2").innerHTML = email;
            document.getElementById("imgp2").src = "/storage/".concat(img);
            document.getElementById("idp2").innerHTML = ide;

        });
</script>

<script>
        $('.addreff').on('click', function(){
            var latitude = $(this).attr("data-ltd");
            var length = $(this).attr("data-lng");
            var description = $(this).attr("data-descrip");
            var email = $(this).attr("data-mail");
            var img = $(this).attr("data-image");
            var ide = $(this).attr("data-idcomplaint");            
            document.getElementById("latd3").innerHTML = latitude;
            document.getElementById("long3").innerHTML = length;
            document.getElementById("descriptionp3").innerHTML = description;
            document.getElementById("emailp3").innerHTML = email;
            document.getElementById("imgp3").src = "/storage/".concat(img);
            document.getElementById("idp3").innerHTML = ide;
        });
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
            $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
             text: 'PDF',
             action: function (e, dt, button, config){
                 window.location="{{route('complaints.pdf')}}";
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
                     text: 'PDF',
                     action: function (e, dt, button, config){
                         window.location="{{route('pdf.fixing')}}";
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
                     text: 'PDF',
                     action: function (e, dt, button, config){
                         window.location="{{route('pdf.solved')}}";
                     }
                    }
                    ]
                    });
                    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
                    </script>
            
@stop