@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">

            @if(count($errors))
                <div class="alert alert-danger">
                    <strong>Ups!</strong> Al parecer no se han cumplido los siguientes criterios:
                    <br/>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if($listas)
            <ul class="list-group">
                @foreach($listas as $lista)
                    <li class="list-group-item">
                        <a href="{{ route('lista', $lista->id) }}">{{ $lista->lista }}</a>
                    </li>
                @endforeach
            </ul>
            @endif
            <button class="btn btn-primary w-100 mt-3" data-toggle="modal" data-target="#nuevaListaModal">
                Nueva lista 
                <i class="fas fa-list-alt"></i>
            </button>
        </div>
    </div>
</div>
<div class="modal fade" id="nuevaListaModal" tabindex="-1" role="dialog" aria-labelledby="nuevaListaModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('listas.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Lista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="lista" class="form-control" placeholder="Agregar Lista">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
