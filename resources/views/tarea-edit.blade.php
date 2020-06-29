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

            <table class="table">
                <tr>
                    <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td colspan="2">
                            <input type="text" class="form-control" name="tarea" placeholder="Agregar Tarea" value="{{ $tarea->tarea }}">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary w-100">Actualizar</button>
                        </td>
                    </form>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
