<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listas;
use App\Models\Tareas;

class ListaController extends Controller
{

    public function index($id)
    {
        $lista  = Listas::find($id);
        $listas = Listas::all();
        $tareas = Tareas::where('id_lista', $lista->id)->get();

        return view('lista')
            ->with('listas', $listas)
            ->with('lista', $lista)
            ->with('tareas', $tareas);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'lista' => 'required|min:1|max:100'
        ], [
            'lista.required' => 'Es necesario rellenar el campo de lista',
            'lista.min'      => 'La lista no puede estar vacio',
            'lista.max'      => 'La lista no puede exceder los 100 caracteres'
        ]);

        $lista = new Listas();

        $lista->id_usuario  = \Auth::id();
        $lista->lista       = $request->input('lista');
        $lista->descripcion = "";
        $lista->created_at  = date('Y-m-d H:i:s');

        $lista->save();

        $request->session()->flash('status', 'La lista fue agregada exitosamente!');

        return redirect()->back();
    }
}
