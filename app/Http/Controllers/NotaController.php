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

    public function show(nota $nota)
    {
        return $nota;
    }

    public function store(Request $request)
    {
        $nota = nota::create($request->all());
        return response()->json($nota, 201);
    }

    public function update(Request $request, nota $nota)
    {
        $nota->update($request->all());

        return response()->json($nota, 200);
    }

    public function delete(nota $nota)
    {
        $nota->delete();

        return response()->json(null, 204);
    }
}
