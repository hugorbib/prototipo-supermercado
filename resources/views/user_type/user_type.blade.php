@extends('layouts.layout')
@section('contenido')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">· Tipos de Usuarios</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Tipos de usuarios</li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Crear Nuevo</button>
        </div>
    </div>
</div>

<div class="row justify-content-md-center">
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tipos de usuarios registrados</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo de Usuario</th>
                            <th>Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user_types as $user_type)
                            <tr>
                                <td>{{$user_type->id}}</td>
                                @if($user_type->tipo == 'ADMINISTRADOR')
                                <td><span class="label label-success">ADMINISTRADOR</span> </td>
                                @else
                                <td><span class="label label-info">EMPLEADO</span> </td>
                                @endif
                                <td>{{$user_type->created_at}}</td>
                            </tr>
                        @endforeach                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@stop