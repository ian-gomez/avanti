@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modulos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="user" class="btn btn-success btn-block btn-share pinterest" role="button">Empleados</a>
                    <a href="proveedores" class="btn btn-success btn-block btn-share pinterest" role="button">Proveedores</a>
                    <a href="remito-cabecera" class="btn btn-success btn-block btn-share pinterest" role="button">Remito</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
