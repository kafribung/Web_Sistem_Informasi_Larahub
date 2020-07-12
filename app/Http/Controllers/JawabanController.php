<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import DB Jawaban
use App\Models\Jawaban;
// Import DB Pertanyaan
use App\Models\Pertanyaan;
use Illuminate\Support\Facades\DB;
use Auth;

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

    public function vote(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $val = $request['nilai'];
        $msg = "";

                
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
                "msg"=>'Reputasi Anda 0 maka tidak bisa untuk tidak menyukai jawaban ini'
            ));
        }


        $query = 'select * from vote_jawab where user_id = '.$user_id.' and jawaban_id = '.$id;
        $result = DB::select($query);
        $nilai = 0;
        foreach ($result as $hasil) {
            $nilai = $hasil->nilai;
        }

   
       
        
        if($result!=null){
            if($val != $nilai ){
                $update = 'update vote_jawab set nilai = '.$val.' 
                            where user_id = '.$user_id.' and jawaban_id = '.$id;
                $result = DB::update($update);
                if($val==1){
                    $msg="Anda telah menyukai jawaban ini";
                    $reput = $reputasi + 1;
                    $update = 'update profil set reputasi = '.$reput.' 
                                where user_id = '.$user_id;
                    $result = DB::update($update);
                    
                }else{
                    $reput = $reputasi - 1;
                    $update = 'update profil set reputasi = '.$reput.' 
                                where user_id = '.$user_id;
                    $result = DB::update($update);
                    $msg="Anda tidak menyukai jawaban ini maka reputasi anda berkurang 1";
                }
            }else{
                if($val==1){
                    $msg="Anda telah menyukai jawaban ini";
                }else{
                    $msg="Anda tidak menyukai jawaban ini";
                }
            }
        }else{
            $insert = 'insert into vote_jawab (jawaban_id, user_id, nilai) 
                        values ('.$id.','.$user_id.','.$val.')';
            $result = DB::update($insert);

            if($val==1){

                


                $msg="Anda telah menyukai jawaban ini";
            }else{
                $reput = $reputasi - 1;
                $update = 'update profil set reputasi = '.$reput.' 
                            where user_id = '.$user_id;
                $result = DB::update($update);
                $msg="Anda tidak menyukai jawaban ini maka reputasi anda berkurang 1";
            }
        }
        

        $query2 = 'select sum(nilai) as hasil from vote_jawab where user_id = '.$user_id.' and jawaban_id = '.$id;
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
