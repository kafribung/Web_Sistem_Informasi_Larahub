<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import DB Jawaban
use App\Models\Jawaban;
// Import DB Pertanyaan
use App\Models\Pertanyaan;

class JawabanController extends Controller
{
    public function create($id)
    {
        $pertanyaan = Pertanyaan::with('user')->findOrFail($id);

        return view('pages.jawaban_create', compact('pertanyaan'));
    }

    public function store(Request $request, $id)
    {
        $data =  $request->validate([
            'description' => ['required']
        ]);

        $data['pertanyaan_id'] = $id;

        $request->user()->jawabans()->create($data);

        return redirect('/jawaban/'. $id)->with('status', 'Jawaban berhasil ditambahkan');
    }
}
