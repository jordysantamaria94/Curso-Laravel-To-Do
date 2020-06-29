<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Listas;
use App\Models\Tareas;

class TareaController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'tarea' => 'required|min:1|max:100'
        ], [
            'tarea.required' => 'Es necesario rellenar el campo de lista',
            'tarea.min'      => 'La lista no puede estar vacio',
            'tarea.max'      => 'La lista no puede exceder los 100 caracteres'
        ]);

        $tarea = new Tareas();

        $tarea->id_lista    = $request->input('id');
        $tarea->tarea       = $request->input('tarea');
        $tarea->created_at  = date('Y-m-d H:i:s');

        $tarea->save();

        $request->session()->flash('status', 'La tarea fue agregada exitosamente!');

        return redirect()->back();
    }

    public function edit($id)
    {
        $listas = Listas::all();
        $tarea = Tareas::find($id);

        return view('tarea-edit')
            ->with('listas', $listas)
            ->with('tarea', $tarea);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tarea' => 'required|min:1|max:100'
        ], [
            'tarea.required' => 'Es necesario rellenar el campo de lista',
            'tarea.min'      => 'La lista no puede estar vacio',
            'tarea.max'      => 'La lista no puede exceder los 100 caracteres'
        ]);

        $tarea = Tareas::find($id);

        $tarea->tarea       = $request->input('tarea');
        $tarea->updated_at  = date('Y-m-d H:i:s');

        $tarea->save();

        $request->session()->flash('status', 'La tarea fue actualizada exitosamente!');

        return redirect()->route('lista', $tarea->id_lista);
    }

    public function destroy($id)
    {
        Tareas::destroy($id);

        return redirect()->back();
    }
}
