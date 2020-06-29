@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            @if($listas)
            <ul class="list-group">
                @foreach($listas as $list)
                    <li class="list-group-item">
                        <a href="{{ route('lista', $list->id) }}">{{ $list->lista }}</a>
                    </li>
                @endforeach
            </ul>
            @endif
            <button class="btn btn-primary w-100 mt-3" data-toggle="modal" data-target="#nuevaListaModal">
                Nueva lista 
                <i class="fas fa-list-alt"></i>
            </button>
        </div>
        <div class="col-8">
              
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

            <h1 class="font-bold mb-3">{{ $lista->lista }}</h1>
            <table class="table">
                @foreach($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->tarea }}</td>
                    <td class="text-right">
                        <a class="btn btn-success" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                            <i class="fas fa-check"></i>
                        </a>
                        <a class="btn btn-primary" href="{{ route('tareas.edit', $tarea->id) }}">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                            <i class="fas fa-trash"></i>
                        </a>
                        <form id="delete-form" action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <form action="{{ route('tareas.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $lista->id }}">
                        <td>
                            <input type="text" class="form-control" name="tarea" placeholder="Agregar Tarea">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary w-100">Agregar</button>
                        </td>
                    </form>
                </tr>
            </table>
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
