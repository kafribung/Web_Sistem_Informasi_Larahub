<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import Class RequestPertanyaan
use App\Http\Requests\PertanyaanRequest;
// Import Class STR
use Illuminate\Support\Str;

// Import DB Pertanyaan
use App\Models\Pertanyaan;

use App\Models\Jawaban;
use Illuminate\Support\Facades\DB;
use Auth;

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

        $data['slug'] = Str::slug($request->title);

        $request->user()->pertanyaans()->create($data);

        return redirect('/pertanyaan')->with('status', 'Pertanyaan Berhasil ditampilkan');
    }

    // SHOW
    public function show($slug)
    {

        $pertanyaan = Pertanyaan::with('user', 'jawabans', 'komen_tanyas')->where('slug', $slug)->first();
      //dd($pertanyaan);
        return view('pages.pertanyaan_single', compact('pertanyaan'));
      
    }

    // EDIT
    public function edit($slug)
    {
        $pertanyaan = Pertanyaan::with('user')->where('slug', $slug)->first();

        // Seleksi jika bukan ownernya
        if (!$pertanyaan->author()) {
            return redirect('/pertanyaan')->with('status', 'Anda tidak memiliki akses');
        }

        return view('pages.pertanyaan_edit', compact('pertanyaan'));
    }

    // UPDATE
    public function update(PertanyaanRequest $request, $id)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->title);

        Pertanyaan::findOrFail($id)->update($data);

        return redirect('/pertanyaan')->with('status', 'Pertanyaan Berhasil diupdate');
    }

    // DELETE
    public function destroy($id)
    {
        Pertanyaans::destroy($id);

        return redirect('/pertanyaan')->with('status', 'Pertanyaan Berhasil dihapus');
    }



    public function vote(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $val = $request['nilai'];
        $msg = "";
        $nilai=0;

                
        $pq = 'select * from profil where user_id = '.$user_id;
        $resultpq = DB::select($pq);
        $reputasi =0;
        foreach ($resultpq as $rep) {
            $reputasi = $rep->reputasi;
        }
        if($reputasi==0 && $val==-1){
            return json_encode(array(
                // "obj"=>$data,
                "statusCode"=>200,
                "msg"=>'Reputasi Anda 0 maka tidak bisa untuk tidak menyukai Pertanyaan ini'
            ));
        }


        $query = 'select * from vote_tanya where user_id = '.$user_id.' and pertanyaan_id = '.$id;
        $result = DB::select($query);
        $nilai = 0;
        foreach ($result as $hasil) {
            $nilai = $hasil->nilai;
        }
       
        
        if($result!=null){
            if($val != $nilai ){
                $update = 'update vote_tanya set nilai = '.$val.' 
                            where user_id = '.$user_id.' and pertanyaan_id = '.$id;
                $result = DB::update($update);
                if($val==1){
                    $msg="Anda telah menyukai Pertanyaan ini";
                    $reput = $reputasi + 1;
                    $update = 'update profil set reputasi = '.$reput.' 
                                where user_id = '.$user_id;
                    $result = DB::update($update);
                    
                }else{
                    $reput = $reputasi - 1;
                    $update = 'update profil set reputasi = '.$reput.' 
                                where user_id = '.$user_id;
                    $result = DB::update($update);
                    $msg="Anda tidak menyukai Pertanyaan ini maka reputasi anda berkurang 1";
                }
            }else{
                if($val==1){
                    $msg="Anda telah menyukai Pertanyaan ini";
                }else{
                    $msg="Anda tidak menyukai Pertanyaan ini";
                }
            }
        }else{
            $insert = 'insert into vote_tanya (pertanyaan_id, user_id, nilai) 
                        values ('.$id.','.$user_id.','.$val.')';
            $result = DB::update($insert);

            if($val==1){
                $msg="Anda telah menyukai Pertanyaan ini";
            }else{
                $reput = $reputasi - 1;
                $update = 'update profil set reputasi = '.$reput.' 
                            where user_id = '.$user_id;
                $result = DB::update($update);
                $msg="Anda tidak menyukai Pertanyaan ini maka reputasi anda berkurang 1";
            }
        }
        

        $query2 = 'select sum(nilai) as hasil from vote_tanya where user_id = '.$user_id.' and pertanyaan_id = '.$id;
        $result = DB::select($query2);
        $nilai = 0;
        foreach ($result as $hasil) {
            $nilai = $hasil->hasil;
        }

        return json_encode(array(
            "nilai"=>$nilai,
            "statusCode"=>200,
            "msg"=>$msg
        ));
    }
}
