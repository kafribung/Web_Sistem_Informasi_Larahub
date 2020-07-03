<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import Class RequestPertanyaan
use App\Http\Requests\PertanyaanRequest;

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
