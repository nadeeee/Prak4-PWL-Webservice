<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class KomentarController extends Controller
{
    public function index(){
        return Komentar::select('id','name','email','comment')->get();
    }

    public function store(Request $request){
        $request->validate([
            'name',
            'email',
            'comment'=>'required'
        ]);

        try{
            Komentar::create($request->post());
            return response()->json([
                'message'=>'Komentar Berhasil di post'
            ], 201);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'message'=>'Ada kesalahan dalam pembuatan komentar'
            ],500);
        }
    }

    public function show(Komentar $komentar){
        return response()->json([
            'komentar'=>$komentar
        ]);
    }
}