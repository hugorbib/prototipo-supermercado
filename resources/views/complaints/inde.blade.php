@extends('layouts.layout')
@section('contenido')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/datatables/dataTables.bootstrap4.css')}}">
<script src="{{ asset('js/dashboard/jquery/jquery-3.2.1.min.js')}}"></script>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
    <h4 class="text-themecolor">· Denuncias recibidas</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active">Denuncias</li>
    </ol>
</div>
    </div>
</div>
<div class="row">
    <div class="col-12">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Lista de denuncias</h4>
        <div class="table-responsive m-t-40">
            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nombre(s)</th>
                        <th>Apellido(s)</th>
                        <th>Teléfono</th>
                        <th>Direcci&oacute;n</th>
                        <th>Recibido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                    <tr>
                        <td>{{$complaint->name}}</td>
                        <td>{{$complaint->lastname}}</td>
                        <td>{{$complaint->phone}}</td>
                        <td>{{$complaint->ref}}</td>
                        <td>{{$complaint->created_at}}</td>
                        <td><a href="#" class="addreff btn btn-success" data-toggle="modal" data-target="#exampleModal"  id="myModalLabel" data-ltd="{{$complaint->latitude}}" data-lng="{{$complaint->length}}" data-descrip="{{$complaint->description}}" data-mail="{{$complaint->email}}" data-image="{{$complaint->img}}"><i class="fa fa-eye"></i></a></td>                                
                    </tr>               
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
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
@include('sweetalert::alert')

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
    document.getElementById("latd").innerHTML = latitude;
    document.getElementById("long").innerHTML = length;
    document.getElementById("descriptionp").innerHTML = description;
    document.getElementById("emailp").innerHTML = email;
    document.getElementById("imgp").src = "/storage/".concat(img);
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
    @stop