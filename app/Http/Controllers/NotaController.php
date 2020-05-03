<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nota;

class NotaController extends Controller
{
    public function index()
    {
        return nota::all();
    }

    public function show($id)
    {
        return nota::findOrFail($id);
    }

    public function store(Request $request)
    {
        $nota = nota::create($request->all());
        return response()->json($nota, 201);
    }

    public function update(Request $request, $id)
    {
        $nota = nota::findOrFail($id);
        $nota->update($request->all());
        return response()->json($nota, 200);
    }

    public function delete($id)
    {
        $nota = nota::findOrFail($id);
        $nota->delete();

        return response()->json(null, 204);
    }
}
