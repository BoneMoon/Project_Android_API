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
        return nota::find($id);
    }

    public function store(Request $request)
    {
        return nota::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $nota = nota::findOrFail($id);
        $nota->update($request->all());

        return $nota;
    }

    public function delete(Request $request, $id)
    {
        $nota = nota::findOrFail($id);
        $nota->delete();

        return 204;
    }
}
