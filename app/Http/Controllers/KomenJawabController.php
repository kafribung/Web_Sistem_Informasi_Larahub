<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jawaban;
use App\Models\KomenJawab;

class KomenJawabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $slug)
    {
        $jawaban = Jawaban::findOrFail($id);
        $data =  $request->validate([
            'description' => ['required'],
        ]);
        $data['jawaban_id'] = $id;
        $request->user()->komen_jawabs()->create($data);
        return redirect('/pertanyaan/'. $slug)->with('status', 'Komentar berhasil ditambahkan');
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
        $komenJawab = KomenJawab::findOrFail($id);
        $data = $request->validate([
            'description' => ['required'],
        ]);
        KomenJawab::findOrFail($id)->update($data);
        return json_encode(array(
            "obj"=>$data,
            "statusCode"=>200,
            "msg"=>"Data Berhasil di simpan"
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $komenkawab = KomenJawab::findOrFail($id);
        KomenJawab::findOrFail($id)->delete();

        return redirect('/pertanyaan/'. $komenkawab->jawaban->pertanyaan->slug)->with('status', 'Komentar berhasil dihapus');
    }
}
