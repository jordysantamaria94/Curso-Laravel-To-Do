@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4 text-center">
            <h2>
                <i class="fas fa-check-double"></i>
            </h2>
            <h1 class="font-extra-bold">To-Do</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <h3 class="font-bold">Todos tus recordatorios en un solo lugar</h3>
            <p>Escribe, Programa y Hazlo</p>
            @guest
                <a class="btn btn-danger btn-lg font-bold" href="{{ route('register') }}">Registrarme</a>
                <p>
                    <a href="{{ route('login') }}">Ya tengo una cuenta</a>
                </p>
            @else
                <a class="btn btn-danger btn-lg font-bold" href="{{ route('login') }}">Ir a mis notas</a>
            @endguest
        </div>
    </div>
</div>
@endsection
