<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class PersonController extends Controller
{
    // Desplega todos los datos
    public function index()
    {
        $data = Person::all();

        return view('crud.index')->with('data', $data);
    }

    // Agrega a una persona
    public function add(Request $resquest)
    {
        $data = new Person;

        $data->nombre = $request->nombre;
        $data->edad = $request->edad;
        $data->email = $request->email;

        $data->save();

        return back()->with('success', 'Persona agregada correctamente');
    }

    // Ver persona en especifico
    public function view(Request $request)
    {
        if ($request->ajax())
        {
            $id = $request->id;

            $info = Person::find($id);

            return response()->json($info);
        }
    }

    // Actualizar a una persona en particular
    public function update(Request $request)
    {
        $id = $request->edit_id;

        $data = Person::find($id);

        $data->nombre = $request->edit_nombre;
        $data->edad = $request->edit_edad;
        $data->email = $request->edit_email;

        $data->save();

        return back()->with('success', 'Persona actulizada correctamente');
    }

    // Eliminar persona en particular
    public function delete(Request $request)
    {
        $id = $request->id;

        $data = Person::find($id);

        $response = $data->delete();

        if ($response)
        {
            echo "Persona elimina correctamente";
        }
        else
        {
            echo "Ocurrio un problema al tratar de eliminar la persona. ¡Intenta de nuevo!";

        }

    }
}
