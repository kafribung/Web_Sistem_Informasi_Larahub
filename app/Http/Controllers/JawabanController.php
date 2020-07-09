<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import DB Jawaban
use App\Models\Jawaban;
// Import DB Pertanyaan
use App\Models\Pertanyaan;

class JawabanController extends Controller
{
    // STORE
    public function store(Request $request, $id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);

        $data =  $request->validate([
            'description' => ['required'],
        ]);

        $data['pertanyaan_id'] = $id;

        $request->user()->jawabans()->create($data);

        return redirect('/pertanyaan/'. $pertanyaan->slug)->with('status', 'Jawaban berhasil ditambahkan');
    }

    // EDIT
    public function edit($id)
    {
        $jawaban = Jawaban::findOrFail($id);

        return view('pages.jawaban_edit', compact('jawaban'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {

        $jawaban = Jawaban::findOrFail($id);
        $data = $request->validate([
            'description' => ['required'],
        ]);

        Jawaban::findOrFail($id)->update($data);

        return redirect('/pertanyaan/'. $jawaban->pertanyaan->slug)->with('status', 'Jawaban berhasil diupdate');
    }

    // DELETE
    public function destory($id)
    {
        $jawaban = Jawaban::findOrFail($id);

        Jawaban::findOrFail($id)->delete();

        return redirect('/pertanyaan/'. $jawaban->pertanyaan->slug)->with('status', 'Jawaban berhasil dihapus');
    }

}
