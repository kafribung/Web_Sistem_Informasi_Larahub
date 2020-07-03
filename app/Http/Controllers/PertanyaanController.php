<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import Class RequestPertanyaan
use App\Http\Requests\PertanyaanRequest;
// Import Class STR
use Illuminate\Support\Str;

// Import DB Pertanyaan
use App\Models\Pertanyaan;

class PertanyaanController extends Controller
{
    // READ
    public function index()
    {
        $pertanyaans =  Pertanyaan::with('user')->latest()->get();

        return view('pages.pertanyaan', compact('pertanyaans'));
    }

    // CREATE
    public function create()
    {
        return view('pages.pertanyaan_create');
    }

    // STORE
    public function store(PertanyaanRequest $request)
    {
        $data = $request->all();

        $request->user()->pertanyaans()->create($data);

        return redirect('/pertanyaan')->with('status', 'Pertanyaan Berhasil ditampilkan');
    }

    // SHOW
    public function show($id)
    {
        $pertanyaan = Pertanyaan::with('user')->findOrFail($id);

        return view('pages.pertanyaan_single', compact('pertanyaan'));
    }

    // EDIT
    public function edit($id)
    {
        $pertanyaan = Pertanyaan::with('user')->findOrFail($id);

        return view('pages.pertanyaan_edit', compact('pertanyaan'));
    }

    // UPDATE
    public function update(PertanyaanRequest $request, $id)
    {
        $data = $request->all();

        Pertanyaan::findOrFail($id)->update($data);

        return redirect('/pertanyaan')->with('status', 'Pertanyaan Berhasil diperbaruhi');
    }

    // DELETE
    public function destroy($id)
    {
        Pertanyaans::destroy($id);

        return redirect('/pertanyaan')->with('status', 'Pertanyaan Berhasil dihapus');
    }
}
